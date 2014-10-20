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

}
