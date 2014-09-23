<?php

/**
 * This is the model class for table "product_option".
 *
 * The followings are the available columns in table 'product_option':
 * @property string $productOptionId
 * @property string $productOptionGroupId
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $priceValue
 * @property string $pricePercent
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property ProductOptionGroup $productOptionGroup
 */
class ProductOptionMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_option';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productOptionGroupId, title, createDateTime, updateDateTime', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('productOptionGroupId', 'length', 'max'=>20),
			array('title', 'length', 'max'=>200),
			array('image', 'length', 'max'=>255),
			array('priceValue', 'length', 'max'=>15),
			array('pricePercent', 'length', 'max'=>5),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('productOptionId, productOptionGroupId, title, description, image, priceValue, pricePercent, status, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
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
			'productOptionGroup' => array(self::BELONGS_TO, 'ProductOptionGroup', 'productOptionGroupId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productOptionId' => 'Product Option',
			'productOptionGroupId' => 'Product Option Group',
			'title' => 'Title',
			'description' => 'Description',
			'image' => 'Image',
			'priceValue' => 'Price Value',
			'pricePercent' => 'Price Percent',
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
			$this->productOptionId = $this->searchText;
			$this->productOptionGroupId = $this->searchText;
			$this->title = $this->searchText;
			$this->description = $this->searchText;
			$this->image = $this->searchText;
			$this->priceValue = $this->searchText;
			$this->pricePercent = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('productOptionId',$this->productOptionId,true, 'OR');
		$criteria->compare('productOptionGroupId',$this->productOptionGroupId,true, 'OR');
		$criteria->compare('title',$this->title,true, 'OR');
		$criteria->compare('description',$this->description,true, 'OR');
		$criteria->compare('image',$this->image,true, 'OR');
		$criteria->compare('priceValue',$this->priceValue,true, 'OR');
		$criteria->compare('pricePercent',$this->pricePercent,true, 'OR');
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
	 * @return ProductOptionMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
