<?php

/**
 * This is the model class for table "supplier_content_group".
 *
 * The followings are the available columns in table 'supplier_content_group':
 * @property string $supplierContentGroupId
 * @property string $supplierId
 * @property string $title
 * @property string $description
 * @property string $image
 * @property integer $sortOrder
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class SupplierContentGroupMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'supplier_content_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('supplierId, title, createDateTime, updateDateTime', 'required'),
			array('sortOrder, status', 'numerical', 'integerOnly'=>true),
			array('supplierId', 'length', 'max'=>20),
			array('title', 'length', 'max'=>200),
			array('image', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('supplierContentGroupId, supplierId, title, description, image, sortOrder, status, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
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
			'supplierContentGroupId' => 'Supplier Content Group',
			'supplierId' => 'Supplier',
			'title' => 'Title',
			'description' => 'Description',
			'image' => 'Image',
			'sortOrder' => 'Sort Order',
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
			$this->supplierContentGroupId = $this->searchText;
			$this->supplierId = $this->searchText;
			$this->title = $this->searchText;
			$this->description = $this->searchText;
			$this->image = $this->searchText;
			$this->sortOrder = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('supplierContentGroupId',$this->supplierContentGroupId,true, 'OR');
		$criteria->compare('supplierId',$this->supplierId,true, 'OR');
		$criteria->compare('title',$this->title,true, 'OR');
		$criteria->compare('description',$this->description,true, 'OR');
		$criteria->compare('image',$this->image,true, 'OR');
		$criteria->compare('sortOrder',$this->sortOrder);
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
	 * @return SupplierContentGroupMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
