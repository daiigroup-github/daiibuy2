<?php

class MadridController extends MasterMyFileController
{

	public function init()
	{
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

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			/*
			  array('allow',  // allow all users to perform 'index' and 'view' actions
			  'actions'=>array('index','view'),
			  'users'=>array('*'),
			  ),
			  array('allow', // allow authenticated user to perform 'create' and 'update' actions
			  'actions'=>array('create','update'),
			  'users'=>array('@'),
			  ),
			  array('allow', // allow admin user to perform 'admin' and 'delete' actions
			  'actions'=>array('admin','delete'),
			  'users'=>array('admin'),
			  ),
			  array('deny',  // deny all users
			  'users'=>array('*'),
			  ),
			 */
		);

		/*
		  $result = array();
		  return CMap::mergeArray(parent::rules(), $result);
		 */
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout = '//layouts/cl1';
		$model = new Order;
		$orderDetailModel = new OrderDetail;
		$orderDetailModel->orderDetailTemplateId = OrderDetail::model()->getOrderDetailTemplateIdBySupplierId(3);
		$orderDetailTemplateField = OrderDetailTemplateField::model()->findAll('orderDetailTemplateId = ' . $orderDetailModel->orderDetailTemplateId . ' AND status = 1');
		$this->render('view', array(
			'model'=>$this->loadModel($id),
			'orderDetailTemplateField'=>$orderDetailTemplateField,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->layout = '//layouts/cl1';
		$model = new Order;
		$orderDetailModel = new OrderDetail;
		$orderDetailModel->orderDetailTemplateId = OrderDetail::model()->getOrderDetailTemplateIdBySupplierId(3);
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
		if(isset($_FILES['OrderFile']))
		{
//			$planFile = $_FILES['OrderFile'];
			try
			{
				if(isset($_POST['Order']))
				{
					$flag = false;
					$transaction = Yii::app()->db->beginTransaction();
					$model->attributes = $_POST['Order'];
					$model->type = 1;
					$model->status = 0;
					$model->supplierId = 3;
					$model->userId = Yii::app()->user->id;
					$model->createDateTime = new CDbExpression("NOW()");

					if($model->save())
					{
						$flag = TRUE;
						$orderId = Yii::app()->db->lastInsertID;
						$this->saveOrderDetail($orderId, $orderDetailModel->orderDetailTemplateId);
						$folderimage = "orderFile";

						for($i = 0; $i <= sizeof($_FILES["OrderFile"]); $i++)
						{
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
								$orderFileModel->createDateTime = new CDbExpression("NOW()");
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
								}
								else
								{
									$flag = FALSE;
									break;
								}
							}
						}

						if($flag)
						{
							foreach($_POST["OrderDetailValue"] as $k=> $v)
							{
								$orderFieldValue = new OrderDetailValue();
								$orderFieldValue->orderDetailTemplateFieldId = $k;
								$orderFieldValue->value = $v["value"];
								$orderFieldValue->orderDetailId = $this->orderDetailId;
								$orderFieldValue->createDateTime = new CDbExpression("NOW()");
								$orderFieldValue->updateDateTime = new CDbExpression("NOW()");
								if(!$orderFieldValue->save())
								{
									$flag = FALSE;
									break;
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
				'orderDetailTemplateField'=>$orderDetailTemplateField,
			));
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Order']))
		{
			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$model->attributes = $_POST['Order'];

				if($model->save())
				{
					$flag = true;
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
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
		}

		$this->render('update', array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
					'admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->layout = '//layouts/cl1';

		$myfileArray = Order::model()->findAllMyFileBySupplierId(isset(Yii::app()->user->id) ? Yii::app()->user->id : 0, 3, null);
		$this->render('index', array(
			'myfileArray'=>$myfileArray));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Order the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Order::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Order $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
