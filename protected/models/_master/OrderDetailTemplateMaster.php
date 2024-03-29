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
class OrderDetailTemplateMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_detail_template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orderDetailId, supplierId, title', 'required'),
			array('orderDetailId, supplierId', 'length', 'max'=>20),
			array('title', 'length', 'max'=>45),
			array('createDateTime, updateDateTime', 'safe'),
			array('createDateTime, updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'insert'),
			array('updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('orderDetailTemplateId, orderDetailId, supplierId, title, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
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
			'orderDetail' => array(self::BELONGS_TO, 'OrderDetail', 'orderDetailId'),
			'supplier' => array(self::BELONGS_TO, 'User', 'supplierId'),
			'orderDetailTemplateFields' => array(self::HAS_MANY, 'OrderDetailTemplateField', 'orderDetailTemplateId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'orderDetailTemplateId' => 'Order Detail Template',
			'orderDetailId' => 'Order Detail',
			'supplierId' => 'Supplier',
			'title' => 'Title',
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
			$this->orderDetailTemplateId = $this->searchText;
			$this->orderDetailId = $this->searchText;
			$this->supplierId = $this->searchText;
			$this->title = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('orderDetailTemplateId',$this->orderDetailTemplateId,true, 'OR');
		$criteria->compare('orderDetailId',$this->orderDetailId,true, 'OR');
		$criteria->compare('supplierId',$this->supplierId,true, 'OR');
		$criteria->compare('title',$this->title,true, 'OR');
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
	 * @return OrderDetailTemplateMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
