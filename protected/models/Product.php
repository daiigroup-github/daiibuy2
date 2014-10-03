<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property string $productId
 * @property string $model
 * @property string $name
 * @property string $isbn
 * @property string $sku
 * @property string $upc
 * @property string $location
 * @property integer $quantity
 * @property string $productUnits
 * @property integer $stockStatusId
 * @property string $image
 * @property integer $shipping
 * @property string $price
 * @property integer $priceGroupId
 * @property string $points
 * @property string $taxClassId
 * @property string $dateAvailable
 * @property string $weight
 * @property string $length
 * @property string $width
 * @property string $height
 * @property string $dimensionUnits
 * @property string $metricUnits
 * @property integer $subtract
 * @property integer $minimum
 * @property integer $sortOrder
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $viewed
 * @property integer $priceGroupId$categoryId
 * @property string $marginId
 * @property string $description
 * @property string $supplierId
 * @property string $brandId
 */
class Product extends ProductMaster
{

//	const STATUS_WAITING_APPROVE = 1;
//	const STATUS_APPROVED = 2;
//	const STATUS_RETURN = 3;
//	const STATUS_REJECT = 4;
//	const STATUS_DELETE = 5;
	const STATUS_APPROVED = 2;
	const STATUS_DELETE = 5;
	const STATUS_DISABLE = 6;
	const DIMENSION_MM = 1;
	const DIMENSION_CM = 2;
	const DIMENSION_INCH = 3;
	const DIMENSION_M = 4;
	const METRIC_GRAMS = 1;
	const METRIC_KILOGRAMS = 2;
	const METRIC_TONS = 3;

	public $searchText;
	public $cartTotal;

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
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
		return CMap::mergeArray(parent::rules(), array(
				//code here
				array(
					'dateAvailable, name, quantity, productUnits, price, priceGroupId, supplierId, sortOrder',
					'required'),
//				array(
//					'createDateTime, updateDateTime',
//					'default',
//					'value'=>new CDbExpression('NOW()'),
//					'setOnEmpty'=>false,
//					'on'=>'insert'
//				),
//				array(
//					'updateDateTime',
//					'default',
//					'value'=>new CDbExpression('NOW()'),
//					'setOnEmpty'=>false,
//					'on'=>'update'
//				),
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
				'priceGroup'=>array(
					self::BELONGS_TO,
					'PriceGroup',
					'priceGroupId'),
				'productAttributeValue'=>array(
					self::HAS_MANY,
					'ProductAttributeValue',
					'productId'),
				'productPromotion'=>array(
					self::HAS_ONE,
					'ProductPromotion',
					'productId',
					'order'=>'productPromotionId desc'),
				'brand'=>array(
					self::BELONGS_TO,
					'ProductBrand',
					'brandId'),
				'margin'=>array(
					self::BELONGS_TO,
					'UserCertificateFile',
					array(
						'marginId'=>'id')),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{

		return CMap::mergeArray(parent::attributeLabels(), array(
				'productId'=>'ID',
				'brandModelId'=>'รุ่น',
				'name'=>'ชื่อ',
				'isbn'=>'รหัสสินค้า',
				'sku'=>'Sku',
				'upc'=>'Upc',
				'location'=>'Location',
				'quantity'=>'จำนวนคงเหลือ',
				'productUnits'=>'หน่วย',
				'stockStatusId'=>'Stock Status',
				'image'=>'รูปภาพ',
				'shipping'=>'Shipping',
				'price'=>'ราคา',
				'points'=>'คะแนนสะสม',
				'taxClassId'=>'Tax Class',
				'dateAvailable'=>'วันเริ่มขาย',
				'weight'=>'น้ำหนัก',
				'length'=>'Length',
				'width'=>'Width',
				'height'=>'Height',
				'dimensionUnits'=>'Dimension Units',
				'metricUnits'=>'Metric Units',
				'subtract'=>'Subtract',
				'minimum'=>'Minimum',
				'sortOrder'=>'ลำดับ',
				'status'=>'Status',
				'createDateTime'=>'Create Date Time',
				'updateDateTime'=>'Update Date Time',
				'viewed'=>'Viewed',
				'categoryId'=>'ประเภท',
				'marginId'=>'Margin',
				'searchText'=>'Search',
				'description'=>'รายละเอียด',
				'priceGroupId'=>'กลุ่มราคาขาย',
				'supplierId'=>'Supplier Id',
				'brandId'=>"ยี่ห้อ",
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
// Warning: Please modify the following code to remove attributes that
// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('LOWER(name)', strtolower($this->searchText), true, "OR");
		$criteria->compare('LOWER(description)', strtolower($this->searchText), true, "OR");
		$criteria->compare("status", $this->status);
		$criteria->compare("supplierId", $this->supplierId);
		/*
		  $criteria->compare('productId',$this->productId,true);
		  $criteria->compare('quantity',$this->quantity);
		  $criteria->compare('stockStatusId',$this->stockStatusId,true);
		  $criteria->compare('shipping',$this->shipping);
		  $criteria->compare('price',$this->price,true);
		  $criteria->compare('points',$this->points);
		  $criteria->compare('dateAvailable',$this->dateAvailable,true);
		  $criteria->compare('weight',$this->weight,true);
		  $criteria->compare('length',$this->length,true);
		  $criteria->compare('width',$this->width,true);
		  $criteria->compare('height',$this->height,true);
		  $criteria->compare('status',$this->status);
		 *
		 */
		if(Yii::app()->user->id > 0 && isset(Yii::app()->user->id))
		{
			$user = User::model()->findByPk(Yii::app()->user->id);
			if($user->type == 3)
			{
				$criteria->compare('supplierId', Yii::app()->user->id);
			}
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'sortOrder ASC'
			)
		));
	}

	public function beforeSave()
	{
		$this->updateDateTime = new CDbExpression('NOW()');

		return parent::beforeSave();
	}

	public function getStatusArray()
	{
		return array(
//			self::STATUS_WAITING_APPROVE=>'Waiting for Approve',
			self::STATUS_APPROVED=>'Approved',
//			self::STATUS_RETURN=>'Return to Edit',
//			self::STATUS_REJECT=>'Rejected',
			self::STATUS_DELETE=>'Delete',
			self::STATUS_DISABLE=>'Disable',
		);
	}

//	public function getStatusText()
//	{
//		$statusArray = $this->getStatusArray();
//		return $statusArray[$this->status];
//	}

	public function getMetricUnits()
	{
		return array(
			self::METRIC_GRAMS=>'กรัม',
			self::METRIC_KILOGRAMS=>'กิโลกรัม',
			self::METRIC_TONS=>'ตัน',
		);
	}

	public function getMetricText()
	{
		$metricArray = $this->getMetricUnits();
		if(isset($metricArray[$this->metricUnits]))
			return $metricArray[$this->metricUnits];
		else
			return "";
	}

	public function getDimensionUnits()
	{
		return array(
			self::DIMENSION_MM=>'มิลลิเมตร',
			self::DIMENSION_CM=>'เซนติเมตร',
			self::DIMENSION_INCH=>'นิ้ว',
			self::DIMENSION_M=>'เมตร',
		);
	}

	public function getDimensionText()
	{
		$dimensionArray = $this->getDimensionUnits();
		if(isset($dimensionArray[$this->dimensionUnits]))
			return $dimensionArray[$this->dimensionUnits];
		else
			return "";
	}

	public function getBadgeStatus()
	{
		switch($this->status)
		{

			case self::STATUS_APPROVED:
				$badge = 'label label-success';
				break;
			case self::STATUS_RETURN :
				$badge = 'badge-info';
				break;
			case self::STATUS_WAITING_APPROVE || self::STATUS_DISABLE :
				$badge = 'badge-warning';
				break;
			case self::STATUS_DELETE :
				$badge = 'badge-important';
				break;
			case self::STATUS_REJECT :
				$badge = 'badge-important';
				break;
		}

		return '<span class="badge ' . $badge . '">' . $this->getStatusText($this->status) . '</span>';
	}

	public function calTotalCartBySupplier($cart)
	{
		$daiibuy = new DaiiBuy();
		$daiibuy->loadCookie();
		$products = $cart['products'];
		$subTotal = 0;
		$today = date("Y-m-d");
		foreach($products as $product)
		{
			$productModel = $product['productModel'];
			$productTemp = Product::model()->findByPk($productModel->productId);
			if(isset($productTemp->productPromotion))
			{

				if($productTemp->productPromotion->dateStart <= $today && $productTemp->productPromotion->dateEnd >= $today)
				{
					$productTotalPrice = Product::model()->calProductPromotionTotalPrice($productTemp->productId, $product['qty'], $daiibuy->provinceId);
				}
				else
				{
					$productTotalPrice = Product::model()->calProductTotalPrice($productModel->productId, $product['qty'], $daiibuy->provinceId);
				}
			}
			else
			{
				$productTotalPrice = Product::model()->calProductTotalPrice($productModel->productId, $product['qty'], $daiibuy->provinceId);
			}
			$subTotal += $productTotalPrice;
		}
		return $subTotal;
	}

	public function cartTotal($items, $provinceId)
	{
		$cartTotal = 0;
		$today = date("Y-m-d");
		foreach($items as $productId=> $qty)
		{

			if(isset(Product::model()->findByPk($productId)->productPromotion))
			{
				$productTemp = Product::model()->findByPk($productId);
				if($productTemp->productPromotion->dateStart <= $today && $productTemp->productPromotion->dateEnd >= $today)
				{
					$cartTotal += Product::model()->calProductPromotionTotalPrice($productId, $qty, $provinceId);
				}
				else
				{
					$cartTotal += Product::model()->calProductTotalPrice($productId, $qty, $provinceId);
				}
			}
			else
			{
				$cartTotal += Product::model()->calProductTotalPrice($productId, $qty, $provinceId);
			}
		}

		return $cartTotal;
	}

	public function cartSummaryBySupplierId($cart, $provinceId, $supplierId)
	{
		$cartTotal = 0;
		$cartItems = 0;
		$cartRowTotal = 0;

		foreach($cart as $supplier=> $items)
		{
			if($supplier == $supplierId)
			{
				$cartTotal += $this->cartSum($items, $provinceId);

				$cartItems += array_sum($items);

				$cartRowTotal += count($items);
			}
		}

		return array(
			'cartTotal'=>$cartTotal,
			'cartItems'=>$cartItems,
			'cartRowTotal'=>$cartRowTotal);
	}

	public function cartSummary($cart, $provinceId)
	{
		$cartTotal = 0;
		$cartItems = 0;
		$cartRowTotal = 0;

		foreach($cart as $items)
		{
			$cartTotal += $this->cartSum($items, $provinceId);

			$cartItems += array_sum($items);

			$cartRowTotal += count($items);
		}

		return array(
			'cartTotal'=>$cartTotal,
			'cartItems'=>$cartItems,
			'cartRowTotal'=>$cartRowTotal);
	}

	public function cartSum($items, $provinceId)
	{
		$total = 0;
		$today = date("Y-m-d");

		foreach($items as $productId=> $qty)
		{

			if(isset(Product::model()->findByPk($productId)->productPromotion))
			{
				$productTemp = Product::model()->findByPk($productId);
				if($productTemp->productPromotion->dateStart <= $today && $productTemp->productPromotion->dateEnd >= $today)
				{
					$total += Product::model()->calProductPromotionTotalPrice($productId, $qty, $provinceId);
				}
				else
				{
					$total += Product::model()->calProductTotalPrice($productId, $qty, $provinceId);
				}
			}
			else
			{
				$total += Product::model()->calProductTotalPrice($productId, $qty, $provinceId);
			}
		}

		return $total;
	}

	public function removeVAT($price)
	{
		$result = $price / 1.07;
		return $result;
	}

	public function calProductPrice($productId, $provinceId = NULL)
	{
		if(!isset($provinceId))
		{
			$daiibuy = new DaiiBuy();
			$daiibuy->loadCookie();
			$provinceId = $daiibuy->$provinceId;
		}

		$product = Product::model()->findByPk($productId);
//		$price = $this->removeVAT($product->price);
		$price = $product->price;


		$$provinceIdPrice = Price::model()->find("provinceId=:provinceId AND priceGroupId=:priceGroupId", array(
			":provinceId"=>$provinceId,
			':priceGroupId'=>$product->priceGroupId));

		if(isset($$provinceIdPrice))
		{
			$price = $price * ((100 + $provincePrice->priceRate) / 100);
		}
		else
		{
			$price = $price * ((100 + $product->priceGroup->priceRate) / 100);
		}

		return floor($price);
//		}
//		else
//		{
//			return 0;
//		}
	}

	public function calProductPromotionPrice($productId, $provinceId = NULL)
	{
		if(!isset($provinceId))
		{
			$daiibuy = new DaiiBuy();
			$daiibuy->loadCookie();
			$provinceId = $daiibuy->provinceId;
		}

		$product = Product::model()->findByPk($productId);
//		if(isset($product))
//		{
		$productPromotion = ProductPromotion::model()->find("productId=:productId AND ('" . date("Y-m-d") . "' BETWEEN dateStart AND dateEnd)", array(
			":productId"=>$product->productId));

//		if (isset($productPromotion))
//		{
//		$price = $this->removeVAT($productPromotion->price);
		$price = $productPromotion->price;

//		} else {
//			$price = $product->price;
//		}

		$provincePrice = Price::model()->find("provinceId=:provinceId AND priceGroupId=:priceGroupId", array(
			":provinceId"=>$provinceId,
			':priceGroupId'=>$product->priceGroupId));

		if(isset($provincePrice))
		{
			$price = $price * ((100 + $provincePrice->priceRate) / 100);
		}
		else
		{
			$price = $price * ((100 + $product->priceGroup->priceRate) / 100);
		}

		return floor($price);
//		}
//		else
//		{
//			return 0;
//		}
	}

	public function calProductPromotionPriceMargin($productId, $provinceId = NULL, $orderModel)
	{
		$productPrice = $this->calProductPromotionPrice($productId, $provinceId);
		$margin = $orderModel->getSupplierMarginToDaiiBuy();
		$result = $productPrice * (100 + $margin['daiiMargin']);
		return $result;
	}

	public function calProductPriceMargin($productId, $provinceId = NULL, $orderModel)
	{
		$productPrice = $this->calProductPrice($productId, $provinceId);
		$margin = $orderModel->getSupplierMarginToDaiiBuy();
		$result = $productPrice * (100 + $margin['daiiMargin']);
		return $result;
	}

	public function calProductTotalPrice($productId, $quantity, $provinceId)
	{
		return $this->calProductPrice($productId, $provinceId) * $quantity;
	}

	public function calProductTotalPriceMargin($productId, $quantity, $provinceId, $orderModel)
	{
		$productPrice = $this->calProductPrice($productId, $provinceId);
		$margin = $orderModel->getSupplierMarginToDaiiBuy();
		$result = $productPrice * (100 + $margin['daiiMargin']) * $quantity;
		return $result;
	}

	public function calProductPromotionTotalPrice($productId, $quantity, $provinceId)
	{
		return $this->calProductPromotionPrice($productId, $provinceId) * $quantity;
	}

	public function calProductPromotionTotalPriceMargin($productId, $quantity, $provinceId, $orderModel)
	{
		$productPrice = $this->calProductPromotionPrice($productId, $provinceId);
		$margin = $orderModel->getSupplierMarginToDaiiBuy();
		$result = $productPrice * (100 + $margin['daiiMargin']) * $quantity;
		return $result;
	}

	public function findAllProductByAmphurIdAndCategoryId($provinceId, $searchText = '', $categoryId = null, $brandId = null)
	{
		$criteria = new CDbCriteria();
		$criteria->with = array(
			'priceGroup',
			'priceGroup.price');
		$criteria->condition = 't.status = 2  AND t.quantity > 0 AND price.provinceId=:provinceId AND (LOWER(t.name) LIKE LOWER(:searchText) OR LOWER(t.description) LIKE LOWER(:searchText))';

		if(isset($categoryId))
			$criteria->condition .= ' AND categoryId=' . $categoryId;

		if(isset($brandId))
			$criteria->condition .= ' AND brandId=' . $brandId;

		$criteria->params = array(
			':provinceId'=>$provinceId,
			':searchText'=>'%' . $searchText . '%');
		$criteria->order = 't.productId';

		Controller::writeToFile('/tmp/product', print_r($criteria, true));

		return $this->findAll($criteria);
	}

	public function findFirstImageProduct($productId)
	{
		$productImage = ProductImage::model()->find("productId =:productId AND sortOrder = 1"
			, array(
			":productId"=>$productId));
		if(isset($productImage))
			return $productImage->image;
		else
			return "";
	}

	public function findAllProductDataByAmphurIdAndCategoryId($provinceId, $searchText = '', $categoryId = null, $brandId = null, $dateNow)
	{
		$criteria = new CDbCriteria();
		$criteria->join = 'LEFT JOIN price_group pg ON t.priceGroupId=pg.priceGroupId ';
		$criteria->join .= 'LEFT JOIN price p ON p.priceGroupId=pg.priceGroupId';
		$criteria->condition = 'p.status = 1 AND t.status = 2 AND p.provinceId=:provinceId AND (LOWER(t.name) LIKE LOWER(:searchText) OR LOWER(t.description) LIKE LOWER(:searchText)) AND t.quantity > 0 AND t.dateAvailable <= ' . $dateNow;

		if(isset($categoryId))
			$criteria->condition .= ' AND t.categoryId=' . $categoryId;

		if(isset($brandId))
			$criteria->condition .= ' AND t.brandId=' . $brandId;

		$criteria->params = array(
			':provinceId'=>$provinceId,
			':searchText'=>'%' . $searchText . '%');
		$criteria->order = 't.productId';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>12),
		));
	}

	public function findAllProductDataByAmphurIdAndCategoryIdAndSupplierId($provinceId, $searchText = '', $categoryId = null, $brandId = null, $dateNow, $supplierId = null)
	{
		$criteria = new CDbCriteria();

		$sort = new CSort('Product');
		$sort->defaultOrder = 't.createDateTime DESC, t.name DESC';
		$sort->attributes = array(
			'createDateTime'=>array(
				'asc'=>'t.createDateTime ASC',
				'desc'=>'t.createDateTime DESC',
			),
			'name'=>array(
				'asc'=>'t.name ASC',
				'desc'=>'t.name DESC',
			),
			'price'=>array(
				'asc'=>'t.price ASC',
				'desc'=>'t.price DESC',
			),
		);
		$sort->applyOrder($criteria);

		$criteria->join = 'LEFT JOIN price_group pg ON t.priceGroupId=pg.priceGroupId ';
		$criteria->join .= 'LEFT JOIN price p ON p.priceGroupId=pg.priceGroupId';
		$criteria->condition = 'p.status = 1 AND t.status = 2 AND p.provinceId=:provinceId AND (LOWER(t.name) LIKE LOWER(:searchText) OR LOWER(t.description) LIKE LOWER(:searchText)) AND t.quantity > 0 AND t.dateAvailable <= ' . $dateNow;

//		if (isset($categoryId))
//			$criteria->condition .= ' AND t.categoryId=' . $categoryId;

		if(isset($brandId))
			$criteria->condition .= ' AND t.brandId=' . $brandId;

		if(isset($supplierId))
			$criteria->condition .= ' AND t.supplierId=' . $supplierId;

		$criteria->params = array(
			':provinceId'=>$provinceId,
			':searchText'=>'%' . $searchText . '%');
		//$criteria->order = 't.categoryId =' . $categoryId . " ASC";
		//$criteria->order = 't.categoryId ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>12),
			'sort'=>$sort,
		));
	}

	public function behaviors()
	{
		return array(
			'ERememberFiltersBehavior'=>array(
				'class'=>'application.components.ERememberFiltersBehavior',
				'defaults'=>array(
				),
				/* optional line */
				'defaultStickOnClear'=>false /* optional line */
			),);
	}


	public function calculateItemSetFenzer($categoryId, $length, $provinceId)
	{
		$category = Category::model()->findByPk($categoryId);
		$height = $category->description;
		$products = Product::model()->findAll('categoryId = '.$categoryId .' AND status = 1');
		$res = array();
		$res['categoryId'] = $categoryId;
		$res['height'] = $height;
		$res['length'] = $length;
		$noOfSpanSet = round(intval($length)/3);

		foreach($products as $product)
			{
			//product
			$res['items'][$product->productId] = $product;

			//quantity
			if($noOfSpanSet == 0)
			{
				//default Qty = 1
				$res['items']['Qty'] = 1;
			}
			else
			{
				$res['items']['Qty'] = $this->getItemQuantityFenzer($product)*$noOfSpanSet;
			}

			//price
			

		}
//		throw new Exception;
		return $res;
	}

	public function getItemQuantityFenzer($product)
	{
		$cat2toProduct = Category2ToProduct::model()->find('productId = '.$product->productId .' AND categoryId = '. $product->categoryId);
		$res = $cat2toProduct->quantity;
		return res;
	}
}

