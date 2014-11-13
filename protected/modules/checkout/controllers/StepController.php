<?php

class StepController extends MasterCheckoutController
{

	public function actionIndex($id)
	{
		if($id > 1)
		{
			if(!isset(Yii::app()->user->id))
			{
				$this->redirect($this->createUrl(1));
			}
		}

		switch($id)
		{
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
		if(Yii::app()->user->id)
		{
			$this->redirect($this->createUrl(2));
		}
		$loginModel = new LoginForm();
		$userModel = new User();
		$addressModel = new Address();
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();

		//Login
		if(isset($_POST['Login']))
		{
			$loginModel->username = $_POST['User']['email'];
			$loginModel->password = $_POST['User']['password'];
			// validate user input and redirect to the previous page if valid
			if($loginModel->validate() && $loginModel->login())
			{
				/**
				 * update order set userId = Yii::app()->user->id
				 */
				$orders = Order::model()->findAll(array(
					'condition'=>'type&' . Order::ORDER_TYPE_CART . ' > 0 AND token=:token AND supplierId=:supplierId',
					'params'=>array(
						':token'=>$daiibuy->token,
						':supplierId'=>Yii::app()->session['supplierId'],
					),
				));

				foreach($orders as $order)
				{
					$order->userId = Yii::app()->user->id;
					$order->save(false);
				}
				$this->redirect($this->createUrl(2));
			}
			else
			{
				$loginModel->addError('username', 'Log in failed.');
			}
		}

		//Register new user
		if(isset($_POST['Register']))
		{
			$userModel->attributes = $_POST['User'];
			$addressModel->attributes = $_POST['Address'];

			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				//code here
				if($userModel->save())
				{
					$addressModel->userId = Yii::app()->db->getlastInsertID();
					$addressModel->type = $addressModel::ADDRESS_TYPE_BILLING;

					if($addressModel->save())
					{
						/**
						 * update order set userId = Yii::app()->user->id
						 */
						$orders = Order::model()->findAll(array(
							'condition'=>'type&' . Order::ORDER_TYPE_CART . ' > 0 AND token=:token AND supplierId=:supplierId',
							'params'=>array(
								':token'=>$daiibuy->token,
								':supplierId'=>Yii::app()->session['supplierId'],
							),
						));

						foreach($orders as $order)
						{
							$order->userId = $addressModel->userId;
							$order->save(false);
						}
						$flag = true;
					}
				}

				if($flag)
				{
					$transaction->commit();

					//redirect to step 2
					$identity = new UserIdentity($userModel->email, $userModel->password);
					$identity->authenticate();
					Yii::app()->user->login($identity);
					$this->redirect($this->createUrl(2));
				}
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
		}
		$this->render('step1', array(
			'loginModel'=>$loginModel,
			'userModel'=>$userModel,
			'addressModel'=>$addressModel,
			'step'=>1,
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

		if(isset($_POST['Next']))
		{
			$this->writeToFile('/tmp/step2', print_r($_POST, true));
			//billing
			if($_POST['billingRadio'] == 1)
			{
				Yii::app()->session['billingAddressId'] = $_POST['existingBillingAddress'];
			}
			else
			{
				//add new billing address
				$billingAddressModel->attributes = $_POST['billing'];
			}

			if($_POST['shippingRadio'] == 1)
			{
				Yii::app()->session['shippingAddressId'] = $_POST['existingShippingAddress'];
			}
			else
			{
				//add new shipping address
				$shippingAddressModel->attributes = $_POST['shipping'];
			}

			$this->redirect($this->createUrl(3));
		}

		$this->render('step2', array(
			'billingAddressModel'=>$billingAddressModel,
			'shippingAddressModel'=>$shippingAddressModel,
			'step'=>2
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

		if(isset($userId))
		{
			$orders = Order::model()->findAll(array(
				'condition'=>'type&' . Order::ORDER_TYPE_CART . ' > 0 AND userId=:userId AND supplierId=:supplierId',
				'params'=>array(
					':userId'=>$userId,
					':supplierId'=>$supplierId,
				),
				'order'=>'type, orderId'
			));
		}
		else
		{
			$orders = Order::model()->findAll(array(
				'condition'=>'type&' . Order::ORDER_TYPE_CART . ' > 0 AND token=:token AND supplierId=:supplierId',
				'params'=>array(
					':token'=>$token,
					':supplierId'=>$supplierId,
				),
			));
		}
		$orderSummary = Order::model()->sumOrderTotalBySupplierId($supplierId);
		$supplierModel = Supplier::model()->findByPk($supplierId);
		$userModel = User::model()->findByPk(Yii::app()->user->id);
		$shippingAddress = Address::model()->findByPk(Yii::app()->session['shippingAddressId']);
		$billingAddress = Address::model()->findByPk(Yii::app()->session['billingAddressId']);

//                                        throw new Exception(print_r(Yii::app()->session['shippingAddressId'].", ".Yii::app()->session['billingAddressId'],true));
//                throw new Exception(print_r($daiibuy,true));
		$this->render('step3', array(
			'step'=>3,
			'orderSummary'=>$orderSummary,
			'orders'=>$orders,
			'supplierName'=>$supplierModel->name,
			'billingAddress'=>$billingAddress,
			'shippingAddress'=>$shippingAddress,
			'userModel'=>$userModel,
		));
		//$this->redirect($this->createUrl(4));
	}

	public function step4()
	{
		$supplierId = Yii::app()->session['supplierId'];
		if(isset($_POST["productId"]))
			$productId = $_POST["productId"];

		if(!isset($productId))
		{
			$orderSummary = Order::model()->sumOrderTotalBySupplierId($supplierId);
		}
		else
		{
			$orderSummary = array();
			$product = Product::model()->findByPk($productId);
			$sumLastTwelveMonth = OrderGroup::model()->sumOrderLastTwelveMonth();
			$discountPercent = SupplierDiscountRange::model()->findDiscountPercent($supplierId, $product->price + $sumLastTwelveMonth);
			$orderSummary['total'] = number_format($product->price, 2);
			$orderSummary['discountPercent'] = $discountPercent;
			$orderSummary['discount'] = number_format($product->price * $discountPercent / 100, 2);
			$orderSummary['grandTotal'] = number_format($product->price - ($product->price * $discountPercent / 100), 2);
		}
		if(isset($_POST['paymentMethod']))
		{
			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				//code here
				//new order group
				$orderGroup = new OrderGroup();
				$orderGroup->supplierId = $supplierId;
				$orderGroup->orderNo = $orderGroup->genOrderNo($supplierId);
				$orderGroup->summary = str_replace(",", "", $orderSummary['grandTotal']);
				$orderGroup->totalIncVAT = str_replace(",", "", $orderSummary['total']);
				$orderGroup->discountPercent = str_replace(",", "", $orderSummary['discountPercent']);
				$orderGroup->discountValue = str_replace(",", "", $orderSummary['discount']);
				$orderGroup->vatPercent = OrderGroup::VAT_PERCENT;
				$orderGroup->vatValue = $orderGroup->calVatValue();
				$orderGroup->userId = Yii::app()->user->id;
				$orderGroup->paymentMethod = $_POST['paymentMethod'];
				if(isset($productId))
				{
					$orderGroup->parentId = $_POST["orderGroupId"];
				}
				$orderGroup->createDateTime = new CDbExpression("NOW()");
				$orderGroup->updateDateTime = new CDbExpression("NOW()");

				/**
				 * Todo:: billing & shipping address
				 */
				$userModel = User::model()->findByPk(Yii::app()->user->id);
				$orderGroup->email = $userModel->email;
				$orderGroup->firstname = $userModel->firstname;
				$orderGroup->lastname = $userModel->lastname;
				$orderGroup->telephone = $userModel->telephone;
				$orderGroup->paymentFirstname = $userModel->billingAddress->firstname;
				$orderGroup->paymentLastname = $userModel->billingAddress->lastname;
				$orderGroup->paymentAddress1 = $userModel->billingAddress->address_1;
				$orderGroup->paymentAddress2 = $userModel->billingAddress->address_2;
				$orderGroup->paymentDistrictId = $userModel->billingAddress->districtId;
				$orderGroup->paymentAmphurId = $userModel->billingAddress->amphurId;
				$orderGroup->paymentProvinceId = $userModel->billingAddress->provinceId;
				$orderGroup->paymentPostcode = $userModel->billingAddress->postcode;

//				$orderGroup->shippingFirstname = $userModel->shippingAddress->firstname;
//				$orderGroup->shippingLastname = $userModel->shippingAddress->lastname;
				$orderGroup->shippingAddress1 = $userModel->shippingAddress->address_1;
				$orderGroup->shippingAddress2 = $userModel->shippingAddress->address_2;
				$orderGroup->shippingDistrictId = $userModel->shippingAddress->districtId;
				$orderGroup->shippingAmphurId = $userModel->shippingAddress->amphurId;
				$orderGroup->shippingProvinceId = $userModel->shippingAddress->provinceId;
				$orderGroup->shippingPostCode = $userModel->shippingAddress->postcode;
				/**
				 * TODO:: remove false after add address
				 */
				if($orderGroup->save(false))
				{
					$orderGroupId = Yii::app()->db->getLastInsertID();
					if(!isset($productId))
					{
						$orders = Order::model()->findAll(array(
							'condition'=>'type&' . Order::ORDER_TYPE_CART . ' > 0 AND userId=:userId AND supplierId=:supplierId',
							'params'=>array(
								':userId'=>Yii::app()->user->id,
								':supplierId'=>$supplierId,
							),
							'order'=>'type, orderId'
						));

						$i = 0;
						foreach($orders as $order)
						{
							$orderGroupToOrder = new OrderGroupToOrder();
							$orderGroupToOrder->orderGroupId = $orderGroupId;
							$orderGroupToOrder->orderId = $order->orderId;

							if(!$orderGroupToOrder->save())
							{
								break;
							}
							$i++;

							$order->type = 4;
//							throw new Exception(print_r($order->type,true));
							$order->save();
						}
						if($i == sizeof($orders))
						{
							$flag = true;
						}
					}
					else
					{
						$orderGroupId = $_POST["orderGroupId"];
						$flag = TRUE;
						$og = OrderGroup::model()->findByPk($orderGroupId);
						$order = new Order();
						$order->userId = Yii::app()->user->id;
						$order->supplierId = $supplierId;
						$order->type = 4;
						$order->total = $product->price;
						$order->totalIncVAT = $product->price * 1.07;
						$order->provinceId = $og->orders[0]->provinceId;
						$order->createDateTime = new CDbExpression("NOW()");
						$order->updateDateTime = new CDbExpression("NOW()");
						if($order->save())
						{
							$orderId = Yii::app()->db->lastInsertID;
							$orderItems = new OrderItems();
							$orderItems->orderId = $orderId;
							$orderItems->productId = $productId;
							$orderItems->price = $product->price;
							$orderItems->quantity = 1;
							$orderItems->total = $product->price;
							$orderItems->createDateTime = new CDbExpression("NOW()");
							$orderItems->updateDateTime = new CDbExpression("NOW()");
							if(!$orderItems->save(false))
							{
								$flag = false;
							}
							$orderGroupToOrder = new OrderGroupToOrder();
							$orderGroupToOrder->orderGroupId = $orderGroupId;
							$orderGroupToOrder->orderId = $orderId;
							$orderGroupToOrder->createDateTime = new CDbExpression("NOW()");
							$orderGroupToOrder->updateDateTime = new CDbExpression("NOW()");
							if(!$orderGroupToOrder->save())
							{
								$flag = FALSE;
							}
						}
						else
						{
							$flag = FALSE;
						}
					}
				}

				if($flag)
				{
					$transaction->commit();

					/**
					 * 1 = card, 2 = transfer
					 * orderNo = $orderGroup->orderNo
					 */
					if($orderGroup->paymentMethod == 1)
					{
						$this->redirect(array(
							"confirmCheckout",
							'id'=>$orderGroupId));
					}
					else
					{

						$this->redirect(array(
							'step6',
							"id"=>$orderGroupId,
						));
					}
				}
				else
				{
					$transaction->rollback();
					if(isset($productId))
					{
						$this->redirect(array(
							"/myfile/ginzaHome/view/id/" . $_POST["orderGroupId"]));
					}
				}
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
		}

		$bankArray = Bank::model()->findAllBankModelBySupplier($supplierId);

		$this->render('step4', array(
			'step'=>4,
			'orderSummary'=>$orderSummary,
			'bankArray'=>$bankArray,
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
		if(isset($_REQUEST) && $_REQUEST != array())
		{
//			if(in_array($_REQUEST["decision"], $decisionArray) && in_array($_REQUEST["reason_code"], $resonCode))
//			{
			if($_REQUEST["decision"] == "ACCEPT")
			{
				$order = OrderGroup::model()->find("orderNo =:orderNo", array(
					":orderNo"=>$_REQUEST["req_reference_number"]));
				if(isset($order))
				{
					$order->status = 2;
					$order->invoiceNo = OrderGroup::model()->genInvNo($order);
					$order->paymentDateTime = new CDbExpression('NOW()');
					if($order->save())
					{
//						$this->cutProductStock($order);
//						unset($daiibuy->cart[$order->supplierId]);
//						unset($daiibuy->order[$order->supplierId]);
//						$daiibuy->usedPoint = 0;
//						$daiibuy->saveCookie();

						$flag = TRUE;
						$emailObj = new Email();
						$sentMail = new EmailSend();
						$documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/myfile/";
						$emailObj->Setmail($order->userId, null, $order->supplierId, $order->orderGroupId, null, $documentUrl);
						$sentMail->mailCompleteOrderCustomer($emailObj);
						$sentMail->mailConfirmOrderSupplierDealer($emailObj);
					}
				}
				else
				{
					echo "ไม่สามารถ ปรับปรุงรายการสั่งซื้อสินค้าของท่านได้";
				}
			}
			else
			{
// Email จ่ายไม่ผ่าน
				if($_REQUEST["decision"] == "REVIEW")
				{
					$order = OrderGroup::model()->find("orderNo =:orderNo", array(
						":orderNo"=>$_REQUEST["req_reference_number"]));
					if(isset($order))
					{
						$order->status = 2;
//						$order->invoiceNo = Order::model()->genInvNo($order);
//						$order->paymentDateTime = new CDbExpression('NOW()');
						if($order->save())
						{
//							$this->cutProductStock($order);
//							unset($daiibuy->cart[$order->supplierId]);
//							unset($daiibuy->order[$order->supplierId]);
//							$daiibuy->usedPoint = 0;
//							$daiibuy->saveCookie();

							$flag = TRUE;
							$emailObj = new Email();
							$sentMail = new EmailSend();
							$documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/myfile";
//							$emailObj->Setmail($order->userId, $order->dealerId, $order->supplierId, $order->orderId, null, $documentUrl);
//							$sentMail->mailCompleteOrderCustomer($emailObj);
//							$sentMail->mailConfirmOrderSupplierDealer($emailObj);
						}
					}
					else
					{
						echo "ไม่สามารถ ปรับปรุงรายการสั่งซื้อสินค้าของท่านได้";
					}
				}
			}
		}
		else
		{
//$flag = TRUE;
		}
		$this->render("step5", array(
			'result'=>$_REQUEST,
			'flag'=>$flag,
			'model'=>$order));
	}

	public function actionStep6($id)
	{
		$daiibuy = new DaiiBuy();
//		$daiibuy->loadCookie();
		$order = new OrderGroup();
		$flag = FALSE;

		$order = OrderGroup::model()->find("orderNo =:orderNo", array(
			":orderNo"=>$id));
		if(isset($order))
		{
			$order->status = 2;
			$order->invoiceNo = OrderGroup::model()->genInvNo($order);
			$order->paymentDateTime = new CDbExpression('NOW()');
			if($order->save())
			{
//						$this->cutProductStock($order);
//						unset($daiibuy->cart[$order->supplierId]);
//						unset($daiibuy->order[$order->supplierId]);
//						$daiibuy->usedPoint = 0;
//						$daiibuy->saveCookie();

				$flag = TRUE;
				$emailObj = new Email();
				$sentMail = new EmailSend();
				$documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/order/" . $order->orderGroupId;
				$emailObj->Setmail($order->userId, null, $order->supplierId, $order->orderGroupId, null, $documentUrl);
				$sentMail->mailCompleteOrderCustomer($emailObj);
				$sentMail->mailConfirmOrderSupplierDealer($emailObj);
			}
		}
		else
		{
			echo "ไม่สามารถ ปรับปรุงรายการสั่งซื้อสินค้าของท่านได้";
		}

		$bankArray = Bank::model()->findAllBankModelBySupplier(Yii::app()->session['supplierId']);
		$this->render("step6", array(
			'bankArray'=>$bankArray,
			'model'=>$order));
	}

	public function actionFindAmphur()
	{
		if(isset($_POST['provinceId']))
		{
			$res = '';
			$amphurs = Amphur::model()->findAll(array(
				'condition'=>'provinceId=:provinceId',
				'params'=>array(
					':provinceId'=>$_POST['provinceId'],
				),
				'order'=>'amphurName'
			));
			$res .= '<option value="">เลือกอำเภอ</option>';
			foreach($amphurs as $amphur)
			{
				$res .= '<option value="' . $amphur->amphurId . '">' . $amphur->amphurName . '</option>';
			}

			echo $res;
		}
	}

	public function actionFindDistrict()
	{
		if(isset($_POST['amphurId']))
		{
			$res = '';
			$districts = District::model()->findAll(array(
				'condition'=>'amphurId=:amphurId',
				'params'=>array(
					':amphurId'=>$_POST['amphurId'],
				),
				'order'=>'districtName'
			));

			foreach($districts as $district)
			{
				$res .= '<option value="' . $district->districtId . '">' . $district->districtName . '</option>';
			}
			echo $res;
		}
	}

	public function actionConfirmation($id)
	{
		$model = OrderGroup::model()->findByPk($id);
		$this->render("e_payment/payment_confirmation", array(
			'model'=>$model));
	}

	public function actionConfirmCheckout($id)
	{
		$model = OrderGroup::model()->findByPk($id);

		$this->render("confirm_checkout", array(
			'model'=>$model));
	}

}
