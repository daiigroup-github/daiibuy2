<?php

/**
 * This is the model class for table "organization".
 *
 * The followings are the available columns in table 'organization':
 * @property string $orgId
 * @property string $code
 * @property string $companyName
 * @property string $taxId
 * @property string $discountPercent
 * @property string $image
 * @property string $adress1
 * @property string $address2
 * @property string $districtId
 * @property string $amphurId
 * @property string $provinceId
 * @property string $postcode
 * @property string $tel
 * @property string $mobile
 * @property string $orgDomain
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class OrganizationMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'organization';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, companyName, image, adress1, districtId, amphurId, provinceId, tel, createDateTime, updateDateTime', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>50),
			array('companyName, orgDomain', 'length', 'max'=>200),
			array('taxId, tel', 'length', 'max'=>45),
			array('discountPercent', 'length', 'max'=>5),
			array('image', 'length', 'max'=>255),
			array('districtId, amphurId, provinceId', 'length', 'max'=>20),
			array('postcode, mobile', 'length', 'max'=>10),
			array('address2', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('orgId, code, companyName, taxId, discountPercent, image, adress1, address2, districtId, amphurId, provinceId, postcode, tel, mobile, orgDomain, status, createDateTime, updateDateTime', 'safe', 'on'=>'search'),
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
			'orgId' => 'Org',
			'code' => 'Code',
			'companyName' => 'Company Name',
			'taxId' => 'Tax',
			'discountPercent' => 'Discount Percent',
			'image' => 'Image',
			'adress1' => 'Adress1',
			'address2' => 'Address2',
			'districtId' => 'District',
			'amphurId' => 'Amphur',
			'provinceId' => 'Province',
			'postcode' => 'Postcode',
			'tel' => 'Tel',
			'mobile' => 'Mobile',
			'orgDomain' => 'Org Domain',
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

		$criteria->compare('orgId',$this->orgId,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('companyName',$this->companyName,true);
		$criteria->compare('taxId',$this->taxId,true);
		$criteria->compare('discountPercent',$this->discountPercent,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('adress1',$this->adress1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('districtId',$this->districtId,true);
		$criteria->compare('amphurId',$this->amphurId,true);
		$criteria->compare('provinceId',$this->provinceId,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('orgDomain',$this->orgDomain,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('createDateTime',$this->createDateTime,true);
		$criteria->compare('updateDateTime',$this->updateDateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->org;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrganizationMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
