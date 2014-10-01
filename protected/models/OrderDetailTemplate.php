<?php

/**
 * This is the model class for table "order_detail_template".
 *
 * The followings are the available columns in table 'order_detail_template':
 * @property string $orderDetailTemplateId
 * @property string $orderDetailId
 * @property string $supplierId
 * @property string $title
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property OrderDetail $orderDetail
 * @property User $supplier
 * @property OrderDetailTemplateField[] $orderDetailTemplateFields
 */
class OrderDetailTemplate extends OrderDetailTemplateMaster
{

	/**
	 * @return string the associated database table name
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
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
				'orderDetailId, supplierId, title',
				'required'),
			array(
				'orderDetailId, supplierId',
				'length',
				'max'=>20),
			array(
				'title',
				'length',
				'max'=>45),
			array(
				'createDateTime, updateDateTime',
				'safe'),
			array(
				'createDateTime, updateDateTime',
				'default',
				'value'=>new CDbExpression('NOW()'),
				'on'=>'insert'),
			array(
				'updateDateTime',
				'default',
				'value'=>new CDbExpression('NOW()'),
				'on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array(
				'orderDetailTemplateId, orderDetailId, supplierId, title, createDateTime, updateDateTime',
				'safe',
				'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return CMap::mergeArray(parent::relations(), array(
				//code here
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return Cmap::mergeArray(parent::attributeLabels(), array(
				//code here
		));
	}

	public function findOrderDetailTemplateBySupplierId($orderDetailTemplateId){
		$criteria = new CDbCriteria();
		$criteria->condition = 'orderDetailTemplateId = '. $orderDetailTemplateId .' AND status = 1';
		$res = $this->find($criteria);
		return $res;
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
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 * public function search()
	 * {
	 * }
	 */
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderDetailTemplate the static model class
	 */
}
