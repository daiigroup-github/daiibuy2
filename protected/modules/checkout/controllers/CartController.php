<?php

class CartController extends MasterCheckoutController
{

	public function actionIndex($id)
	{
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();

		$orders = array();

		if(isset(Yii::app()->user->id))
		{
			$orders = Order::model()->findAll(array(
				'condition'=>'type&' . Order::ORDER_TYPE_CART . ' > 0 AND userId=:userId AND supplierId=:supplierId',
				'params'=>array(
					':userId'=>Yii::app()->user->id,
					':supplierId'=>$id,
				),
				'order'=>'type, orderId'
			));
		}
		else
		{
			$orders = Order::model()->findAll(array(
				'condition'=>'type&' . Order::ORDER_TYPE_CART . ' > 0 AND token=:token AND supplierId=:supplierId',
				'params'=>array(
					':token'=>$daiibuy->token,
					':supplierId'=>$id,
				),
			));
		}

		$desc = array();
		if($id == 4)
		{
			if(isset($orders[0]))
			{
				$i = 0;
				$order = $orders[0];
                //                throw new Exception(print_r($order->orderItems, true));
                foreach($order->orderItems as $orderItem)
				{
//                    throw new Exception(print_r($orderItem->product->category2ToProducts, true));
					$category = isset($orderItem->product->category2ToProducts[1]) ? $orderItem->product->category2ToProducts[1]->category : $orderItem->product->category2ToProducts[0]->category;
					$category2 = isset($orderItem->product->category2ToProducts[1]) ? $orderItem->product->category2ToProducts[1]->category2 : $orderItem->product->category2ToProducts[0]->category2;
					$categoryToSub = CategoryToSub::model()->find(array(
						'condition'=>'categoryId=:categoryId AND subCategoryId=:subCategoryId',
						'params'=>array(
							':categoryId'=>$category->categoryId,
							':subCategoryId'=>$category2->categoryId
						)
					));
//					throw new Exception(print_r($category->categoryId . ", " . $category2->categoryId, true));

					$categoryStakeProvinceModel = CategoryStakeProvince::model()->find(array(
						'condition'=>'categoryId=:categoryId AND provinceId=:provinceId',
						'params'=>array(
							':categoryId'=>$category2->categoryId,
							':provinceId'=>$daiibuy->provinceId
						)
					));

//                $desc[$category->title . ' : ' . $category2->title] = str_replace('{{pile}}', $categoryStakeProvinceModel->stake, $category2->description);
					$desc[$i]['id'] = uniqid();
					$desc[$i]["title"] = $category->title . ' : ' . $category2->title;
					$desc[$i]['detail'] = str_replace('{{pile}}', isset($categoryStakeProvinceModel->stake) ? $categoryStakeProvinceModel->stake : "", isset($categoryToSub->payCondition) ? $categoryToSub->payCondition : "");
//					throw new Exception(print_r($desc[$i]['title'], true));
					$j=1;
					$category2ToProduct = isset($orderItem->product->category2ToProducts[1]) ? $orderItem->product->category2ToProducts[1] :$orderItem->product->category2ToProducts[0];
					$brandId = $category2ToProduct->brandId;
					$brandModelId = $category2ToProduct->brandModelId;
					$category1Id = $category2ToProduct->category1Id;
					$category2Id = $category2ToProduct->category2Id;

					$category2ToProducts = Category2ToProduct::model()->findAll(array(
						'condition'=>'brandId=:brandId and brandModelId=:brandModelId and category1Id=:category1Id and category2Id=:category2Id',
						'params'=>array(
							':brandId'=>$brandId,
							':brandModelId'=>$brandModelId,
							':category1Id'=>$category1Id,
							':category2Id'=>$category2Id,
						)
					));


					foreach ($category2ToProducts as $c2tp) {
						$desc[$i]['detail'] = str_replace("{{" . "price{$j}" . "}}", $c2tp->product->calProductPriceGinza($order->orderId), $desc[$i]['detail']);
                        $j++;
					}


                    $i++;
                                        
                }
			}
		}
        //        throw new Exception(print_r($desc, true));
		
		if ($id == 5)
		{
			$orderSummary = Order::model()->sumOrderTotalByProductIdAndQuantity(NULL, 0, $id, 100000, TRUE, NULL);
		}
		else
		{
			$orderSummary = Order::model()->sumOrderTotalBySupplierId($id);
		}
		$supplierModel = Supplier::model()->findByPk($id);
		$this->render('cart', array(
			'orders'=>$orders,
			'orderSummary'=>$orderSummary,
			'supplierId'=>$id,
            'supplierModel'=>$supplierModel,
			'desc'=>$desc
		));
	}

	public function actionCheckout($id)
	{
		Yii::app()->session['supplierId'] = $id;
		$this->redirect($this->createUrl('../checkout/step/1'));
	}

	public function actionUpdateCart()
	{
		if(isset($_POST['quantity']))
		{
			$res = [];

			foreach($_POST['quantity'] as $orderItemsId=> $quantity)
			{
				$orderItem = OrderItems::model()->findByPk($orderItemsId);

				if($orderItem->quantity == $quantity)
				{
					continue;
				}
				else
				{
					$orderItem->quantity = $quantity;
					$orderItem->total = $orderItem->quantity * $orderItem->price;
					$orderItem->save(FALSE);

					$res['orderItem'][$orderItem->orderItemsId]['total'] = number_format($orderItem->quantity * $orderItem->price, 2);
				}
			}

			$order = Order::model()->findByPk($_POST['orderId']);
			$order->totalIncVAT = $order->orderItemsSum;
			$order->save(false);
			$res['orderTotal'] = number_format($order->totalIncVAT, 2);
			$res['summary'] = $order->sumOrderTotalBySupplierId($order->supplierId);

			$this->writeToFile('/tmp/updatecart', print_r($res, true));
			echo CJSON::encode($res);
		}
	}

	public function actionDeleteCart($id)
	{
		$model = Order::model()->findByPk($id);
		$supplierId = $model->supplierId;
		if($model->type & 1 > 0)
		{
			$model->type = 1;
			$model->save(FALSE);
		}
		else
		{
			OrderItems::model()->deleteAll("orderId = " . $id);
			$model->delete();
		}
		$this->redirect(array(
			'index',
			"id"=>$supplierId));
	}

}
