<?php

/**
 * This is the model class for table "order_detail_template_field".
 *
 * The followings are the available columns in table 'order_detail_template_field':
 * @property string $orderDetailTemplateFieldId
 * @property string $orderDetailTemplateId
 * @property string $title
 * @property string $description
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property OrderDetailTemplate $orderDetailTemplate
 * @property OrderDetailValue[] $orderDetailValues
 */
class OrderDetailTemplateFieldMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_detail_template_field';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orderDetailTemplateId, title, description', 'required'),
			array('orderDetailTemplateId', 'length', 'max'=>20),
			array('title, description', 'length', 'max'=>45),
			array('createDateTime, updateDateTime', 'safe'),
			array('createDateTime, updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'insert'),
			array('updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('orderDetailTemplateFieldId, orderDetailTemplateId, title, description, createDateTime, updateDateTime', 'safe', 'on'=>'search'),
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
			'orderDetailTemplate' => array(self::BELONGS_TO, 'OrderDetailTemplate', 'orderDetailTemplateId'),
			'orderDetailValues' => array(self::HAS_MANY, 'OrderDetailValue', 'orderDetailTemplateFieldId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'orderDetailTemplateFieldId' => 'Order Detail Template Field',
			'orderDetailTemplateId' => 'Order Detail Template',
			'title' => 'Title',
			'description' => 'Description',
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
		$criteria->compare('LOWER(orderDetailTemplateId)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(title)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(description)',strtolower($this->searchText),true, 'OR');
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
	 * @return OrderDetailTemplateFieldMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
