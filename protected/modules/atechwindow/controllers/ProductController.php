<?php

class ProductController extends MasterAtechwindowController
{

	public function actionIndex($id)
	{
		$product = array(
			'title'=>'Madrid Sanitary #1',
			'code'=>'PBS173',
			'category'=>'Sanitary',
			'stock'=>'20',
			'dimension'=>array(
				'w'=>100.00,
				'h'=>100.00,
				'l'=>100.00,
			),
			'weight'=>80.50,
			'price'=>300,
			'pricePromotion'=>280,
			'productId'=>1,
			'options'=>array(
				array(
					'option1'),
				array(
					'option2'),
			),
			'tabs'=>array(
				array(
					'title'=>'Description',
					'detail'=>'Detail Tab1'
				),
				array(
					'title'=>'Reviews',
					'detail'=>'Detail Tab2'
				),
				array(
					'title'=>'Comments',
					'detail'=>'Detail Tab3'
				),
			),
		);

		$this->render('index', array(
			'product'=>$product));
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

	public function actionSearchProductItems()
	{
		if(isset($_POST))
		{
			$res = '';
			$this->writeToFile('/tmp/searchproduct', print_r($_POST, true));

			$colors = array(
				'ALL',
				'White',
				'Brown',
				'Black',
				'Gray',
			);

			$products = Product::model()->findAllProductByWidthHeightCategory2Id($_POST['width'], $_POST['height'], $_POST['categoryId']);
			foreach($products as $product)
			{
				$category2ToProduct = Category2ToProduct::model()->find(array(
					'condition'=>'productId=:productId AND category2Id = :category2Id AND category1Id =:category1Id',
					'params'=>array(
						':productId'=>$product->productId,
						':category2Id'=>$_POST['categoryId'],
						':category1Id'=>$_POST['category1Id']
					),
				));

				$price = ($product->calProductPromotionPrice() != 0) ? $product->calProductPromotionPrice() : $product->calProductPrice();
				if(isset($category2ToProduct)):
					$res .= '<tr>' .
						'<td>' . (isset($category2ToProduct->brand) ? $category2ToProduct->brand->title : "") . "-" . (isset($category2ToProduct->brandModel) ? $category2ToProduct->brandModel->title : "") . '</td>' .
//						'<td>' . strtoupper($product->code) . '</td>' .
						'<td>' . $product->name . '</td>' .
						'<td>' . number_format($product->width, 0) . ' x ' . number_format($product->height, 0) . '</td>' .
//					'<td>' . $colors[rand(0, 4)] . '</td>' .
						'<td>' . number_format($price, 0) . '</td>' .
						'<td>' .
						'<div class="numeric-input full-width">' .
						'<input type="text" value="1" id="' . $product->productId . '" name="qty[' . $product->productId . ']"/>' .
						'<span class="arrow-up"><i class="icons icon-up-dir"></i></span>' .
						'<span class="arrow-down"><i class="icons icon-down-dir"></i></span>' .
						'</div>' .
						'</td>' .
						'<td><a class="btn btn-primary btn-md addToCart" data-productid="' . $product->productId . '"><i class="fa fa-shopping-cart"></i>เพิ่มลงตระกร้า</a>' .
						'<a class="btn btn-success btn-xs" href="' . Yii::app()->createUrl("/atechwindow/category/viewOtherProduct?id=" . $category2ToProduct->id) . '">ดูรายการอื่นๆ</a>' .
						'</td>' .
						'</tr>';
				endif;
			}

			echo $res;
		}
	}

	public function actionAddToCart()
	{
		$this->writeToFile('/tmp/atechAddToCart', print_r($_POST, true));

		$productId = $_POST['productId'];
		$qty = isset($_POST['qty']) ? $_POST['qty'] : 1;

		$supplier = Supplier::model()->find(array(
			'condition'=>'url=:url',
			'params'=>array(
				':url'=>$this->module->id),
		));

		$this->cookie = new DaiiBuy();
		$this->cookie->loadCookie();

		$orderModel = Order::model()->findByTokenAndSupplierId($this->cookie->token, $supplier->supplierId);
		$orderItem = OrderItems::model()->saveByOrderIdAndProductId($orderModel->orderId, $productId, $qty);

		$orderModel->totalIncVAT = $orderModel->orderItemsSum;
		$orderModel->save(false);

		echo CJSON::encode(array(
			'result'=>true));
	}

	public function actionAddToCartFromAtech()
	{
//		$this->writeToFile('/tmp/atechAddToCart', print_r($_POST, true));
//		throw new Exception(print_r($_GET['productId'],true));
		$productId = $_GET['productId'];
		$qty = 1;

		$supplier = Supplier::model()->find(array(
			'condition'=>'url=:url',
			'params'=>array(
				':url'=>$this->module->id),
		));

		$this->cookie = new DaiiBuy();
		$this->cookie->loadCookie();

		$orderModel = Order::model()->findByTokenAndSupplierId($this->cookie->token, $supplier->supplierId);
		$orderItem = OrderItems::model()->saveByOrderIdAndProductId($orderModel->orderId, $productId, $qty);
		$orderModel->provinceId = 1;
		$orderModel->totalIncVAT = $orderModel->orderItemsSum;
//		throw new Exception(print_r($orderModel,true));
		if($orderModel->save()){
			$this->redirect(Yii::app()->baseUrl.'/index.php/checkout/cart/index/id/2');
		}else{
			throw new Exception($orderModel->error,true);
		}
	}

}
