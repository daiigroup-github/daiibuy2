<?php

/**
 * This is the model class for table "category2_to_product".
 *
 * The followings are the available columns in table 'category2_to_product':
 * @property string $id
 * @property string $brandId
 * @property string $brandModelId
 * @property string $category1Id
 * @property string $category2Id
 * @property string $productId
 * @property string $groupName
 * @property integer $quantity
 * @property integer $type
 * @property integer $sortOrder
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property Brand $brand
 * @property BrandModel $brandModel
 * @property Product $product
 */
class Category2ToProductMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category2_to_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productId, createDateTime, updateDateTime', 'required'),
			array('quantity, type, sortOrder, status', 'numerical', 'integerOnly'=>true),
			array('brandId, brandModelId, category1Id, category2Id, productId', 'length', 'max'=>20),
			array('groupName', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, brandId, brandModelId, category1Id, category2Id, productId, groupName, quantity, type, sortOrder, status, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
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
			'brand' => array(self::BELONGS_TO, 'Brand', 'brandId'),
			'brandModel' => array(self::BELONGS_TO, 'BrandModel', 'brandModelId'),
			'product' => array(self::BELONGS_TO, 'Product', 'productId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'brandId' => 'Brand',
			'brandModelId' => 'Brand Model',
			'category1Id' => 'Category1',
			'category2Id' => 'Category2',
			'productId' => 'Product',
			'groupName' => 'Group Name',
			'quantity' => 'Quantity',
			'type' => 'Type',
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
			$this->id = $this->searchText;
			$this->brandId = $this->searchText;
			$this->brandModelId = $this->searchText;
			$this->category1Id = $this->searchText;
			$this->category2Id = $this->searchText;
			$this->productId = $this->searchText;
			$this->groupName = $this->searchText;
			$this->quantity = $this->searchText;
			$this->type = $this->searchText;
			$this->sortOrder = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('id',$this->id,true, 'OR');
		$criteria->compare('brandId',$this->brandId,true, 'OR');
		$criteria->compare('brandModelId',$this->brandModelId,true, 'OR');
		$criteria->compare('category1Id',$this->category1Id,true, 'OR');
		$criteria->compare('category2Id',$this->category2Id,true, 'OR');
		$criteria->compare('productId',$this->productId,true, 'OR');
		$criteria->compare('groupName',$this->groupName,true, 'OR');
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('type',$this->type);
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
	 * @return Category2ToProductMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
