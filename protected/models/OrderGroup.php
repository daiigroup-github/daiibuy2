<?php

/**
 * This is the model class for table "order_group".
 *
 * The followings are the available columns in table 'order_group':
 * @property string $orderGroupId
 * @property string $userId
 * @property string $Ordercol
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property OrderGroupToOrder[] $orderGroupToOrders
 */
class OrderGroup extends OrderGroupMaster
{

	public $maxCode;

	const STATUS_ORDER = 1;
	const STATUS_COMFIRM_TRANSFER = 2;
	const STATUS_APPROVE_TRANSFER = 3;
	const STATUS_SUPPLIER_SHIPPING = 4;

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
				'orders'=>array(
					self::MANY_MANY,
					'Order',
					'order_group_to_order(orderGroupId,orderId)'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return Cmap::mergeArray(parent::attributeLabels(), array(
				//code here
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 * public function search()
	 * {
	 * }
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->orderNo = $this->searchText;
			$this->type = $this->searchText;
		}

		$criteria->compare('orderNo', $this->orderNo, true, 'OR');
//		$criteria->compare('title', $this->title, true, 'OR');

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
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderGroup the static model class
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
		$criteria->compare("status", ">2");
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
		$criteria->condition = "status in (2 , 5 , 6 , 7 , 8 , 11 , 12 ,13, 14 ,15 ,16,98 ) ";
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
		$criteria->condition = "status > 2 AND paymentDateTime is not NULL";
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

	public function findAllStatus()
	{
		return array(
			self::STATUS_ORDER=>$this->showOrderStatus(self::STATUS_ORDER),
			self::STATUS_COMFIRM_TRANSFER=>$this->showOrderStatus(self::STATUS_COMFIRM_TRANSFER),
			self::STATUS_APPROVE_TRANSFER=>$this->showOrderStatus(self::STATUS_APPROVE_TRANSFER),
			self::STATUS_SUPPLIER_SHIPPING=>$this->showOrderStatus(self::STATUS_SUPPLIER_SHIPPING),
		);
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
			case 1:
				return "รอการยืนยันโอนเงินจากลูกค้า";
				break;
			case 2:
				return "รอตรวจสอบการโอนเงิน";
				break;
			case 3:
				return isset($user) ? ($user->type == 1 ? "การสั่งซื้อสินค้าสมบูรณ์" : "การสั่งซื้อสินค้าสมบูรณ์(รอการจัดส่ง)" ) : "การสั่งซื้อสินค้าสมบูรณ์";
				break;
			case 4:
				return "Supplier กำลังจัดส่งสินค้า";
				break;
		}
	}

}
