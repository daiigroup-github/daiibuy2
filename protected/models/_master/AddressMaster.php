<?php

/**
 * This is the model class for table "address".
 *
 * The followings are the available columns in table 'address':
 * @property string $addressId
 * @property string $userId
 * @property string $firstname
 * @property string $lastname
 * @property string $company
 * @property string $address_1
 * @property string $address_2
 * @property string $districtId
 * @property string $amphurId
 * @property string $provinceId
 * @property string $countryId
 * @property string $postcode
 * @property integer $type
 * @property double $latitude
 * @property double $longitude
 * @property string $taxNo
 *
 * The followings are the available model relations:
 * @property User $user
 */
class AddressMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, address_1, address_2, districtId, amphurId, provinceId, postcode, type', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude', 'numerical'),
			array('userId, countryId', 'length', 'max'=>20),
			array('firstname, lastname', 'length', 'max'=>80),
			array('company', 'length', 'max'=>200),
			array('address_1, address_2', 'length', 'max'=>255),
			array('districtId, amphurId, provinceId', 'length', 'max'=>5),
			array('postcode', 'length', 'max'=>10),
			array('taxNo', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('addressId, userId, firstname, lastname, company, address_1, address_2, districtId, amphurId, provinceId, countryId, postcode, type, latitude, longitude, taxNo, searchText', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'addressId' => 'Address',
			'userId' => 'User',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'company' => 'Company',
			'address_1' => 'Address 1',
			'address_2' => 'Address 2',
			'districtId' => 'District',
			'amphurId' => 'Amphur',
			'provinceId' => 'Province',
			'countryId' => 'Country',
			'postcode' => 'Postcode',
			'type' => 'Type',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'taxNo' => 'Tax No',
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
			$this->addressId = $this->searchText;
			$this->userId = $this->searchText;
			$this->firstname = $this->searchText;
			$this->lastname = $this->searchText;
			$this->company = $this->searchText;
			$this->address_1 = $this->searchText;
			$this->address_2 = $this->searchText;
			$this->districtId = $this->searchText;
			$this->amphurId = $this->searchText;
			$this->provinceId = $this->searchText;
			$this->countryId = $this->searchText;
			$this->postcode = $this->searchText;
			$this->type = $this->searchText;
			$this->latitude = $this->searchText;
			$this->longitude = $this->searchText;
			$this->taxNo = $this->searchText;
		}

		$criteria->compare('addressId',$this->addressId,true, 'OR');
		$criteria->compare('userId',$this->userId,true, 'OR');
		$criteria->compare('firstname',$this->firstname,true, 'OR');
		$criteria->compare('lastname',$this->lastname,true, 'OR');
		$criteria->compare('company',$this->company,true, 'OR');
		$criteria->compare('address_1',$this->address_1,true, 'OR');
		$criteria->compare('address_2',$this->address_2,true, 'OR');
		$criteria->compare('districtId',$this->districtId,true, 'OR');
		$criteria->compare('amphurId',$this->amphurId,true, 'OR');
		$criteria->compare('provinceId',$this->provinceId,true, 'OR');
		$criteria->compare('countryId',$this->countryId,true, 'OR');
		$criteria->compare('postcode',$this->postcode,true, 'OR');
		$criteria->compare('type',$this->type);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('taxNo',$this->taxNo,true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AddressMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
