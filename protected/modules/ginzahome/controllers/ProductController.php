<?php

class ProductController extends MasterGinzahomeController
{

	/**
	 * @param $id = categoryId
	 * @param $id2 = subCategoryId
	 * @throws CException
	 */
	public function actionIndex($c, $c2)
	{
		$images = [];
//        foreach ($this->scanDir(Yii::app()->basePath . '/../images/ginzahome') as $k => $image) {
//            $images[$k] = Yii::app()->baseUrl . '/images/ginzahome/' . $image;
//        }

		$description = '
            <p>Grid systems are used for creating page layouts through a series of rows and columns that house your content. Here\'s how the Bootstrap grid system works:</p>
            <ul>
    <li>Rows must be placed within a <code>.container</code> (fixed-width) or <code>.container-fluid</code> (full-width) for proper alignment and padding.</li>
    <li>Use rows to create horizontal groups of columns.</li>
    <li>Content should be placed within columns, and only columns may be immediate children of rows.</li>
    <li>Predefined grid classes like <code>.row</code> and <code>.col-xs-4</code> are available for quickly making grid layouts. Less mixins can also be used for more semantic layouts.</li>
  </ul>
        ';

		$imageRow = array(
			array(
				'title'=>'Image Row 1',
				'maxItems'=>5,
				'images'=>array(
					'/images/ginzahome/1floor.jpg',
					'/images/ginzahome/1floor.jpg',
					'/images/ginzahome/1floor.jpg',
					'/images/ginzahome/1floor.jpg',
					'/images/ginzahome/1floor.jpg',
					'/images/ginzahome/1floor.jpg',
					'/images/ginzahome/1floor.jpg',
					'/images/ginzahome/1floor.jpg',
					'/images/ginzahome/1floor.jpg',
					'/images/ginzahome/1floor.jpg',
					'/images/ginzahome/1floor.jpg',
					'/images/ginzahome/1floor.jpg',
				),
			),
			array(
				'title'=>'Image Row 2',
				'images'=>array(
					'/images/ginzahome/2floor.jpg',
					'/images/ginzahome/2floor.jpg',
					'/images/ginzahome/2floor.jpg',
					'/images/ginzahome/2floor.jpg',
					'/images/ginzahome/2floor.jpg',
				),
			),
			array(
				'title'=>'Image Row 3',
				'maxItems'=>3,
				'images'=>array(
					'/images/ginzahome/1floor.jpg',
					'/images/ginzahome/2floor.jpg',
					'/images/ginzahome/1floor.jpg',
					'/images/ginzahome/2floor.jpg',
					'/images/ginzahome/1floor.jpg',
				),
			),
		);

		/*
		  $product = array(
		  'title' => 'Ginza 188C',
		  'code' => 'PBS173',
		  'category' => 'Sanitary',
		  'stock' => '20',
		  'dimension' => array(
		  'w' => 100.00,
		  'h' => 100.00,
		  'l' => 100.00,
		  ),
		  'weight' => 80.50,
		  'price' => 300,
		  'pricePromotion' => 280,
		  'productId' => 1,
		  'options' => array(
		  array('option1'),
		  array('option2'),
		  ),
		  'images' => $images,
		  'description' => $description,
		  'tabs' => array(
		  array(
		  'title' => 'รายละเอียด',
		  'detail' => $this->renderPartial('_tab_product_detail', array(), true)
		  ),
		  array(
		  'title' => 'Function',
		  'detail' => $this->renderPartial('_image_row', array('imageRow'=>$imageRow), true)
		  ),
		  array(
		  'title' => 'Design',
		  'detail' => $this->renderPartial('_image_gallery', array(), true).$this->renderPartial('_vdo', array(), true)
		  ),
		  array(
		  'title' => 'บ้านตัวอย่าง',
		  'detail' => $this->renderPartial('_reference', array(), true)
		  ),
		  array(
		  'title' => 'วิธีการชำระเงิน',
		  'detail' => 'Detail Tab3'
		  ),
		  ),
		  );
		 */

		$categoryToSub = CategoryToSub::model()->find(array(
			'condition'=>'categoryId=:categoryId AND subCategoryId=:subCategoryId',
			'params'=>array(
				':categoryId'=>$c,
				':subCategoryId'=>$c2,
			),
		));

		$category2ToProducts = Category2ToProduct::model()->findAll(array(
			'condition'=>'category1Id=:category1Id AND category2Id=:category2Id',
			'params'=>array(
				':category1Id'=>$c,
				':category2Id'=>$c2,
			),
			'order'=>'sortOrder'
		));

		$i = 0;
		$price = 0;
		$product = array();
		$productSortOrder1 = '';

		$allPrice = array();

		foreach($category2ToProducts as $category2ToProduct)
		{
			if($i == 0)
			{
				$imgIndex = 0;
				foreach($category2ToProduct->product->productImages as $img):
					$images[$imgIndex] = $img->image;
					$imgIndex++;
				endforeach;
			}
			$price += ($category2ToProduct->product->calProductPromotionPrice() > 0) ? $category2ToProduct->product->calProductPromotionPrice() : $category2ToProduct->product->calProductPrice();

			if($i == 0)
			{
				$bookingPrice = $price;
				$description = $category2ToProduct->product->description;
				$productSortOrder1 = $category2ToProduct->product;
			}

			$allPrice[$i] = $price;

			$i++;
		}

		$productOptionGroupModel = ProductOptionGroup::model()->find(array(
			'condition'=>'productId=:productId',
			'params'=>array(
				':productId'=>$productSortOrder1->productId
			)
		));

		if(isset($productOptionGroupModel->productOptions) && count($productOptionGroupModel->productOptions) > 0)
		{
			foreach($productOptionGroupModel->productOptions as $productOptionModel)
			{
				$images[$productOptionModel->productOptionId] = $productOptionModel->image;
			}
		}

		$tabs = array();
		$j = 0;

		$productOptionGroupDetails = ProductSpecGroup::model()->findAll('productId = ' . $productSortOrder1->productId . ' and parentId = 0 order by sortOrder');
		foreach ($productOptionGroupDetails as $detail)
		{
			$tabs[$j] = array(
				'id'=>$detail->productSpecGroupId,
				'title'=>$detail->title,
				'detail'=>$detail->description,
			);
			$j++;
		}
//
//        $options = array();
//        $k = 0;
//        foreach ($productSortOrder1->productOptionGroups as $productOptionGroup) {
//            $options[$k]['title'] = $productOptionGroup->title;
//            $option = array();
//            $l = 0;
//            foreach ($productOptionGroup->productOptions as $productOptions) {
//                $option[$l] = array();
//                $l++;
//            }
//
//            $k++;
//        }


		$this->render('index', array(
			'product'=>$product,
			'categoryToSub'=>$categoryToSub,
			'bookingPrice'=>$bookingPrice,
			'price'=>$price,
			'description'=>$description,
			'images'=>$images,
			'tabs'=>$tabs,
			'productSortOrder1'=>$productSortOrder1,
			'allPrice'=>$allPrice
		));
	}

	// Uncomment the following methods and override them if needed
	/*
	  public function filters()
	  {
	  // return the filter configuration for this controller, e.g.:
	  return array(
	  'inlineFilterName',
	  array(
	  'class'=>'path.to.FilterClass',
	  'propertyName'=>'propertyValue',
	  ),
	  );
	  }

	  public function actions()
	  {
	  // return external action classes, e.g.:
	  return array(
	  'action1'=>'path.to.ActionClass',
	  'action2'=>array(
	  'class'=>'path.to.AnotherActionClass',
	  'propertyName'=>'propertyValue',
	  ),
	  );
	  }
	 */

	public function actionAddToCart()
	{
		if(isset($_POST['productId']))
		{
//			throw new Exception(print_r(isset(Yii::app()->user->id),true));
			$res = array();
			$supplier = Supplier::model()->find(array(
				'condition'=>'url=:url',
				'params'=>array(
					':url'=>$this->module->id),
			));

			$this->cookie = new DaiiBuy();
			$this->cookie->loadCookie();

			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{

//				if(isset(Yii::app()->user->id))
//				{
//					$isAdd = Order::model()->isAddThisModel($_POST['productId'], $this->cookie->provinceId, Yii::app()->user->id);
//				}
//				else
//				{
//					$isAdd = Order::model()->isAddThisModel($_POST['productId'], $this->cookie->provinceId, NULL, $this->cookie->token);
//				}
//				if($isAdd)
//				{
				//code here
				$orderModel = Order::model()->findByTokenAndSupplierId($this->cookie->token, $supplier->supplierId);
				$flag = OrderItems::model()->saveByOrderIdAndProductId($orderModel->orderId, $_POST['productId'], $_POST['quantity'], $_POST["productOptionGroup"], $_POST["styleId"]);
//				}
//				$flag = true;
				if($flag)
				{
					$orderModel->totalIncVAT = $orderModel->orderItemsSum;
					$orderModel->save(false);

					$transaction->commit();
				}
				else
				{
					$transaction->rollback();
				}

				$res['result'] = $flag;
				echo CJSON::encode($res);
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
		}
	}

}
