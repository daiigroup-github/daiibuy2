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
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();
		$token = $daiibuy->token;
		$orderSummary = Order::model()->sumOrderTotalBySupplierId($supplierId);

		$this->render('step3', array(
			'step'=>3,
			'orderSummary'=>$orderSummary,
		));
		//$this->redirect($this->createUrl(4));
	}

	public function step4()
	{
		$supplierId = Yii::app()->session['supplierId'];
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
				$orderGroup->orderNo = $orderGroup->genOrderNo();
				$orderGroup->summary = $orderSummary['grandTotal'];
				$orderGroup->totalIncVAT = $orderSummary['total'];
				$orderGroup->discountPercent = $orderSummary['discountPercent'];
				$orderGroup->discountValue = $orderSummary['discount'];
				$orderGroup->vatPercent = OrderGroup::VAT_PERCENT;
				$orderGroup->vatValue = $orderGroup->calVatValue();
				$orderGroup->userId = Yii::app()->user->id;
				$orderGroup->paymentMethod = $_POST['paymentMethod'];

				/**
				 * Todo:: billing & shipping address
				 */
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
							"confirmCheckout"));
					}
					else
					{
						//transfer
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

		$this->render('step4', array(
			'step'=>4,
			'orderSummary'=>$orderSummary,
		));
//        $this->redirect($this->createUrl(5));
	}

	public function step5()
	{
		$this->render('step5');
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

	public function actionConfirmation()
	{
		$this->render("e_payment/payment_confirmation");
	}

	public function actionConfirmCheckout($id)
	{
		$model = $this->loadModel($id);

		$this->render("confirm_checkout", array(
			'model'=>$model));
	}

}
