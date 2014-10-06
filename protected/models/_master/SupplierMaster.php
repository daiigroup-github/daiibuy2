<?php

/**
 * This is the model class for table "supplier".
 *
 * The followings are the available columns in table 'supplier':
 * @property string $supplierId
 * @property string $name
 * @property string $description
 * @property string $address1
 * @property string $address2
 * @property string $tel
 * @property string $fax
 * @property string $logo
 * @property string $url
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
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
			array('name, logo', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			array('tel, fax', 'length', 'max'=>25),
			array('logo, url', 'length', 'max'=>255),
			array('description, address1, address2, createDateTime, updateDateTime', 'safe'),
			array('createDateTime, updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'insert'),
			array('updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('supplierId, name, description, address1, address2, tel, fax, logo, url, status, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
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
			'description' => 'Description',
			'address1' => 'Address1',
			'address2' => 'Address2',
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
			$this->description = $this->searchText;
			$this->address1 = $this->searchText;
			$this->address2 = $this->searchText;
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
		$criteria->compare('description',$this->description,true, 'OR');
		$criteria->compare('address1',$this->address1,true, 'OR');
		$criteria->compare('address2',$this->address2,true, 'OR');
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
