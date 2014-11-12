<?php

class OrderItems extends OrderItemsMaster
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
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
		return CMap::mergeArray(parent::rules(), array(
				//code here
		));
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

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	  public function search()
	  {
	  }
	 */
	public function saveByOrderIdAndProductId($orderId, $productId, $qty = 1)
	{
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();

		$orderItem = $this->find(array(
			'condition'=>'orderId=:orderId AND productId=:productId',
			'params'=>array(
				':orderId'=>$orderId,
				':productId'=>$productId,
			),
		));

		if(!isset($orderItem))
		{
			$orderItem = new OrderItems();
			$orderItem->orderId = $orderId;
			$orderItem->productId = $productId;
			$orderItem->createDateTime = new CDbExpression('NOW()');
		}

		$orderItem->quantity = $orderItem->quantity + $qty;
		$orderItem->price = (Product::model()->calProductPromotionPrice($productId, $daiibuy->provinceId) == 0) ? Product::model()->calProductPrice($productId, $daiibuy->provinceId) : Product::model()->calProductPromotionPrice($productId, $daiibuy->provinceId);
		$orderItem->total = $orderItem->quantity * $orderItem->price;
		$orderItem->updateDateTime = new CDbExpression('NOW()');

		if($orderItem->save(false))
		{
			return true;
		}
		else
		{
			$this->writeTofile('/tmp/orderitemmodel', print_r($orderItem->errors, true));
			return false;
		}
	}

	public $sumQuantity;
	public $sumTotal;

	public function findAllOrderItem($orderGroupId)
	{
		$criteria = new CDbCriteria();
		$criteria->select = " sum(t.quantity) as sumQuantity , t.price , sum(t.total) as sumTotal ,t.productId";
		$criteria->join = " LEFT JOIN `order` o ON o.orderId = t.orderId ";
		$criteria->join .= " LEFT JOIN order_group_to_order ogo ON ogo.orderId = o.orderId ";
		$criteria->join .= " LEFT JOIN order_group og ON og.orderGroupId = ogo.orderGroupId ";
		$criteria->group = "t.productId";
		$criteria->compare("og.orderGroupId", $orderGroupId);

		return $this->findAll($criteria);
	}

}
