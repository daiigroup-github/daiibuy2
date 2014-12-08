<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property string $orderId
 * @property string $orderNo
 * @property string $invoiceNo
 * @property string $userId
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $telephone
 * @property string $fax
 * @property string $paymentFirstname
 * @property string $paymentLastname
 * @property string $paymentCompany
 * @property string $taxNo
 * @property string $paymentAddress1
 * @property string $paymentAddress2
 * @property string $paymentDistrict
 * @property string $paymentAmphur
 * @property string $paymentProvince
 * @property string $paymentPostcode
 * @property string $paymentAddressFormat
 * @property string $paymentMethod
 * @property string $paymentCode
 * @property string $shippingFirstname
 * @property string $shippingLastname
 * @property string $shippingCompany
 * @property string $shippingAddress1
 * @property string $shippingAddress2
 * @property string $shippingDistrictId
 * @property string $shippingAmphur
 * @property string $shippingProvince
 * @property string $shippingPostcode
 * @property string $shippingAddressFormat
 * @property string $shippingMethod
 * @property string $shippingCode
 * @property string $comment
 * @property string $total
 * @property string $totalIncVAT
 * @property string $usedPoint
 * @property string $pointToBaht
 * @property integer $orderStatusid
 * @property string $dealerId
 * @property string $supplierId
 * @property string $amphurId
 * @property string $supplierShippingDateTime
 * @property string $commission
 * @property string $ip
 * @property string $forwardedIp
 * @property string $userAgent
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $verifyCode
 * @property string $paymentDateTime
 * @property integer $isSentToCustomer
 * @property string $customerReserve
 * @property string $remark
 * @property integer $isChangeToReward
 */
class OrderDaiibuy1Master extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lastname, email, paymentAddress1, dealerId, supplierId, amphurId, ip, createDateTime', 'required'),
			array('orderStatusid, isSentToCustomer, isChangeToReward', 'numerical', 'integerOnly'=>true),
			array('orderNo, invoiceNo', 'length', 'max'=>40),
			array('userId, dealerId, supplierId, amphurId, verifyCode', 'length', 'max'=>20),
			array('firstname, lastname, telephone, fax, paymentFirstname, paymentLastname, shippingFirstname, shippingLastname', 'length', 'max'=>32),
			array('email', 'length', 'max'=>96),
			array('paymentCompany, paymentAddress1, paymentAddress2, shippingCompany', 'length', 'max'=>200),
			array('taxNo, paymentDistrict, paymentAmphur, paymentProvince, paymentMethod, paymentCode, shippingAddress1, shippingAddress2, shippingDistrictId, shippingAmphur, shippingProvince, shippingMethod, shippingCode', 'length', 'max'=>128),
			array('paymentPostcode, shippingPostcode', 'length', 'max'=>10),
			array('total, totalIncVAT, usedPoint, pointToBaht, commission, ip, forwardedIp', 'length', 'max'=>15),
			array('userAgent', 'length', 'max'=>255),
			array('customerReserve, remark', 'length', 'max'=>500),
			array('paymentAddressFormat, shippingAddressFormat, comment, supplierShippingDateTime, updateDateTime, paymentDateTime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('orderId, orderNo, invoiceNo, userId, firstname, lastname, email, telephone, fax, paymentFirstname, paymentLastname, paymentCompany, taxNo, paymentAddress1, paymentAddress2, paymentDistrict, paymentAmphur, paymentProvince, paymentPostcode, paymentAddressFormat, paymentMethod, paymentCode, shippingFirstname, shippingLastname, shippingCompany, shippingAddress1, shippingAddress2, shippingDistrictId, shippingAmphur, shippingProvince, shippingPostcode, shippingAddressFormat, shippingMethod, shippingCode, comment, total, totalIncVAT, usedPoint, pointToBaht, orderStatusid, dealerId, supplierId, amphurId, supplierShippingDateTime, commission, ip, forwardedIp, userAgent, createDateTime, updateDateTime, verifyCode, paymentDateTime, isSentToCustomer, customerReserve, remark, isChangeToReward, searchText', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'orderId' => 'Order',
			'orderNo' => 'Order No',
			'invoiceNo' => 'Invoice No',
			'userId' => 'User',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'email' => 'Email',
			'telephone' => 'Telephone',
			'fax' => 'Fax',
			'paymentFirstname' => 'Payment Firstname',
			'paymentLastname' => 'Payment Lastname',
			'paymentCompany' => 'Payment Company',
			'taxNo' => 'Tax No',
			'paymentAddress1' => 'Payment Address1',
			'paymentAddress2' => 'Payment Address2',
			'paymentDistrict' => 'Payment District',
			'paymentAmphur' => 'Payment Amphur',
			'paymentProvince' => 'Payment Province',
			'paymentPostcode' => 'Payment Postcode',
			'paymentAddressFormat' => 'Payment Address Format',
			'paymentMethod' => 'Payment Method',
			'paymentCode' => 'Payment Code',
			'shippingFirstname' => 'Shipping Firstname',
			'shippingLastname' => 'Shipping Lastname',
			'shippingCompany' => 'Shipping Company',
			'shippingAddress1' => 'Shipping Address1',
			'shippingAddress2' => 'Shipping Address2',
			'shippingDistrictId' => 'Shipping District',
			'shippingAmphur' => 'Shipping Amphur',
			'shippingProvince' => 'Shipping Province',
			'shippingPostcode' => 'Shipping Postcode',
			'shippingAddressFormat' => 'Shipping Address Format',
			'shippingMethod' => 'Shipping Method',
			'shippingCode' => 'Shipping Code',
			'comment' => 'Comment',
			'total' => 'Total',
			'totalIncVAT' => 'Total Inc Vat',
			'usedPoint' => 'Used Point',
			'pointToBaht' => 'Point To Baht',
			'orderStatusid' => 'Order Statusid',
			'dealerId' => 'Dealer',
			'supplierId' => 'Supplier',
			'amphurId' => 'Amphur',
			'supplierShippingDateTime' => 'Supplier Shipping Date Time',
			'commission' => 'Commission',
			'ip' => 'Ip',
			'forwardedIp' => 'Forwarded Ip',
			'userAgent' => 'User Agent',
			'createDateTime' => 'Create Date Time',
			'updateDateTime' => 'Update Date Time',
			'verifyCode' => 'Verify Code',
			'paymentDateTime' => 'Payment Date Time',
			'isSentToCustomer' => 'Is Sent To Customer',
			'customerReserve' => 'Customer Reserve',
			'remark' => 'Remark',
			'isChangeToReward' => 'Is Change To Reward',
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
			$this->orderId = $this->searchText;
			$this->orderNo = $this->searchText;
			$this->invoiceNo = $this->searchText;
			$this->userId = $this->searchText;
			$this->firstname = $this->searchText;
			$this->lastname = $this->searchText;
			$this->email = $this->searchText;
			$this->telephone = $this->searchText;
			$this->fax = $this->searchText;
			$this->paymentFirstname = $this->searchText;
			$this->paymentLastname = $this->searchText;
			$this->paymentCompany = $this->searchText;
			$this->taxNo = $this->searchText;
			$this->paymentAddress1 = $this->searchText;
			$this->paymentAddress2 = $this->searchText;
			$this->paymentDistrict = $this->searchText;
			$this->paymentAmphur = $this->searchText;
			$this->paymentProvince = $this->searchText;
			$this->paymentPostcode = $this->searchText;
			$this->paymentAddressFormat = $this->searchText;
			$this->paymentMethod = $this->searchText;
			$this->paymentCode = $this->searchText;
			$this->shippingFirstname = $this->searchText;
			$this->shippingLastname = $this->searchText;
			$this->shippingCompany = $this->searchText;
			$this->shippingAddress1 = $this->searchText;
			$this->shippingAddress2 = $this->searchText;
			$this->shippingDistrictId = $this->searchText;
			$this->shippingAmphur = $this->searchText;
			$this->shippingProvince = $this->searchText;
			$this->shippingPostcode = $this->searchText;
			$this->shippingAddressFormat = $this->searchText;
			$this->shippingMethod = $this->searchText;
			$this->shippingCode = $this->searchText;
			$this->comment = $this->searchText;
			$this->total = $this->searchText;
			$this->totalIncVAT = $this->searchText;
			$this->usedPoint = $this->searchText;
			$this->pointToBaht = $this->searchText;
			$this->orderStatusid = $this->searchText;
			$this->dealerId = $this->searchText;
			$this->supplierId = $this->searchText;
			$this->amphurId = $this->searchText;
			$this->supplierShippingDateTime = $this->searchText;
			$this->commission = $this->searchText;
			$this->ip = $this->searchText;
			$this->forwardedIp = $this->searchText;
			$this->userAgent = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
			$this->verifyCode = $this->searchText;
			$this->paymentDateTime = $this->searchText;
			$this->isSentToCustomer = $this->searchText;
			$this->customerReserve = $this->searchText;
			$this->remark = $this->searchText;
			$this->isChangeToReward = $this->searchText;
		}

		$criteria->compare('orderId',$this->orderId,true, 'OR');
		$criteria->compare('orderNo',$this->orderNo,true, 'OR');
		$criteria->compare('invoiceNo',$this->invoiceNo,true, 'OR');
		$criteria->compare('userId',$this->userId,true, 'OR');
		$criteria->compare('firstname',$this->firstname,true, 'OR');
		$criteria->compare('lastname',$this->lastname,true, 'OR');
		$criteria->compare('email',$this->email,true, 'OR');
		$criteria->compare('telephone',$this->telephone,true, 'OR');
		$criteria->compare('fax',$this->fax,true, 'OR');
		$criteria->compare('paymentFirstname',$this->paymentFirstname,true, 'OR');
		$criteria->compare('paymentLastname',$this->paymentLastname,true, 'OR');
		$criteria->compare('paymentCompany',$this->paymentCompany,true, 'OR');
		$criteria->compare('taxNo',$this->taxNo,true, 'OR');
		$criteria->compare('paymentAddress1',$this->paymentAddress1,true, 'OR');
		$criteria->compare('paymentAddress2',$this->paymentAddress2,true, 'OR');
		$criteria->compare('paymentDistrict',$this->paymentDistrict,true, 'OR');
		$criteria->compare('paymentAmphur',$this->paymentAmphur,true, 'OR');
		$criteria->compare('paymentProvince',$this->paymentProvince,true, 'OR');
		$criteria->compare('paymentPostcode',$this->paymentPostcode,true, 'OR');
		$criteria->compare('paymentAddressFormat',$this->paymentAddressFormat,true, 'OR');
		$criteria->compare('paymentMethod',$this->paymentMethod,true, 'OR');
		$criteria->compare('paymentCode',$this->paymentCode,true, 'OR');
		$criteria->compare('shippingFirstname',$this->shippingFirstname,true, 'OR');
		$criteria->compare('shippingLastname',$this->shippingLastname,true, 'OR');
		$criteria->compare('shippingCompany',$this->shippingCompany,true, 'OR');
		$criteria->compare('shippingAddress1',$this->shippingAddress1,true, 'OR');
		$criteria->compare('shippingAddress2',$this->shippingAddress2,true, 'OR');
		$criteria->compare('shippingDistrictId',$this->shippingDistrictId,true, 'OR');
		$criteria->compare('shippingAmphur',$this->shippingAmphur,true, 'OR');
		$criteria->compare('shippingProvince',$this->shippingProvince,true, 'OR');
		$criteria->compare('shippingPostcode',$this->shippingPostcode,true, 'OR');
		$criteria->compare('shippingAddressFormat',$this->shippingAddressFormat,true, 'OR');
		$criteria->compare('shippingMethod',$this->shippingMethod,true, 'OR');
		$criteria->compare('shippingCode',$this->shippingCode,true, 'OR');
		$criteria->compare('comment',$this->comment,true, 'OR');
		$criteria->compare('total',$this->total,true, 'OR');
		$criteria->compare('totalIncVAT',$this->totalIncVAT,true, 'OR');
		$criteria->compare('usedPoint',$this->usedPoint,true, 'OR');
		$criteria->compare('pointToBaht',$this->pointToBaht,true, 'OR');
		$criteria->compare('orderStatusid',$this->orderStatusid);
		$criteria->compare('dealerId',$this->dealerId,true, 'OR');
		$criteria->compare('supplierId',$this->supplierId,true, 'OR');
		$criteria->compare('amphurId',$this->amphurId,true, 'OR');
		$criteria->compare('supplierShippingDateTime',$this->supplierShippingDateTime,true, 'OR');
		$criteria->compare('commission',$this->commission,true, 'OR');
		$criteria->compare('ip',$this->ip,true, 'OR');
		$criteria->compare('forwardedIp',$this->forwardedIp,true, 'OR');
		$criteria->compare('userAgent',$this->userAgent,true, 'OR');
		$criteria->compare('createDateTime',$this->createDateTime,true, 'OR');
		$criteria->compare('updateDateTime',$this->updateDateTime,true, 'OR');
		$criteria->compare('verifyCode',$this->verifyCode,true, 'OR');
		$criteria->compare('paymentDateTime',$this->paymentDateTime,true, 'OR');
		$criteria->compare('isSentToCustomer',$this->isSentToCustomer);
		$criteria->compare('customerReserve',$this->customerReserve,true, 'OR');
		$criteria->compare('remark',$this->remark,true, 'OR');
		$criteria->compare('isChangeToReward',$this->isChangeToReward);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbDaiibuy1;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderDaiibuy1Master the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
