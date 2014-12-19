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
//			throw new Exception(print_r($_POST['Address'],true));

			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$userModel->type = 1;
				$userModel->status = 1;
				$userModel->approved = 1;
				$userModel->password = $userModel->hashPassword($userModel->email, $userModel->password);
				$userModel->createDateTime = new CDbExpression('NOW()');
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
					else
					{
						throw new Exception(print_r($addressModel->errors, true));
					}
				}
				else
				{
					throw new Exception(print_r($userModel->errors, true));
				}
				if($flag)
				{
					$transaction->commit();
					//redirect to step 2
//					$identity = new UserIdentity($userModel->email, $userModel->password);
//					$identity->authenticate();
//					Yii::app()->user->login($identity);

					$loginModel->username = $_POST['User']['email'];
					$loginModel->password = $_POST['User']['password'];
					// validate user input and redirect to the previous page if valid
					if($loginModel->validate() && $loginModel->login())
					{
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
				$billingAddressModel->userId = Yii::app()->user->id;
				if(!$billingAddressModel->save())
				{
					throw new Exception(print_r($billingAddressModel->errors, true));
				}
				else
				{
					Yii::app()->session['billingAddressId'] = Yii::app()->db->getLastInsertID();
				}
			}

			if($_POST['shippingRadio'] == 1)
			{
				Yii::app()->session['shippingAddressId'] = $_POST['existingShippingAddress'];
			}
			else
			{
				//add new shipping address
				$shippingAddressModel->attributes = $_POST['shipping'];
				$shippingAddressModel->provinceId = $this->cookie->provinceId;
				$shippingAddressModel->userId = Yii::app()->user->id;
				Yii::app()->session['shippingAddressId'] = $shippingAddressModel->attributes;
				if(!$shippingAddressModel->save())
				{

					throw new Exception(print_r($shippingAddressModel->errors, true));
				}
				else
				{
					Yii::app()->session['shippingAddressId'] = Yii::app()->db->getLastInsertID();
				}
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
		$billingAddress = Address::model()->findByPk(Yii::app()->session['billingAddressId']);
		$shippingAddress = Address::model()->findByPk(Yii::app()->session['shippingAddressId']);


//                                        throw new Exception(print_r(Yii::app()->session['shippingAddressId'].", ".Yii::app()->session['billingAddressId'],true));
//                throw new Exception(print_r($billingAddress,true));
		$this->render('step3', array(
			'step'=>3,
			'orderSummary'=>$orderSummary,
			'orders'=>$orders,
			'supplierName'=>$supplierModel->name,
			'billingAddress'=>$billingAddress,
			'shippingAddress'=>$shippingAddress,
			'supplierId'=>$supplierId,
			'userModel'=>$userModel,
		));
		//$this->redirect($this->createUrl(4));
	}

	public function step4()
	{
		$supplierId = Yii::app()->session['supplierId'];
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();
		$provinceId = $daiibuy['provinceId'];

		$orderSummary = Order::model()->sumOrderTotalBySupplierId($supplierId);
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
				$orderGroup->total = $orderGroup->totalIncVAT / 1.07;
				$orderGroup->discountPercent = str_replace(",", "", $orderSummary['discountPercent']);
				$orderGroup->discountValue = str_replace(",", "", $orderSummary['discount']);
				$orderGroup->totalPostDiscount = str_replace(",", "", $orderSummary['total']) - str_replace(",", "", $orderSummary['discount']);
				//Distributor Discount & Spacial Project Discount
				if(isset($orderSummary['distributorDiscountPercent']))
				{
					$orderGroup->distributorDiscountPercent = str_replace(",", "", $orderSummary['distributorDiscountPercent']);
					$orderGroup->distributorDiscount = str_replace(",", "", $orderSummary['distributorDiscount']);

					$orderGroup->totalPostDistributorDiscount = str_replace(",", "", $orderSummary['totalPostDistributorDiscount']);
				}
				if(isset($orderSummary['extraDiscount']))
				{
					$orderGroup->extraDiscount = str_replace(",", "", $orderSummary['extraDiscount']);
				}
				//Distributor Discount & Spacial Project Discount
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
				$billingAddress = Address::model()->findByPk(Yii::app()->session['billingAddressId']);
				$shippingAddress = Address::model()->findByPk(Yii::app()->session['shippingAddressId']);
				$userModel = User::model()->findByPk(Yii::app()->user->id);
				$orderGroup->email = $userModel->email;
				$orderGroup->firstname = $userModel->firstname;
				$orderGroup->lastname = $userModel->lastname;
				$orderGroup->telephone = $userModel->telephone;
				$orderGroup->paymentCompany = $billingAddress->company;
				$orderGroup->paymentTaxNo = $billingAddress->taxNo;
				$orderGroup->paymentFirstname = $billingAddress->firstname;
				$orderGroup->paymentLastname = $billingAddress->lastname;
				$orderGroup->paymentAddress1 = $billingAddress->address_1;
				$orderGroup->paymentAddress2 = $billingAddress->address_2;
				$orderGroup->paymentDistrictId = $billingAddress->districtId;
				$orderGroup->paymentAmphurId = $billingAddress->amphurId;
				$orderGroup->paymentProvinceId = $billingAddress->provinceId;
				$orderGroup->paymentPostcode = $billingAddress->postcode;

//				$orderGroup->shippingFirstname = $shippingAddress->firstname;
//				$orderGroup->shippingLastname = $shippingAddress->lastname;
				$orderGroup->shippingCompany = $shippingAddress->company;
				$orderGroup->shippingAddress1 = $shippingAddress->address_1;
				$orderGroup->shippingAddress2 = $shippingAddress->address_2;
				$orderGroup->shippingDistrictId = $shippingAddress->districtId;
				$orderGroup->shippingAmphurId = $shippingAddress->amphurId;
				$orderGroup->shippingProvinceId = $shippingAddress->provinceId;
				$orderGroup->shippingPostCode = $shippingAddress->postcode;
				/**
				 * TODO:: remove false after add address
				 */
				if($orderGroup->save(false))
				{
					$orderGroupId = Yii::app()->db->getLastInsertID();
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
						$sumTotal = 0;
						foreach($order->orderItems as $item)
						{
							$price = ($item->product->calProductPromotionPrice() != 0) ? $item->product->calProductPromotionPrice() : $item->product->calProductPrice();
							$total = ($price * $item->quantity);
							$sumTotal+=$total;
							$item->price = $price;
							$item->total = $total;
							$item->save(FALSE);
						}
						$order->totalIncVAT = $sumTotal;
						$order->total = $sumTotal / 1.07;
						if(isset($orderSummary["extraDiscountArray"][$order->orderId]))
						{
							$order->spacialProjectDiscount = $orderSummary["extraDiscountArray"][$order->orderId]["extraDiscount"];
						}

						$order->provinceId = $provinceId;
						$order->type = 4;
//							throw new Exception(print_r($order->type,true));
						$order->save();
						$i++;
					}
					if($i == sizeof($orders))
					{
						$flag = true;
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
						$emailObj = new Email();
						$sentMail = new EmailSend();
						$documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/myfile/";
						$emailObj->Setmail($orderGroup->userId, null, $orderGroup->supplierId, $orderGroup->orderGroupId, null, $documentUrl);
						$sentMail->mailCompleteOrderCustomer($emailObj);
						$sentMail->mailConfirmOrderSupplierDealer($emailObj);
						$this->redirect(array(
							'step6',
							"id"=>$orderGroupId,
						));
					}
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

//		$order = OrderGroup::model()->find("orderNo =:orderNo", array(
//			":orderNo"=>$id));
		$order = OrderGroup::model()->findByPk($id);
		if(isset($order))
		{
			$order->status = 1;
//			$order->invoiceNo = OrderGroup::model()->genInvNo($order);
//			$order->paymentDateTime = new CDbExpression('NOW()');
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
//			$res .= '<option value="">เลือกอำเภอ</option>';
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
