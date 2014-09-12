<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property string $orderId
 * @property string $supplierId
 * @property string $title
 * @property integer $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property User $supplier
 * @property OrderGroupToOrder[] $orderGroupToOrders
 */
class OrderMaster extends MasterCActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order';
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
				'supplierId',
				'required'
			),
			array(
				'type, status',
				'numerical',
				'integerOnly'=>true
			),
			array(
				'supplierId',
				'length',
				'max'=>20
			),
			array(
				'title',
				'length',
				'max'=>200
			),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array(
				'orderId, supplierId, title, type, status, searchText',
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
			'supplier'=>array(
				self::BELONGS_TO,
				'User',
				'supplierId'
			),
			'orderGroupToOrders'=>array(
				self::HAS_MANY,
				'OrderGroupToOrder',
				'orderId'
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'orderId'=>'Order',
			'supplierId'=>'Supplier',
			'title'=>'Title',
			'type'=>'Type',
			'status'=>'Status',
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
			$this->orderId = $this->searchText;
			$this->supplierId = $this->searchText;
			$this->title = $this->searchText;
			$this->type = $this->searchText;
			$this->status = $this->searchText;
		}

		$criteria->compare('orderId', $this->orderId, true, 'OR');
		$criteria->compare('supplierId', $this->supplierId, true, 'OR');
		$criteria->compare('title', $this->title, true, 'OR');
		$criteria->compare('type', $this->type);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderMaster the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

}
