<?php

/**
 * This is the model class for table "product_spec".
 *
 * The followings are the available columns in table 'product_spec':
 * @property string $productSpecId
 * @property string $productSpecGroupId
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $videoEmbeded
 * @property integer $sortOrder
 * @property integer $spanWidth
 * @property integer $ShowTitleType
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property ProductSpecGroup $productSpecGroup
 */
class ProductSpecMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_spec';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productSpecGroupId, title, createDateTime, updateDateTime', 'required'),
			array('sortOrder, spanWidth, ShowTitleType, status', 'numerical', 'integerOnly'=>true),
			array('productSpecGroupId', 'length', 'max'=>20),
			array('title', 'length', 'max'=>200),
			array('image', 'length', 'max'=>255),
			array('description, videoEmbeded', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('productSpecId, productSpecGroupId, title, description, image, videoEmbeded, sortOrder, spanWidth, ShowTitleType, status, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
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
			'productSpecGroup' => array(self::BELONGS_TO, 'ProductSpecGroup', 'productSpecGroupId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productSpecId' => 'Product Spec',
			'productSpecGroupId' => 'Product Spec Group',
			'title' => 'Title',
			'description' => 'Description',
			'image' => 'Image',
			'videoEmbeded' => 'Video Embeded',
			'sortOrder' => 'Sort Order',
			'spanWidth' => 'Span Width',
			'ShowTitleType' => 'Show Title Type',
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
			$this->productSpecId = $this->searchText;
			$this->productSpecGroupId = $this->searchText;
			$this->title = $this->searchText;
			$this->description = $this->searchText;
			$this->image = $this->searchText;
			$this->videoEmbeded = $this->searchText;
			$this->sortOrder = $this->searchText;
			$this->spanWidth = $this->searchText;
			$this->ShowTitleType = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('productSpecId',$this->productSpecId,true, 'OR');
		$criteria->compare('productSpecGroupId',$this->productSpecGroupId,true, 'OR');
		$criteria->compare('title',$this->title,true, 'OR');
		$criteria->compare('description',$this->description,true, 'OR');
		$criteria->compare('image',$this->image,true, 'OR');
		$criteria->compare('videoEmbeded',$this->videoEmbeded,true, 'OR');
		$criteria->compare('sortOrder',$this->sortOrder);
		$criteria->compare('spanWidth',$this->spanWidth);
		$criteria->compare('ShowTitleType',$this->ShowTitleType);
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
	 * @return ProductSpecMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
