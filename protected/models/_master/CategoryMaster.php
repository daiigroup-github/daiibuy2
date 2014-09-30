<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property string $categoryId
 * @property string $title
 * @property string $description
 * @property string $image
 * @property integer $sortOrder
 * @property integer $isRoot
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property Category2ToProduct[] $category2ToProducts
 * @property CategoryToSub[] $categoryToSubs
 * @property CategoryToSub[] $categoryToSubs1
 * @property ModelToCategory1[] $modelToCategory1s
 * @property Product[] $products
 */
class CategoryMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('sortOrder, isRoot, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>200),
			array('image', 'length', 'max'=>255),
			array('description, createDateTime, updateDateTime', 'safe'),
			array('createDateTime, updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'insert'),
			array('updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('categoryId, title, description, image, sortOrder, isRoot, status, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
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
			'category2ToProducts' => array(self::HAS_MANY, 'Category2ToProduct', 'categoryId'),
			'categoryToSubs' => array(self::HAS_MANY, 'CategoryToSub', 'categoryId'),
			'categoryToSubs1' => array(self::HAS_MANY, 'CategoryToSub', 'subCategoryId'),
			'modelToCategory1s' => array(self::HAS_MANY, 'ModelToCategory1', 'categoryId'),
			'products' => array(self::MANY_MANY, 'Product','category2_to_product(categoryId,productId)',),
			'brandModels' => array(self::MANY_MANY, 'BrandModel','model_to_category1(categoryId,brandModelId)',),
			'subCategorys' =>array(self::MANY_MANY, 'Category','category_to_sub(categoryId,subCategoryId)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'categoryId' => 'Category',
			'title' => 'Title',
			'description' => 'Description',
			'image' => 'Image',
			'sortOrder' => 'Sort Order',
			'isRoot' => 'Is Root',
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
			$this->categoryId = $this->searchText;
			$this->title = $this->searchText;
			$this->description = $this->searchText;
			$this->image = $this->searchText;
			$this->sortOrder = $this->searchText;
			$this->isRoot = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('categoryId',$this->categoryId,true, 'OR');
		$criteria->compare('title',$this->title,true, 'OR');
		$criteria->compare('description',$this->description,true, 'OR');
		$criteria->compare('image',$this->image,true, 'OR');
		$criteria->compare('sortOrder',$this->sortOrder);
		$criteria->compare('isRoot',$this->isRoot);
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
	 * @return CategoryMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
