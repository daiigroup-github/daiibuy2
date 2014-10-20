<?php

class AtechWindowController extends MasterMyFileController
{

	public function init(){
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/wizard.create.myfile.js');
		parent::init();
	}

	public function actionIndex()
	{
		$this->layout = '//layouts/cl1';

		$suppliers = array(
			'myfile1'=>'myfile1',
			'myfile2'=>'myfile2',
			'myfile3'=>'myfile3',
			'myfile4'=>'myfile4',
		);
		$this->render('index', array(
			'suppliers'=>$suppliers));
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
}
