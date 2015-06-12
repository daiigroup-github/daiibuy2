<?php

/**
 * This is the model class for table "category_payment_condition".
 *
 * The followings are the available columns in table 'category_payment_condition':
 * @property string $categoryPaymentConditionId
 * @property string $category2Id
 * @property string $title
 * @property string $description
 * @property string $percent
 * @property string $value
 * @property integer $extimateDay
 * @property integer $sortOrder
 * @property string $image
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property Category $category2
 */
class CategoryPaymentConditionMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category_payment_condition';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category2Id, title', 'required'),
			array('extimateDay, sortOrder, status', 'numerical', 'integerOnly'=>true),
			array('category2Id', 'length', 'max'=>20),
			array('title', 'length', 'max'=>45),
			array('percent', 'length', 'max'=>5),
			array('value', 'length', 'max'=>15),
			array('image', 'length', 'max'=>255),
			array('description, createDateTime, updateDateTime', 'safe'),
			array('createDateTime, updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'insert'),
			array('updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('categoryPaymentConditionId, category2Id, title, description, percent, value, extimateDay, sortOrder, image, status, createDateTime, updateDateTime', 'safe', 'on'=>'search'),
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
			'category2' => array(self::BELONGS_TO, 'Category', 'category2Id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'categoryPaymentConditionId' => 'Category Payment Condition',
			'category2Id' => 'Category2',
			'title' => 'Title',
			'description' => 'Description',
			'percent' => 'Percent',
			'value' => 'Value',
			'extimateDay' => 'Extimate Day',
			'sortOrder' => 'Sort Order',
			'image' => 'Image',
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
		$criteria->compare('LOWER(category2Id)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(title)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(description)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(percent)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(value)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('extimateDay',$this->extimateDay);
		$criteria->compare('sortOrder',$this->sortOrder);
		$criteria->compare('LOWER(image)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('status',$this->status);
		$criteria->compare('LOWER(createDateTime)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(updateDateTime)',strtolower($this->searchText),true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CategoryPaymentConditionMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
