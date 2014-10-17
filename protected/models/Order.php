<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property string $orderId
 * @property string $supplierId
 * @property string $title
 * @property integer $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property User $supplier
 * @property OrderGroupToOrder[] $orderGroupToOrders
 */
class Order extends OrderMaster
{

	public $maxCode;
	public $searchText;
	public $orderError;
	public $marginToDealer;
	public $marginToDaii;
	public $sumMarginDealer;

	const ORDER_TYPE_MYFILE = 1;
	const ORDER_TYPE_CART = 2;

	/**
	 * @return string the associated database table name
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return CMap::mergeArray(parent::rules(), array(
				//code here
		));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return CMap::mergeArray(parent::relations(), array(
				//code here
				'shippingAmphur'=>array(
					self::BELONGS_TO,
					'Amphur',
					array(
						'shippingAmphurId'=>'amphurId'),),
				'shippingProvince'=>array(
					self::BELONGS_TO,
					'Province',
					array(
						'shippingProvinceId'=>'provinceId'),),
				'shippingDistrict'=>array(
					self::BELONGS_TO,
					'District',
					array(
						'shippingDistrictId'=>'districtId'),),
				'orderItemsSum'=>array(
					self::STAT,
					'OrderItems',
					'orderId',
					'select'=>'sum(total)'
				),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return Cmap::mergeArray(parent::attributeLabels(), array(
			));
	}

	public function findAllMyFileBySupplierId($userId, $supplierId, $type, $status, $token)
	{
		$criteria = new CDbCriteria();
		if(($this->userId == 0))
		{
			$criteria->condition = 'userId = :userId AND supplierId = :supplierId AND type = :type AND status = :status';
			$criteria->params = array(
				':userId'=>$userId,
				':supplierId'=>$supplierId,
				':type'=>$type,
				':status'=>$status,);
		}
		else
		{
			$criteria->condition = 'token = :token AND supplierId = :supplierId AND type = :type AND status = :status';
			$criteria->params = array(
				':token'=>$token,
				':supplierId'=>$supplierId,
				':type'=>$type,
				':status'=>$status,);
		}

		$res = $this->findAll($criteria);

		return $res;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 * public function search()
	 * {
	 * }
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public function findMaxInvoiceNo($model)
	{
// Warning: Please modify the following code to remove attributes that
// should not be searched.
		$supplierUser = Supplier::model()->findByPk($model->supplierId);

		$criteria = new CDbCriteria;

		$criteria->select = 'max(RIGHT(invoiceNo,6)) as maxCode';
//		if(isset($supplierUser->redirectURL))
//		{
		$criteria->condition = 'YEAR(updateDateTime) = YEAR(NOW()) AND supplierId = ' . $supplierUser->supplierId . ' AND paymentMethod = ' . $model->paymentMethod;
//		}
//		else
//		{
//			$supplierArray = array();
//			$supplierArray = User::model()->findAllSupplierHasRedirectURL();
//			$criteria->condition = 'MONTH(updateDateTime) = MONTH(NOW())';
//		$criteria->addNotInCondition('supplierId', $supplierArray);
//		}
		$result = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
		return isset($result->data[0]) ? $result->data[0]->maxCode : 0;
	}

	public function findMaxOrderNo()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->select = 'max(RIGHT(orderNo,6)) as maxCode';
		$criteria->condition = 'YEAR(updateDateTime) = YEAR(NOW())';

		$result = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
		return isset($result->data[0]) ? $result->data[0]->maxCode : 0;
	}

	public function findAllUserOrder()
	{
		$criteria = new CDbCriteria();
		$criteria->compare("userId", Yii::app()->user->id);
		$criteria->compare('invoiceNo', $this->invoiceNo, true);
		$criteria->compare('orderNo', $this->orderNo, true);
		$criteria->compare('firstname', $this->firstname, true);
		$criteria->compare('lastname', $this->lastname, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('telephone', $this->telephone, true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.createDateTime DESC',
			),
			'pagination'=>array(
				'pageSize'=>30
			),
		));
	}

	public function findAllDealerOrder()
	{
		$criteria = new CDbCriteria();
		$criteria->compare("dealerId", Yii::app()->user->id);
		$criteria->compare('invoiceNo', $this->invoiceNo, true);
		$criteria->compare('orderNo', $this->orderNo, true);
		$criteria->compare('firstname', $this->firstname, true);
		$criteria->compare('lastname', $this->lastname, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('telephone', $this->telephone, true);
//		$criteria->compare("status", ">2");
//		$criteria->compare("status", "<99");
		$criteria->addCondition(" (status = 0 AND userId = " . Yii::app()->user->id . ") OR ( status >2 AND status < 99) ");
//$criteria->compare("status",2);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.createDateTime DESC',
			),
			'pagination'=>array(
				'pageSize'=>30
			),
		));
	}

	public function findAllSupplierOrder()
	{
		$criteria = new CDbCriteria();
		$criteria->compare("supplierId", Yii::app()->user->supplierId);
		$criteria->compare('invoiceNo', $this->invoiceNo, true);
		$criteria->compare('orderNo', $this->orderNo, true);
		$criteria->compare('firstname', $this->firstname, true);
		$criteria->compare('lastname', $this->lastname, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('telephone', $this->telephone, true);
		$criteria->compare("status", ">1");
		$criteria->compare("status", "<99");
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.updateDateTime DESC ,t.createDateTime DESC',
			),
			'pagination'=>array(
				'pageSize'=>30
			),
		));
	}

	public function findAllFinanceAdminOrder()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "status in (1 , 4 , 6 , 7 , 8 , 11 , 12 ,13, 14 ,15 ,16,98 ) ";
		$criteria->compare('invoiceNo', $this->invoiceNo, true);
		$criteria->compare('orderNo', $this->orderNo, true);
		$criteria->compare('firstname', $this->firstname, true);
		$criteria->compare('lastname', $this->lastname, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('telephone', $this->telephone, true);
		$criteria->compare('paymentMethod', $this->paymentMethod, true);
		$criteria->compare("status", ">0");
		$criteria->compare("status", "<99");
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.updateDateTime DESC ,t.createDateTime DESC',
			),
			'pagination'=>array(
				'pageSize'=>30
			),
		));
	}

	public function findAllFinanceAdminOrderPay()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "status > 1 AND paymentDateTime is not NULL";
		$criteria->compare('invoiceNo', $this->invoiceNo, true);
		$criteria->compare('orderNo', $this->orderNo, true);
		$criteria->compare('firstname', $this->firstname, true);
		$criteria->compare('lastname', $this->lastname, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('telephone', $this->telephone, true);
		$criteria->compare("status", ">1");
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.updateDateTime DESC ,t.createDateTime DESC',
			),
			'pagination'=>array(
				'pageSize'=>30
			),
		));
	}

	public function findGuestOrder()
	{
		$criteria = new CDbCriteria();
		$criteria->compare("orderNo", $this->orderNo, FALSE, "AND");
		$criteria->compare("email", $this->email, FALSE, "AND");
		$criteria->compare("userId", 0);
		$guestOrder = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.updateDateTime DESC ,t.createDateTime DESC',
			),
			'pagination'=>array(
				'pageSize'=>30
			),
		));
		return $guestOrder;
	}

//Use in report
	public function getNotpaySupplierOrder()
	{
		$criteria = new CDbCriteria();
		if(isset($this->supplierId))
		{
			$criteria->compare("supplierId", $this->supplierId);
			$criteria->addInCondition("orderStatusid", array(
				"11",
				"13"));
		}
//$criteria->compare("orderStatusid","in(4,6,7");
		$criteria->group = "supplierId";

		return $this->findAll($criteria);
	}

	public function getNotpayDealerOrder()
	{
		$criteria = new CDbCriteria();
		if(isset($this->dealerId))
		{
			$criteria->compare("dealerId", $this->dealerId);
			$criteria->addInCondition("orderStatusid", array(
				"11",
				"12"));
		}
//$criteria->compare("orderStatusid","in(4,6,7");
		$criteria->group = "dealerId";

		return $this->findAll($criteria);
	}

	public function getSumOrderBySupplier($supplierId)
	{
		$totals = Yii::app()->db->createCommand()
			->select('sum(total+pointToBaht) as totals')
			->from('order')
			->where('supplierId = ' . $supplierId . ' AND ' . '(order.orderStatusid = 11 OR order.orderStatusid = 13 OR order.orderStatusid = 16) ')
			->queryRow();
		return $totals;
	}

	public function getSumOrderBySupplierTransferd($supplierId)
	{
		$totals = Yii::app()->db->createCommand()
			->select('sum(total+pointToBaht) as totals')
			->from('order')
			->where('supplierId = ' . $supplierId . ' AND ' . '(order.orderStatusid = 12 OR order.orderStatusid = 14 OR order.orderStatusid = 15 OR order.orderStatusid = 16) ')
			->queryRow();
		return $totals;
	}

	public function getSumOrderByDealerTransferd($dealerId)
	{
		$totals = Yii::app()->db->createCommand()
			->select('sum(total+pointToBaht) as totals')
			->from('order')
			->where('dealerId = ' . $dealerId . ' AND ' . '(order.orderStatusid = 13 OR order.orderStatusid = 14 OR order.orderStatusid = 16 OR order.orderStatusid = 15) ')
			->queryRow();
		return $totals;
	}

	public function getSumMarginDealer($dealerId)
	{
		$totalDealerMargin = Yii::app()->db->createCommand()
			->select('sum((((order.total+order.pointToBaht)*user_certificate_file.value)/100)) as sumMarginDealer')
			->from('order')
			->join('user_certificate_file', 'order.supplierId = user_certificate_file.userId AND user_certificate_file.forUserType = 2 ')
			->join('user_certificate_file ucf', 'order.supplierId = ucf.userId AND ucf.forUserType = 3 ')
			->where('order.dealerId = ' . $dealerId . ' AND ' . '(order.orderStatusid = 11 OR order.orderStatusid = 12 OR order.orderStatusid = 15) AND user_certificate_file.status = 1 ')
			->queryRow();
		return $totalDealerMargin;
	}

	public function getSumMargin($supplierId)
	{
		$totalMargin = Yii::app()->db->createCommand()
			->select('sum(((order_product.total*1.07)*user_certificate_file.value)/100) as totalMargin')
			->from('order')
			->join('order_product', 'order.orderId = order_product.orderId')
			->join('user_certificate_file', 'order_product.marginId = user_certificate_file.id')
			->where('order.supplierId = ' . $supplierId . ' AND ' . '(order.orderStatusid = 11 OR order.orderStatusid = 13 OR order.orderStatusid = 16) AND user_certificate_file.forUserType = 3 ')
			->queryRow();
		return $totalMargin;
	}

	public function findOrderBySupplierId($supplierId)
	{
		$criteria = new CDbCriteria();
		$criteria->compare("supplierId", $supplierId);
		$criteria->addInCondition("orderStatusid", array(
			"11",
			"13",
			"16"));
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function findOrderByDealerId($dealerId)
	{
		$criteria = new CDbCriteria();
		$criteria->select = "t.orderId,
					t.invoiceNo,
					t.orderNo,
					t.paymentFirstname,
					t.paymentLastname,
					t.orderStatusid,
					t.total+t.pointToBaht as total, ((t.total+t.pointToBaht)*ucf.value)/100 as marginToDaii, (((t.total+t.pointToBaht)*uc.value)/100) as marginToDealer ";
		$criteria->join = "JOIN user_certificate_file uc ON t.supplierId = uc.userId AND uc.forUserType = 2 ";
		$criteria->join .= "JOIN order_product op ON t.orderId = op.orderId ";
		$criteria->join .= "JOIN user_certificate_file ucf ON op.marginId = ucf.id AND t.supplierId = ucf.userId AND ucf.forUserType = 3 ";
		$criteria->compare("t.dealerId", $dealerId);
//		$criteria->compare("uc.forUserType", 2);
//		$criteria->compare("ucf.forUserType", 3);
		$criteria->addInCondition("orderStatusid", array(
			"11",
			"12",
			"15"));
		$criteria->group = "t.orderId";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria));
	}

	public function findOrderBySupplierIdTransfered($supplierId)
	{
		$criteria = new CDbCriteria();
		$criteria->compare("supplierId", $supplierId);
		$criteria->addInCondition("orderStatusid", array(
			"12",
			"14",
			"15",
			"16"));
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function findOrderByDealerIdTransfered($dealerId)
	{
		$criteria = new CDbCriteria();
		$criteria->select = "t.orderId,t.invoiceNo,
					t.orderNo,
					t.paymentFirstname,
					t.paymentLastname,
					t.orderStatusid,
					(t.total+t.pointToBaht) as Total, ((t.total+t.pointToBaht)*ucf.value)/100 as marginToDaii, ((((t.total+t.pointToBaht)*ucf.value)/100)*uc.value)/100 as marginToDealer ";
		$criteria->join = "JOIN user_certificate_file uc ON t.supplierId = uc.userId AND uc.forUserType = 2 ";
		$criteria->join .= "JOIN order_product op ON t.orderId = op.orderId ";
		$criteria->join .= "JOIN user_certificate_file ucf ON op.marginId = ucf.id AND t.supplierId = ucf.userId AND ucf.forUserType = 3 ";
		$criteria->compare("t.dealerId", $dealerId);
		$criteria->addInCondition("orderStatusid", array(
			"13",
			"14",
			"15",
			"16"));
		$criteria->group = "t.orderId";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria));
	}

	public function getSupplierRewardPoint()
	{

		$margin = Yii::app()->db->createCommand()
			->select('value as userReward')
			->from('user_certificate_file')
			->where('supplierId = :id and status = 1', array(
				'id'=>$this->supplierId))
			->queryRow();
		return $margin;
	}

//	public function getSupplierMarginToDaiiBuy()
//	{
//		$totals = Yii::app()->db->createCommand()
//			->select('value as daiiMargin')
//			->from('order t')
//			->join('order_items op', 't.orderId = op.orderId')
//			->join('user_certificate_file ucf', 'op.marginId = ucf.id')
//			->where('t.orderId=:id', array(
//				':id'=>$this->orderId))
//			->group('t.orderId')
//			->queryRow();
//		return $totals;
//	}

	public function getCollectedOrderView($userId)
	{
		$value = Configuration::model()->getOrderExpiredDate();
		$orders = Order::model()->findAll('DATE_ADD(createDateTime, INTERVAL ' . $value->value . ' YEAR) >= NOW() AND orderStatusid > 1 AND orderStatusid < 99 AND userId = ' . $userId);
		$res = 0;
		foreach($orders as $order)
		{
			$res = $res + $order->total;
		}

//		$res = Yii::app()->db->createCommand()
//				->select('sum(total) as collectedOrder')
//				->from('order')
//				->where('DATE_ADD(createDateTime, INTERVAL ' . $value->value . ' YEAR) >= NOW() AND orderStatusid > 1 AND userId = ' . $userId . ' AND isChangeToReward = 0')
//				->queryRow();
//		return $res['collectedOrder'] == null ? 0 : $res['collectedOrder'];
		return $res;
	}

	public function getCollectedOrder($userId)
	{
		$value = Configuration::model()->getOrderExpiredDate();
		$orders = Order::model()->findAll('DATE_ADD(createDateTime, INTERVAL ' . $value->value . ' YEAR) >= NOW() AND status > 1 AND userId = ' . $userId);
		$res = 0.00;
		foreach($orders as $order)
		{
			$res = $res + ($order->totalIncVAT - $order->usedPoint);
//			$order->isChangeToReward = 1;
			//$order->save();
		}

//		$res = Yii::app()->db->createCommand()
//				->select('sum(total) as collectedOrder')
//				->from('order')
//				->where('DATE_ADD(createDateTime, INTERVAL ' . $value->value . ' YEAR) >= NOW() AND orderStatusid > 1 AND userId = ' . $userId . ' AND isChangeToReward = 0')
//				->queryRow();
//		return $res['collectedOrder'] == null ? 0 : $res['collectedOrder'];
		return $res;
	}

	public function clearCollectedOrder($userId)
	{
		$value = Configuration::model()->getOrderExpiredDate();
		$res = Yii::app()->db->createCommand()
			->select('sum(total) as collectedOrder')
			->from('order')
			->where('DATE_ADD(createDateTime, INTERVAL ' . $value->value . ' YEAR) >= NOW() AND orderStatusid > 1 AND userId = ' . $userId)
			->queryRow();
		return $res['collectedOrder'] == null ? 0 : $res['collectedOrder'];
	}

	public function showOrderStatus($status)
	{
		$user = User::model()->findByPk(Yii::app()->user->id);
		switch($status)
		{
			case 99:
				return "แบบร่าง";
				break;
			case 98:
				return "ระหว่างดำเนินการตรวจสอบเครดิต";
				break;
			case 0:
				return "รอการยืนยันโอนเงินจากลูกค้า";
				break;
			case 1:
				return "รอตรวจสอบการโอนเงิน";
				break;
			case 2:
				return isset($user) ? ($user->type == 1 ? "การสั่งซื้อสินค้าสมบูรณ์" : "การสั่งซื้อสินค้าสมบูรณ์(รอการจัดส่ง)" ) : "การสั่งซื้อสินค้าสมบูรณ์";
				break;
			case 3:
				return "Supplier กำลังจัดส่งสินค้า";
				break;
			case 4:
				return isset($user) ? ($user->type == 1 || $user->type == 0 ? "การซื้อสินค้าเสร็จสมบูรณ์" : "การซื้อสินค้าเสร็จสมบูรณ์(รออัพโหลดเอกสาร)") : "การซื้อสินค้าเสร็จสมบูรณ์";
				break;
			case 5:
				return isset($user) ? ($user->type == 1 || $user->type == 0 ? "รอยืนยันการรับสินค้าผ่านอีเมลล์" : "รอการยืนยันของ ลูกค้า ผ่าน Email") : "การซื้อสินค้าเสร็จสมบูรณ์";
				break;
			case 6:
				return isset($user) ? ($user->type == 1 || $user->type == 0 ? "การซื้อสินค้าเสร็จสมบูรณ์" : "รออัพโหลดใบส่งสินค้า") : "การซื้อสินค้าเสร็จสมบูรณ์";
				break;
			case 7:
				return isset($user) ? ($user->type == 1 || $user->type == 0 ? "รอยืนยันการรับสินค้าผ่านอีเมลล์" : "ผู้ดูแลระบบติดตามเอกสารและยืนยันรับของ") : "การซื้อสินค้าเสร็จสมบูรณ์";
				break;
			case 8:
				return isset($user) ? ($user->type == 1 || $user->type == 0 ? "การซื้อสินค้าเสร็จสมบูรณ์" : "รอการอนุมัติจ่ายเงิน จากผู้ดูแลระบบ(การเงิน)") : "การซื้อสินค้าเสร็จสมบูรณ์";
				break;
			case 9:
				return isset($user) ? ($user->type == 1 || $user->type == 0 ? "การซื้อสินค้าเสร็จสมบูรณ์" : "ให้ ผู้ผลิดสินค้า แนบเอกสารใหม่") : "การซื้อสินค้าเสร็จสมบูรณ์";
				break;
			case 10:
				return isset($user) ? ($user->type == 1 || $user->type == 0 ? "การซื้อสินค้าเสร็จสมบูรณ์" : "ให้ ตัวแทนกระจายสินค้า แนบเอกสารใหม่") : "การซื้อสินค้าเสร็จสมบูรณ์";
				break;
			case 11:
				return isset($user) ? ($user->type == 1 || $user->type == 0 ? "การซื้อสินค้าเสร็จสมบูรณ์" : "เอกสารเรียบร้อยสามารถจ่ายเงินได้") : "การซื้อสินค้าเสร็จสมบูรณ์";
				break;
			case 12:
				return isset($user) ? ($user->type == 1 || $user->type == 0 ? "การซื้อสินค้าเสร็จสมบูรณ์" : "จ่ายเงินให้ ผู้ผลิดสินค้า แล้วรอยืนยันการจ่ายเงินให้ ตัวแทนกระจายสินค้า") : "การซื้อสินค้าเสร็จสมบูรณ์";
				break;
			case 13:
				return isset($user) ? ($user->type == 1 || $user->type == 0 ? "การซื้อสินค้าเสร็จสมบูรณ์" : "จ่ายเงินให้ ตัวแทนกระจายสินค้า แล้วรอยืนยันการจ่ายเงินให้ ผู้ผลิดสินค้า") : "การซื้อสินค้าเสร็จสมบูรณ์";
				break;
			case 14:
				return isset($user) ? ($user->type == 1 || $user->type == 0 ? "การซื้อสินค้าเสร็จสมบูรณ์" : "รอการยืนยันชำระเงินให้ ผู้ผลิต และ ตัวแทนกระจายสินค้า") : "การซื้อสินค้าเสร็จสมบูรณ์";
				break;
			case 15:
				return isset($user) ? ($user->type == 1 || $user->type == 0 ? "การซื้อสินค้าเสร็จสมบูรณ์" : "ยืนยันชำระเงินให้ผู้ผลิตสินค้าเรียบร้อย") : "การซื้อสินค้าเสร็จสมบูรณ์";
				break;
			case 16:
				return isset($user) ? ($user->type == 1 || $user->type == 0 ? "การซื้อสินค้าเสร็จสมบูรณ์" : "ยืนยันชำระเงินให้ตัวแทนกระจายสินค้าเรียบร้อย") : "การซื้อสินค้าเสร็จสมบูรณ์";
				break;
			case 17:
				return isset($user) ? ($user->type == 1 || $user->type == 0 ? "การซื้อสินค้าเสร็จสมบูรณ์" : "เอกสารดำเนินการเรียบร้อยแล้ว") : "การซื้อสินค้าเสร็จสมบูรณ์";
				break;
			case 18:
				return isset($user) ? ($user->type == 1 || $user->type == 0 ? "สามารถไปรับของได้ที่ตัวแทนกระจายสินค้า" : "Distributor รับสินค้าเรียบร้อยแล้ว") : "สามารถไปรับสินค้าได้ที่ตัวแทนกระจายสินค้า";
				break;
			case 19:
				return isset($user) ? ($user->type == 1 || $user->type == 0 ? "สินค้าถูกตีกลับรอส่งสินค้าใหม่" : "สินค้าถูกตีกลับรอส่งใหม่") : "สินค้าถูกตีกลับรอส่งสินค้าใหม่";
				break;
			case 20:
				return;
				break;
		}
	}

	public function genInvNo($model)
	{
//		$prefix = "IV" . UserCompany::model()->getPrefixBySupplierId($model->supplierId);
		$prefix = $model->paymentMethod == 1 ? "IVC" : "IVO";
		$max_code = $this->findMaxInvoiceNo($model);
		$max_code += 1;
		return $prefix . date("Ym") . str_pad($max_code, 6, "0", STR_PAD_LEFT);
	}

	public function genOrderNo()
	{
		$prefix = "OD";
		$max_code = $this->findMaxOrderNo();
		$max_code += 1;
		return $prefix . date("Ym") . "-" . str_pad($max_code, 6, "0", STR_PAD_LEFT);
	}

	public function formatMoney($number, $fractional = false)
	{
		if($fractional)
		{
			$number = sprintf('%.2f', $number);
		}
		while(true)
		{
			$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
			if($replaced != $number)
			{
				$number = $replaced;
			}
			else
			{
				break;
			}
		}
		return $number;
	}

	public function beforeSave()
	{

		if(!$this->isNewRecord)
		{
			$this->updateDateTime = new CDbExpression("NOW()");
		}

		return parent::beforeSave();
	}

	//Summary Report

	public $paymentYear;
	public $paymentMonth;
	public $totalSummary;

	public function findAllYearSalesArray()
	{
		$result = array();
		$criteria = new CDbCriteria();
		$criteria->select = "YEAR(paymentDateTime) as paymentYear";
		$criteria->compare("status", ">2");
		$criteria->compare("paymentDateTime", "<>''");
		$criteria->group = "YEAR(paymentDateTime)";
		foreach($this->findAll($criteria) as $item)
		{
			$result[$item->paymentYear] = $item->paymentYear;
		}
		return $result;
	}

	public function findAllMonthSalesArray()
	{
		$result = array();
		$result[1] = "ม.ค.";
		$result[2] = "ก.พ.";
		$result[3] = "มี.ค.";
		$result[4] = "เม.ย.";
		$result[5] = "พ.ค.";
		$result[6] = "มิ.ย.";
		$result[7] = "ก.ค.";
		$result[8] = "ส.ค.";
		$result[9] = "ก.ย.";
		$result[10] = "ต.ค.";
		$result[11] = "พ.ย.";
		$result[12] = "ธ.ค.";
		return $result;
	}

	public function findAllSummaryReport()
	{
// Warning: Please modify the following code to remove attributes that
// should not be searched.

		$criteria = new CDbCriteria;
		$criteria->compare('YEAR(paymentDateTime)', $this->paymentYear, FALSE, 'AND');
		$criteria->compare('MONTH(paymentDateTime)', $this->paymentMonth, FALSE, "AND");
		$criteria->compare("paymentDateTime", "<> '' ", TRUE, "AND");
		$criteria->compare("status", ">=2");
		$criteria->compare("status", "<> 99");
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.orderNo',
			),
			'pagination'=>array(
				'pageSize'=>50
			),
		));
	}

	public function findTotalSummaryReport()
	{
		$criteria = new CDbCriteria;
		$criteria->select = "sum(totalIncVat) as totalSummary";
		$criteria->compare('YEAR(paymentDateTime)', $this->paymentYear, FALSE, 'AND');
		$criteria->compare('MONTH(paymentDateTime)', $this->paymentMonth, FALSE, "AND");
		$criteria->compare("paymentDateTime", "<> '' ", TRUE, "AND");
		$criteria->compare("status", ">=2");
		$criteria->compare("status", "<> 99");
		return $this->find($criteria)->totalSummary;
	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->orderNo = $this->searchText;
			$this->title = $this->searchText;
			$this->type = $this->searchText;
		}

		$criteria->compare('orderNo', $this->orderNo, true, 'OR');
		$criteria->compare('title', $this->title, true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.createDateTime DESC',
			),
			'pagination'=>array(
				'pageSize'=>30
			),
		));
	}

	/**
	 * Front
	 */
	public function findByTokenAndSupplierId($token, $supplierId)
	{
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();

		$model = $this->find(array(
			'condition'=>'token=:token AND supplierId=:supplierId',
			'params'=>array(
				':token'=>$token,
				':supplierId'=>$supplierId,
			),
		));

		if(!isset($model))
		{
			$model = new Order();
			$model->token = $token;
			$model->supplierId = $supplierId;
			$model->provinceId = $daiibuy->provinceId;
			$model->type = self::ORDER_TYPE_CART;
			$model->createDateTime = $model->updateDateTime = new CDbExpression('NOW()');
			$model->save(false);
		}
		return $model;
	}

}
