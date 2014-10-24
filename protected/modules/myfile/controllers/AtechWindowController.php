<?php

class AtechWindowController extends MasterMyFileController
{

	public function init(){
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/vendor/jquery.ui.widget.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/jquery.iframe-transport.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/jquery.fileupload.js');
//		Yii::app()->clientScript->registerScrisptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/jquery.fileupload-process.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/jquery.fileupload-image.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/jquery.fileupload-audio.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/jquery.fileupload-video.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/jquery.fileupload-validate.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/main.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/jquery.blueimp-gallery.min.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/canvas-to-blob.min.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/load-image.all.min.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/tmpl.min.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/fileinput.js');
		Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/themes/homeshop/assets/css/fileinput.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/wizard.create.myfile.js');
		parent::init();
	}

	public function actionIndex()
	{
		$this->layout = '//layouts/cl1';

		$myfileArray = Order::model()->findAllMyFileBySupplierId(isset(Yii::app()->user->id) ? Yii::app()->user->id : 0, 2, null);
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
		// uncomment the following code to enable ajax-based validation
		/*
		  if(isset($_POST['ajax']) && $_POST['ajax']==='order-create-form')
		  {
		  echo CActiveForm::validate($model);
		  Yii::app()->end();
		  }
		 */
//		throw new Exception(print_r($_FILES['OrderFile'],true));
		if(isset($_FILES['OrderFile'])){
//			$planFile = $_FILES['OrderFile'];
		try{
			if(isset($_POST['Order']))
			{
				$flag = false;
				$transaction = Yii::app()->db->beginTransaction();
				$model->attributes = $_POST['Order'];
				$model->type = 1;
				$model->status = 0;
				$model->supplierId = 2;
				$model->userId = Yii::app()->user->id;
				$model->createDateTime = new CDbExpression("NOW()");

				if($model->save())
				{
					$folderimage = "orderFile";
					$orderId = Yii::app()->db->lastInsertID;
					for($i=0;$i<=sizeof($_FILES["OrderFile"]);$i++){
						$image = CUploadedFile::getInstanceByName("OrderFile[$i]");

						if(isset($image) && !empty($image))
						{
							$orderFileModel = new OrderFile();
							$imgType = explode('.', $image->name);
							$imgType = $imgType[count($imgType) - 1];
							$imageUrl = '/images/' . $folderimage . '/' . time() . '-' . rand(0, 999999) . '.' . $imgType;
							$imagePathimage = '/../' . $imageUrl;
							$orderFileModel->senderId = Yii::app()->user->id;
							$orderFileModel->filePath = $imageUrl;
							$orderFileModel->orderId = $orderId;
							$orderFileModel->fileName = $image->name;
							$orderFileModel->createDateTime =  new CDbExpression("NOW()");
							$orderFileModel->userType = 1;
							$orderFileModel->status = 1;
							if($orderFileModel->save())
							{
									if(!file_exists(Yii::app()->getBasePath() . '/../' . 'images/' . $folderimage))
									{
										mkdir(Yii::app()->getBasePath() . '/../' . 'images/' . $folderimage, 0777);
									}
									if($image->saveAs(Yii::app()->getBasePath() . $imagePathimage))
									{
										$flag = true;
									}
									else
									{
										$flag = false;
									}
							}else{
								throw new Exception(print_r($orderFileModel->error,TRUE));
							}
						}
					}
				}

				if($flag)
				{
					$transaction->commit();
					$this->redirect(array(
						'view',
						'id'=>$model->orderId));
						}
					else
						{
						$transaction->rollback();
						}
				}
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
		}
		else
		{
			$this->render('create', array(
				'model'=>$model,
//				'orderDetailModel'=>$orderDetailModel,
//				'orderDetailTemplateFieldArray'=>$orderDetailTemplateField,
			));
		}
	}

	public function actionView($id)
	{
		$this->layout = '//layouts/cl1';
		$this->render('view', array(
			'model'=>$this->loadModel($id),
		));
	}

	public function loadModel($id)
	{
		$model = Order::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

//
//	public function actionSaveTitleAndProvinceId(){
//		$model = new Order();
//		if(isset($_POST['title']) && !empty($_POST['title'])){
//			$model->title = $_POST['title'];
//		}
//		if(isset($_POST['provinceId']) && !empty($_POST['provinceId'])){
//			$model->provinceId = $_POST['provinceId'];
//		}
//		echo $this->renderPartial('/atechWindow/_upload_plan', array(
//				'model'=>$model,
//				),TRUE, TRUE);
//	}

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
