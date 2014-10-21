<?php

/**
 * This is the model class for table "supplier".
 *
 * The followings are the available columns in table 'supplier':
 * @property string $supplierId
 * @property string $name
 * @property string $prefix
 * @property string $description
 * @property string $companyName
 * @property string $address1
 * @property string $address2
 * @property string $districtId
 * @property string $amphurId
 * @property string $provinceId
 * @property string $postcode
 * @property string $taxNumber
 * @property string $email
 * @property string $tel
 * @property string $fax
 * @property string $logo
 * @property string $url
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property Order[] $orders
 * @property OrderDetailTemplate[] $orderDetailTemplates
 * @property OrderGroup[] $orderGroups
 * @property Product[] $products
 * @property Amphur $amphur
 * @property District $district
 * @property Province $province
 * @property SupplierDiscountRange[] $supplierDiscountRanges
 * @property SupplierEpayment[] $supplierEpayments
 * @property UserToSupplier[] $userToSuppliers
 */
class SupplierMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'supplier';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, districtId, amphurId, provinceId, postcode, logo, createDateTime, updateDateTime', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name, companyName, email', 'length', 'max'=>200),
			array('prefix', 'length', 'max'=>5),
			array('districtId, amphurId, provinceId, postcode', 'length', 'max'=>10),
			array('taxNumber', 'length', 'max'=>50),
			array('tel, fax', 'length', 'max'=>25),
			array('logo, url', 'length', 'max'=>255),
			array('description, address1, address2', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('supplierId, name, prefix, description, companyName, address1, address2, districtId, amphurId, provinceId, postcode, taxNumber, email, tel, fax, logo, url, status, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
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
			'orders' => array(self::HAS_MANY, 'Order', 'supplierId'),
			'orderDetailTemplates' => array(self::HAS_MANY, 'OrderDetailTemplate', 'supplierId'),
			'orderGroups' => array(self::HAS_MANY, 'OrderGroup', 'supplierId'),
			'products' => array(self::HAS_MANY, 'Product', 'supplierId'),
			'amphur' => array(self::BELONGS_TO, 'Amphur', 'amphurId'),
			'district' => array(self::BELONGS_TO, 'District', 'districtId'),
			'province' => array(self::BELONGS_TO, 'Province', 'provinceId'),
			'supplierDiscountRanges' => array(self::HAS_MANY, 'SupplierDiscountRange', 'supplierId'),
			'supplierEpayments' => array(self::HAS_MANY, 'SupplierEpayment', 'supplierId'),
			'userToSuppliers' => array(self::HAS_MANY, 'UserToSupplier', 'supplierId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'supplierId' => 'Supplier',
			'name' => 'Name',
			'prefix' => 'Prefix',
			'description' => 'Description',
			'companyName' => 'Company Name',
			'address1' => 'Address1',
			'address2' => 'Address2',
			'districtId' => 'District',
			'amphurId' => 'Amphur',
			'provinceId' => 'Province',
			'postcode' => 'Postcode',
			'taxNumber' => 'Tax Number',
			'email' => 'Email',
			'tel' => 'Tel',
			'fax' => 'Fax',
			'logo' => 'Logo',
			'url' => 'Url',
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
			$this->supplierId = $this->searchText;
			$this->name = $this->searchText;
			$this->prefix = $this->searchText;
			$this->description = $this->searchText;
			$this->companyName = $this->searchText;
			$this->address1 = $this->searchText;
			$this->address2 = $this->searchText;
			$this->districtId = $this->searchText;
			$this->amphurId = $this->searchText;
			$this->provinceId = $this->searchText;
			$this->postcode = $this->searchText;
			$this->taxNumber = $this->searchText;
			$this->email = $this->searchText;
			$this->tel = $this->searchText;
			$this->fax = $this->searchText;
			$this->logo = $this->searchText;
			$this->url = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('supplierId',$this->supplierId,true, 'OR');
		$criteria->compare('name',$this->name,true, 'OR');
		$criteria->compare('prefix',$this->prefix,true, 'OR');
		$criteria->compare('description',$this->description,true, 'OR');
		$criteria->compare('companyName',$this->companyName,true, 'OR');
		$criteria->compare('address1',$this->address1,true, 'OR');
		$criteria->compare('address2',$this->address2,true, 'OR');
		$criteria->compare('districtId',$this->districtId,true, 'OR');
		$criteria->compare('amphurId',$this->amphurId,true, 'OR');
		$criteria->compare('provinceId',$this->provinceId,true, 'OR');
		$criteria->compare('postcode',$this->postcode,true, 'OR');
		$criteria->compare('taxNumber',$this->taxNumber,true, 'OR');
		$criteria->compare('email',$this->email,true, 'OR');
		$criteria->compare('tel',$this->tel,true, 'OR');
		$criteria->compare('fax',$this->fax,true, 'OR');
		$criteria->compare('logo',$this->logo,true, 'OR');
		$criteria->compare('url',$this->url,true, 'OR');
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
	 * @return SupplierMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
