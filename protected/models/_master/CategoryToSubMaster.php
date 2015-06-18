<?php

/**
 * This is the model class for table "category_to_sub".
 *
 * The followings are the available columns in table 'category_to_sub':
 * @property string $id
 * @property string $brandModelId
 * @property string $categoryId
 * @property string $subCategoryId
 * @property integer $isTheme
 * @property integer $isSet
 * @property integer $isType
 * @property integer $sortOrder
 * @property string $description
 * @property string $payCondition
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
			array('isTheme, isSet, isType, sortOrder, status', 'numerical', 'integerOnly'=>true),
			array('brandModelId, categoryId, subCategoryId', 'length', 'max'=>20),
			array('description, payCondition', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, brandModelId, categoryId, subCategoryId, isTheme, isSet, isType, sortOrder, description, payCondition, status, createDateTime, updateDateTime', 'safe', 'on'=>'search'),
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
			'brandModelId' => 'Brand Model',
			'categoryId' => 'Category',
			'subCategoryId' => 'Sub Category',
			'isTheme' => 'Is Theme',
			'isSet' => 'Is Set',
			'isType' => 'Is Type',
			'sortOrder' => 'Sort Order',
			'description' => 'Description',
			'payCondition' => 'Pay Condition',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('brandModelId',$this->brandModelId,true);
		$criteria->compare('categoryId',$this->categoryId,true);
		$criteria->compare('subCategoryId',$this->subCategoryId,true);
		$criteria->compare('isTheme',$this->isTheme);
		$criteria->compare('isSet',$this->isSet);
		$criteria->compare('isType',$this->isType);
		$criteria->compare('sortOrder',$this->sortOrder);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('payCondition',$this->payCondition,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('createDateTime',$this->createDateTime,true);
		$criteria->compare('updateDateTime',$this->updateDateTime,true);

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
