<?php

class OrderController extends MasterMyFileController
{

	public $layout = '//layouts/cl1';

	public function actionIndex()
	{

		$model = new OrderGroup('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['OrderGroup']))
			$model->attributes = $_GET['OrderGroup'];

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
					$serchFn = $model->findAllUserOrder();
					break;
//				case 3:
//					$serchFn = $model->findAllSupplierOrder();
//					break;
//				case 4:
//					$serchFn = $model->search();
//					break;
//				case 5:
//					$serchFn = $model->findAllFinanceAdminOrder();
//					break;
			}
		}
		else
		{
			$this->redirect(array(
				"/site/login"));
		}

		$this->render('index', array(
			'model'=>$model,
			'searchFn'=>$serchFn));
	}

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

	public function selectPageTitle($model = null)
	{
		$user = User::model()->findByPk(Yii::app()->user->id);
//return Array to use in view.php
		$userOrder = User::model()->findByPk($model->userId);

		switch($user->type)
		{
			case 1://User
				return array(
					'1'=>array(
						'pageTitle'=>"ใบสั่งซื้อสินค้า/ใบแจ้งหนี้",
						'defaultStatus'=>'1',
						'optionButtonText'=>'ยืนยันชำระเงิน',
						'comfirmText'=>'ต้องการยืนยันโอนเงิน ?',
						'actionUrl'=>(isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/UserConfirmTransfer",
						'description'=>"รอการยืนยันโอนเงินจากลูกค้า"
					),
					'2'=>array(
						'pageTitle'=>"แบบร่างใบเสร็จรับเงิน",
						'defaultStatus'=>'2',
						'description'=>"รอตรวจสอบการโอนเงิน"
					),
					'3'=>array(
						'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
						'defaultStatus'=>'3',
						'description'=>"การสั่งซื้อสินค้าสมบูรณ์"
					),
					'4'=>array(
						'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
						'defaultStatus'=>'4',
						'description'=>"Supplier กำลังจัดส่งสินค้า",
						'optionButtonText3'=>' แก้ไขรายชื่อผู้รับสินค้าแทน',
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
					'1'=>(Yii::app()->user->userType == $userOrder->type) ? array(
						'pageTitle'=>"ใบสั่งซื้อสินค้า/ใบแจ้งหนี้",
						'defaultStatus'=>'1',
						'optionButtonText'=>'ยืนยันชำระเงิน',
						'comfirmText'=>'ต้องการยืนยันโอนเงิน ?',
						'actionUrl'=>(isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/UserConfirmTransfer",
						'description'=>"รอการยืนยันโอนเงินจากลูกค้า"
						) : array(
						'pageTitle'=>"แบบร่างใบสั่งซื้อสินค้า",
						'defaultStatus'=>'0',
						'description'=>"รอยืนยันการโอนเงินจากลูกค้า"
						),
					'2'=>array(
						'pageTitle'=>"แบบร่างใบสั่งซื้อสินค้า",
						'defaultStatus'=>'2',
						'description'=>"รอผู้ดูแลระบบยืนยันการโอนเงินจากลูกค้า"
					),
					'3'=>array(
						'pageTitle'=>"ใบสั่งซื้อสินค้า",
						'defaultStatus'=>'3',
						'description'=>"ลูกค้าชำระเงินเรียบร้อยแล้ว"
					),
					'4'=>$model->isSentToCustomer == 1 ? array(
						'pageTitle'=>"ใบส่งสินค้า",
						'defaultStatus'=>'4',
						'description'=>"รอผู้สั่งซื้อรับสินค้า",) : array(
						'pageTitle'=>"ใบส่งสินค้า",
						'defaultStatus'=>'4',
						'optionButtonText'=>'ยืนยันรับสินค้า',
						'comfirmText'=>'ต้องการยืนยันรับสินค้า?',
						'actionUrl'=>"order/DealerReceived",
						'optionButtonText2'=>'ตีกลับสินค้า',
						'description'=>"เมื่อสินค้าถูกส่งมาถึง กรุณาตรวจสอบความถูกต้องสมบูรณ์ของสินค้าก่อนรับสินค้า หากสินค้าแตกหักเสียหาย หรือไม่สมบูรณ์กรุณาส่งคืนแล้วกดปุ่ม 'ตีกลับสินค้า' หากตรวจสอบถูกต้องเรียบร้อยดีให้กดยืนยันรับสินค้า."
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
					'1'=>array(
						'pageTitle'=>"แบบร่างใบสั่งซื้อสินค้า",
						'defaultStatus'=>'1',
						'description'=>"รอยืนยันการโอนเงินจากลูกค้า"
					),
					'2'=>array(
						'pageTitle'=>"แบบร่างใบสั่งซื้อสินค้า",
						'defaultStatus'=>'2',
						'description'=>"รอผู้ดูแลระบบยืนยันการโอนเงิน"),
					'3'=>array(
						'pageTitle'=>"ใบสั่งซื้อสินค้า",
						'printText'=>"พิมพ์",
						'description'=>"รอจัดส่งสินค้า",
						'defaultStatus'=>'3',
						'optionButtonText'=>' ระบุวันจัดส่งสินค้า',
						'comfirmText'=>'ต้องการยืนยันส่งสินค้า ?',
						'actionUrl'=>(isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/SupplierShipping",
//							'optionButtonText2'=>' อัพโหลดใบกำกับภาษี',
//							'actionUrl2'=>"order/SupplierUploadFile",
					),
					'4'=>$model->isSentToCustomer == 1 ? array(
						'pageTitle'=>"ใบส่งสินค้า",
						'defaultStatus'=>'4',
						'description'=>"รอผู้สั่งซื้อรับสินค้า",
						'optionButtonText'=>'ส่งสินค้าเรียบร้อย',
						'comfirmText'=>'ต้องการยืนยันส่งสินค้าเรียบร้อย ?',
						'actionUrl'=>"order/ConfirmSentToCustomer") : array(
						'pageTitle'=>"ใบส่งสินค้า",
						'defaultStatus'=>'3',
						'description'=>"รอผู้สั่งซื้อรับสินค้า"),
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
					'1'=>array(
						'pageTitle'=>"แบบร่างใบสั่งซื้อสินค้า",
						'defaultStatus'=>'1',
						'description'=>"รอยืนยันการโอนเงินจากลูกค้า"
					),
					'2'=>array(
						'pageTitle'=>"ใบสั่งซื้อสินค้า",
						'defaultStatus'=>'2',
						'description'=>"รอยืนยันการโอนเงินจากผู้ดูแลระบบ"
					),
					'3'=>array(
						'pageTitle'=>"ใบสั่งซื้อสินค้า",
						'defaultStatus'=>'3',
						'description'=>"ลูกค้าชำระเงินเรียบร้อยแล้ว"
					),
					'4'=>array(
						'pageTitle'=>"ใบส่งสินค้า",
						'defaultStatus'=>'4',
						'description'=>"ผู้ผลิตกำลังจัดส่งสินค้า"),
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
					'1'=>array(
						'pageTitle'=>"ใบสั่งซื้อสินค้า",
						'defaultStatus'=>'1',
						'description'=>"รอยืนยันการโอนเงินจากลูกค้า"
					),
					'2'=>array(
						'pageTitle'=>"ใบสั่งซื้อสินค้า",
						'defaultStatus'=>'2',
//							'optionButtonText'=>'ยืนยันหลักฐานการโอนเงินถูกต้อง',
//							'comfirmText'=>'ต้องการยืนยัน ?',
//							'actionUrl'=>(isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/adminDefinePaymentDateTime",
//							'actionUrl'=>"order/adminApproveConfirmTransfer",
						'optionButtonTextCredit'=>'ยืนยันหลักฐานการโอนเงินถูกต้อง',
						'comfirmTextCredit'=>'ต้องการยืนยัน ?',
						'actionUrlCredit'=>(isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/adminApproveConfirmTransfer",
						'optionButtonText2'=>'ให้ผู้สั่งซื้อยืนยันโอนเงินอีกครั้ง',
						'comfirmText2'=>'ต้องการส่งกลับให้ผู้สั่งซื้อยืนยัน ?',
						'actionUrl2'=>(isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/adminRejectConfirmTransfer",
						'description'=>"ลูกค้ายืนยันการโอนเงินเรียบร้อยแล้ว"
					),
					'3'=>array(
						'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
						'defaultStatus'=>'3',
						'description'=>"ลูกค้าชำระเงินเรียบร้อยแล้ว"
					),
					'4'=>array(
						'pageTitle'=>"ใบเสร็จรับเงิน/ใบกำกับภาษี",
						'defaultStatus'=>'4',
						'description'=>"ผู้ผลิตสินค้าส่งสินค้าแล้ว"),
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

}
