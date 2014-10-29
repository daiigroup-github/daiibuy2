<?php

/**
 * This is the model class for table "category_to_sub".
 *
 * The followings are the available columns in table 'category_to_sub':
 * @property string $id
 * @property string $categoryId
 * @property string $subCategoryId
 * @property integer $isTheme
 * @property integer $isSet
 * @property integer $sortOrder
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property Category $category
 * @property Category $subCategory
 */
class CategoryToSubMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category_to_sub';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('categoryId, subCategoryId, createDateTime, updateDateTime', 'required'),
			array('isTheme, isSet, sortOrder, status', 'numerical', 'integerOnly'=>true),
			array('categoryId, subCategoryId', 'length', 'max'=>20),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, categoryId, subCategoryId, isTheme, isSet, sortOrder, description, status, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Category', 'categoryId'),
			'subCategory' => array(self::BELONGS_TO, 'Category', 'subCategoryId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'categoryId' => 'Category',
			'subCategoryId' => 'Sub Category',
			'isTheme' => 'Is Theme',
			'isSet' => 'Is Set',
			'sortOrder' => 'Sort Order',
			'description' => 'Description',
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
			$this->categoryId = $this->searchText;
			$this->subCategoryId = $this->searchText;
			$this->isTheme = $this->searchText;
			$this->isSet = $this->searchText;
			$this->sortOrder = $this->searchText;
			$this->description = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('id',$this->id,true, 'OR');
		$criteria->compare('categoryId',$this->categoryId,true, 'OR');
		$criteria->compare('subCategoryId',$this->subCategoryId,true, 'OR');
		$criteria->compare('isTheme',$this->isTheme);
		$criteria->compare('isSet',$this->isSet);
		$criteria->compare('sortOrder',$this->sortOrder);
		$criteria->compare('description',$this->description,true, 'OR');
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
	 * @return CategoryToSubMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
