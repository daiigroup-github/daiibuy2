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
				'orderItemOptions'=>array(
					self::HAS_MANY,
					"OrderItemOption",
					'orderItemId',
					'limit'=>1)
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
	public function saveByOrderIdAndProductId($orderId, $productId, $qty = 1, $productOptionGroup = array())
	{
		$product = Product::model()->findByPk($productId);
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();
		$pOptionIds = implode(",", $productOptionGroup);
		if(isset($pOptionIds) && !empty($pOptionIds))
		{
			$orderItem = $this->find(array(
				'condition'=>'t.orderId=:orderId AND t.productId=:productId AND o.productOptionId in(:pOptionIds)',
				'join'=>'LEFT JOIN order_item_option o ON t.orderItemsId = o.orderItemId',
				'params'=>array(
					':orderId'=>$orderId,
					':productId'=>$productId,
					':pOptionIds'=>$pOptionIds
				),
			));
		}
		else
		{
			$orderItem = $this->find(array(
				'condition'=>'t.orderId=:orderId AND t.productId=:productId',
				'params'=>array(
					':orderId'=>$orderId,
					':productId'=>$productId,
				),
			));
		}

		if(!isset($orderItem))
		{
			$orderItem = new OrderItems();
			$orderItem->orderId = $orderId;
			$orderItem->productId = $productId;
			$orderItem->createDateTime = new CDbExpression('NOW()');
		}
		if(isset($orderItem->quantity))
		{
			$orderItem->quantity = $orderItem->quantity + $qty;
		}
		else
		{
			$orderItem->quantity = $qty;
		}
		$orderItem->title = $product->name;
		$orderItem->price = (Product::model()->calProductPromotionPrice($productId, $daiibuy->provinceId) == 0) ? Product::model()->calProductPrice($productId, $daiibuy->provinceId) : Product::model()->calProductPromotionPrice($productId, $daiibuy->provinceId);
		$orderItem->total = $orderItem->quantity * $orderItem->price;
		$orderItem->updateDateTime = new CDbExpression('NOW()');

		if($orderItem->save(false))
		{
			$orderItemId = $orderItem->orderItemsId;
			foreach($productOptionGroup as $k=> $v)
			{
				$orderItemOption = OrderItemOption::model()->find("orderItemId = " . $orderItemId . " AND productOptionGroupId = " . $k . " AND productOptionId = " . $v);
				if(!isset($orderItemOption))
				{
					$orderItemOption = new OrderItemOption();
					$orderItemOption->orderItemId = $orderItemId;
					$orderItemOption->productOptionGroupId = $k;
					$orderItemOption->productOptionId = $v;
				}
				$productOption = ProductOption::model()->findByPk($v);
				if(isset($productOption->pricePercent) && intval($productOption->pricePercent) > 0)
				{
					$orderItemOption->percent = $productOption->pricePercent;
					$orderItemOption->total = $orderItem->total * ($productOption->pricePercent / 100);
				}
				else
				{
					$orderItemOption->percent = 0;
					$orderItemOption->total = 0;
				}
				if(isset($productOption->priceValue) && intval($productOption->priceValue) > 0)
				{
					$orderItemOption->value = $productOption->priceValue;
					$orderItemOption->total = $productOption->priceValue * $orderItem->quantity;
				}
				else
				{
					$orderItemOption->value = 0;
					$orderItemOption->total += 0;
				}
				$orderItemOption->createDateTime = new CDbExpression("NOW()");
				$orderItemOption->updateDateTime = new CDbExpression("NOW()");
				if($orderItemOption->save())
				{
					$orderItem->total +=$orderItemOption->total;
					$orderItem->save(FALSE);
					return true;
				}
				else
				{
					return false;
				}
			}
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
