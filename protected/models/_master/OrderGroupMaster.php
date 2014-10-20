<?php

/**
 * This is the model class for table "order_group".
 *
 * The followings are the available columns in table 'order_group':
 * @property string $orderGroupId
 * @property string $userId
 * @property string $supplierId
 * @property string $orderNo
 * @property string $invoiceNo
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $telephone
 * @property string $total
 * @property string $totalIncVAT
 * @property string $paymentDateTime
 * @property string $paymentCompany
 * @property string $paymentFirstname
 * @property string $paymentLastname
 * @property string $paymentPostcode
 * @property integer $paymentMethod
 * @property string $shippingCompany
 * @property string $shippingAddress1
 * @property string $shippingAddress2
 * @property string $shippingDistrictId
 * @property string $shippingAmphurId
 * @property string $shippingProvinceId
 * @property string $shippingPostCode
 * @property integer $usedPoint
 * @property integer $isSentToCustomer
 * @property string $remark
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property OrderGroupToOrder[] $orderGroupToOrders
 */
class OrderGroupMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, createDateTime, updateDateTime', 'required'),
			array('paymentMethod, usedPoint, isSentToCustomer, status', 'numerical', 'integerOnly'=>true),
			array('userId, supplierId, invoiceNo, telephone', 'length', 'max'=>20),
			array('orderNo', 'length', 'max'=>45),
			array('firstname, lastname, email, paymentCompany, paymentFirstname, paymentLastname, shippingCompany', 'length', 'max'=>200),
			array('total, totalIncVAT', 'length', 'max'=>15),
			array('paymentPostcode, shippingDistrictId, shippingAmphurId, shippingProvinceId, shippingPostCode', 'length', 'max'=>10),
			array('paymentDateTime, shippingAddress1, shippingAddress2, remark', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('orderGroupId, userId, supplierId, orderNo, invoiceNo, firstname, lastname, email, telephone, total, totalIncVAT, paymentDateTime, paymentCompany, paymentFirstname, paymentLastname, paymentPostcode, paymentMethod, shippingCompany, shippingAddress1, shippingAddress2, shippingDistrictId, shippingAmphurId, shippingProvinceId, shippingPostCode, usedPoint, isSentToCustomer, remark, status, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'orderGroupToOrders' => array(self::HAS_MANY, 'OrderGroupToOrder', 'orderGroupId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'orderGroupId' => 'Order Group',
			'userId' => 'User',
			'supplierId' => 'Supplier',
			'orderNo' => 'Order No',
			'invoiceNo' => 'Invoice No',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'email' => 'Email',
			'telephone' => 'Telephone',
			'total' => 'Total',
			'totalIncVAT' => 'Total Inc Vat',
			'paymentDateTime' => 'Payment Date Time',
			'paymentCompany' => 'Payment Company',
			'paymentFirstname' => 'Payment Firstname',
			'paymentLastname' => 'Payment Lastname',
			'paymentPostcode' => 'Payment Postcode',
			'paymentMethod' => 'Payment Method',
			'shippingCompany' => 'Shipping Company',
			'shippingAddress1' => 'Shipping Address1',
			'shippingAddress2' => 'Shipping Address2',
			'shippingDistrictId' => 'Shipping District',
			'shippingAmphurId' => 'Shipping Amphur',
			'shippingProvinceId' => 'Shipping Province',
			'shippingPostCode' => 'Shipping Post Code',
			'usedPoint' => 'Used Point',
			'isSentToCustomer' => 'Is Sent To Customer',
			'remark' => 'Remark',
			'status' => 'Status',
			'createDateTime' => 'Create Date Time',
			'updateDateTime' => 'Update Date Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->orderGroupId = $this->searchText;
			$this->userId = $this->searchText;
			$this->supplierId = $this->searchText;
			$this->orderNo = $this->searchText;
			$this->invoiceNo = $this->searchText;
			$this->firstname = $this->searchText;
			$this->lastname = $this->searchText;
			$this->email = $this->searchText;
			$this->telephone = $this->searchText;
			$this->total = $this->searchText;
			$this->totalIncVAT = $this->searchText;
			$this->paymentDateTime = $this->searchText;
			$this->paymentCompany = $this->searchText;
			$this->paymentFirstname = $this->searchText;
			$this->paymentLastname = $this->searchText;
			$this->paymentPostcode = $this->searchText;
			$this->paymentMethod = $this->searchText;
			$this->shippingCompany = $this->searchText;
			$this->shippingAddress1 = $this->searchText;
			$this->shippingAddress2 = $this->searchText;
			$this->shippingDistrictId = $this->searchText;
			$this->shippingAmphurId = $this->searchText;
			$this->shippingProvinceId = $this->searchText;
			$this->shippingPostCode = $this->searchText;
			$this->usedPoint = $this->searchText;
			$this->isSentToCustomer = $this->searchText;
			$this->remark = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('orderGroupId',$this->orderGroupId,true, 'OR');
		$criteria->compare('userId',$this->userId,true, 'OR');
		$criteria->compare('supplierId',$this->supplierId,true, 'OR');
		$criteria->compare('orderNo',$this->orderNo,true, 'OR');
		$criteria->compare('invoiceNo',$this->invoiceNo,true, 'OR');
		$criteria->compare('firstname',$this->firstname,true, 'OR');
		$criteria->compare('lastname',$this->lastname,true, 'OR');
		$criteria->compare('email',$this->email,true, 'OR');
		$criteria->compare('telephone',$this->telephone,true, 'OR');
		$criteria->compare('total',$this->total,true, 'OR');
		$criteria->compare('totalIncVAT',$this->totalIncVAT,true, 'OR');
		$criteria->compare('paymentDateTime',$this->paymentDateTime,true, 'OR');
		$criteria->compare('paymentCompany',$this->paymentCompany,true, 'OR');
		$criteria->compare('paymentFirstname',$this->paymentFirstname,true, 'OR');
		$criteria->compare('paymentLastname',$this->paymentLastname,true, 'OR');
		$criteria->compare('paymentPostcode',$this->paymentPostcode,true, 'OR');
		$criteria->compare('paymentMethod',$this->paymentMethod);
		$criteria->compare('shippingCompany',$this->shippingCompany,true, 'OR');
		$criteria->compare('shippingAddress1',$this->shippingAddress1,true, 'OR');
		$criteria->compare('shippingAddress2',$this->shippingAddress2,true, 'OR');
		$criteria->compare('shippingDistrictId',$this->shippingDistrictId,true, 'OR');
		$criteria->compare('shippingAmphurId',$this->shippingAmphurId,true, 'OR');
		$criteria->compare('shippingProvinceId',$this->shippingProvinceId,true, 'OR');
		$criteria->compare('shippingPostCode',$this->shippingPostCode,true, 'OR');
		$criteria->compare('usedPoint',$this->usedPoint);
		$criteria->compare('isSentToCustomer',$this->isSentToCustomer);
		$criteria->compare('remark',$this->remark,true, 'OR');
		$criteria->compare('status',$this->status);
		$criteria->compare('createDateTime',$this->createDateTime,true, 'OR');
		$criteria->compare('updateDateTime',$this->updateDateTime,true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderGroupMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
