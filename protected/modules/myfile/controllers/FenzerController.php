<?php

class FenzerController extends MasterMyFileController
{

	public function init()
	{

		parent::init();
	}

	public function actionIndex()
	{
		$this->layout = '//layouts/cl1';

		$myfileArray = Order::model()->findAllMyFileBySupplierId(Yii::app()->user->id, 1, null);
		$this->render('index', array(
			'myfileArray'=>$myfileArray));
	}

	public function actionCreate()
	{
		$this->layout = '//layouts/cl1';

		$model = new Order;
		$orderDetailModel = new OrderDetail;
		$orderDetailModel->orderDetailTemplateId = OrderDetail::model()->getOrderDetailTemplateIdBySupplierId(1);
		$orderDetailTemplateField = OrderDetailTemplateField::model()->findAll('orderDetailTemplateId = ' . $orderDetailModel->orderDetailTemplateId . ' AND status = 1');
		foreach($orderDetailTemplateField as $field)
		{
			$heightField = $field;
		}
		$heightArray = array(
			'1.40-1.60'=>'1.40-1.60',
			'1.61-1.80'=>'1.61-1.80',
			'1.81-2.00'=>'1.81-2.00',
			'2.01-2.40'=>'2.01-2.40',
			'2.41-2.60'=>'2.41-2.60',
			'2.61-2.80'=>'2.61-2.80',
			'2.81-3.00'=>'2.81-3.00');

		// uncomment the following code to enable ajax-based validation
		/*
		  if(isset($_POST['ajax']) && $_POST['ajax']==='order-create-form')
		  {
		  echo CActiveForm::validate($model);
		  Yii::app()->end();
		  }
		 */

		if(isset($_POST['Order']))
		{
			$model->attributes = $_POST['Order'];
			$orderModel->type = 1;
			$orderModel->status = 1;

			if($model->save())
			{
				$this->redirect(array(
					'index'
				));
			}
		}
		else
		{
			$this->render('create', array(
				'model'=>$model,
				'orderDetailModel'=>$orderDetailModel,
				'orderDetailTemplateFieldArray'=>$orderDetailTemplateField,
				'heightArray'=>$heightArray,
			));
		}
	}

	public function actionShowFenzerProductResultByHeight()
	{
//		if(isset($value))
//		{
			$status = 1;

//			$brandModel = BrandModel::model()->find('supplierId = 1 AND status = 1');
//			$cate1Model = $brandModel->with('categorys')->findAll(
//				array('condition'=>'categorys.isRoot = 1 AND categorys.status = 1'
//					));

//			$categoryModel = Category::model()->findByPk($categoryId);
			if(isset($_POST['height']))
			{
				$value = $_POST['height'];
				$height = explode("-", $value);
			}
			$cate1Model = Category::model()->with('subCategorys')->findAll(
				array('condition'=>'subCategorys.status = 1 AND subCategorys.supplierId = 1 AND '
					. '(subCategorys.description > :minHeight AND subCategorys.description < :maxHeight)',
					'params'=>array(':minHeight'=>$height[0],
						':maxHeight'=>$height[1])
					));

//			$cate2Model = $cate1Model->with('subCategorys')->findAll(
//				array('condition'=>'subCategorys.status = 1 AND '
//					. '(subCategorys.description > :minHeight AND subCategorys.description < :maxHeight)',
//					'params'=>array(':minHeight'=>$height[0],
//						':maxHeight'=>$height[1])
//					));


			$productResult = Category::model()->findAll('supplierId = 1 AND status = 1 AND isRoot = 0 AND (description > ' . $height[0] . ' AND description < ' . $height[1] . ')');
			if(count($productResult) > 0)
			{
				echo $this->renderPartial('/fenzer/_product_result', array(
					'productResult'=>$productResult), TRUE, TRUE);
//				throw new Exception();
			}
			else
			{
				//throw new Exception();
				echo "<div class='text-center'>ไม่ค้นพบสินค้า.</div>";
			}
//		}
	}

	public function actionShowProductSelected()
	{
//		throw new Exception(print_r($_REQUEST, true));

		if(isset($_POST['categoryId']))
		{
			$categoryId = $_POST['categoryId'];
		}
		if(isset($categoryId))
		{
			$res = Category::model()->findByPk($categoryId);
			$planImage = $res->image;
			$image = $res->image;
			echo $this->renderPartial('/fenzer/_product_result_selected', array(
				'productResultSelected'=>$res,
				'planImage'=>$planImage,
				'image'=>$image), TRUE, TRUE);
		}
	}

	public function actionShowProductOrder()
	{
		$orderModel = new Order();
		$orderDetailTemplate = OrderDetailTemplate::model()->findOrderDetailTemplateBySupplierId(1);
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();
		$provinceId = $daiibuy->provinceId;
		$categoryId = $_POST['categoryId'];
		if(isset($_POST['height']))
		{
			$value = $_POST['height'];
			$height = explode("-", $value);
		}
		if(isset($_POST['length']) && !empty($_POST['length']))
		{
			$length = $_POST['length'];
		}
		$categoryModel = Category::model()->findByPk($categoryId);
//		$cate2 = $categoryModel->with('subCategorys')->findAll(
//				array('condition'=>'subCategorys.status = 1 AND '
//					. '(subCategorys.description > :minHeight AND subCategorys.description < :maxHeight)',
//					'params'=>array(':minHeight'=>$height[0],
//						':maxHeight'=>$height[1])
//					));
//		$productCate2 = $cate2[0]->subCategorys[0];

		if(!isset($length))
		{
			$length = 0;
		}
		$itemSetArray = Product::model()->calculateItemSetFenzer($categoryId, $length, $provinceId);

		echo $this->renderPartial('/fenzer/_edit_product_result', array(
				'productResult'=>$itemSetArray,
				),TRUE, TRUE);
	}

	public function actionAddNewProductItem(){
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();
		$provinceId = $daiibuy->provinceId;
		if(isset($_POST['productId']) && !empty($_POST['productId']))
		{
			$productId = $_POST['productId'];
		}
		$itemSetArray = Product::model()->calculateNewItemFenzer($productId,$provinceId);
		echo '<tr>'
		. '<td>'. $itemSetArray['item']['code'].'</td>'
		. '<td>'. $itemSetArray['item']['name'].'</td>'
			. '<td>'. $itemSetArray['item']['productUnits'].'</td>'
			. '<td>'. CHtml::textField('productItems['.$itemSetArray['item']['productId'].'][quantity]', $itemSetArray['item']['quantity'],array('class'=>'edit-table-qty-input')).'</td>'
			. '<td>'. $this->formatMoney($itemSetArray['item']['price']/$itemSetArray['item']['quantity'],true).'</td>'
			. '<td>'. $this->formatMoney($itemSetArray['item']['price'],true).'</td>'
			. '<td>'. $this->formatMoney(($itemSetArray['item']['price']/$itemSetArray['item']['quantity'])/3,true).'</td>'
			. '<td><button id="deleteRow" class="deleteRow btn btn-danger">remove</button></td>'
			. '</tr>';

		//echo CJSON::encode($itemSetArray);
//		$itemSetArray = Product::model()->calculateItemSetFenzer($categoryId, $length, $provinceId, $productId);
//		echo $this->renderPartial('/fenzer/_edit_product_result', array(
//				'productResult'=>$itemSetArray,
//				),TRUE, TRUE);

	}


	public function actionUpdatePrice(){
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();
		$provinceId = $daiibuy->provinceId;
		$productItems = array();
		if(isset($_POST['productItems']) && !empty($_POST['productItems']))
		{
			$productItems = $_POST['productItems'];
		}
		if(isset($_POST['length']) && !empty($_POST['length']))
		{
			$length = $_POST['length'];
		}else{
			$length = 0;
		}
		if(isset($_POST['categoryId']) && !empty($_POST['categoryId']))
		{
			$categoryId = $_POST['categoryId'];
		}
		if($length==0){
			$itemSetArray = Product::model()->calculateItemSetFenzerManualAndSave($categoryId,$productItems, $provinceId,$length,FALSE, NULL);
		}else{
		$itemSetArray = Product::model()->calculateItemSetFenzer($categoryId, $length, $provinceId);
		}

		echo $this->renderPartial('/fenzer/_edit_product_result', array(
				'productResult'=>$itemSetArray,
				),TRUE, TRUE);
	}

	public function actionSaveOrderMyFile(){
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();
		$provinceId = $daiibuy->provinceId;
		$productItems = array();
		$orderId = NULL;

		if(isset($_POST['productItems']) && !empty($_POST['productItems']))
		{
			$productItems = $_POST['productItems'];
		}
		if(isset($_POST['length']) && !empty($_POST['length']))
		{
			$length = $_POST['length'];
		}else{
			$length = 0;
		}
		if(isset($_POST['categoryId']) && !empty($_POST['categoryId']))
		{
			$categoryId = $_POST['categoryId'];
		}
		if(isset($_POST['orderId']) && !empty($_POST['orderId'])){
			$orderId = $_POST['orderId'];
		}
		$itemSetArray = Product::model()->calculateItemSetFenzerManualAndSave($categoryId,$productItems, $provinceId, $length, TRUE, $orderId);

		echo $this->renderPartial('/fenzer/_confirm_order_myfile', array(
				'productResult'=>$itemSetArray,
				),TRUE, TRUE);
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

	public function actionViews($id){
		$this->layout = '//layouts/cl1';

		$model = Order::model()->findByPk($id);

		$productItems = $this->prepareProductItems($model);

		if(isset($_POST['Order']))
		{
			$model->attributes = $_POST['Order'];
			$orderModel->type = 1;
			$orderModel->status = 1;

			if($model->save())
			{
				$this->redirect(array(
					'index'
				));
			}
		}
		else
		{
			$this->render('view', array(
				'model'=>$model,
				'productResult'=>$productItems,
			));
		}
	}

	public function findLengthHeigtByOrderId($orderId){
		$res = array();
		$orderDetail = OrderDetail::model()->find('orderId = '.$orderId);
		$orderDetailValues = OrderDetailValue::model()->findAll('orderDetailId = '.$orderDetail->orderDetailId);
		if(count($orderDetailValues)==0){
				$res['categoryId'] = 0;
				$res['height'] = 0;
				$res['length'] = 0;
		}else{
			foreach($orderDetailValues as $item){
				if($item->orderDetailTemplateFieldId == 1){
				$res['height'] = $item->value;
				}else if($item->orderDetailTemplateFieldId == 2){
					$res['length'] = $item->value;
				}else{
					$res['categoryId'] = $item->value;
				}
			}
		}

		return $res;
	}

	public function prepareProductItems($model){
		$res = array();
		$orderItems = $model->orderItems;
		$provinceId = $model->provinceId;
		$totalPrice = 0.00;
		$result = $this->findLengthHeigtByOrderId($model->orderId);
		$res['height'] = $result['height'];
		$res['length'] = $result['length'];
		$res['categoryId'] = $result['categoryId'];
		foreach($orderItems as $item){
			$productId = $item->productId;
			$product = Product::model()->findByPk($productId);

			//product
			$res['items'][$productId] = $product;

			//quantity
			$res['items'][$productId]['quantity'] = intval($item->quantity);
//			print_r($qty);

			//price
			$productPromotion = ProductPromotion::model()->find("productId=:productId AND ('" . date("Y-m-d") . "' BETWEEN dateStart AND dateEnd)", array(
			":productId"=>$productId));
			if(isset($productPromotion)){
				//promotion price
				$res['items'][$productId]['price'] = Product::model()->calProductPromotionTotalPrice($productId, $res['items'][$productId]['quantity'] ,$provinceId)*1;
			}else{
				//normal price
				$res['items'][$productId]['price'] = Product::model()->calProductTotalPrice($productId, $res['items'][$productId]['quantity'] ,$provinceId)*1;
			}
			$totalPrice = $totalPrice+$res['items'][$productId]['price'];
			$categoryId = $product->categoryId;
		}
		$res['totalPrice'] = $totalPrice;
		$res['orderId'] = $model->orderId;

		return $res;
	}

	public function actionAddToCart()
	{
		if(isset($_POST['orderId']) && !empty($_POST['orderId']))
		{
		$orderId = $_POST['orderId'];
		$model = Order::model()->findByPk($orderId);
		$model->type = 3;
			if($model->save()){
				echo 'success';
			}
		}
		echo 'fail';
	}
}
