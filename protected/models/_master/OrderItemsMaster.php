<?php

/**
 * This is the model class for table "order_items".
 *
 * The followings are the available columns in table 'order_items':
 * @property string $orderItemsId
 * @property string $orderId
 * @property string $productId
 * @property string $title
 * @property string $price
 * @property string $quantity
 * @property string $total
 * @property string $groupName
 * @property string $area
 * @property string $productOptionId
 * @property string $styleId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property Order $order
 * @property Product $product
 */
class OrderItemsMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orderId, title, price, quantity, total, createDateTime, updateDateTime', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('orderId, productId, productOptionId, styleId', 'length', 'max'=>20),
			array('title, groupName', 'length', 'max'=>45),
			array('price, total, area', 'length', 'max'=>15),
			array('quantity', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('orderItemsId, orderId, productId, title, price, quantity, total, groupName, area, productOptionId, styleId, status, createDateTime, updateDateTime', 'safe', 'on'=>'search'),
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
			'order' => array(self::BELONGS_TO, 'Order', 'orderId'),
			'product' => array(self::BELONGS_TO, 'Product', 'productId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'orderItemsId' => 'Order Items',
			'orderId' => 'Order',
			'productId' => 'Product',
			'title' => 'Title',
			'price' => 'Price',
			'quantity' => 'Quantity',
			'total' => 'Total',
			'groupName' => 'Group Name',
			'area' => 'Area',
			'productOptionId' => 'Product Option',
			'styleId' => 'Style',
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

		$criteria->compare('orderItemsId',$this->orderItemsId,true);
		$criteria->compare('orderId',$this->orderId,true);
		$criteria->compare('productId',$this->productId,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('groupName',$this->groupName,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('productOptionId',$this->productOptionId,true);
		$criteria->compare('styleId',$this->styleId,true);
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
	 * @return OrderItemsMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
