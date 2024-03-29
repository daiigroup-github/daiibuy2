<?php

class MyfileController extends MasterBackofficeController
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
//		$model = $this->loadModel($id);
		$model = OrderGroup::model()->findByPk($id);
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
			}
			if(($_POST["action"] == "approve"))
			{
				$paymentDateTime = isset($_POST["paymentDateTime"]) ? $_POST["paymentDateTime"] : "-";
				$this->actionAdminDefinePaymentDateTime($id, $paymentDateTime);
			}
		}
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();
		$this->render('view', array(
			'model'=>$model,
			'pageText'=>$this->selectPageTitle($model),
			'daiibuy'=>$daiibuy,
			'token'=>$token,
		));
	}

	public function actionViewOrder($id)
	{
		$model = OrderGroup::model()->findByPk($id);
		$this->layout = '//layouts/print';
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();
		$this->render('view', array(
			'model'=>$model,
			'pageText'=>$this->selectPageTitle($model),
			'daiibuy'=>$daiibuy
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
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->checkSupplierAndAdminAccessMenu();
		$model = new Order('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Order']))
			$model->attributes = $_GET['Order'];

		if(Yii::app()->user->id != 0)
		{
			if(Yii::app()->user->supplierId != 4 && Yii::app()->user->supplierId != 5)
			{
				$serchFn = $model->findAllSupplierMyfile();
			}
			else
			{
				$this->redirect(array(
					"/backoffice/myfile/indexGinza"));
			}
		}
		else
		{
			$this->redirect(array(
				"/backoffice/login"));
		}

		$this->render('index', array(
			'model'=>$model,
			'searchFn'=>$serchFn));
	}

	public function actionIndexGinza()
	{
		$this->checkSupplierAndAdminAccessMenu();
		$model = new OrderGroup('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['Order']))
			$model->attributes = $_GET['Order'];

		if(Yii::app()->user->id != 0)
		{
			$serchFn = $model->findAllPayGinzaMyfile();
		}
		else
		{
			$this->redirect(array(
				"/backoffice/login"));
		}

		$this->render('index_ginza', array(
			'model'=>$model,
			'searchFn'=>$serchFn));
	}

	public function actionProve($id)
	{
		$model = $this->loadModel($id);
		$flag = true;
		if(isset($_POST["OrderItems"]))
		{
//            throw new Exception(print_r($_POST["OrderItems"], true));
			try
			{
				$transaction = Yii::app()->db->beginTransaction();
				if(Yii::app()->user->supplierId != 3):
					foreach($_POST["OrderItems"]["brandId"] as $k=> $v)
					{


						$orderItems = new OrderItems();
						$orderItems->orderId = $id;
						$orderItems->productId = $_POST["OrderItems"]["productId"][$k];
						if(isset($_POST["OrderItems"]["quantity"][$k]))
						{
							$orderItems->quantity = $_POST["OrderItems"]["quantity"][$k];
						}
						$orderItems->createDateTime = new CDbExpression("NOW()");
						$orderItems->updateDateTime = new CDbExpression("NOW()");


						if(!$orderItems->save(FALSE))
						{
							$flag = false;
							break;
						}
					}
				else:
					foreach($_POST["OrderItems"]["groupName"] as $k=> $v)
					{
						$orderItems = new OrderItems();
						$orderItems->orderId = $id;
						if(isset($_POST["OrderItems"]["groupName"][$k]))
						{
							$orderItems->groupName = $_POST["OrderItems"]["groupName"][$k];
						}
						if(isset($_POST["OrderItems"]["area"][$k]))
						{
							$orderItems->area = $_POST["OrderItems"]["area"][$k];
						}

						$orderItems->createDateTime = new CDbExpression("NOW()");
						$orderItems->updateDateTime = new CDbExpression("NOW()");


						if(!$orderItems->save(FALSE))
						{
							$flag = false;
							break;
						}
					}
				endif;
                //                throw new Exception(print_r($_POST, true));
                if (isset($_POST["OrderItems"]["category1Id"])) {
                    $category1Id = $_POST["OrderItems"]["category1Id"][$k];
                    $orderDetailModel = OrderDetail::model()->find('orderId = ' . $id);
                    $orderDetailValueModel = new OrderDetailValue();
                    $orderDetailValueModel->orderDetailId = $orderDetailModel->orderDetailId;
                    $orderDetailValueModel->orderDetailTemplateFieldId = 9;
                    $orderDetailValueModel->value = $category1Id;
                    $orderDetailValueModel->createDateTime = new CDbExpression("NOW()");
                    $orderDetailValueModel->updateDateTime = new CDbExpression("NOW()");
                    $orderDetailValueModel->save();
                }

//                throw new Exception(print_r($flag, true));
				if($flag)
				{
					$model->status = 1;
					if($model->save())
					{
						$transaction->commit();
						$this->redirect(array(
							"index"));
					}
				}
				else
				{
					$transaction->rollback();
				}
			}
			catch(Exception $ex)
			{
				if($flag)
				{
					$transaction->rollback();
				}
				throw new Exception($ex->getMessage());
			}
		}

		$this->render("view", array(
			'model'=>$model));
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
		$model = OrderGroup::model()->findByPk($id);
		$this->layout = '//layouts/print';
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();
		$this->render('view', array(
			'model'=>$model,
			'pageText'=>$this->selectPageTitle($model),
			'daiibuy'=>$daiibuy
		));
	}

	public function actionPrintPayForm($id)
	{
		$model = OrderGroup::model()->findByPk($id);
		$this->layout = '//layouts/print';
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();
		$this->render('view', array(
			'model'=>$model,
			'pageText'=>$this->selectPageTitle($model),
			'daiibuy'=>$daiibuy
		));
	}

	public function actionUserConfirmTransfer($id)
	{
		$order = OrderGroup::model()->findByPk($id);
		$orderFile = new OrderGroupFile();
		if(isset($order))
		{
			if(isset($_POST["OrderGroupFile"]))
			{
				$flag = TRUE;
				$transaction = Yii::app()->db->beginTransaction();
				try
				{
					$order->status = 2;
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
						$orderFile->attributes = $_POST["OrderGroupFile"];
						$orderFile->orderGroupId = $id;
						$orderFile->senderId = isset(Yii::app()->user->id) ? Yii::app()->user->id : 0;
						$orderFile->receiverId = -1;
						$orderFile->userType = isset(Yii::app()->user->userType) ? Yii::app()->user->userType : 0;
						$orderFile->createDateTime = $dateNow;
						$image = CUploadedFile::getInstanceByName("OrderGroupFile[filePath]");
						if(!empty($image))
						{
							$ran = rand(0, 999999);
							$imgType = explode(".", $image->name);
							$imgType = $imgType[count($imgType) - 1];
							$imageUrl = "images/orderFile/" . $order->orderGroupId . "/" . time() . '-' . $ran . "." . $imgType;
							$imagePath = '/../' . $imageUrl;
							$Img = $imageUrl;
//throw new Exception(Yii::app()->getBasePath().'/../'."images/userFile/$userId");
							if(!file_exists(Yii::app()->getBasePath() . '/../' . "images/orderFile/$order->orderGroupId"))
							{
								mkdir(Yii::app()->getBasePath() . '/../' . "images/orderFile/$order->orderGroupId", 0777);
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
						$emailObj->Setmail($order->userId, NULL, $order->supplierId, $order->orderGroupId, null, $documentUrl);
//						$sentMail->mailRequestApproveTranferToAdmin($emailObj);

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

	public function actionAdminDefinePaymentDateTime($id, $paymentDateTime)
	{
		$order = OrderGroup::model()->findByPk($id);
		if(isset($order))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$order->paymentDateTime = $paymentDateTime;
				if($order->save())
				{
					$transaction->commit();
					$this->redirect(Yii::app()->createUrl(isset($this->action->controller->module) ? "/" . $this->action->controller->module->id . "/order/adminApproveConfirmTransfer/id/" . $id : "" . "/order/adminApproveConfirmTransfer/id/" . $id));
				}
			}
			catch(Exception $exc)
			{
				$transaction->rollback();
				echo $exc->getTraceAsString();
			}
		}
	}

	public function actionAdminApproveConfirmTransfer($id)
	{
		$model = OrderGroup::model()->findByPk($id);
		$model->status = 3;
		$model->invoiceNo = OrderGroup::model()->genInvNo($model);
//			$model->paymentDateTime = new CDbExpression('NOW()');
		$transaction = Yii::app()->db->beginTransaction();
		try
		{
			if($model->userId <> 0)
			{
				$bahtToPoint = Configuration::model()->find('name = "bahtToPoint"')->value;
//			Order::model()->clearCollectedOrder($model->userId);
				if($bahtToPoint > 0)
				{
//					$model->isChangeToReward = 1;
					$systemBonus = Configuration::model()->getSystemMultiply();
					$point = floor(floatval(($model->total / $bahtToPoint) * $systemBonus->value));
					$userReward = new UserReward();
					$userReward->status = 1;
					$userReward->userId = $model->userId;
					$userReward->orderId = $model->orderGroupId;
					$userReward->points = $point;
					$userReward->remainingPoints = $point;
					$userReward->createDateTime = new CDbExpression('NOW()');
					$userReward->updateDateTime = new CDbExpression('NOW()');
//					$datetime = new DateTime('now');
					$configExpiredDate = Configuration::model()->getRewardExpiredDate();
//					$interval = new DateInterval('P' . $configExpiredDate->value . 'Y');
//					$userReward->expiredDate = $datetime->add($interval);
					$userReward->expiredDate = new CDbExpression('DATE_ADD(NOW(), INTERVAL ' . $configExpiredDate->value . ' YEAR)');
					if($userReward->save())
					{
						if($model->save())
						{
							$emailObj = new Email();
							$sentMail = new EmailSend();
							$documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/" . $id;
							$emailObj->Setmail($model->userId, null, $model->supplierId, $model->orderGroupId, null, $documentUrl);
//							$sentMail->mailCompleteOrderCustomer($emailObj);
//							$sentMail->mailConfirmOrderSupplierDealer($emailObj);
							$transaction->commit();
							$this->redirect(array(
								'index'));
						}
						else
						{
							$transaction->rollback();
						}
					}
					else
					{
						throw new Exception(print_r($userReward->errors, true));
						$transaction->rollback();
					}
//            $this->updateCollectedOrder($model);
//            $this->updateActiveReward($model->userId);
				}
				if($model->save())
				{
					$emailObj = new Email();
					$sentMail = new EmailSend();
					$documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/" . $id;
					$emailObj->Setmail($model->userId, null, $model->supplierId, $model->orderId, null, $documentUrl);
//					$sentMail->mailCompleteOrderCustomer($emailObj);
//					$sentMail->mailConfirmOrderSupplierDealer($emailObj);
					$transaction->commit();
					$this->redirect(array(
						'index'));
				}
			}
			else
			{
				if($model->save())
				{
					$emailObj = new Email();
					$sentMail = new EmailSend();
					$documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/" . $id;
					$emailObj->Setmail($model->userId, null, $model->supplierId, $model->orderGroupId, null, $documentUrl);
					$sentMail->mailCompleteOrderCustomer($emailObj);
					$sentMail->mailConfirmOrderSupplierDealer($emailObj);
					$transaction->commit();
					$this->redirect(array(
						'index'));
				}
			}
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
			$transaction->rollback();
		}
		$this->render("_confirm_transfer", array(
			'orderModel'=>$model));
	}

	public function actionAdminRejectConfirmTransfer($id, $remark)
	{
//		if (isset($_POST["remark"]))
//			$remark = $_POST["remark"];
		$model = OrderGroup::model()->findByPk($id);
		$user = User::model()->findByPk(Yii::app()->user->id);
		if(isset($model->remark))
		{
			$model->remark .= ",";
		}
		$model->remark .="{" . $user->firstname . " " . $user->lastname . "}-" . $model->status . ":" . $remark;
		$model->status = 1;
		$model->invoiceNo = null;
		$model->save();
		$emailObj = new Email();
		$sentMail = new EmailSend();
		$documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/" . $model->orderGroupId;
		$emailObj->Setmail($model->userId, NULL, $model->supplierId, $model->orderGroupId, null, $documentUrl, $remark);
		$sentMail->mailRejectConfirmTransferToCustomer($emailObj);

		$this->redirect(array(
			'index'));
	}

	public function actionSupplierShipping($id)
	{
		$order = OrderGroup::model()->findByPk($id);
		if(isset($order))
		{
			if(isset($_POST["OrderGroup"]["supplierShippingDateTime"]))
			{
				$flag = TRUE;
				$transaction = Yii::app()->db->beginTransaction();
				try
				{
					$order->status = 4;
					$order->supplierShippingDateTime = $_POST["OrderGroup"]["supplierShippingDateTime"];
					if(!$order->save())
					{
						$flag = FALSE;
						echo print_r($order->getErrors(), true);
					}

					if($flag)
					{
						$transaction->commit();
						$emailObj = new Email();
						$sentMail = new EmailSend();
						$documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/";
						$emailObj->Setmail($order->userId, NULL, $order->supplierId, $order->orderGroupId, null, $documentUrl);
//						$sentMail->mailReadyToShipProduct($emailObj);

						$this->redirect(array(
							'supplierShippingNotice',
							'id'=>$id));
					}
					else
					{
						$transaction->rollback();
					}
				}
				catch(Exception $exc)
				{
					$transaction->rollback();
					echo $exc->getMessage();
				}
			}
			else
			{
				$order->addError("supplierShippingDateTime", "กรุณาเลือกวัน และ เวลา ที่สินค้าจะส่งถึง ตัวแทนกระจากสินค้า");
			}

			$this->render("_supplier_shipping", array(
				"orderModel"=>$order
			));
		}
	}

	public function actionPrintProductList($id)
	{
		$model = OrderGroup::model()->findByPk($id);
		$this->layout = '//layouts/print';
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();
		$this->render('view', array(
			'model'=>$model,
			'pageText'=>$this->selectPageTitle($model),
			'daiibuy'=>$daiibuy
		));
	}

	public function actionSendWork($id)
	{
		$model = OrderGroup::model()->findByPk($id);
		$flag = TRUE;
		if(isset($_POST["OrderGroupSendWork"]))
		{
			try
			{
				$transaction = Yii::app()->db->beginTransaction();

				$i = 1;
				foreach($_POST["OrderGroupSendWork"] as $orderGroupId=> $seq)
				{


					foreach($seq as $index=> $obj)
					{
						if(isset($obj["title"]) && !empty($obj["title"]))
						{
							$oldImage = null;
							$sendWork = OrderGroupSendWork::model()->find("orderGroupId = $orderGroupId AND seq = $index");
							if(!isset($sendWork))
							{
								$sendWork = new OrderGroupSendWork();
							}
							else
							{
								$oldImage = $sendWork->image;
							}
							$sendWork->seq = $index;
							$sendWork->attributes = $obj;
							$folderimage = 'orderGroupSendWork';
							$image = CUploadedFile::getInstanceByName("OrderGroupSendWork[$orderGroupId][$index][image]");
							if(isset($image) && !empty($image))
							{
								$imgType = explode('.', $image->name);
								$imgType = $imgType[count($imgType) - 1];
								$imageUrl = '/images/' . $folderimage . '/' . time() . '-' . rand(0, 999999) . '.' . $imgType;
								$imagePathimage = '/../' . $imageUrl;
								$sendWork->image = $imageUrl;
							}
							else
							{
								if(!isset($oldImage))
								{
									$sendWork->image = null;
								}
								else
								{
									$sendWork->image = $oldImage;
								}
							}
							$sendWork->orderGroupId = $orderGroupId;
							$sendWork->createDateTime = new CDbExpression("now()");
							$sendWork->updateDateTime = new CDbExpression("now()");
							if(!$sendWork->save())
							{
								$flag = FALSE;
								throw new Exception(print_r($sendWork->errors, true));
							}
							else
							{
								if(isset($image) && !empty($image))
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
									$flag = true;
							}
							if(!$flag)
							{
								$transaction->rollback();
								break;
							}
						}
						else
						{
							continue;
						}
					}
				}
				if($flag)
				{
					$transaction->commit();
				}
			}
			catch(Exception $exc)
			{
				$transaction->rollback();
				echo $exc->getMessage();
			}
		}
		$this->render('send_work', array(
			'model'=>$model));
	}

}
