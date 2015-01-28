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
 * @property string $vatPercent
 * @property string $vatValue
 * @property string $totalIncVAT
 * @property string $discountPercent
 * @property string $discountValue
 * @property string $totalPostDiscount
 * @property string $distributorDiscountPercent
 * @property string $distributorDiscount
 * @property string $totalPostDistributorDiscount
 * @property string $extraDiscount
 * @property string $summary
 * @property string $paymentDateTime
 * @property string $paymentCompany
 * @property string $paymentFirstname
 * @property string $paymentLastname
 * @property string $paymentAddress1
 * @property string $paymentAddress2
 * @property string $paymentDistrictId
 * @property string $paymentAmphurId
 * @property string $paymentProvinceId
 * @property string $paymentPostcode
 * @property integer $paymentMethod
 * @property string $paymentTaxNo
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
 * @property string $supplierShippingDateTime
 * @property string $parentId
 * @property string $mainId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property District $shippingDistrict
 * @property Amphur $paymentAmphur
 * @property District $paymentDistrict
 * @property Province $paymentProvince
 * @property Amphur $shippingAmphur
 * @property Province $shippingProvince
 * @property Supplier $supplier
 * @property OrderGroupFile[] $orderGroupFiles
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
			array('userId, total, totalIncVAT, discountPercent, discountValue, createDateTime, updateDateTime', 'required'),
			array('paymentMethod, usedPoint, isSentToCustomer, status', 'numerical', 'integerOnly'=>true),
			array('userId, supplierId, invoiceNo, telephone, parentId, mainId', 'length', 'max'=>20),
			array('orderNo, paymentTaxNo', 'length', 'max'=>45),
			array('firstname, lastname, email, paymentCompany, paymentFirstname, paymentLastname, shippingCompany', 'length', 'max'=>200),
			array('total, vatValue, totalIncVAT, discountValue, totalPostDiscount, distributorDiscount, totalPostDistributorDiscount, extraDiscount, summary', 'length', 'max'=>15),
			array('vatPercent, discountPercent, distributorDiscountPercent', 'length', 'max'=>5),
			array('paymentDistrictId, paymentAmphurId, paymentProvinceId, paymentPostcode, shippingDistrictId, shippingAmphurId, shippingProvinceId, shippingPostCode', 'length', 'max'=>10),
			array('paymentDateTime, paymentAddress1, paymentAddress2, shippingAddress1, shippingAddress2, remark, supplierShippingDateTime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('orderGroupId, userId, supplierId, orderNo, invoiceNo, firstname, lastname, email, telephone, total, vatPercent, vatValue, totalIncVAT, discountPercent, discountValue, totalPostDiscount, distributorDiscountPercent, distributorDiscount, totalPostDistributorDiscount, extraDiscount, summary, paymentDateTime, paymentCompany, paymentFirstname, paymentLastname, paymentAddress1, paymentAddress2, paymentDistrictId, paymentAmphurId, paymentProvinceId, paymentPostcode, paymentMethod, paymentTaxNo, shippingCompany, shippingAddress1, shippingAddress2, shippingDistrictId, shippingAmphurId, shippingProvinceId, shippingPostCode, usedPoint, isSentToCustomer, remark, supplierShippingDateTime, parentId, mainId, status, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
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
			'shippingDistrict' => array(self::BELONGS_TO, 'District', 'shippingDistrictId'),
			'paymentAmphur' => array(self::BELONGS_TO, 'Amphur', 'paymentAmphurId'),
			'paymentDistrict' => array(self::BELONGS_TO, 'District', 'paymentDistrictId'),
			'paymentProvince' => array(self::BELONGS_TO, 'Province', 'paymentProvinceId'),
			'shippingAmphur' => array(self::BELONGS_TO, 'Amphur', 'shippingAmphurId'),
			'shippingProvince' => array(self::BELONGS_TO, 'Province', 'shippingProvinceId'),
			'supplier' => array(self::BELONGS_TO, 'Supplier', 'supplierId'),
			'orderGroupFiles' => array(self::HAS_MANY, 'OrderGroupFile', 'orderGroupId'),
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
			'vatPercent' => 'Vat Percent',
			'vatValue' => 'Vat Value',
			'totalIncVAT' => 'Total Inc Vat',
			'discountPercent' => 'Discount Percent',
			'discountValue' => 'Discount Value',
			'totalPostDiscount' => 'Total Post Discount',
			'distributorDiscountPercent' => 'Distributor Discount Percent',
			'distributorDiscount' => 'Distributor Discount',
			'totalPostDistributorDiscount' => 'Total Post Distributor Discount',
			'extraDiscount' => 'Extra Discount',
			'summary' => 'Summary',
			'paymentDateTime' => 'Payment Date Time',
			'paymentCompany' => 'Payment Company',
			'paymentFirstname' => 'Payment Firstname',
			'paymentLastname' => 'Payment Lastname',
			'paymentAddress1' => 'Payment Address1',
			'paymentAddress2' => 'Payment Address2',
			'paymentDistrictId' => 'Payment District',
			'paymentAmphurId' => 'Payment Amphur',
			'paymentProvinceId' => 'Payment Province',
			'paymentPostcode' => 'Payment Postcode',
			'paymentMethod' => 'Payment Method',
			'paymentTaxNo' => 'Payment Tax No',
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
			'supplierShippingDateTime' => 'Supplier Shipping Date Time',
			'parentId' => 'Parent',
			'mainId' => 'Main',
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
			$this->vatPercent = $this->searchText;
			$this->vatValue = $this->searchText;
			$this->totalIncVAT = $this->searchText;
			$this->discountPercent = $this->searchText;
			$this->discountValue = $this->searchText;
			$this->totalPostDiscount = $this->searchText;
			$this->distributorDiscountPercent = $this->searchText;
			$this->distributorDiscount = $this->searchText;
			$this->totalPostDistributorDiscount = $this->searchText;
			$this->extraDiscount = $this->searchText;
			$this->summary = $this->searchText;
			$this->paymentDateTime = $this->searchText;
			$this->paymentCompany = $this->searchText;
			$this->paymentFirstname = $this->searchText;
			$this->paymentLastname = $this->searchText;
			$this->paymentAddress1 = $this->searchText;
			$this->paymentAddress2 = $this->searchText;
			$this->paymentDistrictId = $this->searchText;
			$this->paymentAmphurId = $this->searchText;
			$this->paymentProvinceId = $this->searchText;
			$this->paymentPostcode = $this->searchText;
			$this->paymentMethod = $this->searchText;
			$this->paymentTaxNo = $this->searchText;
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
			$this->supplierShippingDateTime = $this->searchText;
			$this->parentId = $this->searchText;
			$this->mainId = $this->searchText;
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
		$criteria->compare('vatPercent',$this->vatPercent,true, 'OR');
		$criteria->compare('vatValue',$this->vatValue,true, 'OR');
		$criteria->compare('totalIncVAT',$this->totalIncVAT,true, 'OR');
		$criteria->compare('discountPercent',$this->discountPercent,true, 'OR');
		$criteria->compare('discountValue',$this->discountValue,true, 'OR');
		$criteria->compare('totalPostDiscount',$this->totalPostDiscount,true, 'OR');
		$criteria->compare('distributorDiscountPercent',$this->distributorDiscountPercent,true, 'OR');
		$criteria->compare('distributorDiscount',$this->distributorDiscount,true, 'OR');
		$criteria->compare('totalPostDistributorDiscount',$this->totalPostDistributorDiscount,true, 'OR');
		$criteria->compare('extraDiscount',$this->extraDiscount,true, 'OR');
		$criteria->compare('summary',$this->summary,true, 'OR');
		$criteria->compare('paymentDateTime',$this->paymentDateTime,true, 'OR');
		$criteria->compare('paymentCompany',$this->paymentCompany,true, 'OR');
		$criteria->compare('paymentFirstname',$this->paymentFirstname,true, 'OR');
		$criteria->compare('paymentLastname',$this->paymentLastname,true, 'OR');
		$criteria->compare('paymentAddress1',$this->paymentAddress1,true, 'OR');
		$criteria->compare('paymentAddress2',$this->paymentAddress2,true, 'OR');
		$criteria->compare('paymentDistrictId',$this->paymentDistrictId,true, 'OR');
		$criteria->compare('paymentAmphurId',$this->paymentAmphurId,true, 'OR');
		$criteria->compare('paymentProvinceId',$this->paymentProvinceId,true, 'OR');
		$criteria->compare('paymentPostcode',$this->paymentPostcode,true, 'OR');
		$criteria->compare('paymentMethod',$this->paymentMethod);
		$criteria->compare('paymentTaxNo',$this->paymentTaxNo,true, 'OR');
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
		$criteria->compare('supplierShippingDateTime',$this->supplierShippingDateTime,true, 'OR');
		$criteria->compare('parentId',$this->parentId,true, 'OR');
		$criteria->compare('mainId',$this->mainId,true, 'OR');
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
