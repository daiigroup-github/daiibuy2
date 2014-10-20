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

	public function getCollectedOrderView($userId)
	{
		$value = Configuration::model()->getOrderExpiredDate();
		$orders = Order::model()->findAll('DATE_ADD(createDateTime, INTERVAL ' . $value->value . ' YEAR) >= NOW() AND orderStatusid > 1 AND orderStatusid < 99 AND userId = ' . $userId);
		$res = 0;
		foreach($orders as $order)
		{
			$res = $res + $order->total;
		}

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
