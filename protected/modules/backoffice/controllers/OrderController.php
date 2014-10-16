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
			'pageText'=>$this->selectPageTitle($model),
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

	public function actionPrint($id)
	{
		$this->layout = '//layouts/print';
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();
		$this->render('view', array(
			'model'=>$this->loadModel($id),
			'pageText'=>$this->selectPageTitle($this->loadModel($id)),
			'daiibuy'=>$daiibuy
		));
	}

	public function actionPrintPayForm($id)
	{
		$this->layout = '//layouts/print';
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();
		$this->render('view', array(
			'model'=>$this->loadModel($id),
			'pageText'=>$this->selectPageTitle($this->loadModel($id)),
			'daiibuy'=>$daiibuy
		));
	}

	public function actionUserConfirmTransfer($id)
	{
		$order = Order::model()->findByPk($id);
		$orderFile = new OrderFile();
		if(isset($order))
		{
			if(isset($_POST["OrderFile"]))
			{
				$flag = TRUE;
				$transaction = Yii::app()->db->beginTransaction();
				try
				{
					$order->status = 1;
//$order->updateDateTime = new CDbExpression("NOW()");
					if(!$order->save())
					{
						$flag = FALSE;
					}
					else
					{
//						$oldFile = OrderFile::model()->findAll("orderId =:orderId AND userType=:userType", array(
//							":orderId" => $id,
//							":userType" => isset(Yii::app()->user->userType) ? Yii::app()->user->userType : 0));
//						if (count($oldFile) > 0) {
//							foreach ($oldFile as $item) {
////								$item->status = 0;
//								$item->save();
//							}
//						}
						$dateNow = new CDbExpression("NOW()");
						$orderFile->attributes = $_POST["OrderFile"];
						$orderFile->orderId = $id;
						$orderFile->senderId = isset(Yii::app()->user->id) ? Yii::app()->user->id : 0;
						$orderFile->receiverId = -1;
						$orderFile->userType = isset(Yii::app()->user->userType) ? Yii::app()->user->userType : 0;
						$orderFile->createDateTime = $dateNow;
						$image = CUploadedFile::getInstanceByName("OrderFile[filePath]");
						if(!empty($image))
						{
							$ran = rand(0, 999999);
							$imgType = explode(".", $image->name);
							$imgType = $imgType[count($imgType) - 1];
							$imageUrl = "images/orderFile/" . $order->orderId . "/" . time() . '-' . $ran . "." . $imgType;
							$imagePath = '/../' . $imageUrl;
							$Img = $imageUrl;
//throw new Exception(Yii::app()->getBasePath().'/../'."images/userFile/$userId");
							if(!file_exists(Yii::app()->getBasePath() . '/../' . "images/orderFile/$order->orderId"))
							{
								mkdir(Yii::app()->getBasePath() . '/../' . "images/orderFile/$order->orderId", 0777);
							}

							$image->saveAs(Yii::app()->getBasePath() . $imagePath);
							$orderFile->filePath = $Img;
						}
						else
						{
							$orderFile->filePath = null;
						}
						if(!$orderFile->save())
						{
							$flag = FALSE;
						}
					}

					if($flag)
					{
						$transaction->commit();
//Send Request Confirm Email to customer for Comfirm
						$emailObj = new Email();
						$sentMail = new EmailSend();
						$documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/";
						$emailObj->Setmail($order->userId, NULL, $order->supplierId, $order->orderId, null, $documentUrl);
						$sentMail->mailRequestApproveTranferToAdmin($emailObj);

						$this->redirect(array(
							"index"));
					}
					else
					{
						$transaction->rollback();
					}
				}
				catch(Exception $exc)
				{
					echo $exc->getTraceAsString();
					$transaction->rollback();
				}
			}

			$this->render("_confirm_transfer", array(
				"orderFileModel"=>$orderFile,
			));
		}
	}

	public function actionAdminDefinePaymentDateTime($id)
	{
		$order = Order::model()->findByPk($id);
		if(isset($order))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$order->paymentDateTime = $_POST['paymentDateTime'];
				if($order->save())
				{
					$transaction->commit();
				}
			}
			catch(Exception $exc)
			{
				$transaction->rollback();
				echo $exc->getTraceAsString();
			}
			$this->redirect(Yii::app()->createUrl(isset($this->action->controller->module) ? $this->action->controller->module : "" . "/order/adminApproveConfirmTransfer/" . $id));
		}
	}

	public function selectPageTitle($model = null)
	{
		$user = User::model()->findByPk(Yii::app()->user->id);
//return Array to use in view.php
		$userOrder = User::model()->findByPk($model->userId);

		if(isset($user->type))
		{
			switch($user->type)
			{
				case 1://User
					return array(
						'0'=>array(
							'pageTitle'=>"ใบสั่งซื้อสินค้า",
							'defaultStatus'=>'0',
							'optionButtonText'=>'ยืนยันชำระเงิน',
							'comfirmText'=>'ต้องการยืนยันโอนเงิน ?',
							'actionUrl'=>(isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/UserConfirmTransfer",
							'description'=>"รอการยืนยันโอนเงินจากลูกค้า"
						),
						'1'=>array(
							'pageTitle'=>"แบบร่างใบเสร็จรับเงิน",
							'defaultStatus'=>'1',
							'description'=>"รอตรวจสอบการโอนเงิน"
						),
						'2'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'2',
							'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
						),
						'3'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'3',
							'description'=>"Supplier กำลังจัดส่งสินค้า",
							'optionButtonText3'=>' แก้ไขรายชื่อผู้รับสินค้าแทน',
						),
						'4'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'4',
							'description'=>"คุณรับของแล้ว ขอบคุณที่ใช้บริการ!!!"
						),
						'5'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'5',
							'actionUrl'=>"order/UserConfirmFromMail",
							'optionButtonText'=>'ยืนยันรับสินค้า',
							'comfirmText'=>'ต้องการยืนยันรับสินค้า ?',
							'description'=>"กรุณาตรวจสอบสินค้าที่ได้รับและทำการยืนยันการรับสินค้าผ่าน E-mail."
						),
						'6'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'6',
							'description'=>"คุณยืนยันรับสินค้าแล้ว ขอบคุณที่ใช้บริการ!!!"
						),
						'7'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'7',
							'description'=>"กรุณาตรวจสอบสินค้าที่ได้รับและทำการยืนยันการรับสินค้าผ่าน E-mail."
						),
						'8'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'8',
							'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
						),
						'9'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'9',
							'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
						),
						'10'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'10',
							'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
						),
						'11'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'11',
							'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
						),
						'12'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'12',
							'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
						),
						'13'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'13',
							'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
						),
						'14'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'14',
							'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
						),
						'15'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'15',
							'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
						),
						'16'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'16',
							'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
						),
						'17'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'17',
							'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
						),
						'18'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'18',
							'description'=>"สามารถไปรับของที่ตัวแทนกระจายสินค้า"
						),
						'19'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'19',
							'description'=>"สินค้าถูกตีกลับรอส่งสินค้าใหม่"
						),
						'20'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'20',
							'description'=>"รอยืนยันรับสินค้าจาก Distributor"
						),
						'98'=>array(
							'pageTitle'=>"ใบสั่งซื้อสินค้า",
							'defaultStatus'=>'98',
							'description'=>"ระหว่างดำเนินการตรวจสอบเครดิต",
						),
						'99'=>array(
							'pageTitle'=>"แบบร่างใบสั่งซื้อสินค้า",
							'defaultStatus'=>'99'
						),
					);
					break;
				case 2://Dealer
					return array(
						'0'=>(Yii::app()->user->userType == $userOrder->type) ? array(
							'pageTitle'=>"ใบสั่งซื้อสินค้า",
							'defaultStatus'=>'0',
							'optionButtonText'=>'ยืนยันชำระเงิน',
							'comfirmText'=>'ต้องการยืนยันโอนเงิน ?',
							'actionUrl'=>"order/UserConfirmTransfer",
							'description'=>"รอการยืนยันโอนเงินจากลูกค้า"
							) : array(
							'pageTitle'=>"แบบร่างใบสั่งซื้อสินค้า",
							'defaultStatus'=>'0',
							'description'=>"รอยืนยันการโอนเงินจากลูกค้า"
							),
						'1'=>array(
							'pageTitle'=>"แบบร่างใบสั่งซื้อสินค้า",
							'defaultStatus'=>'1',
							'description'=>"รอผู้ดูแลระบบยืนยันการโอนเงินจากลูกค้า"
						),
						'2'=>array(
							'pageTitle'=>"ใบสั่งซื้อสินค้า",
							'defaultStatus'=>'2',
							'description'=>"ลูกค้าชำระเงินเรียบร้อยแล้ว"
						),
						'3'=>$model->isSentToCustomer == 1 ? array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'3',
							'description'=>"รอผู้สั่งซื้อรับสินค้า",) : array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'3',
							'optionButtonText'=>'ยืนยันรับสินค้า',
							'comfirmText'=>'ต้องการยืนยันรับสินค้า?',
							'actionUrl'=>"order/DealerReceived",
							'optionButtonText2'=>'ตีกลับสินค้า',
							'description'=>"เมื่อสินค้าถูกส่งมาถึง กรุณาตรวจสอบความถูกต้องสมบูรณ์ของสินค้าก่อนรับสินค้า หากสินค้าแตกหักเสียหาย หรือไม่สมบูรณ์กรุณาส่งคืนแล้วกดปุ่ม 'ตีกลับสินค้า' หากตรวจสอบถูกต้องเรียบร้อยดีให้กดยืนยันรับสินค้า."
							),
						'4'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'4',
							'description'=>"User ยืนยันรับของแล้ว สามารถอัพโหลดไฟล์ใบส่งของได้",
							'optionButtonText'=>'อัพโหลดไฟล์ยืนยันรับสินค้า',
							'comfirmText'=>'ต้องการยืนยันอัพโหลดไฟล์ ?',
							'actionUrl'=>"order/DealerUploadFile"),
						'5'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'5',
							'description'=>"User รอยืนยันทางอีเมล์ สามารถอัพโหลดไฟล์ใบส่งของได้",
							'optionButtonText'=>'อัพโหลดไฟล์ยืนยันรับสินค้า',
							'comfirmText'=>'ต้องการยืนยันอัพโหลดไฟล์ ?',
							'actionUrl'=>"order/DealerUploadFile"
						),
						'6'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'6',
							'description'=>"User ยืนยันทางอีเมล์แล้ว สามารถอัพโหลดไฟล์ใบส่งของได้",
							'optionButtonText'=>'อัพโหลดไฟล์ยืนยันรับสินค้า',
							'comfirmText'=>'ต้องการยืนยันอัพโหลดไฟล์ ?',
							'actionUrl'=>"order/DealerUploadFile"
						),
						'7'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'7',
							'description'=>"User ยืนยันทางอีเมล์แล้ว สามารถอัพโหลดไฟล์ใบส่งของได้",
							'optionButtonText'=>'อัพโหลดไฟล์ยืนยันรับสินค้า',
							'comfirmText'=>'ต้องการยืนยันอัพโหลดไฟล์ ?',
							'actionUrl'=>"order/DealerUploadFile"
						),
						'8'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'8',
							'description'=>"รอการอนุมัติจ่ายเงินของ ผู้ดูแลระบบ(การเงิน)"
						),
						'9'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'9',
							'description'=>'รอ ผู้ผลิตสินค้า อัพโหลดไฟล์ใหม่ '
						),
						'10'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'10',
							'description'=>"ผู้ดูแลระบบต้องการให้คุณอัพโหลดเอกสารใหม่",
							'optionButtonText'=>'อัพโหลดไฟล์ยืนยันรับสินค้าอีกครั้ง',
							'comfirmText'=>'ต้องการยืนยันอัพโหลดไฟล์ ?',
							'actionUrl'=>"order/DealerUploadFile"
						),
						'11'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'11',
							'description'=>"รอการอนุมัติจ่ายเงินของ ผู้ดูแลระบบ(การเงิน)"
						),
						'12'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'12',
							'description'=>"อนุมัติจ่ายผู้ผลิตแล้ว รออนุมัติจ่ายผู้กระจายสินค้า"
						),
						'13'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'13',
							'description'=>"อนุมัติจ่ายผู้กระจายสินค้าแล้ว รออนุมัติจ่ายผู้ผลิต"
						),
						'14'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'14',
							'description'=>"รอยืนยันการจ่ายเงินผู้ผลิตและผู้กระจายสินค้า"
						),
						'15'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'15',
							'description'=>"ยืนยันการจ่ายเงินผู้ผลิตแล้ว รอยืนยันผู้กระจายสินค้า"
						),
						'16'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'16',
							'description'=>"ยืนยันการจ่ายเงินผู้กระจายสินค้าแล้ว รอยืนยังผู้ผลิต"
						),
						'17'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'17',
							'description'=>"การซื้อขายเสร็จสมบูรณ์"
						),
						'18'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'18',
							'description'=>"ตัวแทนกระจายสินค้ารับของแล้ว",
							'optionButtonText'=>'จ่ายสินค้าให้ลูกค้า',
							'comfirmText'=>'ต้องการจ่ายสินค้าให้ลูกค้า?',
							'actionUrl'=>"order/UserReceived",
						),
						'19'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน",
							'defaultStatus'=>'19',
							'description'=>"สินค้าถูกตีกลับรอส่งสินค้าใหม่"
						),
						'20'=>array(
							'pageTitle'=>"ใบส่งของ",
							'defaultStatus'=>'20',
							'optionButtonText'=>'ยืนยันลูกค้ารับสินค้า',
							'comfirmText'=>'ต้องการยืนยันรับสินค้า?',
							'actionUrl'=>"order/ConfirmCustomerReceived",
							'description'=>"รอยืนยันรับสินค้า",
						),
						'98'=>array(
							'pageTitle'=>"ใบสั่งซื้อสินค้า",
							'defaultStatus'=>'98',
							'description'=>"ระหว่างดำเนินการตรวจสอบเครดิต",
						),
						'99'=>array(
							'pageTitle'=>"แบบร่างใบสั่งซื้อสินค้า",
							'defaultStatus'=>'99',
						),
					);
					break;
				case 3://supplier
					return array(
						'0'=>array(
							'pageTitle'=>"แบบร่างใบสั่งซื้อสินค้า",
							'defaultStatus'=>'0',
							'description'=>"รอยืนยันการโอนเงินจากลูกค้า"
						),
						'1'=>array(
							'pageTitle'=>"แบบร่างใบสั่งซื้อสินค้า",
							'defaultStatus'=>'1',
							'description'=>"รอผู้ดูแลระบบยืนยันการโอนเงิน"),
						'2'=>array(
							'pageTitle'=>"ใบสั่งซื้อสินค้า",
							'printText'=>"พิมพ์",
							'description'=>"รอจัดส่งสินค้า",
							'defaultStatus'=>'2',
							'optionButtonText'=>' ส่งสินค้า',
							'comfirmText'=>'ต้องการยืนยันส่งสินค้า ?',
							'actionUrl'=>"order/SupplierShipping",
							'optionButtonText2'=>' อัพโหลดใบกำกับภาษี',
							'actionUrl2'=>"order/SupplierUploadFile",),
						'3'=>$model->isSentToCustomer == 1 ? array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'3',
							'description'=>"รอผู้สั่งซื้อรับสินค้า",
							'optionButtonText'=>'ส่งสินค้าเรียบร้อย',
							'comfirmText'=>'ต้องการยืนยันส่งสินค้าเรียบร้อย ?',
							'actionUrl'=>"order/ConfirmSentToCustomer") : array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'3',
							'description'=>"รอผู้สั่งซื้อรับสินค้า"),
						'4'=>$model->isSentToCustomer == 1 ? array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'3',
							'description'=>"รอผู้สั่งซื้อรับสินค้า",
							'optionButtonText'=>'ส่งสินค้าเรียบร้อย',
							'comfirmText'=>'ต้องการยืนยันส่งสินค้าเรียบร้อย ?',
							'actionUrl'=>"order/ConfirmSentToCustomer") : array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'4',
							'description'=>"User ยืนยันรับของแล้ว สามารถอัพโหลดไฟล์ใบส่งของได้",
							'optionButtonText'=>'อัพโหลดไฟล์ยืนยันรับสินค้า',
							'comfirmText'=>'ต้องการยืนยันอัพโหลดไฟล์ ?',
							'actionUrl'=>"order/SupplierUploadFile"),
						'5'=>$model->isSentToCustomer == 1 ? array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'3',
							'description'=>"รอผู้สั่งซื้อรับสินค้า",
							'optionButtonText'=>'ส่งสินค้าเรียบร้อย',
							'comfirmText'=>'ต้องการยืนยันส่งสินค้าเรียบร้อย ?',
							'actionUrl'=>"order/ConfirmSentToCustomer") : array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'5',
							'description'=>"User รอยืนยันทางอีเมล์ สามารถอัพโหลดไฟล์ใบส่งของได้",
							'optionButtonText'=>'อัพโหลดไฟล์ยืนยันรับสินค้า',
							'comfirmText'=>'ต้องการยืนยันอัพโหลดไฟล์ ?',
							'actionUrl'=>"order/SupplierUploadFile"
							),
						'6'=>$model->isSentToCustomer == 1 ? array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'3',
							'description'=>"รอผู้สั่งซื้อรับสินค้า",
							'optionButtonText'=>'ส่งสินค้าเรียบร้อย',
							'comfirmText'=>'ต้องการยืนยันส่งสินค้าเรียบร้อย ?',
							'actionUrl'=>"order/ConfirmSentToCustomer") : array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'6',
							'description'=>"User ยืนยันทางอีเมล์แล้ว สามารถอัพโหลดไฟล์ใบส่งของได้",
							'optionButtonText'=>'อัพโหลดไฟล์ยืนยันรับสินค้า',
							'comfirmText'=>'ต้องการยืนยันอัพโหลดไฟล์ ?',
							'actionUrl'=>"order/SupplierUploadFile"
							),
						'7'=>$model->isSentToCustomer == 1 ? array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'3',
							'description'=>"รอผู้สั่งซื้อรับสินค้า",
							'optionButtonText'=>'ส่งสินค้าเรียบร้อย',
							'comfirmText'=>'ต้องการยืนยันส่งสินค้าเรียบร้อย ?',
							'actionUrl'=>"order/ConfirmSentToCustomer") : array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'7',
							'description'=>"User ยืนยันทางอีเมล์แล้ว สามารถอัพโหลดไฟล์ใบส่งของได้",
							'optionButtonText'=>'อัพโหลดไฟล์ยืนยันรับสินค้า',
							'comfirmText'=>'ต้องการยืนยันอัพโหลดไฟล์ ?',
							'actionUrl'=>"order/SupplierUploadFile"
							),
						'8'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'8',
							'description'=>"รอการอนุมัติจ่ายเงินของ ผู้ดูแลระบบ(การเงิน)"
						),
						'9'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'9',
							'description'=>"ผู้ดูแลระบบต้องการให้อัพโหลดเอกสารใหม่",
							'optionButtonText'=>'อัพโหลดไฟล์ยืนยันรับสินค้าอีกครั้ง',
							'comfirmText'=>'ต้องการยืนยันอัพโหลดไฟล์ ?',
							'actionUrl'=>"order/SupplierUploadFile"
						),
						'10'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'10',
							'description'=>'รอ ตัวแทนกระจายสินค้า อัพโหลดไฟล์ใหม่'
						),
						'11'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'11',
							'description'=>"รอการอนุมัติจ่ายเงินของ ผู้ดูแลระบบ(การเงิน)"
						),
						'12'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'12',
							'description'=>"อนุมัติจ่ายผู้ผลิตแล้ว รออนุมัติจ่ายผู้กระจายสินค้า"
						),
						'13'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'13',
							'description'=>"อนุมัติจ่ายผู้กระจายสินค้าแล้ว รออนุมัติจ่ายผู้ผลิต"
						),
						'14'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'14',
							'description'=>"รอยืนยันการจ่ายเงินผู้ผลิตและผู้กระจายสินค้า"
						),
						'15'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'15',
							'description'=>"ยืนยันการจ่ายเงินผู้ผลิตแล้ว รอยืนยันผู้กระจายสินค้า"
						),
						'16'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'16',
							'description'=>"ยืนยันการจ่ายเงินผู้กระจายสินค้าแล้ว รอยืนยังผู้ผลิต"
						),
						'17'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'17',
							'description'=>"การซื้อขายเสร็จสมบูรณ์"
						),
						'18'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'18',
							'description'=>"ตัวแทนกระจายสินค้ารับของแล้ว"
						),
						'19'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน",
							'defaultStatus'=>'19',
							'description'=>"สินค้าถูกตีกลับรอส่งสินค้าใหม่"
						),
						'20'=>$model->isSentToCustomer == 1 ? array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'3',
							'description'=>"รอลูกค้ายืนยันรับสินค้า") : array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'20',
							'description'=>"รอยืนยันรับสินค้าจาก Distributor",
							'optionButtonText'=>'อัพโหลดไฟล์ยืนยันรับสินค้า',
							'comfirmText'=>'ต้องการยืนยันอัพโหลดไฟล์ ?',
							'actionUrl'=>"order/SupplierUploadFile"
							),
						'98'=>array(
							'pageTitle'=>"ใบสั่งซื้อสินค้า",
							'defaultStatus'=>'98',
							'description'=>"ระหว่างดำเนินการตรวจสอบเครดิต",
						),
						'99'=>array(
							'pageTitle'=>"แบบร่างใบสั่งซื้อสินค้า",
							'defaultStatus'=>'99'
						)
					);
					break;
				case 4://Admin
					return array(
						'0'=>array(
							'pageTitle'=>"แบบร่างใบสั่งซื้อสินค้า",
							'defaultStatus'=>'0',
							'description'=>"รอยืนยันการโอนเงินจากลูกค้า"
						),
						'1'=>array(
							'pageTitle'=>"ใบสั่งซื้อสินค้า",
							'defaultStatus'=>'1',
							'description'=>"รอยืนยันการโอนเงินจากผู้ดูแลระบบ"
						),
						'2'=>array(
							'pageTitle'=>"ใบสั่งซื้อสินค้า",
							'defaultStatus'=>'2',
							'description'=>"ลูกค้าชำระเงินเรียบร้อยแล้ว"
						),
						'3'=>array(
							'pageTitle'=>"ใบส่งสินค้า",
							'defaultStatus'=>'3',
							'description'=>"ผู้ผลิตกำลังจัดส่งสินค้า"),
						'4'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'4',
							'description'=>"ลูกค้ารับสินค้าพร้อมยืนยันการรับสินค้าเรียบร้อยแล้ว"
						),
						'5'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'5',
							'description'=>"รอการยืนยันผ่าน Email ของลูกค้า"
						),
						'6'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'6',
							'description'=>"รอการยืนยันผ่าน Email ของลูกค้า"
						),
						'7'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'7',
							'description'=>"รอการยืนยันผ่าน Email ของลูกค้า"
						),
						'8'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'8',
							'description'=>"รอการอนุมัติจ่ายเงินของ ผู้ดูแลระบบ(การเงิน)"
						),
						'9'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'9',
							'description'=>"ให้ ผู้ผลิดสินค้า แนบเอกสารใหม่"
						),
						'10'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'10',
							'description'=>"ให้ ตัวแทนกระจายสินค้า แนบเอกสารใหม่"
						),
						'11'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'11',
							'description'=>"รอการอนุมัติจ่ายเงินของ ผู้ดูแลระบบ(การเงิน)"
						),
						'12'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'12',
							'description'=>"อนุมัติจ่ายผู้ผลิตแล้ว รออนุมัติจ่ายผู้กระจายสินค้า"
						),
						'13'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'13',
							'description'=>"อนุมัติจ่ายผู้กระจายสินค้าแล้ว รออนุมัติจ่ายผู้ผลิต"
						),
						'14'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'14',
							'description'=>"รอยืนยันการจ่ายเงินผู้ผลิตและผู้กระจายสินค้า"
						),
						'15'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'15',
							'description'=>"ยืนยันการจ่ายเงินผู้ผลิตแล้ว รอยืนยันผู้กระจายสินค้า"
						),
						'16'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'16',
							'description'=>"ยืนยันการจ่ายเงินผู้กระจายสินค้าแล้ว รอยืนยังผู้ผลิต"
						),
						'17'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'17',
							'description'=>"การซื้อขายเสร็จสมบูรณ์"
						),
						'18'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน",
							'defaultStatus'=>'18',
							'description'=>"สินค้าถึงตัวแทนกระจายสินค้าแล้ว"
						),
						'19'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน",
							'defaultStatus'=>'19',
							'description'=>"สินค้าถูกตีกลับรอส่งสินค้าใหม่"
						),
						'20'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน",
							'defaultStatus'=>'20',
							'description'=>"รอยืนยันรับสินค้าจาก Distributor"
						),
						'98'=>array(
							'pageTitle'=>"ใบสั่งซื้อสินค้า",
							'defaultStatus'=>'98',
							'description'=>"ระหว่างดำเนินการตรวจสอบเครดิต",
						),
						'99'=>array(
							'pageTitle'=>"แบบร่างใบสั่งซื้อสินค้า",
							'defaultStatus'=>'99',
							'optionButtonText'=>'ยืนยันหลักฐานการโอนเงินถูกต้อง',
							'comfirmText'=>'ต้องการยืนยัน ?',
							'actionUrl'=>"order/adminApproveConfirmTransfer",
						)
					);
					break;
				case 5://Finance
					return array(
						'0'=>array(
							'pageTitle'=>"ใบสั่งซื้อสินค้า",
							'defaultStatus'=>'0',
							'description'=>"รอยืนยันการโอนเงินจากลูกค้า"
						),
						'1'=>array(
							'pageTitle'=>"ใบสั่งซื้อสินค้า",
							'defaultStatus'=>'1',
							'optionButtonText'=>'ยืนยันหลักฐานการโอนเงินถูกต้อง',
							'comfirmText'=>'ต้องการยืนยัน ?',
							'actionUrl'=>(isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/adminDefinePaymentDateTime",
//							'actionUrl'=>"order/adminApproveConfirmTransfer",
							'optionButtonTextCredit'=>'ยืนยันหลักฐานการโอนเงินถูกต้อง',
							'comfirmTextCredit'=>'ต้องการยืนยัน ?',
							'actionUrlCredit'=>(isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/adminApproveConfirmTransfer",
							'optionButtonText2'=>'ให้ผู้สั่งซื้อยืนยันโอนเงินอีกครั้ง',
							'comfirmText2'=>'ต้องการส่งกลับให้ผู้สั่งซื้อยืนยัน ?',
							'actionUrl2'=>(isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/adminRejectConfirmTransfer",
							'description'=>"ลูกค้ายืนยันการโอนเงินเรียบร้อยแล้ว"
						),
						'2'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'2',
							'description'=>"ลูกค้าชำระเงินเรียบร้อยแล้ว"
						),
						'3'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'3',
							'description'=>"ผู้ผลิตสินค้าส่งสินค้าแล้ว"),
						'4'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'4',
							'description'=>"ลูกค้ารับสินค้าพร้อมยืนยันการรับสินค้าเรียบร้อยแล้ว"
						),
						'5'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'5',
							'description'=>"รอการยืนยันผ่าน Email ของลูกค้า"
						),
						'6'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'6',
							'description'=>"User ยืนยันทางอีเมล์แล้ว "
						),
						'7'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'7',
							'description'=>"รอการยืนยันผ่าน Email ของลูกค้า"
						),
						'8'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'8',
							'description'=>"รอการอนุมัติจ่ายเงินของ ผู้ดูแลระบบ(การเงิน)",
							//button 1
							'optionButtonText'=>'อนุมัติจ่ายเงินให้ Supplier & Distributor',
							'comfirmText'=>'ต้องการยืนยันการอนุมัติ ?',
							'actionUrl'=>"order/AdminApproveSupplierAndDealerFile",
							//button 2
							'optionButtonText2'=>'ให้ Supplier อัพโหลดไฟล์อีกครั้ง',
							'comfirmText2'=>'ต้องการส่งกลับให้ผู้สั่งซื้อยืนยัน ?',
							'actionUrl2'=>"order/AdminReturnSupplierFile",
							//button 3
							'optionButtonText3'=>'ให้ Distributor อัพโหลดไฟล์อีกครั้ง',
							'comfirmText3'=>'ต้องการส่งกลับให้ผู้สั่งซื้อยืนยัน ?',
							'actionUrl3'=>"order/AdminReturnDealerFile",
						),
						'9'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'9',
							'description'=>"ให้ ผู้ผลิดสินค้า แนบเอกสารใหม่"
						),
						'10'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'10',
							'description'=>"ให้ ตัวแทนกระจายสินค้า แนบเอกสารใหม่"
						),
						'11'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'11',
							'description'=>"รอการอนุมัติจ่ายเงินจาก ผู้ดูแลระบบ(การเงิน)"
						),
						'12'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'12',
							'description'=>"อนุมัติจ่ายผู้ผลิตแล้ว รออนุมัติจ่ายผู้กระจายสินค้า"
						),
						'13'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'13',
							'description'=>"อนุมัติจ่ายผู้กระจายสินค้าแล้ว รออนุมัติจ่ายผู้ผลิต"
						),
						'14'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'14',
							'description'=>"รอยืนยันการจ่ายเงินผู้ผลิตและผู้กระจายสินค้า"
						),
						'15'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'15',
							'description'=>"ยืนยันการจ่ายเงินผู้ผลิตแล้ว รอยืนยันผู้กระจายสินค้า"
						),
						'16'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'16',
							'description'=>"ยืนยันการจ่ายเงินผู้กระจายสินค้าแล้ว รอยืนยังผู้ผลิต"
						),
						'17'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'17',
							'description'=>"การซื้อขายเสร็จสมบูรณ์"
						),
						'18'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'18',
							'description'=>"สินค้าถึงตัวแทนกระจายสินค้าแล้ว"
						),
						'18'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'18',
							'description'=>"สินค้าถูกตีกลับรอส่งใหม่",
							'optionButtonText'=>'ส่งสินค้า',
							'comfirmText'=>'ต้องการยืนยันส่งสินค้า ?',
							'actionUrl'=>"order/SupplierShipping"),
						'19'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'19',
							'description'=>"สินค้าถูกตีกลับรอส่งสินค้าใหม่"
						),
						'20'=>array(
							'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
							'defaultStatus'=>'20',
							'description'=>"รอยืนยันรับสินค้าจาก Distributor"
						),
						'98'=>array(
							'pageTitle'=>"ใบสั่งซื้อสินค้า",
							'defaultStatus'=>'98',
							'optionButtonText'=>'ยืนยันเครดิตถูกต้อง',
							'comfirmText'=>'ต้องการยืนยัน ?',
							'actionUrl'=>"order/adminApproveConfirmTransfer",
							'optionButtonText2'=>'ให้ผู้สั่งซื้อยืนยันโอนเงินอีกครั้ง',
							'comfirmText2'=>'ตีกลับให้ลูกค้ายืนยันใหม่ ?',
							'actionUrl2'=>"order/adminRejectConfirmTransfer",
							'description'=>"ระหว่างดำเนินการตรวจสอบเครดิต",
						),
						'99'=>array(
							'pageTitle'=>"แบบร่างใบสั่งซื้อสินค้า",
							'defaultStatus'=>'99',
							'optionButtonText'=>'ยืนยันหลักฐานการโอนเงินถูกต้อง',
							'comfirmText'=>'ต้องการยืนยัน ?',
							'actionUrl'=>"order/adminApproveConfirmTransfer",
						)
					);
					break;
			}
		}
		else
		{
			return array(
				'0'=>array(
					'pageTitle'=>"ใบสั่งซื้อสินค้า",
					'defaultStatus'=>'0',
					'optionButtonText'=>'ยืนยันชำระเงิน',
					'comfirmText'=>'ต้องการยืนยันโอนเงิน ?',
					'actionUrl'=>"order/UserConfirmTransfer"
				),
				'1'=>array(
					'pageTitle'=>"แบบร่างใบเสร็จรับเงิน",
					'defaultStatus'=>'1',
					'description'=>"รอตรวจสอบการโอนเงิน"
				),
				'2'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'2',
					'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
				),
				'3'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'2',
					'description'=>"Supplier กำลังจัดส่งสินค้า"
				),
				'4'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน!!!",
					'defaultStatus'=>'4',
					'description'=>"คุณรับของแล้ว ขอบคุณที่ใช้บริการ!!!"
				),
				'5'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน.",
					'defaultStatus'=>'5',
					'actionUrl'=>"order/UserConfirmFromMail",
					'optionButtonText'=>'ยืนยันรับสินค้า',
					'comfirmText'=>'ต้องการยืนยันรับสินค้า ?',
					'description'=>"กรุณาตรวจสอบสินค้าที่ได้รับและทำการยืนยันการรับสินค้าผ่าน E-mail."
				),
				'6'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'6',
					'description'=>"คุณยืนยันรับสินค้าแล้ว ขอบคุณที่ใช้บริการ!!!"
				),
				'7'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'7',
					'description'=>"กรุณาตรวจสอบสินค้าที่ได้รับและทำการยืนยันการรับสินค้าผ่าน E-mail."
				),
				'8'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'8',
					'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
				),
				'9'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'9',
					'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
				),
				'10'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'10',
					'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
				),
				'11'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'11',
					'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
				),
				'12'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'12',
					'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
				),
				'13'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'13',
					'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
				),
				'14'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'14',
					'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
				),
				'15'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'15',
					'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
				),
				'16'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'16',
					'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
				),
				'17'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'17',
					'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
				),
				'18'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'18',
					'description'=>"สินค้าถึงตัวแทนกระจายสินค้าแล้ว"
				),
				'19'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'19',
					'description'=>"สินค้าถูกตีกลับรอส่งสินค้าใหม่"
				),
				'20'=>array(
					'pageTitle'=>"ใบเสร็จรับเงิน",
					'defaultStatus'=>'20',
					'description'=>"รอยืนยันรับสินค้าจาก Distributor"
				),
				'99'=>array(
					'pageTitle'=>"แบบร่างใบสั่งซื้อสินค้า",
					'defaultStatus'=>'99'
				),
			);
		}
	}

}
