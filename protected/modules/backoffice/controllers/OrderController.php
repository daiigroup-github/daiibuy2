<?php

class OrderController extends MasterBackofficeController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
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
    public function actionView($id, $token = null) {
//		$model = $this->loadModel($id);
        $model = OrderGroup::model()->findByPk($id);
//		if(!isset(Yii::app()->user->id) && $model->userId != 0)
//		{
//			Yii::app()->user->setReturnUrl(Yii::app()->createUrl('order/view/' . $id));
//			$this->redirect(array(
//				"site/login"));
//		}
        if (isset($_POST["action"])) {
            if (($_POST["action"]) == "editReserve") {
                if ($_POST["m1"] != "") {
                    if ($model->email == $_POST["m1"]) {
                        $this->actionEditReserveCustomer($id, $_POST["r1"], $_POST["r2"], $_POST["r3"]);
                    } else {
                        $model->addError('email', "E-mail ของท่านไม่ถูกต้อง");
                    }
                } else {
                    $model->addError('email', "กรุณากรอก E-mail เพื่อยืนยันการแก้ไขรายชื่อผู้รับสินค้าแทน.");
                }
            }
            if (($_POST["action"] == "return2")) {
                $remark2 = isset($_POST["remark2"]) ? $_POST["remark2"] : "-";
                $this->actionDistributorRejectProduct($id, $remark2);
            }
            if (($_POST["action"] == "return")) {
                $remark = isset($_POST["remark"]) ? $_POST["remark"] : "-";
                $this->actionAdminRejectConfirmTransfer($id, $remark);
            }
            if (($_POST["action"] == "approve")) {
                $paymentDateTime = isset($_POST["paymentDateTime"]) ? $_POST["paymentDateTime"] : "-";
                $this->actionAdminDefinePaymentDateTime($id, $paymentDateTime);
            }
        }
        $daiibuy = new DaiiBuy();
        $daiibuy->loadCookie();
        $this->render('view', array(
            'model' => $model,
            'pageText' => $this->selectPageTitle($model),
            'daiibuy' => $daiibuy,
            'token' => $token,
        ));
    }

    public function actionViewOrder($id) {
        $model = OrderGroup::model()->findByPk($id);
        $this->layout = '//layouts/print';
        $daiibuy = new DaiiBuy();
        $daiibuy->loadCookie();
        $this->render('view', array(
            'model' => $model,
            'pageText' => $this->selectPageTitle($model),
            'daiibuy' => $daiibuy
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Order;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Order'])) {
            $flag = false;
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $model->attributes = $_POST['Order'];

                if ($model->save()) {
                    $flag = true;
                }

                if ($flag) {
                    $transaction->commit();
                    $this->redirect(array(
                        'view',
                        'id' => $model->orderId));
                } else {
                    $transaction->rollback();
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
                $transaction->rollback();
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Order'])) {
            $flag = false;
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $model->attributes = $_POST['Order'];

                if ($model->save()) {
                    $flag = true;
                }

                if ($flag) {
                    $transaction->commit();
                    $this->redirect(array(
                        'view',
                        'id' => $model->orderId));
                } else {
                    $transaction->rollback();
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
                $transaction->rollback();
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
                        'admin'));
    }

    /**
     * Lists all models.
     */
    public function actionAdmin() {
        $dataProvider = new CActiveDataProvider('Order');
        $this->render('admin', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {

        $model = new OrderGroup('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['OrderGroup']))
            $model->attributes = $_GET['OrderGroup'];

        if (Yii::app()->user->id != 0) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            if ($user->type == 6)
                throw new CHttpException("คุณไม่สามารถดูรายการสั่งซื้อได้", 'เนื่องจากคุณเป็นสมาชิกประเภท Assign Admin');
            switch ($user->type) {
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
        } else {
            $this->redirect(array(
                "/backoffice/login"));
        }

        $this->render('index', array(
            'model' => $model,
            'searchFn' => $serchFn));
    }

    public function actionOrderHistory() {
        $model = new OrderGroup('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['OrderGroup']))
            $model->attributes = $_GET['OrderGroup'];

        if (Yii::app()->user->id != 0) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            if ($user->type != 5 && $user->type != 7)
                throw new CHttpException("คุณไม่สามารถเข้าถึงข้อมูลในส่วนนี้ได้", 'เนื่องจากคุณไม่ใช่ผู้ดูแลระบบ');
            $serchFn = $model->findAllFinanceAdminOrderPay();
        }
        else {
            $this->redirect(array(
                "//site/login"));
        }
        $this->render('orderHistory', array(
            'model' => $model,
            'searchFn' => $serchFn));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Order the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Order::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Order $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'order-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionPrint($id) {
        $model = OrderGroup::model()->findByPk($id);
        $this->layout = '//layouts/print';
        $daiibuy = new DaiiBuy();
        $daiibuy->loadCookie();
        $this->render('view', array(
            'model' => $model,
            'pageText' => $this->selectPageTitle($model),
            'daiibuy' => $daiibuy
        ));
    }

    public function actionPrintPayForm($id) {
        $model = OrderGroup::model()->findByPk($id);
        $this->layout = '//layouts/print';
        $daiibuy = new DaiiBuy();
        $daiibuy->loadCookie();
        $this->render('view', array(
            'model' => $model,
            'pageText' => $this->selectPageTitle($model),
            'daiibuy' => $daiibuy
        ));
    }

    public function actionUserConfirmTransfer($id) {
        $order = OrderGroup::model()->findByPk($id);
        $orderFile = new OrderGroupFile();
        if (isset($order)) {
            if (isset($_POST["OrderGroupFile"])) {
                $flag = TRUE;
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $order->status = 2;
//$order->updateDateTime = new CDbExpression("NOW()");
                    if (!$order->save()) {
                        $flag = FALSE;
                    } else {
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
                        if (!empty($image)) {
                            $ran = rand(0, 999999);
                            $imgType = explode(".", $image->name);
                            $imgType = $imgType[count($imgType) - 1];
                            $imageUrl = "images/orderFile/" . $order->orderGroupId . "/" . time() . '-' . $ran . "." . $imgType;
                            $imagePath = '/../' . $imageUrl;
                            $Img = $imageUrl;
//throw new Exception(Yii::app()->getBasePath().'/../'."images/userFile/$userId");
                            if (!file_exists(Yii::app()->getBasePath() . '/../' . "images/orderFile/$order->orderGroupId")) {
                                mkdir(Yii::app()->getBasePath() . '/../' . "images/orderFile/$order->orderGroupId", 0777);
                            }

                            $image->saveAs(Yii::app()->getBasePath() . $imagePath);
                            $orderFile->filePath = $Img;
                        } else {
                            $orderFile->filePath = null;
                        }
                        if (!$orderFile->save()) {
                            $flag = FALSE;
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
//Send Request Confirm Email to customer for Comfirm
                        $emailObj = new Email();
                        $sentMail = new EmailSend();
                        $documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/";
                        $emailObj->Setmail($order->userId, NULL, $order->supplierId, $order->orderGroupId, null, $documentUrl);
//						$sentMail->mailRequestApproveTranferToAdmin($emailObj);

                        $this->redirect(array(
                            "index"));
                    } else {
                        $transaction->rollback();
                    }
                } catch (Exception $exc) {
                    echo $exc->getTraceAsString();
                    $transaction->rollback();
                }
            }

            $this->render("_confirm_transfer", array(
                "orderFileModel" => $orderFile,
            ));
        }
    }

    public function actionAdminDefinePaymentDateTime($id, $paymentDateTime) {
//		throw new Exception(print_r(date_create($paymentDateTime),true));
        $order = OrderGroup::model()->findByPk($id);
        if (isset($order)) {
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $order->paymentDateTime = date_format(date_create($paymentDateTime), 'Y-m-d H:i:s');

                if ($order->save()) {
                    $transaction->commit();
                    $this->redirect(Yii::app()->createUrl(isset($this->action->controller->module) ? "/" . $this->action->controller->module->id . "/order/adminApproveConfirmTransfer/id/" . $id : "" . "/order/adminApproveConfirmTransfer/id/" . $id));
                }
            } catch (Exception $exc) {
                $transaction->rollback();
                echo $exc->getTraceAsString();
            }
        }
    }

    public function actionAdminApproveConfirmTransfer($id) {
        $model = OrderGroup::model()->findByPk($id);
        $model->status = 3;
        $model->invoiceNo = OrderGroup::model()->genInvNo($model);
//			$model->paymentDateTime = new CDbExpression('NOW()');
        $transaction = Yii::app()->db->beginTransaction();
        try {
            if ($model->userId <> 0) {
                $bahtToPoint = Configuration::model()->find('name = "bahtToPoint"')->value;
//			Order::model()->clearCollectedOrder($model->userId);
                if ($bahtToPoint > 0) {
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
                    if ($userReward->save()) {
                        if ($model->save()) {
                            $emailObj = new Email();
                            $sentMail = new EmailSend();
                            $documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/" . $id;
                            $emailObj->Setmail($model->userId, null, $model->supplierId, $model->orderGroupId, null, $documentUrl);
//							$sentMail->mailCompleteOrderCustomer($emailObj);
//							$sentMail->mailConfirmOrderSupplierDealer($emailObj);
                            $transaction->commit();
                            $this->redirect(array(
                                'index'));
                        } else {
                            $transaction->rollback();
                        }
                    } else {
                        throw new Exception(print_r($userReward->errors, true));
                        $transaction->rollback();
                    }
//            $this->updateCollectedOrder($model);
//            $this->updateActiveReward($model->userId);
                }
                if ($model->save()) {
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
            } else {
                if ($model->save()) {
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
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
            $transaction->rollback();
        }
        $this->render("_confirm_transfer", array(
            'orderModel' => $model));
    }

    public function actionAdminRejectConfirmTransfer($id, $remark) {
//		if (isset($_POST["remark"]))
//			$remark = $_POST["remark"];
        $model = OrderGroup::model()->findByPk($id);
        $user = User::model()->findByPk(Yii::app()->user->id);
        if (isset($model->remark)) {
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

    public function actionSupplierShipping($id) {
        $order = OrderGroup::model()->findByPk($id);
        if (isset($order)) {
            if (isset($_POST["OrderGroup"]["supplierShippingDateTime"])) {
                $flag = TRUE;
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $order->status = 4;
                    $order->supplierShippingDateTime = $_POST["OrderGroup"]["supplierShippingDateTime"];
                    if (!$order->save()) {
                        $flag = FALSE;
                        echo print_r($order->getErrors(), true);
                    }

                    if ($flag) {
                        $transaction->commit();
                        $emailObj = new Email();
                        $sentMail = new EmailSend();
                        $documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/";
                        $emailObj->Setmail($order->userId, NULL, $order->supplierId, $order->orderGroupId, null, $documentUrl);
//						$sentMail->mailReadyToShipProduct($emailObj);

                        $this->redirect(array(
                            'supplierShippingNotice',
                            'id' => $id));
                    } else {
                        $transaction->rollback();
                    }
                } catch (Exception $exc) {
                    $transaction->rollback();
                    echo $exc->getMessage();
                }
            } else {
                $order->addError("supplierShippingDateTime", "กรุณาเลือกวัน และ เวลา ที่สินค้าจะส่งถึง ตัวแทนกระจากสินค้า");
            }

            $this->render("_supplier_shipping", array(
                "orderModel" => $order
            ));
        }
    }

    public function actionSupplierShippingNotice($id) {
        $model = OrderGroup::model()->findByPk($id);
        $this->render("_supplier_shipping_notice", array(
            "model" => $model
        ));
    }

    public function actionPrintProductList($id) {
        $model = OrderGroup::model()->findByPk($id);
        $this->layout = '//layouts/print';
        $daiibuy = new DaiiBuy();
        $daiibuy->loadCookie();
        $this->render('view', array(
            'model' => $model,
            'pageText' => $this->selectPageTitle($model),
            'daiibuy' => $daiibuy
        ));
    }

    public function selectPageTitle($model = null) {
        $user = User::model()->findByPk(Yii::app()->user->id);
//return Array to use in view.php
        $userOrder = User::model()->findByPk($model->userId);

        switch ($user->type) {
            case 1://User
                return array(
                    '1' => array(
                        'pageTitle' => "ใบสั่งซื้อสินค้า",
                        'defaultStatus' => '1',
                        'optionButtonText' => 'ยืนยันชำระเงิน',
                        'comfirmText' => 'ต้องการยืนยันโอนเงิน ?',
                        'actionUrl' => (isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/UserConfirmTransfer",
                        'description' => "รอการยืนยันโอนเงินจากลูกค้า"
                    ),
                    '2' => array(
                        'pageTitle' => "แบบร่างใบเสร็จรับเงิน",
                        'defaultStatus' => '2',
                        'description' => "รอตรวจสอบการโอนเงิน"
                    ),
                    '3' => array(
                        'pageTitle' => "ใบเสร็จรับเงิน/ใบกำกับภาษี",
                        'defaultStatus' => '3',
                        'description' => "การสั่งซื้อสินค้าสมบูรณ์"
                    ),
                    '4' => array(
                        'pageTitle' => "ใบเสร็จรับเงิน/ใบกำกับภาษี",
                        'defaultStatus' => '4',
                        'description' => "Supplier กำลังจัดส่งสินค้า",
                        'optionButtonText3' => ' แก้ไขรายชื่อผู้รับสินค้าแทน',
                    ),
                    '98' => array(
                        'pageTitle' => "ใบสั่งซื้อสินค้า",
                        'defaultStatus' => '98',
                        'description' => "ระหว่างดำเนินการตรวจสอบเครดิต",
                    ),
                    '99' => array(
                        'pageTitle' => "แบบร่างใบสั่งซื้อสินค้า",
                        'defaultStatus' => '99'
                    ),
                );
                break;
            case 2://Dealer
                return array(
                    '1' => (Yii::app()->user->userType == $userOrder->type) ? array(
                        'pageTitle' => "ใบสั่งซื้อสินค้า",
                        'defaultStatus' => '1',
                        'optionButtonText' => 'ยืนยันชำระเงิน',
                        'comfirmText' => 'ต้องการยืนยันโอนเงิน ?',
                        'actionUrl' => "order/UserConfirmTransfer",
                        'description' => "รอการยืนยันโอนเงินจากลูกค้า"
                            ) : array(
                        'pageTitle' => "แบบร่างใบสั่งซื้อสินค้า",
                        'defaultStatus' => '0',
                        'description' => "รอยืนยันการโอนเงินจากลูกค้า"
                            ),
                    '2' => array(
                        'pageTitle' => "แบบร่างใบสั่งซื้อสินค้า",
                        'defaultStatus' => '2',
                        'description' => "รอผู้ดูแลระบบยืนยันการโอนเงินจากลูกค้า"
                    ),
                    '3' => array(
                        'pageTitle' => "ใบสั่งซื้อสินค้า",
                        'defaultStatus' => '3',
                        'description' => "ลูกค้าชำระเงินเรียบร้อยแล้ว"
                    ),
                    '4' => $model->isSentToCustomer == 1 ? array(
                        'pageTitle' => "ใบส่งสินค้า",
                        'defaultStatus' => '4',
                        'description' => "รอผู้สั่งซื้อรับสินค้า",) : array(
                        'pageTitle' => "ใบส่งสินค้า",
                        'defaultStatus' => '4',
                        'optionButtonText' => 'ยืนยันรับสินค้า',
                        'comfirmText' => 'ต้องการยืนยันรับสินค้า?',
                        'actionUrl' => "order/DealerReceived",
                        'optionButtonText2' => 'ตีกลับสินค้า',
                        'description' => "เมื่อสินค้าถูกส่งมาถึง กรุณาตรวจสอบความถูกต้องสมบูรณ์ของสินค้าก่อนรับสินค้า หากสินค้าแตกหักเสียหาย หรือไม่สมบูรณ์กรุณาส่งคืนแล้วกดปุ่ม 'ตีกลับสินค้า' หากตรวจสอบถูกต้องเรียบร้อยดีให้กดยืนยันรับสินค้า."
                            ),
                    '98' => array(
                        'pageTitle' => "ใบสั่งซื้อสินค้า",
                        'defaultStatus' => '98',
                        'description' => "ระหว่างดำเนินการตรวจสอบเครดิต",
                    ),
                    '99' => array(
                        'pageTitle' => "แบบร่างใบสั่งซื้อสินค้า",
                        'defaultStatus' => '99',
                    ),
                );
                break;
            case 3://supplier
                return array(
                    '1' => array(
                        'pageTitle' => "แบบร่างใบสั่งซื้อสินค้า",
                        'defaultStatus' => '1',
                        'description' => "รอยืนยันการโอนเงินจากลูกค้า"
                    ),
                    '2' => array(
                        'pageTitle' => "แบบร่างใบสั่งซื้อสินค้า",
                        'defaultStatus' => '2',
                        'description' => "รอผู้ดูแลระบบยืนยันการโอนเงิน"),
                    '3' => array(
                        'pageTitle' => "ใบสั่งซื้อสินค้า",
                        'printText' => "พิมพ์",
                        'description' => "รอจัดส่งสินค้า",
                        'defaultStatus' => '3',
                        'optionButtonText' => ' ระบุวันจัดส่งสินค้า',
                        'comfirmText' => 'ต้องการยืนยันส่งสินค้า ?',
                        'actionUrl' => (isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/SupplierShipping",
//							'optionButtonText2'=>' อัพโหลดใบกำกับภาษี',
//							'actionUrl2'=>"order/SupplierUploadFile",
                    ),
                    '4' => $model->isSentToCustomer == 1 ? array(
                        'pageTitle' => "ใบส่งสินค้า",
                        'defaultStatus' => '4',
                        'description' => "รอผู้สั่งซื้อรับสินค้า",
                        'optionButtonText' => 'ส่งสินค้าเรียบร้อย',
                        'comfirmText' => 'ต้องการยืนยันส่งสินค้าเรียบร้อย ?',
                        'actionUrl' => "order/ConfirmSentToCustomer") : array(
                        'pageTitle' => "ใบส่งสินค้า",
                        'defaultStatus' => '3',
                        'description' => "รอผู้สั่งซื้อรับสินค้า"),
                    '98' => array(
                        'pageTitle' => "ใบสั่งซื้อสินค้า",
                        'defaultStatus' => '98',
                        'description' => "ระหว่างดำเนินการตรวจสอบเครดิต",
                    ),
                    '99' => array(
                        'pageTitle' => "แบบร่างใบสั่งซื้อสินค้า",
                        'defaultStatus' => '99'
                    )
                );
                break;
            case 4://Admin
                return array(
                    '1' => array(
                        'pageTitle' => "แบบร่างใบสั่งซื้อสินค้า",
                        'defaultStatus' => '1',
                        'description' => "รอยืนยันการโอนเงินจากลูกค้า"
                    ),
                    '2' => array(
                        'pageTitle' => "ใบสั่งซื้อสินค้า",
                        'defaultStatus' => '2',
                        'description' => "รอยืนยันการโอนเงินจากผู้ดูแลระบบ"
                    ),
                    '3' => array(
                        'pageTitle' => "ใบสั่งซื้อสินค้า",
                        'defaultStatus' => '3',
                        'description' => "ลูกค้าชำระเงินเรียบร้อยแล้ว"
                    ),
                    '4' => array(
                        'pageTitle' => "ใบส่งสินค้า",
                        'defaultStatus' => '4',
                        'description' => "ผู้ผลิตกำลังจัดส่งสินค้า"),
                    '98' => array(
                        'pageTitle' => "ใบสั่งซื้อสินค้า",
                        'defaultStatus' => '98',
                        'description' => "ระหว่างดำเนินการตรวจสอบเครดิต",
                    ),
                    '99' => array(
                        'pageTitle' => "แบบร่างใบสั่งซื้อสินค้า",
                        'defaultStatus' => '99',
                        'optionButtonText' => 'ยืนยันหลักฐานการโอนเงินถูกต้อง',
                        'comfirmText' => 'ต้องการยืนยัน ?',
                        'actionUrl' => "order/adminApproveConfirmTransfer",
                    )
                );
                break;
            case 5://Finance
                return array(
                    '1' => array(
                        'pageTitle' => "ใบสั่งซื้อสินค้า",
                        'defaultStatus' => '1',
                        'description' => "รอยืนยันการโอนเงินจากลูกค้า"
                    ),
                    '2' => array(
                        'pageTitle' => "ใบสั่งซื้อสินค้า",
                        'defaultStatus' => '2',
//							'optionButtonText'=>'ยืนยันหลักฐานการโอนเงินถูกต้อง',
//							'comfirmText'=>'ต้องการยืนยัน ?',
//							'actionUrl'=>(isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/adminDefinePaymentDateTime",
//							'actionUrl'=>"order/adminApproveConfirmTransfer",
                        'optionButtonTextCredit' => 'ยืนยันหลักฐานการโอนเงินถูกต้อง',
                        'comfirmTextCredit' => 'ต้องการยืนยัน ?',
                        'actionUrlCredit' => (isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/adminApproveConfirmTransfer",
                        'optionButtonText2' => 'ให้ผู้สั่งซื้อยืนยันโอนเงินอีกครั้ง',
                        'comfirmText2' => 'ต้องการส่งกลับให้ผู้สั่งซื้อยืนยัน ?',
                        'actionUrl2' => (isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/adminRejectConfirmTransfer",
                        'description' => "ลูกค้ายืนยันการโอนเงินเรียบร้อยแล้ว"
                    ),
                    '3' => array(
                        'pageTitle' => "ใบเสร็จรับเงิน/ใบกำกับภาษี",
                        'defaultStatus' => '3',
                        'description' => "ลูกค้าชำระเงินเรียบร้อยแล้ว"
                    ),
                    '4' => array(
                        'pageTitle' => "ใบเสร็จรับเงิน/ใบกำกับภาษี",
                        'defaultStatus' => '4',
                        'description' => "ผู้ผลิตสินค้าส่งสินค้าแล้ว"),
                    '98' => array(
                        'pageTitle' => "ใบสั่งซื้อสินค้า",
                        'defaultStatus' => '98',
                        'optionButtonText' => 'ยืนยันเครดิตถูกต้อง',
                        'comfirmText' => 'ต้องการยืนยัน ?',
                        'actionUrl' => "order/adminApproveConfirmTransfer",
                        'optionButtonText2' => 'ให้ผู้สั่งซื้อยืนยันโอนเงินอีกครั้ง',
                        'comfirmText2' => 'ตีกลับให้ลูกค้ายืนยันใหม่ ?',
                        'actionUrl2' => "order/adminRejectConfirmTransfer",
                        'description' => "ระหว่างดำเนินการตรวจสอบเครดิต",
                    ),
                    '99' => array(
                        'pageTitle' => "แบบร่างใบสั่งซื้อสินค้า",
                        'defaultStatus' => '99',
                        'optionButtonText' => 'ยืนยันหลักฐานการโอนเงินถูกต้อง',
                        'comfirmText' => 'ต้องการยืนยัน ?',
                        'actionUrl' => "order/adminApproveConfirmTransfer",
                    )
                );
                break;
        }
    }

    public function actionFindAllModelByBrandIdAjax() {
        $data = BrandModel::model()->findAll('brandId=:brandId', array(
            ':brandId' => (int) $_POST['brandId']));

//		$result = array(
//			);
        echo CHtml::tag('option', array(
            'value' => ''), CHtml::encode("-- Select Model --"), true);
        foreach ($data as $item) {
//			$result[$item->brandModelId] = $item->title;
            echo CHtml::tag('option', array(
                'value' => $item->brandModelId), CHtml::encode($item->title), true);
        }
//		echo CJSON::encode($result);
    }

    public function actionFindAllCat1ByBrandModelIdAjax() {
        $data = ModelToCategory1::model()->findAll('brandModelId=:brandModelId', array(
            ':brandModelId' => (int) $_POST['brandModelId']));
//		$result = array(
//			);
        echo CHtml::tag('option', array(
            'value' => ''), CHtml::encode("-- Select Cat1 --"), true);
        foreach ($data as $item) {
//			$result[$item->brandModelId] = $item->title;
            echo CHtml::tag('option', array(
                'value' => $item->categoryId), CHtml::encode(isset($item->category) ? $item->category->title : ""), true);
        }
//		echo CJSON::encode($result);
    }

    public function actionFindAllCat2AndProductByBrandCat1IdAjax() {
        $data = CategoryToSub::model()->findAll('categoryId=:categoryId', array(
            ':categoryId' => (int) $_POST['cat1Id']));
//		$result = array(
//			);
        echo CHtml::tag('option', array(
            'value' => ''), CHtml::encode("-- Select Cat2 --"), true);
        foreach ($data as $item) {
//			$result[$item->brandModelId] = $item->title;
            echo CHtml::tag('option', array(
                'value' => $item->subCategoryId), CHtml::encode(isset($item->subCategory) ? $item->subCategory->title : ""), true);
        }
//		echo CJSON::encode($result);
    }

    public function actionFindAllProductInCat2Cat1IdAjax() {
        $data = Category2ToProduct::model()->findAll('category1Id=:category1Id', array(
            ':category1Id' => (int) $_POST['cat1Id']));
//		$result = array(
//			);
        echo CHtml::tag('option', array(
            'value' => ''), CHtml::encode("-- Select Cat2 --"), true);
        foreach ($data as $item) {
//			$result[$item->brandModelId] = $item->title;
            echo CHtml::tag('option', array(
                'value' => $item->productId), CHtml::encode(isset($item->product) ? $item->product->name : ""), true);
        }
//		echo CJSON::encode($result);
    }

    public function actionFindAllProductByCat1IdAjax() {
        $data = Category2ToProduct::model()->findAll('category1Id=:category1Id', array(
            ':category1Id' => (int) $_POST['cat1Id']));
//		$result = array(
//			);
        echo CHtml::tag('option', array(
            'value' => ''), CHtml::encode("-- Select Product --"), true);
        foreach ($data as $item) {
//			$result[$item->brandModelId] = $item->title;
            echo CHtml::tag('option', array(
                'value' => $item->productId), CHtml::encode(isset($item->product) ? $item->product->name : ""), true);
        }
//		echo CJSON::encode($result);
    }

    public function actionFindAllProductByCat2IdAjax() {
        $data = Category2ToProduct::model()->findAll('category2Id=:category2Id', array(
            ':category2Id' => (int) $_POST['cat2Id']));
//		$result = array(
//			);
        echo CHtml::tag('option', array(
            'value' => ''), CHtml::encode("-- Select Product --"), true);
        foreach ($data as $item) {
//			$result[$item->brandModelId] = $item->title;
            echo CHtml::tag('option', array(
                'value' => $item->productId), CHtml::encode(isset($item->product) ? $item->product->name : ""), true);
        }
//		echo CJSON::encode($result);
    }

    public function actionFindAllGroupNameByCat2IdAjax() {
        $data = Category2ToProduct::model()->findAll('category2Id=:category2Id AND groupName is not null', array(
            ':category2Id' => (int) $_POST['cat2Id']));
//		$result = array(
//			);
        echo CHtml::tag('option', array(
            'value' => ''), CHtml::encode("-- Select Product --"), true);
        foreach ($data as $item) {
//			$result[$item->brandModelId] = $item->title;
            echo CHtml::tag('option', array(
                'value' => $item->groupName), CHtml::encode($item->groupName), true);
        }
//		echo CJSON::encode($result);
    }

}
