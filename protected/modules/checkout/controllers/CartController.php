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

		$this->render('cart', array(
			'orders'=>$orders,
			'orderSummary'=>Order::model()->sumOrderTotalBySupplierId($id),
			'supplierId'=>$id,
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
