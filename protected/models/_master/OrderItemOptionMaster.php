<?php

/**
 * This is the model class for table "order_item_option".
 *
 * The followings are the available columns in table 'order_item_option':
 * @property string $orderItemOption
 * @property string $orderItemId
 * @property string $productOptionGroupId
 * @property string $productOptionId
 * @property string $value
 * @property string $percent
 * @property string $total
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class OrderItemOptionMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_item_option';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orderItemId, productOptionGroupId, productOptionId, createDateTime, updateDateTime', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('orderItemId, productOptionGroupId, productOptionId', 'length', 'max'=>20),
			array('value, total', 'length', 'max'=>15),
			array('percent', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('orderItemOption, orderItemId, productOptionGroupId, productOptionId, value, percent, total, status, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
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
			'orderItemOption' => 'Order Item Option',
			'orderItemId' => 'Order Item',
			'productOptionGroupId' => 'Product Option Group',
			'productOptionId' => 'Product Option',
			'value' => 'Value',
			'percent' => 'Percent',
			'total' => 'Total',
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
			$this->orderItemOption = $this->searchText;
			$this->orderItemId = $this->searchText;
			$this->productOptionGroupId = $this->searchText;
			$this->productOptionId = $this->searchText;
			$this->value = $this->searchText;
			$this->percent = $this->searchText;
			$this->total = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('orderItemOption',$this->orderItemOption,true, 'OR');
		$criteria->compare('orderItemId',$this->orderItemId,true, 'OR');
		$criteria->compare('productOptionGroupId',$this->productOptionGroupId,true, 'OR');
		$criteria->compare('productOptionId',$this->productOptionId,true, 'OR');
		$criteria->compare('value',$this->value,true, 'OR');
		$criteria->compare('percent',$this->percent,true, 'OR');
		$criteria->compare('total',$this->total,true, 'OR');
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
	 * @return OrderItemOptionMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
