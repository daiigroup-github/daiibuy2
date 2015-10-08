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
 * @property string $partnerDiscountCode
 * @property string $partnerDiscountPercent
 * @property string $partnerDiscountValue
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
 * @property string $partnerCode
 * @property integer $partnerType
 * @property string $parentId
 * @property string $mainId
 * @property string $mainFurnitureId
 * @property string $furnitureGroupId
 * @property string $furnitureId
 * @property integer $isRequestSpacialProject
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property District $shippingDistrict
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
			array('paymentMethod, usedPoint, isSentToCustomer, partnerType, isRequestSpacialProject, status', 'numerical', 'integerOnly'=>true),
			array('userId, supplierId, invoiceNo, telephone, partnerCode, parentId, mainId, mainFurnitureId, furnitureGroupId, furnitureId', 'length', 'max'=>20),
			array('orderNo, paymentTaxNo', 'length', 'max'=>45),
			array('firstname, lastname, email, partnerDiscountCode, paymentCompany, paymentFirstname, paymentLastname, shippingCompany', 'length', 'max'=>200),
			array('total, vatValue, totalIncVAT, discountValue, totalPostDiscount, distributorDiscount, totalPostDistributorDiscount, extraDiscount, partnerDiscountValue, summary', 'length', 'max'=>15),
			array('vatPercent, discountPercent, distributorDiscountPercent, partnerDiscountPercent', 'length', 'max'=>5),
			array('paymentDistrictId, paymentAmphurId, paymentProvinceId, paymentPostcode, shippingDistrictId, shippingAmphurId, shippingProvinceId, shippingPostCode', 'length', 'max'=>10),
			array('paymentDateTime, paymentAddress1, paymentAddress2, shippingAddress1, shippingAddress2, remark, supplierShippingDateTime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('orderGroupId, userId, supplierId, orderNo, invoiceNo, firstname, lastname, email, telephone, total, vatPercent, vatValue, totalIncVAT, discountPercent, discountValue, totalPostDiscount, distributorDiscountPercent, distributorDiscount, totalPostDistributorDiscount, extraDiscount, partnerDiscountCode, partnerDiscountPercent, partnerDiscountValue, summary, paymentDateTime, paymentCompany, paymentFirstname, paymentLastname, paymentAddress1, paymentAddress2, paymentDistrictId, paymentAmphurId, paymentProvinceId, paymentPostcode, paymentMethod, paymentTaxNo, shippingCompany, shippingAddress1, shippingAddress2, shippingDistrictId, shippingAmphurId, shippingProvinceId, shippingPostCode, usedPoint, isSentToCustomer, remark, supplierShippingDateTime, partnerCode, partnerType, parentId, mainId, mainFurnitureId, furnitureGroupId, furnitureId, isRequestSpacialProject, status, createDateTime, updateDateTime', 'safe', 'on'=>'search'),
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
			'shippingDistrict' => array(
				self::BELONGS_TO,
				'District',
				'shippingDistrictId'),
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
			'partnerDiscountCode' => 'Partner Discount Code',
			'partnerDiscountPercent' => 'Partner Discount Percent',
			'partnerDiscountValue' => 'Partner Discount Value',
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
			'partnerCode' => 'Partner Code',
			'partnerType' => 'Partner Type',
			'parentId' => 'Parent',
			'mainId' => 'Main',
			'mainFurnitureId' => 'Main Furniture',
			'furnitureGroupId' => 'Furniture Group',
			'furnitureId' => 'Furniture',
			'isRequestSpacialProject' => 'Is Request Spacial Project',
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

		$criteria->compare('orderGroupId',$this->orderGroupId,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('supplierId',$this->supplierId,true);
		$criteria->compare('orderNo',$this->orderNo,true);
		$criteria->compare('invoiceNo',$this->invoiceNo,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('vatPercent',$this->vatPercent,true);
		$criteria->compare('vatValue',$this->vatValue,true);
		$criteria->compare('totalIncVAT',$this->totalIncVAT,true);
		$criteria->compare('discountPercent',$this->discountPercent,true);
		$criteria->compare('discountValue',$this->discountValue,true);
		$criteria->compare('totalPostDiscount',$this->totalPostDiscount,true);
		$criteria->compare('distributorDiscountPercent',$this->distributorDiscountPercent,true);
		$criteria->compare('distributorDiscount',$this->distributorDiscount,true);
		$criteria->compare('totalPostDistributorDiscount',$this->totalPostDistributorDiscount,true);
		$criteria->compare('extraDiscount',$this->extraDiscount,true);
		$criteria->compare('partnerDiscountCode',$this->partnerDiscountCode,true);
		$criteria->compare('partnerDiscountPercent',$this->partnerDiscountPercent,true);
		$criteria->compare('partnerDiscountValue',$this->partnerDiscountValue,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('paymentDateTime',$this->paymentDateTime,true);
		$criteria->compare('paymentCompany',$this->paymentCompany,true);
		$criteria->compare('paymentFirstname',$this->paymentFirstname,true);
		$criteria->compare('paymentLastname',$this->paymentLastname,true);
		$criteria->compare('paymentAddress1',$this->paymentAddress1,true);
		$criteria->compare('paymentAddress2',$this->paymentAddress2,true);
		$criteria->compare('paymentDistrictId',$this->paymentDistrictId,true);
		$criteria->compare('paymentAmphurId',$this->paymentAmphurId,true);
		$criteria->compare('paymentProvinceId',$this->paymentProvinceId,true);
		$criteria->compare('paymentPostcode',$this->paymentPostcode,true);
		$criteria->compare('paymentMethod',$this->paymentMethod);
		$criteria->compare('paymentTaxNo',$this->paymentTaxNo,true);
		$criteria->compare('shippingCompany',$this->shippingCompany,true);
		$criteria->compare('shippingAddress1',$this->shippingAddress1,true);
		$criteria->compare('shippingAddress2',$this->shippingAddress2,true);
		$criteria->compare('shippingDistrictId',$this->shippingDistrictId,true);
		$criteria->compare('shippingAmphurId',$this->shippingAmphurId,true);
		$criteria->compare('shippingProvinceId',$this->shippingProvinceId,true);
		$criteria->compare('shippingPostCode',$this->shippingPostCode,true);
		$criteria->compare('usedPoint',$this->usedPoint);
		$criteria->compare('isSentToCustomer',$this->isSentToCustomer);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('supplierShippingDateTime',$this->supplierShippingDateTime,true);
		$criteria->compare('partnerCode',$this->partnerCode,true);
		$criteria->compare('partnerType',$this->partnerType);
		$criteria->compare('parentId',$this->parentId,true);
		$criteria->compare('mainId',$this->mainId,true);
		$criteria->compare('mainFurnitureId',$this->mainFurnitureId,true);
		$criteria->compare('furnitureGroupId',$this->furnitureGroupId,true);
		$criteria->compare('furnitureId',$this->furnitureId,true);
		$criteria->compare('isRequestSpacialProject',$this->isRequestSpacialProject);
		$criteria->compare('status',$this->status);
		$criteria->compare('createDateTime',$this->createDateTime,true);
		$criteria->compare('updateDateTime',$this->updateDateTime,true);

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
