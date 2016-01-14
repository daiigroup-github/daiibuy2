<?php

class StepController extends MasterCheckoutController
{

    public function actionIndex($id)
    {
        if ($id > 1) {
            if (!isset(Yii::app()->user->id)) {
                $this->redirect($this->createUrl(1));
            }
        }

        switch ($id) {
            case 1:
                $this->step1();
                break;
            case 2:
                $this->step2();
                break;
            case 3:
                $this->step3();
                break;
            case 4:
                $this->step4();
                break;
            case 5:
                $this->step5();
                break;
        }

//$this->render('index', array('step' => $id, 'userModel' => $userModel, 'addressModel' => $addressModel));
    }

    public function step1()
    {
        if (Yii::app()->user->id) {
            $this->redirect($this->createUrl(2));
        }
        $loginModel = new LoginForm();
        $userModel = new User();
        $addressModel = new Address();
        $daiibuy = new DaiiBuy();
        $daiibuy->loadCookie();

//Login
        if (isset($_POST['Login'])) {
            $loginModel->username = $_POST['User']['email'];
            $loginModel->password = $_POST['User']['password'];
// validate user input and redirect to the previous page if valid
            if ($loginModel->validate() && $loginModel->login()) {
                /**
                 * update order set userId = Yii::app()->user->id
                 */
                $orders = Order::model()->findAll(array(
                    'condition' => 'type&' . Order::ORDER_TYPE_CART . ' > 0 AND token=:token AND supplierId=:supplierId',
                    'params' => array(
                        ':token' => $daiibuy->token,
                        ':supplierId' => Yii::app()->session['supplierId'],
                    ),
                ));

                foreach ($orders as $order) {
                    $order->userId = Yii::app()->user->id;
                    $order->save(false);
                }
                $this->redirect($this->createUrl(2));
            } else {
                $loginModel->addError('username', 'Log in failed.');
            }
        }

//Register new user
        if (isset($_POST['Register'])) {
            $userModel->attributes = $_POST['User'];
            $addressModel->attributes = $_POST['Address'];
//			throw new Exception(print_r($_POST['Address'],true));

            $flag = false;
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $userModel->type = 1;
                $userModel->status = 1;
                $userModel->approved = 1;
                $userModel->password = $userModel->hashPassword($userModel->email, $userModel->password);
                $userModel->createDateTime = new CDbExpression('NOW()');
//				$userModel->partnerType = 0;
                if ($userModel->save()) {
                    $addressModel->userId = Yii::app()->db->getlastInsertID();
                    $addressModel->type = $addressModel::ADDRESS_TYPE_BILLING;
                    if ($addressModel->save()) {
                        /**
                         * update order set userId = Yii::app()->user->id
                         */
                        $orders = Order::model()->findAll(array(
                            'condition' => 'type&' . Order::ORDER_TYPE_CART . ' > 0 AND token=:token AND supplierId=:supplierId',
                            'params' => array(
                                ':token' => $daiibuy->token,
                                ':supplierId' => Yii::app()->session['supplierId'],
                            ),
                        ));

                        foreach ($orders as $order) {
                            $order->userId = $addressModel->userId;
                            $order->save(false);
                        }
                        $flag = true;
                    } else {
                        throw new Exception(print_r($addressModel->errors, true));
                    }
                } else {
                    throw new Exception(print_r($userModel->errors, true));
                }
                if ($flag) {
                    $transaction->commit();
//redirect to step 2
//					$identity = new UserIdentity($userModel->email, $userModel->password);
//					$identity->authenticate();
//					Yii::app()->user->login($identity);

                    $loginModel->username = $_POST['User']['email'];
                    $loginModel->password = $_POST['User']['password'];
// validate user input and redirect to the previous page if valid
                    if ($loginModel->validate() && $loginModel->login()) {
                        $orders = Order::model()->findAll(array(
                            'condition' => 'type&' . Order::ORDER_TYPE_CART . ' > 0 AND token=:token AND supplierId=:supplierId',
                            'params' => array(
                                ':token' => $daiibuy->token,
                                ':supplierId' => Yii::app()->session['supplierId'],
                            ),
                        ));

                        foreach ($orders as $order) {
                            $order->userId = Yii::app()->user->id;
                            $order->save(false);
                        }
                        $this->redirect($this->createUrl(2));
                    }
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
                $transaction->rollback();
            }
        }
        $this->render('step1', array(
            'loginModel' => $loginModel,
            'userModel' => $userModel,
            'addressModel' => $addressModel,
            'step' => 1,
        ));
    }

    public function step2()
    {
        /*
          $billingAddressModel = Address::model()->find(array(
          'condition' => 'type=:type AND userId=:userId',
          'params' => array(
          ':type' => Address::ADDRESS_TYPE_BILLING,
          ':userId' => Yii::app()->user->id,
          ),
          ));
         */
        $billingAddressModel = new Address();
        $billingAddressModel->type = Address::ADDRESS_TYPE_BILLING;
        $shippingAddressModel = new Address();
        $shippingAddressModel->type = Address::ADDRESS_TYPE_SHIPPING;
        $flag = 0;
        if (isset($_POST['Next'])) {
//			throw new Exception(print_r($_POST['billing']['company'] != "", true));
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $this->writeToFile('/tmp/step2', print_r($_POST, true));
//billing
                if ($_POST['billingRadio'] == 1) {
                    Yii::app()->session['billingAddressId'] = $_POST['existingBillingAddress'];
                    $flag = 1;
                } else {
//add new billing address
//                throw new Exception(print_r($_POST['billing']['company'], true));
                    if ($_POST['billing']['company'] != "") {
                        if (!isset($_POST['companyBranch'])) {
                            $billingAddressModel->addError("paymentCompany", '"สำนักงานใหญ่" หรือ "สาขา" ของบริษัทท่าน');

//						throw new Exception(print_r($billingAddressModel->errors, true));
                        } elseif ($_POST['companyBranch'] == 2) {
                            if (!isset($_POST['billing']['companyBranchDetail']) || $_POST['billing']['companyBranchDetail'] == "") {
                                $billingAddressModel->addError("paymentCompany", "สาขาของบริษัทของท่าน.");
//								2 => "กรุณาระบุสาขาของบริษัทของท่าน");
//							throw new Exception($billingAddressModel->errors);
                            }
                        }
                    }

                    $billingAddressModel->attributes = $_POST['billing'];
                    if (isset($_POST['companyBranch'])) {
                        if ($_POST['companyBranch'] == 1) {
                            $billingAddressModel->company = $billingAddressModel->company . " (สำนักงานใหญ่)";
                        } else {
                            if (isset($_POST['billing']['companyBranchDetail'])) {
                                $billingAddressModel->company = $billingAddressModel->company . " " . $_POST['billing']['companyBranchDetail'];
                            } else {
                                throw new Exception(print_r($billingAddressModel->errors, true));
                            }
                        }
                    }
                    if (!isset($billingAddressModel->taxNo) || $billingAddressModel->taxNo == "") {
                        $billingAddressModel->addError("paymentCompany", "เลขที่ผู้เสียภาษีของท่าน (ในกรณีที่เป็นบุคคลธรรมดากรุณากรอกเลขประจำตัวประชาชน 13 หลัก)");
//					throw new Exception($billingAddressModel->errors);
                    }

                    $billingAddressModel->userId = Yii::app()->user->id;
                    if (!$billingAddressModel->save()) {
                        $flag = 0;
                        throw new Exception(print_r($billingAddressModel->errors, true));
                    } else if (count($billingAddressModel->errors) > 0) {
                        throw new Exception(print_r($billingAddressModel->errors, true));
                    } else {
                        $flag = 1;
                        Yii::app()->session['billingAddressId'] = Yii::app()->db->getLastInsertID();
                    }
                }

//			throw new Exception(print_r($billingAddressModel->errors, true));


                if ($_POST['shippingRadio'] == 1) {
                    Yii::app()->session['shippingAddressId'] = $_POST['existingShippingAddress'];
                    $flag = 1;
                } else {
//add new shipping address
                    $shippingAddressModel->attributes = $_POST['shipping'];
                    $shippingAddressModel->provinceId = $this->cookie->provinceId;
                    $shippingAddressModel->userId = Yii::app()->user->id;
                    Yii::app()->session['shippingAddressId'] = $shippingAddressModel->attributes;
                    if (!$shippingAddressModel->save()) {
                        $flag = 0;
                        throw new Exception(print_r($shippingAddressModel->errors, true));
                    } else {
                        $flag = 1;
                        Yii::app()->session['shippingAddressId'] = Yii::app()->db->getLastInsertID();
                    }
                }
            } catch (Exception $exc) {
//				if (count($billingAddressModel->errors) > 0)
//				{
//					print_r($billingAddressModel->errors);
//				}
//				else if (count($shippingAddressModel->errors) > 0)
//				{
//					print_r($shippingAddressModel->errors);
//				}
//				print_r(count($billingAddressModel->errors) > 0 ? $billingAddressModel->errors : "อิอิ", true);
//				print_r(count($shippingAddressModel->errors) > 0 ? $shippingAddressModel->errors : array(), true);

                $transaction->rollback();
                $billingAddressModel->attributes = $_POST['billing'];
                $shippingAddressModel->attributes = $_POST['shipping'];
//
            }
            if ($flag) {
                $transaction->commit();
                $this->redirect($this->createUrl(3));
            }
        }

        $this->render('step2', array(
            'billingAddressModel' => $billingAddressModel,
            'shippingAddressModel' => $shippingAddressModel,
            'step' => 2,
            'errors' => count($shippingAddressModel->errors) > 0 ? $shippingAddressModel->errors : $billingAddressModel->errors,
        ));
//$this->redirect($this->createUrl(3));
    }

    public function step3()
    {
        $supplierId = Yii::app()->session['supplierId'];
        $userId = Yii::app()->user->id;
        $daiibuy = new DaiiBuy();
        $daiibuy->loadCookie();
        $token = $daiibuy->token;
        $orders = array();

        if (isset($userId)) {
            $orders = Order::model()->findAll(array(
                'condition' => 'type&' . Order::ORDER_TYPE_CART . ' > 0 AND userId=:userId AND supplierId=:supplierId',
                'params' => array(
                    ':userId' => $userId,
                    ':supplierId' => $supplierId,
                ),
                'order' => 'type, orderId'
            ));
        } else {
            $orders = Order::model()->findAll(array(
                'condition' => 'type&' . Order::ORDER_TYPE_CART . ' > 0 AND token=:token AND supplierId=:supplierId',
                'params' => array(
                    ':token' => $token,
                    ':supplierId' => $supplierId,
                ),
            ));
        }
        $orderSummary = Order::model()->sumOrderTotalBySupplierId($supplierId);
        $supplierModel = Supplier::model()->findByPk($supplierId);
        $userModel = User::model()->findByPk(Yii::app()->user->id);
        $billingAddress = Address::model()->findByPk(Yii::app()->session['billingAddressId']);
        $shippingAddress = Address::model()->findByPk(Yii::app()->session['shippingAddressId']);


//                                        throw new Exception(print_r(Yii::app()->session['shippingAddressId'].", ".Yii::app()->session['billingAddressId'],true));
//                throw new Exception(print_r($billingAddress,true));
        $this->render('step3', array(
            'step' => 3,
            'orderSummary' => $orderSummary,
            'orders' => $orders,
            'supplierName' => $supplierModel->name,
            'billingAddress' => $billingAddress,
            'shippingAddress' => $shippingAddress,
            'supplierId' => $supplierId,
            'userModel' => $userModel,
        ));
//$this->redirect($this->createUrl(4));
    }

    public function step4()
    {
//		throw new Exception(print_r($_POST["orderGroupId"],true));
        if (isset($_POST["orderGroupId"])) {
            $oldOrderGroup = OrderGroup::model()->findByPk($_POST["orderGroupId"]);
        }
        $supplierId = Yii::app()->session['supplierId'];
        $daiibuy = new DaiiBuy();
        $daiibuy->loadCookie();
        $provinceId = $daiibuy['provinceId'];

        $orderSummary = Order::model()->sumOrderTotalBySupplierId($supplierId);
//		throw new Exception(print_r($orderSummary, true));
        if (isset($_POST['paymentMethod'])) {
            $flag = false;
            $transaction = Yii::app()->db->beginTransaction();
            try {
//code here
//new order group
                $orderGroup = new OrderGroup();
                $orderGroup->supplierId = $supplierId;
                $orderGroup->orderNo = $orderGroup->genOrderNo($supplierId);
                $orderGroup->summary = str_replace(",", "", $orderSummary['grandTotal']);
                $orderGroup->totalIncVAT = str_replace(",", "", $orderSummary['total']);
                $orderGroup->total = number_format($orderGroup->totalIncVAT / 1.07, 2, ".", "");
                $orderGroup->discountPercent = str_replace(",", "", $orderSummary['discountPercent']);
                $orderGroup->discountValue = str_replace(",", "", $orderSummary['discount']);
//				$orderGroup->totalPostDiscount = str_replace(",", "", $orderSummary['total']) - str_replace(",", "", $orderSummary['discount']);
//Distributor Discount & Spacial Project Discount
                if (isset($orderSummary['partnerDiscountPercent'])) {
                    $orderGroup->partnerDiscountPercent = str_replace(",", "", $orderSummary['partnerDiscountPercent']);
                    $orderGroup->partnerDiscountValue = str_replace(",", "", $orderSummary['partnerDiscount']);
//					$orderGroup->totalPostPartnerDiscount = str_replace(",", "", $orderSummary['totalPostPartnerDiscount']);
                } else if (isset($orderSummary['distributorDiscountPercent'])) {
                    $orderGroup->distributorDiscountPercent = str_replace(",", "", $orderSummary['distributorDiscountPercent']);
                    $orderGroup->distributorDiscount = str_replace(",", "", $orderSummary['distributorDiscount']);
                    $orderGroup->totalPostDistributorDiscount = str_replace(",", "", $orderSummary['totalPostDistributorDiscount']);
                }
                if (isset($orderSummary['extraDiscount'])) {
                    $orderGroup->extraDiscount = str_replace(",", "", $orderSummary['extraDiscount']);
                }
//Distributor Discount & Spacial Project Discount
                $orderGroup->vatPercent = OrderGroup::VAT_PERCENT;
                $orderGroup->vatValue = number_format($orderGroup->calVatValue(), 2, ".", "");
                $orderGroup->userId = Yii::app()->user->id;
                $orderGroup->paymentMethod = $_POST['paymentMethod'];
                $orderGroup->createDateTime = new CDbExpression("NOW()");
                $orderGroup->updateDateTime = new CDbExpression("NOW()");

                /**
                 * Todo:: billing & shipping address
                 */
                $billingAddress = Address::model()->findByPk(Yii::app()->session['billingAddressId']);
                $shippingAddress = Address::model()->findByPk(Yii::app()->session['shippingAddressId']);

                $userModel = User::model()->findByPk(Yii::app()->user->id);
                $orderGroup->email = isset($userModel->email) ? $userModel->email : $oldOrderGroup->email;
                $orderGroup->firstname = isset($userModel->firstname) ? $userModel->firstname : $oldOrderGroup->firstname;
                $orderGroup->lastname = isset($userModel->lastname) ? $userModel->lastname : $oldOrderGroup->lastname;
                $orderGroup->telephone = isset($userModel->telephone) ? $userModel->telephone : $oldOrderGroup->telephone;
                $orderGroup->paymentCompany = isset($billingAddress->company) ? $billingAddress->company : $oldOrderGroup->paymentCompany;
                $orderGroup->paymentTaxNo = isset($billingAddress->taxNo) ? $billingAddress->taxNo : $oldOrderGroup->paymentTaxNo;
                $orderGroup->paymentFirstname = isset($billingAddress->firstname) ? $billingAddress->firstname : $oldOrderGroup->paymentFirstname;
                $orderGroup->paymentLastname = isset($billingAddress->lastname) ? $billingAddress->lastname : $oldOrderGroup->paymentLastname;
                $orderGroup->paymentAddress1 = isset($billingAddress->address_1) ? $billingAddress->address_1 : $oldOrderGroup->paymentAddress1;
                $orderGroup->paymentAddress2 = isset($billingAddress->address_2) ? $billingAddress->address_2 : $oldOrderGroup->paymentAddress2;
                $orderGroup->paymentDistrictId = isset($billingAddress->districtId) ? $billingAddress->districtId : $oldOrderGroup->paymentDistrictId;
                $orderGroup->paymentAmphurId = isset($billingAddress->amphurId) ? $billingAddress->amphurId : $oldOrderGroup->paymentAmphurId;
                $orderGroup->paymentProvinceId = isset($billingAddress->provinceId) ? $billingAddress->provinceId : $oldOrderGroup->paymentProvinceId;
                $orderGroup->paymentPostcode = isset($billingAddress->postcode) ? $billingAddress->postcode : $oldOrderGroup->paymentPostcode;
                $orderGroup->shippingCompany = isset($shippingAddress->company) ? $shippingAddress->company : $oldOrderGroup->shippingCompany;
                $orderGroup->shippingAddress1 = isset($shippingAddress->address_1) ? $shippingAddress->address_1 : $oldOrderGroup->shippingAddress1;
                $orderGroup->shippingAddress2 = isset($shippingAddress->address_2) ? $shippingAddress->address_2 : $oldOrderGroup->shippingAddress2;
                $orderGroup->shippingDistrictId = isset($shippingAddress->districtId) ? $shippingAddress->districtId : $oldOrderGroup->shippingDistrictId;
                $orderGroup->shippingAmphurId = isset($shippingAddress->amphurId) ? $shippingAddress->amphurId : $oldOrderGroup->shippingAmphurId;
                $orderGroup->shippingProvinceId = isset($shippingAddress->provinceId) ? $shippingAddress->provinceId : $oldOrderGroup->shippingProvinceId;
                $orderGroup->shippingPostCode = isset($shippingAddress->postcode) ? $shippingAddress->postcode : $oldOrderGroup->shippingPostCode;
                /**
                 * TODO:: remove false after add address
                 */
                if ($orderGroup->save(FALSE)) {
                    $orderGroupId = Yii::app()->db->getLastInsertID();

                    $orders = Order::model()->findAll(array(
                        'condition' => 'type&' . Order::ORDER_TYPE_CART . ' > 0 AND userId=:userId AND supplierId=:supplierId',
                        'params' => array(
                            ':userId' => Yii::app()->user->id,
                            ':supplierId' => $supplierId,
                        ),
                        'order' => 'type, orderId'
                    ));
//					throw new Exception(print_r($orders, true));
                    $i = 0;

                    foreach ($orders as $order) {

                        $orderGroupToOrder = new OrderGroupToOrder();
                        $orderGroupToOrder->orderGroupId = $orderGroupId;
                        $orderGroupToOrder->orderId = $order->orderId;



                        if (!$orderGroupToOrder->save()) {
                            break;
                        }
                        $sumTotal = 0;
                        foreach ($order->orderItems as $item) {

                            $price = ($item->product->calProductPromotionPrice() != 0) ? $item->product->calProductPromotionPrice() : $item->product->calProductPrice();
                            $total = ($price * $item->quantity);
                            $sumTotal+=$total;
                            $item->price = $price;
                            $item->total = $total;
                            $item->save(FALSE);
                        }
                        $order->totalIncVAT = $sumTotal;
                        $order->total = $sumTotal / 1.07;
                        if (isset($orderSummary["extraDiscountArray"][$order->orderId])) {
                            $order->spacialProjectDiscount = $orderSummary["extraDiscountArray"][$order->orderId]["extraDiscount"];
                        }

                        $order->provinceId = $provinceId;
                        $order->type = 4;
//							throw new Exception(print_r($order->type,true));
                        $order->save();
                        $i++;
                    }
                    if ($i == sizeof($orders)) {
                        $flag = true;
                    }
                    if ($supplierId == 4 || $supplierId == 5) {
                        $flag = $this->saveGinzaOrder($supplierId, $orderGroupId);
                    }
                } else {
                    throw new Exception(print_r($orderGroup->errors, true));
                }
//				throw new Exception($flag);
                if ($flag) {
                    $transaction->commit();

                    /**
                     * 1 = card, 2 = transfer
                     * orderNo = $orderGroup->orderNo
                     */
                    if ($orderGroup->paymentMethod == 1) {
                        $this->redirect(array(
                            "confirmCheckout",
                            'id' => $orderGroupId));
                    } else {
                        $emailObj = new Email();
                        $sentMail = new EmailSend();
                        $documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/myfile/";
                        $emailObj->Setmail($orderGroup->userId, null, $orderGroup->supplierId, $orderGroup->orderGroupId, null, $documentUrl);
                        $sentMail->mailCompleteOrderCustomer($emailObj);
                        $sentMail->mailConfirmOrderSupplierDealer($emailObj);
                        $this->redirect(array(
                            'step6',
                            "id" => $orderGroupId,
                        ));
                    }
                } else {
                    $transaction->rollback();
                }
            } catch (Exception $e) {
                $transaction->rollback();
                throw new Exception($e->getMessage());
            }
        }

        $bankArray = Bank::model()->findAllBankModelBySupplier($supplierId);
        $supplierModel = Supplier::model()->findByPk($supplierId);

        $this->render('step4', array(
            'step' => 4,
            'orderSummary' => $orderSummary,
            'bankArray' => $bankArray,
            'supplierModel' => $supplierModel,
        ));
//        $this->redirect($this->createUrl(5));
    }

    public function step5()
    {
        $daiibuy = new DaiiBuy();
//		$daiibuy->loadCookie();
        $order = new OrderGroup();
        $decisionArray = array(
            "ACCEPT",
//			"REVIEW"
        );
        $resonCode = array(
            100,
//			110,
//			200,
//			201,
//			230,
//			520
        );
        $flag = FALSE;
        if (isset($_REQUEST) && $_REQUEST != array()) {
//			if(in_array($_REQUEST["decision"], $decisionArray) && in_array($_REQUEST["reason_code"], $resonCode))
//			{
            $request = $_REQUEST;
            if ($_REQUEST["decision"] == "ACCEPT") {
                $oldOrder = OrderGroup::model()->find("orderNo =:orderNo", array(
                    ":orderNo" => $_REQUEST["req_reference_number"]));
                if (isset($oldOrder)) {
                    if ($oldOrder->supplierId == 4 || $oldOrder->supplierId == 5) {
                        foreach ($oldOrder->orderGroupToOrders[0]->order->orderItems as $item) {
                            for ($i = 1;
                            ; $i++) {
                                $transaction = Yii::app()->db->beginTransaction();
                                try {
                                    $newOrderGroup = new OrderGroup();
                                    $newOrderGroup->attributes = $oldOrder->attributes;
                                    $newOrderGroup->orderNo = OrderGroup::model()->genOrderNo($newOrderGroup->supplierId);
                                    $newOrderGroup->totalIncVAT = $item->price;
                                    $newOrderGroup->total = $newOrderGroup->totalIncVAT / (1 + ($newOrderGroup->vatPercent / 100));
                                    $newOrderGroup->vatValue = $newOrderGroup->totalIncVAT - $newOrderGroup->total;
                                    $newOrderGroup->discountValue = ($newOrderGroup->totalIncVAT * $newOrderGroup->discountPercent) / 100;
                                    $newOrderGroup->totalPostDiscount = $newOrderGroup->totalIncVAT - $newOrderGroup->discountValue;
                                    $newOrderGroup->summary = $newOrderGroup->totalPostDiscount;
                                    $newOrderGroup->orderGroupId = NULL;



                                    $newOrderItem = new OrderItems();
                                    $newOrderItem->attributes = $item->attributes;


//						throw new Exception(print_r($newOrderItem->attributes, true));

                                    if ($newOrderGroup->save()) {
                                        $newOrderGroupId = Yii::app()->db->getLastInsertID();
                                        $tempOrder = $oldOrder->orderGroupToOrders[0]->order;
                                        $newOrder = new Order();
                                        $newOrder->attributes = $tempOrder->attributes;
                                        $newOrder->orderId = NULL;
                                        $newOrder->totalIncVAT = $item->price;
                                        $newOrder->total = $newOrderGroup->total;
                                        if ($newOrder->save()) {
                                            $newOrderId = Yii::app()->db->getLastInsertID();
                                            $orderGroupToOrder = new OrderGroupToOrder();
                                            $orderGroupToOrder->orderGroupId = $newOrderGroupId;
                                            $orderGroupToOrder->orderId = $newOrderId;
                                            if ($orderGroupToOrder->save()) {
                                                $newOrderItem = new OrderItems();
                                                $newOrderItem->attributes = $item->attributes;
                                                $newOrderItem->orderId = $newOrderId;
                                                $newOrderItem->quantity = 1;
                                                $newOrderItem->total = $newOrderItem->price;
                                                if ($newOrderItem->save()) {
                                                    $this->saveGinzaOrder($newOrderGroup->supplierId, $newOrderGroupId);
                                                    $transaction->commit();
                                                } else {
                                                    throw new Exception;
                                                }
                                            } else {
                                                throw new Exception;
                                            }
                                        } else {
                                            throw new Exception;
                                        }
                                    } else {
                                        throw new Exception;
                                    }
                                } catch (Exception $ex) {
                                    throw new Exception($ex->getMessage());
                                    $transaction->rollback();
                                }

                                if ($i == $item->quantity) {
                                    $oldOrder->status = -1;
                                    $oldOrder->paymentDateTime = new CDbExpression('NOW()');
                                    break;
                                }
                            }
                        }
                    } else {
                        $oldOrder->status = 2;
                        $oldOrder->paymentDateTime = new CDbExpression('NOW()');
                    }
                    if ($oldOrder->save()) {
                        $_REQUEST["reasonDescription"] = $this->saveOrderGroupLog($request, $oldOrder);
                        $flag = TRUE;
                        $emailObj = new Email();
                        $sentMail = new EmailSend();
                        $documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/myfile/";
                        $emailObj->Setmail($order->userId, null, $order->supplierId, $order->orderGroupId, null, $documentUrl);
                        $sentMail->mailReviewEPayment($emailObj);
//                        $sentMail->mailConfirmOrderSupplierDealer($emailObj);
                        $sentMail->mailCompleteOrderCustomer($emailObj);
                        $sentMail->mailConfirmOrderSupplierDealer($emailObj);
                    }
                } else {
                    echo "ไม่สามารถ ปรับปรุงรายการสั่งซื้อสินค้าของท่านได้";
                }
            } else {
// Email จ่ายไม่ผ่าน
                if ($_REQUEST["decision"] == "REVIEW") {
                    $order = OrderGroup::model()->find("orderNo =:orderNo", array(
                        ":orderNo" => $_REQUEST["req_reference_number"]));
                    if ($oldOrder->supplierId == 4 || $oldOrder->supplierId == 5) {
                        foreach ($oldOrder->orderGroupToOrders[0]->order->orderItems as $item) {
                            for ($i = 1;
                            ; $i++) {
                                $transaction = Yii::app()->db->beginTransaction();
                                try {
                                    $newOrderGroup = new OrderGroup();
                                    $newOrderGroup->attributes = $oldOrder->attributes;
                                    $newOrderGroup->orderNo = OrderGroup::model()->genOrderNo($newOrderGroup->supplierId);
                                    $newOrderGroup->totalIncVAT = $item->price;
                                    $newOrderGroup->total = $newOrderGroup->totalIncVAT / (1 + ($newOrderGroup->vatPercent / 100));
                                    $newOrderGroup->vatValue = $newOrderGroup->totalIncVAT - $newOrderGroup->total;
                                    $newOrderGroup->discountValue = ($newOrderGroup->totalIncVAT * $newOrderGroup->discountPercent) / 100;
                                    $newOrderGroup->totalPostDiscount = $newOrderGroup->totalIncVAT - $newOrderGroup->discountValue;
                                    $newOrderGroup->summary = $newOrderGroup->totalPostDiscount;
                                    $newOrderGroup->orderGroupId = NULL;

                                    $newOrderItem = new OrderItems();
                                    $newOrderItem->attributes = $item->attributes;
//						throw new Exception(print_r($newOrderItem->attributes, true));
                                    if ($newOrderGroup->save()) {
                                        $newOrderGroupId = Yii::app()->db->getLastInsertID();
                                        $tempOrder = $oldOrder->orderGroupToOrders[0]->order;
                                        $newOrder = new Order();
                                        $newOrder->attributes = $tempOrder->attributes;
                                        $newOrder->orderId = NULL;
                                        $newOrder->totalIncVAT = $item->price;
                                        $newOrder->total = $newOrderGroup->total;
                                        if ($newOrder->save()) {
                                            $newOrderId = Yii::app()->db->getLastInsertID();
                                            $orderGroupToOrder = new OrderGroupToOrder();
                                            $orderGroupToOrder->orderGroupId = $newOrderGroupId;
                                            $orderGroupToOrder->orderId = $newOrderId;
                                            if ($orderGroupToOrder->save()) {
                                                $newOrderItem = new OrderItems();
                                                $newOrderItem->attributes = $item->attributes;
                                                $newOrderItem->orderId = $newOrderId;
                                                $newOrderItem->quantity = 1;
                                                $newOrderItem->total = $newOrderItem->price;
                                                if ($newOrderItem->save()) {
                                                    $this->saveGinzaOrder($newOrderGroup->supplierId, $newOrderGroupId);
                                                    $transaction->commit();
                                                } else {
                                                    throw new Exception;
                                                }
                                            } else {
                                                throw new Exception;
                                            }
                                        } else {
                                            throw new Exception;
                                        }
                                    } else {
                                        throw new Exception;
                                    }
                                } catch (Exception $ex) {
                                    throw new Exception($e->getMessage());
                                    $transaction->rollback();
                                }

                                if ($i == $item->quantity) {
                                    $oldOrder->status = -1;
                                    $oldOrder->paymentDateTime = new CDbExpression('NOW()');
                                    break;
                                }
                            }
                        }
                    } else {
                        $oldOrder->status = 2;
                        $oldOrder->paymentDateTime = new CDbExpression('NOW()');
                    }
                    if ($oldOrder->save()) {
//						$this->cutProductStock($order);
//						unset($daiibuy->cart[$order->supplierId]);
//						unset($daiibuy->order[$order->supplierId]);
//						$daiibuy->usedPoint = 0;
//						$daiibuy->saveCookie();
                        $_REQUEST["reasonDescription"] = $this->saveOrderGroupLog($request, $oldOrder);
                        $flag = TRUE;
                        $emailObj = new Email();
                        $sentMail = new EmailSend();
                        $documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/myfile/";
                        $emailObj->Setmail($oldOrder->userId, null, $oldOrder->supplierId, $oldOrder->orderGroupId, null, $documentUrl);
                        $sentMail->mailReviewEPayment($emailObj);
//                        $sentMail->mailCompleteOrderCustomer($emailObj);
                        $sentMail->mailConfirmOrderSupplierDealer($emailObj);
                    } else {
                        echo "ไม่สามารถ ปรับปรุงรายการสั่งซื้อสินค้าของท่านได้";
                    }
                } else if ($_REQUEST["decision"] == "REJECT") {
                    $oldOrder = OrderGroup::model()->find("orderNo =:orderNo", array(
                        ":orderNo" => $_REQUEST["req_reference_number"]));
                    $oldOrder->status = 97;
                    $oldOrder->save();
                    $this->saveOrderGroupLog($_REQUEST, $oldOrder);

                    $_REQUEST["reasonDescription"] = $this->saveOrderGroupLog($request, $oldOrder);
//                    $emailObj = new Email();
//                    $sentMail = new EmailSend();
//                    $documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/myfile/";
//                    $emailObj->Setmail($oldOrder->userId, null, $oldOrder->supplierId, $oldOrder->orderGroupId, null, $documentUrl);
//                    $sentMail->mailCompleteOrderCustomer($emailObj);
//                    $sentMail->mailConfirmOrderSupplierDealer($emailObj);
                } else if ($_REQUEST["decision"] == "ERROR") {
                    $oldOrder = OrderGroup::model()->find("orderNo =:orderNo", array(
                        ":orderNo" => $_REQUEST["req_reference_number"]));
                    $oldOrder->status = 97;
                    $oldOrder->save();

                    $_REQUEST["reasonDescription"] = $this->saveOrderGroupLog($request, $oldOrder);
                }
            }
        } else {
//$flag = TRUE;
        }
        $this->render("step5", array(
            'result' => $_REQUEST,
            'flag' => $flag,
            'model' => $order));
    }

    public function saveOrderGroupLog($request, $orderGroup)
    {
        $description = OrderGroup::model()->getReasonCode($request["reasonCode"]);
        $orderGroupHistory = new OrderGroupHistory();
        $orderGroupHistory->orderGroupId = $orderGroup->orderGroupId;
        $orderGroupHistory->reasonCode = $request["reasonCode"];
        $orderGroupHistory->description = $description;
        $orderGroupHistory->decision = $request["decision"];
        $orderGroupHistory->createDateTime = new CDbExpression('NOW()');
        $orderGroupHistory->save();
        return $description;
    }

    public function actionStep6($id)
    {
//		$daiibuy = new DaiiBuy();
//		$daiibuy->loadCookie();
        $flag = TRUE;

//		$order = OrderGroup::model()->find("orderNo =:orderNo", array(
//			":orderNo"=>$id));
        $oldOrder = OrderGroup::model()->findByPk($id);

        if (isset($oldOrder)) {
            if (($oldOrder->supplierId == 4 || $oldOrder->supplierId == 5) && ($oldOrder->parentId == null) && $oldOrder->mainFurnitureId == NULL) {
                if (isset($oldOrder->orderGroupToOrders[0])) {
                    $transaction = Yii::app()->db->beginTransaction();
                    foreach ($oldOrder->orderGroupToOrders[0]->order->orderItems as $item) {
                        for ($i = 1; $i <= $item->quantity; $i++) {

                            try {
                                $newOrderGroup = new OrderGroup();
                                $newOrderGroup->attributes = $oldOrder->attributes;
                                $newOrderGroup->orderNo = OrderGroup::model()->genOrderNo($newOrderGroup->supplierId);
                                $newOrderGroup->totalIncVAT = $item->price;
                                $newOrderGroup->total = $newOrderGroup->totalIncVAT / (1 + ($newOrderGroup->vatPercent / 100));
                                $newOrderGroup->vatValue = $newOrderGroup->totalIncVAT - $newOrderGroup->total;
                                $newOrderGroup->discountValue = ($newOrderGroup->totalIncVAT * $newOrderGroup->discountPercent) / 100;
                                $newOrderGroup->totalPostDiscount = $newOrderGroup->totalIncVAT - $newOrderGroup->discountValue;
                                $newOrderGroup->summary = $newOrderGroup->totalPostDiscount;
                                $newOrderGroup->orderGroupId = NULL;
                                $newOrderItem = new OrderItems();
                                $newOrderItem->attributes = $item->attributes;
                                $newOrderItem->updateDateTime = new CDbExpression("NOW()");
//						throw new Exception(print_r($newOrderItem->attributes, true));
                                if ($newOrderGroup->save()) {
                                    $newOrderGroupId = Yii::app()->db->getLastInsertID();
                                    $tempOrder = $oldOrder->orderGroupToOrders[0]->order;
                                    $newOrder = new Order();
                                    $newOrder->attributes = $tempOrder->attributes;
                                    $newOrder->orderId = NULL;
                                    $newOrder->totalIncVAT = $item->price;
                                    $newOrder->total = $newOrderGroup->total;
                                    if ($newOrder->save()) {
                                        $newOrderId = Yii::app()->db->getLastInsertID();
                                        $orderGroupToOrder = new OrderGroupToOrder();
                                        $orderGroupToOrder->orderGroupId = $newOrderGroupId;
                                        $orderGroupToOrder->orderId = $newOrderId;
                                        if ($orderGroupToOrder->save()) {
                                            $newOrderItem = new OrderItems();

                                            $newOrderItem->attributes = $item->attributes;
                                            $newOrderItem->title = $item->product->name;
                                            $newOrderItem->orderId = $newOrderId;
                                            $newOrderItem->quantity = 1;
                                            $newOrderItem->total = $newOrderItem->price;
                                            if ($newOrderItem->save()) {
                                                $this->saveGinzaOrder($newOrderGroup->supplierId, $newOrderGroupId);
                                            } else {
                                                $flag = FALSE;
                                            }
                                        } else {
                                            $flag = FALSE;
                                        }
                                    } else {
                                        $flag = FALSE;
                                    }
                                } else {
                                    $flag = FALSE;
                                }
                            } catch (Exception $ex) {
                                throw new Exception($ex->getMessage());
                                $transaction->rollback();
                            }
//							if($i == $item->quantity)
//							{
//								$oldOrder->status = -1;
//								break;
//							}
                        }
                    }
                    if ($flag) {
                        $oldOrder->status = -1;
                        $oldOrder->updateDateTime = new CDbExpression("NOW()");
                        $transaction->commit();
                    }
                } else {
//					$oldOrder->status = 1;
                }
//					$oldOrder->totalIncVAT = $oldOrder->totalIncVAT / $splitNo;
//					$oldOrder->discountValue = ($oldOrder->totalIncVAT * $oldOrder->discountPercent) / 100;
//					$oldOrder->totalPostDiscount = $oldOrder->totalIncVAT - $oldOrder->discountValue;
//					$oldOrder->total = $oldOrder->totalIncVAT / (1 + ($oldOrder->vatPercent / 100));
//					$oldOrder->vatValue = $oldOrder->totalIncVAT - $oldOrder->total;
//					$oldOrder->orderGroupId = NULL;
//						$oldOrder->orderNo = $oldOrder->order->findMaxOrderNo();
            } else {
                $oldOrder->status = 1;
                $oldOrder->updateDateTime = new CDbExpression("NOW()");
            }
        }
//                throw new Exception(print_r($oldOrder, true));
//					$oldOrder->paymentDateTime = new CDbExpression('NOW()');
        if ($oldOrder->save()) {
//						$this->cutProductStock($order);
//						unset($daiibuy->cart[$order->supplierId]);
//						unset($daiibuy->order[$order->supplierId]);
//						$daiibuy->usedPoint = 0;
//						$daiibuy->saveCookie();
            if ($oldOrder->status < 0) {
                $orderToSentMail = $oldOrder;
            } else {
                $orderToSentMail = isset($newOrderGroup) ? $newOrderGroup : $oldOrder;
            }
            $emailObj = new Email();
            $sentMail = new EmailSend();
            $documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/myfile/";
            $emailObj->Setmail($orderToSentMail->userId, null, $orderToSentMail->supplierId, $orderToSentMail->orderGroupId, null, $documentUrl);
            $sentMail->mailCompleteOrderCustomer($emailObj);
            $sentMail->mailConfirmOrderSupplierDealer($emailObj);
        }

//		if(isset($order))
//		{
//			$order->status = 1;
////			$order->invoiceNo = OrderGroup::model()->genInvNo($order);
////			$order->paymentDateTime = new CDbExpression('NOW()');
//			if($order->save())
//			{
////						$this->cutProductStock($order);
////						unset($daiibuy->cart[$order->supplierId]);
////						unset($daiibuy->order[$order->supplierId]);
////						$daiibuy->usedPoint = 0;
////						$daiibuy->saveCookie();
//
//				$flag = TRUE;
//				$emailObj = new Email();
//				$sentMail = new EmailSend();
//				$documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/" . $order->orderGroupId;
//				$emailObj->Setmail($order->userId, null, $order->supplierId, $order->orderGroupId, null, $documentUrl);
//				$sentMail->mailCompleteOrderCustomer($emailObj);
//				$sentMail->mailConfirmOrderSupplierDealer($emailObj);
//			}
//		}
        else {
            echo "ไม่สามารถ ปรับปรุงรายการสั่งซื้อสินค้าของท่านได้";
        }

        $bankArray = Bank::model()->findAllBankModelBySupplier($oldOrder->supplierId);
        $this->render("step6", array(
            'bankArray' => $bankArray,
            'model' => $oldOrder));
    }

    public function actionFindAmphur()
    {
        if (isset($_POST['provinceId'])) {
            $res = '';
            $amphurs = Amphur::model()->findAll(array(
                'condition' => 'provinceId=:provinceId',
                'params' => array(
                    ':provinceId' => $_POST['provinceId'],
                ),
                'order' => 'amphurName'
            ));
//			$res .= '<option value="">เลือกอำเภอ</option>';
            foreach ($amphurs as $amphur) {
                $res .= '<option value="' . $amphur->amphurId . '">' . $amphur->amphurName . '</option>';
            }

            echo $res;
        }
    }

    public function actionFindDistrict()
    {
        if (isset($_POST['amphurId'])) {
            $res = '';
            $districts = District::model()->findAll(array(
                'condition' => 'amphurId=:amphurId',
                'params' => array(
                    ':amphurId' => $_POST['amphurId'],
                ),
                'order' => 'districtName'
            ));

            foreach ($districts as $district) {
                $res .= '<option value="' . $district->districtId . '">' . $district->districtName . '</option>';
            }
            echo $res;
        }
    }

    public function actionConfirmation($id)
    {
        $model = OrderGroup::model()->findByPk($id);
        $model->status = 97; //sending to e-payment
        $this->render("e_payment/payment_confirmation", array(
            'model' => $model));
    }

    public function actionConfirmCheckout($id)
    {
        $model = OrderGroup::model()->findByPk($id);
        $this->render("confirm_checkout", array(
            'model' => $model));
    }

    public function splitGinzaOrder($item)
    {
        $oldOrder = OrderGroup::model()->findByPk($oldOrderGroupId);
        $order = new OrderGroup();
        $order->attributes = $oldOrder->attributes;
        $order->totalIncVAT = $oldOrder->totalIncVAT / $splitNo;
        $order->discountValue = ($order->totalIncVAT * $order->discountPercent) / 100;
        $order->totalPostDiscount = $order->totalIncVAT - $order->discountValue;
        $order->total = $order->totalIncVAT / (1 + ($order->vatPercent / 100));
        $order->vatValue = $order->totalIncVAT - $order->total;
        $order->orderGroupId = NULL;
        $order->orderNo = $oldOrder->order->findMaxOrderNo();
        $order->status = 1;
        $order->updateDateTime = new CDbExpression("NOW()");
//							$order->paymentDateTime = new CDbExpression('NOW()');
        if ($order->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function copyGinzaOrder($oldOrderGroupId, $splitNo)
    {
        $oldOrder = OrderGroup::model()->findByPk($oldOrderGroupId);
        $order = new OrderGroup();
        $order->attributes = $oldOrder->attributes;
        $order->totalIncVAT = $oldOrder->totalIncVAT / $splitNo;
        $order->discountValue = ($order->totalIncVAT * $order->discountPercent) / 100;
        $order->totalPostDiscount = $order->totalIncVAT - $order->discountValue;
        $order->total = $order->totalIncVAT / (1 + ($order->vatPercent / 100));
        $order->vatValue = $order->totalIncVAT - $order->total;
        $order->orderGroupId = NULL;
        $order->orderNo = $oldOrder->order->findMaxOrderNo();
        $order->status = 1;
//							$order->paymentDateTime = new CDbExpression('NOW()');
        if ($order->save()) {
            $orderGroupId = Yii::app()->db->lastInsertID;

//		$orderGroup = OrderGroup::model()->findByPk($orderGroupId);
            $newOrder = new Order();
            $newOrder->attributes = $order->orderGroupToOrders[0]->order->attributes;
            $newOrder->orderId = NULL;
            $newOrder->totalIncVAT = $newOrder->totalIncVAT / $splitNo;
            if ($newOrder->save()) {
                $newOrderId = Yii::app()->db->getLastInsertID();
                $newOrderGroupToOrder = new OrderGroupToOrder();
                $modelwOrderGroupToOrder->orderGroupId = $orderGroupId;
                $newOrderGroupToOrder->orderId = $newOrderId;
                if ($newOrderGroupToOrder->save()) {
                    $newOrderItem = new OrderItems();
                    $newOrderItem->attributes = $oldOrderGroup->orderGroupToOrders[0]->order->orderItems[0]->attributes;
                    $newOrderItem->total = $newOrderItem->total / $splitNo;
                    $newOrderItem->orderItemId = NULL;
                    $newOrderItem->orderId = $newOrderId;
                    if ($newOrderItem->save()) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public function saveGinzaOrder($supplierId, $orderGroupId)
    {
        $flag = false;
        $newOrderGroupId = null;
        try {
            $oldOrderGroup = OrderGroup::model()->findByPk($orderGroupId);
            $cat2ToProducts = Category2ToProduct::model()->findAll("productId=" . $oldOrderGroup->orderGroupToOrders[0]->order->orderItems[0]->productId . ' ORDER BY productId DESC');
            $cat2ToProduct = isset($cat2ToProducts[1]) ? $cat2ToProducts[1] : $cat2ToProducts[0];
            $models = Category2ToProduct::model()->findAll("brandId= :brandId AND brandModelId = :brandModelId AND category1Id = :category1Id AND category2Id =:category2Id AND productId != :productId ORDER BY sortOrder", array(
                ":brandId" => $cat2ToProduct->brandId,
                ':brandModelId' => $cat2ToProduct->brandModelId,
                ":category1Id" => $cat2ToProduct->category1Id,
                ":category2Id" => $cat2ToProduct->category2Id,
                ":productId" => $oldOrderGroup->orderGroupToOrders[0]->order->orderItems[0]->productId));
            foreach ($models as $model) {
//				throw new Exception(print_r($oldOrderGroup, true));
                $orderSummary = Order::model()->sumOrderTotalByProductIdAndQuantity($model->productId, $oldOrderGroup->orderGroupToOrders[0]->order->orderItems[0]->quantity, $supplierId, null, null, $orderGroupId);
                $orderGroup = new OrderGroup();
                $orderGroup->attributes = $oldOrderGroup->attributes;
                $orderGroup->supplierId = $supplierId;
                $orderGroup->orderNo = $orderGroup->genOrderNo($supplierId);
                $orderGroup->summary = str_replace(",", "", $orderSummary['grandTotal']);
                $orderGroup->totalIncVAT = str_replace(",", "", $orderSummary['total']);
                $orderGroup->total = $orderGroup->totalIncVAT / 1.07;
                $orderGroup->discountPercent = str_replace(",", "", $orderSummary['discountPercent']);
                $orderGroup->discountValue = str_replace(",", "", $orderSummary['discount']);
                $orderGroup->totalPostDiscount = str_replace(",", "", $orderSummary['total']) - str_replace(",", "", $orderSummary['discount']);
                $orderGroup->parentId = isset($newOrderGroupId) ? $newOrderGroupId : $orderGroupId;
                $orderGroup->status = 0;

//Distributor Discount & Spacial Project Discount
                if (isset($orderSummary['partnerDiscountPercent'])) {
                    $orderGroup->partnerDiscountPercent = str_replace(",", "", $orderSummary['partnerDiscountPercent']);
                    $orderGroup->partnerDiscountValue = str_replace(",", "", $orderSummary['partnerDiscount']);
//					$orderGroup->totalPostPartnerDiscount = str_replace(",", "", $orderSummary['totalPostPartnerDiscount']);
                } else if (isset($orderSummary['distributorDiscountPercent'])) {
                    $orderGroup->distributorDiscountPercent = str_replace(",", "", $orderSummary['distributorDiscountPercent']);
                    $orderGroup->distributorDiscount = str_replace(",", "", $orderSummary['distributorDiscount']);

                    $orderGroup->totalPostDistributorDiscount = str_replace(",", "", $orderSummary['totalPostDistributorDiscount']);
                }
                if (isset($orderSummary['extraDiscount'])) {
                    $orderGroup->extraDiscount = str_replace(",", "", $orderSummary['extraDiscount']);
                }
//Distributor Discount & Spacial Project Discount
//                                throw new Exception(print_r($orderSummary,true));

                $orderGroup->vatPercent = OrderGroup::VAT_PERCENT;
                $orderGroup->vatValue = $orderGroup->calVatValue();
                $orderGroup->userId = Yii::app()->user->id;
                $orderGroup->paymentMethod = isset($_POST['paymentMethod']) ? $_POST['paymentMethod'] : $oldOrderGroup->paymentMethod;
                $orderGroup->createDateTime = new CDbExpression("NOW()");
                $orderGroup->updateDateTime = new CDbExpression("NOW()");
                if ($orderGroup->save(false)) {
                    $newOrderGroupId = Yii::app()->db->getLastInsertID();

                    $flag = TRUE;
                    $product = Product::model()->findByPk($model->productId);
                    $price = ($product->calProductPromotionPrice() != 0) ? $product->calProductPromotionPrice() : $product->calProductPrice();
                    $quantity = $oldOrderGroup->orderGroupToOrders[0]->order->orderItems[0]->quantity;
                    $totalIncVat = $price * $quantity;
                    $order = new Order();
                    $order->userId = Yii::app()->user->id;
                    $order->supplierId = $supplierId;
                    $order->title = $product->name;
                    $order->type = 4;
                    $order->totalIncVAT = $totalIncVat;
                    $order->total = $order->totalIncVAT / 1.07;
                    $order->provinceId = $oldOrderGroup->orderGroupToOrders[0]->order->provinceId;
                    $order->createDateTime = new CDbExpression("NOW()");
                    $order->updateDateTime = new CDbExpression("NOW()");

                    if ($order->save()) {
                        $orderId = Yii::app()->db->lastInsertID;
                        foreach ($oldOrderGroup->orderGroupToOrders[0]->order->orderItems as $orderItem) {
                            $orderItems = new OrderItems();
                            $orderItems->orderId = $orderId;
                            $orderItems->productId = $model->productId;
                            $orderItems->quantity = $quantity;
                            $total = $price * $quantity;
                            $orderItems->price = $price;
                            $orderItems->total = $total;
                            $orderItems->styleId = $oldOrderGroup->orderGroupToOrders[0]->order->orderItems[0]->styleId;
                            $orderItems->productOptionId = $oldOrderGroup->orderGroupToOrders[0]->order->orderItems[0]->productOptionId;
                            $orderItems->createDateTime = new CDbExpression("NOW()");
                            $orderItems->updateDateTime = new CDbExpression("NOW()");
                            if ($orderItems->save(false)) {
                                $orderItemId = Yii::app()->db->lastInsertID;
                                foreach ($orderItem->orderItemOptions as $orderOptions) {
                                    $orderItemOption = new OrderItemOption();
                                    $orderItemOption->orderItemId = $orderItemId;
                                    $orderItemOption->productOptionGroupId = $orderOptions->productOptionGroupId;
                                    $orderItemOption->productOptionId = $orderOptions->productOptionId;
                                    $productOption = ProductOption::model()->findByPk($orderOptions->productOptionId);
                                    if (isset($productOption->pricePercent) && intval($productOption->pricePercent) > 0) {
                                        $orderItemOption->percent = $productOption->pricePercent;
                                        $orderItemOption->total = $orderItem->total * ($productOption->pricePercent / 100);
                                    } else {
                                        $orderItemOption->percent = 0;
                                        $orderItemOption->total = 0;
                                    }
                                    if (isset($productOption->priceValue) && intval($productOption->priceValue) > 0) {
                                        $orderItemOption->value = $productOption->priceValue;
                                        $orderItemOption->total = $productOption->priceValue * $orderItem->quantity;
                                    } else {
                                        $orderItemOption->value = 0;
                                        $orderItemOption->total += 0;
                                    }
                                    $orderItemOption->createDateTime = new CDbExpression("NOW()");
                                    $orderItemOption->updateDateTime = new CDbExpression("NOW()");
                                    if ($orderItemOption->save()) {
                                        $orderItems->total +=$orderItemOption->total;
                                        $orderItems->save(FALSE);
                                    } else {

                                    }
                                }
                            }
                        }
                        $orderGroupToOrder = new OrderGroupToOrder();
                        $orderGroupToOrder->orderGroupId = $newOrderGroupId;
                        $orderGroupToOrder->orderId = $orderId;
                        $orderGroupToOrder->createDateTime = new CDbExpression("NOW()");
                        $orderGroupToOrder->updateDateTime = new CDbExpression("NOW()");
                        if (!$orderGroupToOrder->save()) {
                            $flag = FALSE;
                        }
                    }
                }
            }
            if ($flag) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
            $transaction->rollback();
        }
    }

    public function actionMyfileGinzaStep()
    {

        $orderGroup = OrderGroup::model()->findByPk($_GET["orderGroupId"]);
        $rootOrderGroup = OrderGroup::model()->findRootOrderGroup($_GET["orderGroupId"]);
        $orderSummary = Order::model()->sumOrderTotalByProductIdAndQuantity($orderGroup->orders[0]->orderItems[0]->productId, $orderGroup->orders[0]->orderItems[0]->quantity, $orderGroup->supplierId, FALSE, $_GET["orderGroupId"]);

        if (isset($_POST["period"])) {
            if ($_POST["period"] == 2) {
                $cat2p = $orderGroup->orders[0]->orderItems[0]->product->category2ToProducts[0];
//				throw new Exception(print_r($_POST, true));
//				throw new Exception(print_r($cat2p->attributes, true));
                if ($cat2p->brandModelId != $_POST["brandModelId"] || $cat2p->category1Id != $_POST["category1Id"] || $cat2p->category2Id != $_POST["category2Id"] || $orderGroup->shippingProvinceId != $_POST["provinceId"] || $orderGroup->orders[0]->orderItems[0]->productOptionId != $_POST["productOptionId"] || (isset($orderGroup->orders[0]->orderItems[0]->styleId) && $orderGroup->orders[0]->orderItems[0]->styleId != $_POST["styleId"])) {

                    try {
                        $cat2ToProduct = Category2ToProduct::model()->findAll("brandModelId = " . $_POST["brandModelId"] . " AND category1Id = " . $_POST["category1Id"] . " AND category2Id =" . $_POST["category2Id"]);
                        if (isset($cat2ToProduct)) {
                            $this->updateChangeSpecGinzaOrderGroup($orderGroup, $cat2ToProduct, 2);
                            $orderThree = $orderGroup->child;
                            $this->updateChangeSpecGinzaOrderGroup($orderThree, $cat2ToProduct, 3);
                            $orderFour = $orderThree->child;
                            $this->updateChangeSpecGinzaOrderGroup($orderFour, $cat2ToProduct, 4);
                            $flag = true;
                        }
                        if ($flag) {
//							$bankArray = Bank::model()->findAllBankModelBySupplier(4);
//							$this->render('step4', array(
//								'step'=>4,
//								'orderSummary'=>$orderSummary,
//								'bankArray'=>$bankArray,
//							));
                        } else {
                            $transaction->rollback();
                        }
                    } catch (Exception $e) {
                        throw new Exception($e->getMessage());
                        $transaction->rollback();
                    }
                } else {
//					$bankArray = Bank::model()->findAllBankModelBySupplier(4);
//					$this->render('step4', array(
//						'step'=>4,
//						'orderSummary'=>$orderSummary,
//						'bankArray'=>$bankArray,
//					));
                }
            }
//		}
//		else
//		{
//			if(isset($_POST["period"]))
//			{
            $sumSupPay = 0;
            foreach ($orderGroup->sup as $sup) {
                $sumSupPay +=$sup->totalIncVAT;
            }
            if ($orderGroup->totalIncVAT != $_POST["payValue"]) {

                if ($orderGroup->totalIncVAT >= ($_POST["payValue"] + $sumSupPay) && $_POST["payValue"] >= 1000) {

                    $orderSummary = Order::model()->sumOrderTotalByProductIdAndQuantity(null, $orderGroup->orderGroupToOrders[0]->order->orderItems[0]->quantity, $orderGroup->supplierId, $_POST["payValue"], FALSE, $_GET["orderGroupId"]);
                    $oldOrderGroup = $orderGroup;
                    $titleBlankOrderAndOrderItem = "รายการแบ่งชำระเงิน ของ" . $oldOrderGroup->orderGroupToOrders[0]->order->orderItems[0]->product->name;
                    $orderGroup = OrderGroup::model()->find("mainId = " . $oldOrderGroup->orderGroupId . " AND status =0");
                    if (!isset($orderGroup)) {
                        $orderGroup = new OrderGroup();
                    }
                    $orderGroup->attributes = $oldOrderGroup->attributes;
                    $orderGroup->orderNo = $orderGroup->genOrderNo($orderGroup->supplierId);
                    $orderGroup->summary = str_replace(",", "", $orderSummary['grandTotal']);
                    $orderGroup->totalIncVAT = str_replace(",", "", $orderSummary['total']);
                    $orderGroup->total = $orderGroup->totalIncVAT / 1.07;
                    $orderGroup->discountPercent = str_replace(",", "", $orderSummary['discountPercent']);
                    $orderGroup->discountValue = str_replace(",", "", $orderSummary['discount']);
                    $orderGroup->totalPostDiscount = str_replace(",", "", $orderSummary['total']) - str_replace(",", "", $orderSummary['discount']);
                    $orderGroup->status = 0;
//Distributor Discount & Spacial Project Discount
                    if (isset($orderSummary['distributorDiscountPercent'])) {
                        $orderGroup->distributorDiscountPercent = str_replace(",", "", $orderSummary['distributorDiscountPercent']);
                        $orderGroup->distributorDiscount = str_replace(",", "", $orderSummary['distributorDiscount']);

                        $orderGroup->totalPostDistributorDiscount = str_replace(",", "", $orderSummary['totalPostDistributorDiscount']);
                    }
                    if (isset($orderSummary["extraDiscountArray"][$rootOrderGroup->orderGroupId]['extraDiscount'])) {
                        $orderGroup->extraDiscount = $orderSummary["extraDiscountArray"][$rootOrderGroup->orderGroupId]['extraDiscount'];
                    }
//Distributor Discount & Spacial Project Discount
                    $orderGroup->vatPercent = OrderGroup::VAT_PERCENT;
                    $orderGroup->vatValue = $orderGroup->calVatValue();
                    $orderGroup->userId = Yii::app()->user->id;
                    $orderGroup->mainId = $oldOrderGroup->orderGroupId;
                    $orderGroup->createDateTime = new CDbExpression("NOW()");
                    $orderGroup->updateDateTime = new CDbExpression("NOW()");
                    if ($orderGroup->save(false)) {
                        $this->saveBlankOrderAndOrderItem($oldOrderGroup->orderGroupId, $orderGroup->orderGroupId, $orderGroup->supplierId, str_replace(",", "", $orderSummary['total']), $titleBlankOrderAndOrderItem);
                        $oldOrderGroup->status = -1;
                        $oldOrderGroup->save(FALSE);
                        $bankArray = Bank::model()->findAllBankModelBySupplier($orderGroup->supplierId);
                        $supplierModel = Supplier::model()->findByPk($orderGroup->supplierId);
                        $this->render('step4', array(
                            'step' => 4,
                            'orderSummary' => $orderSummary,
                            'bankArray' => $bankArray,
                            'supplierModel' => $supplierModel
                        ));
                    }
                } else {
                    $this->redirect(array(
                        "/myfile/ginzaHome/view",
                        'id' => $orderGroup->parent->orderGroupId,
                        'errorMessage' => 'ไม่สามารถชำระยอดเงินเกินที่กำหนด หรือ ต้องชำระตั้งแต่ 1,000 บาทขึ้นไป  !!!'));
                }
            } else {
                $orderSummary = Order::model()->sumOrderTotalByProductIdAndQuantity(null, $orderGroup->orderGroupToOrders[0]->order->orderItems[0]->quantity, $orderGroup->supplierId, $_POST["payValue"], FALSE, $_GET["orderGroupId"]);
                $orderGroup->summary = str_replace(",", "", $orderSummary['grandTotal']);
                $orderGroup->totalIncVAT = str_replace(",", "", $orderSummary['total']);
                $orderGroup->total = $orderGroup->totalIncVAT / 1.07;
                $orderGroup->discountPercent = str_replace(",", "", $orderSummary['discountPercent']);
                $orderGroup->discountValue = str_replace(",", "", $orderSummary['discount']);
                $orderGroup->totalPostDiscount = str_replace(",", "", $orderSummary['total']) - str_replace(",", "", $orderSummary['discount']);
                $orderGroup->status = 0;
//Distributor Discount & Spacial Project Discount
                if (isset($orderSummary['distributorDiscountPercent'])) {
                    $orderGroup->distributorDiscountPercent = str_replace(",", "", $orderSummary['distributorDiscountPercent']);
                    $orderGroup->distributorDiscount = str_replace(",", "", $orderSummary['distributorDiscount']);

                    $orderGroup->totalPostDistributorDiscount = str_replace(",", "", $orderSummary['totalPostDistributorDiscount']);
                }
                if (isset($orderSummary["extraDiscountArray"][$rootOrderGroup->orderGroupId]['extraDiscount'])) {
                    $orderGroup->extraDiscount = $orderSummary["extraDiscountArray"][$rootOrderGroup->orderGroupId]['extraDiscount'];
                }
//Distributor Discount & Spacial Project Discount
                $orderGroup->vatPercent = OrderGroup::VAT_PERCENT;
                $orderGroup->vatValue = $orderGroup->calVatValue();
                $orderGroup->userId = Yii::app()->user->id;
                $orderGroup->createDateTime = new CDbExpression("NOW()");
                $orderGroup->updateDateTime = new CDbExpression("NOW()");
                if ($orderGroup->save()) {
                    $bankArray = Bank::model()->findAllBankModelBySupplier($orderGroup->supplierId);
                    $supplierModel = Supplier::model()->findByPk($orderGroup->supplierId);
                    $this->render('step4', array(
                        'step' => 4,
                        'orderSummary' => $orderSummary,
                        'bankArray' => $bankArray,
                        'supplierModel' => $supplierModel,
                    ));
                }
            }
//			}
        }

        if (isset($_POST['paymentMethod'])) {
            if ($_POST['paymentMethod'] == 1) {
                $orderGroup->paymentMethod = 1;
                $orderGroup->save(false);
                $this->redirect(array(
                    "confirmCheckout",
                    'id' => isset($orderGroup->supNotPay) ? $orderGroup->supNotPay->orderGroupId : $orderGroup->orderGroupId));
            } else {
                $orderGroup->paymentMethod = 2;
                $orderGroup->save(false);
                $emailObj = new Email();
                $sentMail = new EmailSend();
                $documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/myfile/";
                $emailObj->Setmail($orderGroup->userId, null, $orderGroup->supplierId, $orderGroup->orderGroupId, null, $documentUrl);
                $sentMail->mailCompleteOrderCustomer($emailObj);
                $sentMail->mailConfirmOrderSupplierDealer($emailObj);
                $this->redirect(array(
                    'step6',
                    "id" => isset($orderGroup->supNotPay) ? $orderGroup->supNotPay->orderGroupId : $orderGroup->orderGroupId,
                ));
            }
        }
    }

    public function actionUpdateCart()
    {
        if (isset($_POST['quantity'])) {
            $res = [];

            foreach ($_POST['quantity'] as $orderItemsId => $quantity) {
                $orderItem = OrderItems::model()->findByPk($orderItemsId);

                if ($orderItem->quantity == $quantity) {
                    continue;
                } else {
                    $orderItem->quantity = $quantity;
                    $orderItem->total = $orderItem->quantity * $orderItem->price;
                    $orderItem->save(FALSE);

                    $res['orderItem'][$orderItem->orderItemsId]['total'] = number_format($orderItem->quantity * $orderItem->price, 2);
                }
            }

            $order = Order::model()->findByPk($_POST['orderId']);
            $order->totalIncVAT = $order->orderItemsSum;
            $order->save(false);
            $res['orderTotal'] = number_format($order->totalIncVAT, 2);
            $res['summary'] = $order->sumOrderTotalBySupplierId($order->supplierId);

            echo CJSON::encode($res);
        }
    }

    public function actionMyfileFurnitureStep()
    {
        $orderGroup = OrderGroup::model()->findByPk($_GET["orderGroupId"]);
        if (isset($_POST["furnitureGroupId"])) {
            $furnitureGroup = FurnitureGroup::model()->findByPk($_POST["furnitureGroupId"]);

            $orderSummary = Order::model()->sumOrderTotalByProductIdAndQuantity(null, $orderGroup->orderGroupToOrders[0]->order->orderItems[0]->quantity, $orderGroup->supplierId, $furnitureGroup->price, false);
            $oldOrderGroup = $orderGroup;
            $titleBlankOrderAndOrderItem = "Furniture Set " . $furnitureGroup->title . " " . $orderGroup->orderGroupToOrders[0]->order->orderItems[0]->product->name;


            if (!isset($orderGroup->fur[0])) {
                $orderGroup = new OrderGroup();
            } else {
                $orderGroup = OrderGroup::model()->findByPk($orderGroup->fur[0]->orderGroupId);
            }

            $orderSummary['grandTotal'] = $furnitureGroup->price;
            $orderSummary['total'] = $furnitureGroup->price;
            $orderSummary['discountPercent'] = 0;
            $orderSummary['discount'] = 0;

            $orderGroup->attributes = $oldOrderGroup->attributes;
//			throw new Exception(print_r($orderGroup, true));
            $orderGroup->invoiceNo = null;
            $orderGroup->mainFurnitureId = $_GET["orderGroupId"];
            $orderGroup->furnitureGroupId = $_POST["furnitureGroupId"];
            $orderGroup->furnitureId = $_POST["furnitureId"];
            $orderGroup->orderNo = $orderGroup->genOrderNo($orderGroup->supplierId);
            $orderGroup->summary = str_replace(",", "", $orderSummary['grandTotal']);
            $orderGroup->totalIncVAT = str_replace(",", "", $orderSummary['total']);
            $orderGroup->total = $orderGroup->totalIncVAT / 1.07;
            $orderGroup->discountPercent = str_replace(",", "", $orderSummary['discountPercent']);
            $orderGroup->discountValue = str_replace(",", "", $orderSummary['discount']);
            $orderGroup->totalPostDiscount = str_replace(",", "", $orderSummary['total']) - str_replace(",", "", $orderSummary['discount']);
            $orderGroup->status = 1;
//Distributor Discount & Spacial Project Discount
//			if(isset($orderSummary['distributorDiscountPercent']))
//			{
//				$orderGroup->distributorDiscountPercent = str_replace(",", "", $orderSummary['distributorDiscountPercent']);
//				$orderGroup->distributorDiscount = str_replace(",", "", $orderSummary['distributorDiscount']);
//
//				$orderGroup->totalPostDistributorDiscount = str_replace(",", "", $orderSummary['totalPostDistributorDiscount']);
//			}
//			if(isset($orderSummary['extraDiscount']))
//			{
//				$orderGroup->extraDiscount = str_replace(",", "", $orderSummary['extraDiscount']);
//			}
//Distributor Discount & Spacial Project Discount

            $orderGroup->vatPercent = OrderGroup::VAT_PERCENT;
            $orderGroup->vatValue = $orderGroup->calVatValue();
            $orderGroup->userId = Yii::app()->user->id;
            $orderGroup->mainId = $oldOrderGroup->orderGroupId;
            $orderGroup->createDateTime = new CDbExpression("NOW()");
            $orderGroup->updateDateTime = new CDbExpression("NOW()");

//			$orderGroup = new OrderGroup;
            if ($orderGroup->isNewRecord) {
                $orderGroup->orderGroupId = null;
            }
            if ($orderGroup->save()) {
                $this->saveBlankOrderAndOrderItem($_GET["orderGroupId"], $orderGroup->orderGroupId, $orderGroup->supplierId, str_replace(",", "", $orderSummary['total']), $titleBlankOrderAndOrderItem);
                $bankArray = Bank::model()->findAllBankModelBySupplier($orderGroup->supplierId);
                $supplierModel = Supplier::model()->findByPk($orderGroup->supplierId);
                $this->render('step4', array(
                    'step' => 4,
                    'orderSummary' => $orderSummary,
                    'bankArray' => $bankArray,
                    'supplierModel' => $supplierModel
                ));
            } else {
                $this->saveBlankOrderAndOrderItem($_GET["orderGroupId"], $orderGroup->orderGroupId, $orderGroup->supplierId, str_replace(",", "", $orderSummary['total']), $titleBlankOrderAndOrderItem);
                $bankArray = Bank::model()->findAllBankModelBySupplier($orderGroup->supplierId);
                $supplierModel = Supplier::model()->findByPk($orderGroup->supplierId);
                $this->render('step4', array(
                    'step' => 4,
                    'orderSummary' => $orderSummary,
                    'bankArray' => $bankArray,
                    'supplierModel' => $supplierModel
                ));
            }
        }
        if (isset($_POST['paymentMethod'])) {
            if ($_POST['paymentMethod'] == 1) {
                $orderGroup->paymentMethod = 1;
                $orderGroup->save(false);
                $this->redirect(array(
                    "confirmCheckout",
                    'id' => $orderGroup->fur[0]->orderGroupId));
            } else {
                $orderGroup->paymentMethod = 2;
                $orderGroup->save(false);
                $emailObj = new Email();
                $sentMail = new EmailSend();
                $documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/myfile/";
                $emailObj->Setmail($orderGroup->userId, null, $orderGroup->supplierId, $orderGroup->orderGroupId, null, $documentUrl);
                $sentMail->mailCompleteOrderCustomer($emailObj);
                $sentMail->mailConfirmOrderSupplierDealer($emailObj);
                $this->redirect(array(
                    'step6',
                    "id" => $orderGroup->fur[0]->orderGroupId,
                ));
            }
        }
    }

    public function updateChangeSpecGinzaOrderGroup($orderGroup, $cat2ToProduct, $period)
    {
        $productId = $cat2ToProduct[$period - 1]->productId;
        $qty = $orderGroup->orders[0]->orderItems[0]->quantity;
        $supplierId = $orderGroup->supplierId;

//		throw new Exception(print_r("change spec", true));
        $orderSummary = Order::model()->sumOrderTotalByProductIdAndQuantity($productId, $qty, $supplierId, null, false, $orderGroup->orderGroupId);
        $orderGroup->attributes = $orderGroup->attributes;
        $orderGroup->orderNo = $orderGroup->genOrderNo($orderGroup->supplierId);
        $orderGroup->invoiceNo = null;
        $orderGroup->summary = str_replace(",", "", $orderSummary['grandTotal']);
        $orderGroup->totalIncVAT = str_replace(",", "", $orderSummary['total']);
        $orderGroup->total = $orderGroup->totalIncVAT / 1.07;
        $orderGroup->discountPercent = str_replace(",", "", $orderSummary['discountPercent']);
        $orderGroup->discountValue = str_replace(",", "", $orderSummary['discount']);
        $orderGroup->totalPostDiscount = str_replace(",", "", $orderSummary['total']) - str_replace(",", "", $orderSummary['discount']);
        $orderGroup->status = 0;
//Distributor Discount & Spacial Project Discount
        if (isset($orderSummary['distributorDiscountPercent'])) {
            $orderGroup->distributorDiscountPercent = str_replace(",", "", $orderSummary['distributorDiscountPercent']);
            $orderGroup->distributorDiscount = str_replace(",", "", $orderSummary['distributorDiscount']);

            $orderGroup->totalPostDistributorDiscount = str_replace(",", "", $orderSummary['totalPostDistributorDiscount']);
        }
        if (isset($orderSummary['extraDiscount'])) {
            $orderGroup->extraDiscount = str_replace(",", "", $orderSummary['extraDiscount']);
        }
//Distributor Discount & Spacial Project Discount

        $orderGroup->vatPercent = OrderGroup::VAT_PERCENT;
        $orderGroup->vatValue = $orderGroup->calVatValue();
        $orderGroup->userId = Yii::app()->user->id;
        $orderGroup->updateDateTime = new CDbExpression("NOW()");
        if ($orderGroup->save(false)) {

            $flag = TRUE;
            $product = Product::model()->findByPk($cat2ToProduct[$period - 1]->productId);
            $price = ($product->calProductPromotionPrice() != 0) ? $product->calProductPromotionPrice() : $product->calProductPrice();
            $quantity = $orderGroup->orderGroupToOrders[0]->order->orderItems[0]->quantity;
            $totalIncVat = $price * $quantity;
            $order = $orderGroup->orderGroupToOrders[0]->order;
            $order->userId = Yii::app()->user->id;
            $order->title = $product->name;
            $order->type = 4;
            $order->totalIncVAT = $totalIncVat;
            $order->total = $order->totalIncVAT / 1.07;
            $order->updateDateTime = new CDbExpression("NOW()");

            if ($order->save()) {
                foreach ($orderGroup->orderGroupToOrders[0]->order->orderItems as $orderItem) {
                    $orderItem->productId = $cat2ToProduct[$period - 1]->productId;
                    $orderItem->quantity = $quantity;
                    $total = $price * $quantity;
                    $orderItem->price = $price;
                    $orderItem->total = $total;
                    $orderItem->createDateTime = new CDbExpression("NOW()");
                    $orderItem->updateDateTime = new CDbExpression("NOW()");
                    if ($orderItem->save(false)) {
                        foreach ($orderItem->orderItemOptions as $orderOptions) {
                            $orderItemOption = new OrderItemOption();
                            $orderItemOption->productOptionGroupId = $orderOptions->productOptionGroupId;
                            $orderItemOption->productOptionId = $orderOptions->productOptionId;
                            $productOption = ProductOption::model()->findByPk($orderOptions->productOptionId);
                            if (isset($productOption->pricePercent) && intval($productOption->pricePercent) > 0) {
                                $orderItemOption->percent = $productOption->pricePercent;
                                $orderItemOption->total = $orderItem->total * ($productOption->pricePercent / 100);
                            } else {
                                $orderItemOption->percent = 0;
                                $orderItemOption->total = 0;
                            }
                            if (isset($productOption->priceValue) && intval($productOption->priceValue) > 0) {
                                $orderItemOption->value = $productOption->priceValue;
                                $orderItemOption->total = $productOption->priceValue * $orderItem->quantity;
                            } else {
                                $orderItemOption->value = 0;
                                $orderItemOption->total += 0;
                            }
                            $orderItemOption->createDateTime = new CDbExpression("NOW()");
                            $orderItemOption->updateDateTime = new CDbExpression("NOW()");
                            if ($orderItemOption->save()) {
                                $orderItems->total += $orderItemOption->total;
                                $orderItems->save(FALSE);
                            } else {

                            }
                        }
                    }
                }
            }
        }
    }

    public function saveBlankOrderAndOrderItem($oldOrderGroupId, $newOrderGroupId, $supplierId, $price, $title)
    {

        $flag = TRUE;
        $orderGroup = OrderGroup::model()->findByPk($oldOrderGroupId);
        $product = Product::model()->findByPk($orderGroup->orderGroupToOrders[0]->order->orderItems[0]->productId);
        $quantity = 1;
        $totalIncVat = $price * $quantity;
        $newOrderGroup = OrderGroup::model()->findByPk($newOrderGroupId);
        if (isset($newOrderGroup) && isset($newOrderGroup->orderGroupToOrders[0]->order)) {
            $order = $newOrderGroup->orderGroupToOrders[0]->order;
        } else {
            $order = new Order();
        }
        $order->userId = Yii::app()->user->id;
        $order->supplierId = $supplierId;
        $order->title = $title;
        $order->type = $supplierId;
        $order->totalIncVAT = $totalIncVat;
        $order->total = $order->totalIncVAT / 1.07;
        $order->provinceId = $orderGroup->orderGroupToOrders[0]->order->provinceId;
        $order->createDateTime = new CDbExpression("NOW()");
        $order->updateDateTime = new CDbExpression("NOW()");

        if ($order->save()) {
            $orderItems = OrderItems::model()->find("orderId = $order->orderId");
            if (!isset($orderItems)) {
                $orderId = Yii::app()->db->lastInsertID;
                $orderItems = new OrderItems();
            } else {
                $orderId = $order->orderId;
            }
            $orderItems->title = $title;
            $orderItems->orderId = $orderId;
//			$orderItems->productId = $product->productId;
            $orderItems->productId = null;
            $orderItems->quantity = $quantity;
            $total = $price * $quantity;
            $orderItems->price = $price;
            $orderItems->total = $total;
            $orderItems->createDateTime = new CDbExpression("NOW()");
            $orderItems->updateDateTime = new CDbExpression("NOW()");
            if ($orderItems->save(false)) {
//				$orderItemId = Yii::app()->db->lastInsertID;
//				foreach($orderItem->orderItemOptions as $orderOptions)
//				{
//					$orderItemOption = new OrderItemOption();
//					$orderItemOption->orderItemId = $orderItemId;
//					$orderItemOption->productOptionGroupId = $orderOptions->productOptionGroupId;
//					$orderItemOption->productOptionId = $orderOptions->productOptionId;
//					$productOption = ProductOption::model()->findByPk($orderOptions->productOptionId);
//					if(isset($productOption->pricePercent) && intval($productOption->pricePercent) > 0)
//					{
//						$orderItemOption->percent = $productOption->pricePercent;
//						$orderItemOption->total = $orderItem->total * ($productOption->pricePercent / 100);
//					}
//					else
//					{
//						$orderItemOption->percent = 0;
//						$orderItemOption->total = 0;
//					}
//					if(isset($productOption->priceValue) && intval($productOption->priceValue) > 0)
//					{
//						$orderItemOption->value = $productOption->priceValue;
//						$orderItemOption->total = $productOption->priceValue * $orderItem->quantity;
//					}
//					else
//					{
//						$orderItemOption->value = 0;
//						$orderItemOption->total += 0;
//					}
//					$orderItemOption->createDateTime = new CDbExpression("NOW()");
//					$orderItemOption->updateDateTime = new CDbExpression("NOW()");
//					if($orderItemOption->save())
//					{
//						$orderItems->total +=$orderItemOption->total;
//						$orderItems->save(FALSE);
//					}
//					else
//					{
//
//					}
//				}
            }
            $orderGroupToOrder = OrderGroupToOrder::model()->find("orderGroupId = $newOrderGroupId AND orderId = $orderId");
            if (!isset($orderGroupToOrder)) {
                $orderGroupToOrder = new OrderGroupToOrder();
            }
            $orderGroupToOrder->orderGroupId = $newOrderGroupId;
            $orderGroupToOrder->orderId = $orderId;
            $orderGroupToOrder->createDateTime = new CDbExpression("NOW()");
            $orderGroupToOrder->updateDateTime = new CDbExpression("NOW()");
            if (!$orderGroupToOrder->save()) {
                $flag = FALSE;
            }
        }

        return $flag;
    }

// Use This Function for Pay OrderGroup Status 0
    public function actionPayWrongOrder()
    {
        $orderGroup = OrderGroup::model()->findByPk($_GET["orderGroupId"]);
        $orderSummary = Order::model()->sumOrderTotalByProductIdAndQuantity(null, $orderGroup->orderGroupToOrders[0]->order->orderItems[0]->quantity, $orderGroup->supplierId, $orderGroup->orderGroupToOrders[0]->order->orderItems[0]->price, false, $_GET["orderGroupId"]);
        $bankArray = Bank::model()->findAllBankModelBySupplier($orderGroup->supplierId);
        $supplierModel = Supplier::model()->findByPk($orderGroup->supplierId);


        if (isset($_POST['paymentMethod'])) {
            if ($_POST['paymentMethod'] == 1) {
                $orderGroup->paymentMethod = 1;
                $orderGroup->save(false);
                $this->redirect(array(
                    "confirmCheckout",
                    'id' => isset($orderGroup->supNotPay) ? $orderGroup->supNotPay->orderGroupId : $orderGroup->orderGroupId));
            } else {
                $orderGroup->paymentMethod = 2;
                $orderGroup->save(false);
                $emailObj = new Email();
                $sentMail = new EmailSend();
                $documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/myfile/";
                $emailObj->Setmail($orderGroup->userId, null, $orderGroup->supplierId, $orderGroup->orderGroupId, null, $documentUrl);
                $sentMail->mailCompleteOrderCustomer($emailObj);
                $sentMail->mailConfirmOrderSupplierDealer($emailObj);
                $this->redirect(array(
                    'step6',
                    "id" => isset($orderGroup->supNotPay) ? $orderGroup->supNotPay->orderGroupId : $orderGroup->orderGroupId,
                ));
            }
        }
        $this->render('step4', array(
            'step' => 4,
            'orderSummary' => $orderSummary,
            'bankArray' => $bankArray,
            'supplierModel' => $supplierModel
        ));
    }

    public function actionIsValidEmail()
    {
        $email = $_POST['email'];
        $res = User::model()->findAll('email = "' . $email . '"');

        $result["status"] = count($res) > 0 ? false : true;
        echo CJSON::encode($result);
    }

}
