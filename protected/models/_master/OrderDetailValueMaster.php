<?php

/**
 * This is the model class for table "order_detail_value".
 *
 * The followings are the available columns in table 'order_detail_value':
 * @property string $orderDetailValueId
 * @property string $orderDetailId
 * @property string $orderDetailTemplateFieldId
 * @property string $value
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property OrderDetailTemplateField $orderDetailTemplateField
 * @property OrderDetail $orderDetail
 */
class OrderDetailValueMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_detail_value';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orderDetailId, orderDetailTemplateFieldId, value, createDateTime, updateDateTime', 'required'),
			array('orderDetailId, orderDetailTemplateFieldId', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('orderDetailValueId, orderDetailId, orderDetailTemplateFieldId, value, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
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
			'orderDetailTemplateField' => array(self::BELONGS_TO, 'OrderDetailTemplateField', 'orderDetailTemplateFieldId'),
			'orderDetail' => array(self::BELONGS_TO, 'OrderDetail', 'orderDetailId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'orderDetailValueId' => 'Order Detail Value',
			'orderDetailId' => 'Order Detail',
			'orderDetailTemplateFieldId' => 'Order Detail Template Field',
			'value' => 'Value',
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
			$this->orderDetailValueId = $this->searchText;
			$this->orderDetailId = $this->searchText;
			$this->orderDetailTemplateFieldId = $this->searchText;
			$this->value = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('orderDetailValueId',$this->orderDetailValueId,true, 'OR');
		$criteria->compare('orderDetailId',$this->orderDetailId,true, 'OR');
		$criteria->compare('orderDetailTemplateFieldId',$this->orderDetailTemplateFieldId,true, 'OR');
		$criteria->compare('value',$this->value,true, 'OR');
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
	 * @return OrderDetailValueMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
