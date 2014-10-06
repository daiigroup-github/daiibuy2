<?php

class OrderController extends MasterBackofficeController
{

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
	public function actionView($id, $token = null)
	{
		$model = $this->loadModel($id);
		if(!isset(Yii::app()->user->id) && $model->userId != 0)
		{
			Yii::app()->user->setReturnUrl(Yii::app()->createUrl('order/view/' . $id));
			$this->redirect(array(
				"site/login"));
		}
		if(isset($_POST["action"]))
		{
			if(($_POST["action"]) == "editReserve")
			{
				if($_POST["m1"] != "")
				{
					if($model->email == $_POST["m1"])
					{
						$this->actionEditReserveCustomer($id, $_POST["r1"], $_POST["r2"], $_POST["r3"]);
					}
					else
					{
						$model->addError('email', "E-mail ของท่านไม่ถูกต้อง");
					}
				}
				else
				{
					$model->addError('email', "กรุณากรอก E-mail เพื่อยืนยันการแก้ไขรายชื่อผู้รับสินค้าแทน.");
				}
			}
			if(($_POST["action"] == "return2"))
			{
				$remark2 = isset($_POST["remark2"]) ? $_POST["remark2"] : "-";
				$this->actionDistributorRejectProduct($id, $remark2);
			}
			if(($_POST["action"] == "return"))
			{
				$remark = isset($_POST["remark"]) ? $_POST["remark"] : "-";
				$this->actionAdminRejectConfirmTransfer($id, $remark);
//			$model->updateDateTime = new CDbExpression('NOW()');
//			$model->status = 3;
//			if ($model->save())
//			{
//
//				//save history
//				$productHistory = new ProductHistory();
//				$productHistory->userId = $model->supplierId;
//				$productHistory->productId = $model->productId;
//				$productHistory->description = "Return";
//				$productHistory->remark = isset($remark) ? $remark : null;
//				$productHistory->createDateTime = new CDbExpression('NOW()');
//				$productHistory->save();
//
//				//sent mail
//				$emailObj = new Email();
//				$sentMail = new EmailSend();
//				$emailObj->Setmail(NULL, null, $model->supplierId, null, $model->productId, null, $remark = null);
//				$sentMail->mailAddNewProductEdit($emailObj);
//		}
			}
		}
//		if (!isset(Yii::app()->user->id) || Yii::app()->user->id == 0)
//		{
//			$this->redirect(array(
//				"site/login"));
//		}
//		if (isset($_POST["remark"]))
//			$remark = $_POST["remark"];
//		if (isset($_POST["action"]))
//		{
//			$this->actionAdminRejectConfirmTransfer($id);
//		}


		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();
		$this->render('view', array(
			'model'=>$model,
			'daiibuy'=>$daiibuy,
			'token'=>$token,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Order;

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

		$this->render('create', array(
			'model'=>$model,
		));
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
	 * Lists all models.
	 */
	public function actionAdmin()
	{
		$dataProvider = new CActiveDataProvider('Order');
		$this->render('admin', array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{

		$model = new Order('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Order']))
			$model->attributes = $_GET['Order'];

		if(Yii::app()->user->id != 0)
		{
			$user = User::model()->findByPk(Yii::app()->user->id);
			if($user->type == 6)
				throw new CHttpException("คุณไม่สามารถดูรายการสั่งซื้อได้", 'เนื่องจากคุณเป็นสมาชิกประเภท Assign Admin');
			switch($user->type)
			{
				case 1:
					$serchFn = $model->findAllUserOrder();
					break;
				case 2:
					$serchFn = $model->findAllDealerOrder();
					break;
				case 3:
					$serchFn = $model->findAllSupplierOrder();
					break;
				case 4:
					$serchFn = $model->search();
					break;
				case 5:
					$serchFn = $model->findAllFinanceAdminOrder();
					break;
			}
		}
		else
		{
			$this->redirect(array(
				"/login"));
		}

		$this->render('index', array(
			'model'=>$model,
			'searchFn'=>$serchFn));
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
