<?php

/**
 * This is the model class for table "promotion".
 *
 * The followings are the available columns in table 'promotion':
 * @property string $promotionId
 * @property string $partnerTypeId
 * @property string $title
 * @property string $description
 * @property string $creatorId
 * @property string $startDateTime
 * @property string $endDateTime
 * @property string $percent
 * @property string $value
 * @property string $accumulation
 * @property integer $type
 * @property string $image
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class PromotionMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'promotion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('partnerTypeId, title, startDateTime, endDateTime, type', 'required'),
			array('type, status', 'numerical', 'integerOnly'=>true),
			array('partnerTypeId, creatorId', 'length', 'max'=>20),
			array('title', 'length', 'max'=>200),
			array('percent', 'length', 'max'=>5),
			array('value, accumulation', 'length', 'max'=>15),
			array('image', 'length', 'max'=>255),
			array('description, createDateTime, updateDateTime', 'safe'),
			array('createDateTime, updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'insert'),
			array('updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('promotionId, partnerTypeId, title, description, creatorId, startDateTime, endDateTime, percent, value, accumulation, type, image, status, createDateTime, updateDateTime', 'safe', 'on'=>'search'),
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
			'promotionId' => 'Promotion',
			'partnerTypeId' => 'Partner Type',
			'title' => 'Title',
			'description' => 'Description',
			'creatorId' => 'Creator',
			'startDateTime' => 'Start Date Time',
			'endDateTime' => 'End Date Time',
			'percent' => 'Percent',
			'value' => 'Value',
			'accumulation' => 'Accumulation',
			'type' => 'Type',
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
		$criteria->compare('LOWER(partnerTypeId)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(title)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(description)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(creatorId)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(startDateTime)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(endDateTime)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(percent)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(value)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(accumulation)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('type',$this->type);
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
	 * @return PromotionMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
