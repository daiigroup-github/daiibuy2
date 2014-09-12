<?php

/**
 * This is the model class for table "order_detail".
 *
 * The followings are the available columns in table 'order_detail':
 * @property string $orderDetailId
 * @property string $orderId
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property OrderDetailTemplate[] $orderDetailTemplates
 * @property OrderDetailValue[] $orderDetailValues
 */
class OrderDetailMaster extends MasterCActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(
				'orderId',
				'required'
			),
			array(
				'orderId',
				'length',
				'max'=>20
			),
			array(
				'createDateTime, updateDateTime',
				'safe'
			),
			array(
				'createDateTime, updateDateTime',
				'default',
				'value'=>new CDbExpression('NOW()'),
				'on'=>'insert'
			),
			array(
				'updateDateTime',
				'default',
				'value'=>new CDbExpression('NOW()'),
				'on'=>'update'
			),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array(
				'orderDetailId, orderId, createDateTime, updateDateTime, searchText',
				'safe',
				'on'=>'search'
			),
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
			'orderDetailTemplates'=>array(
				self::HAS_MANY,
				'OrderDetailTemplate',
				'orderDetailId'
			),
			'orderDetailValues'=>array(
				self::HAS_MANY,
				'OrderDetailValue',
				'orderDetailId'
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'orderDetailId'=>'Order Detail',
			'orderId'=>'Order',
			'createDateTime'=>'Create Date Time',
			'updateDateTime'=>'Update Date Time',
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

		$criteria = new CDbCriteria;
		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->orderDetailId = $this->searchText;
			$this->orderId = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('orderDetailId', $this->orderDetailId, true, 'OR');
		$criteria->compare('orderId', $this->orderId, true, 'OR');
		$criteria->compare('createDateTime', $this->createDateTime, true, 'OR');
		$criteria->compare('updateDateTime', $this->updateDateTime, true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderDetailMaster the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

}
