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

    const SPAN_FENZER = 3;
	const SPAN_BLOCK = 0.46;

	public $searchText;
	public $cartTotal;
	public $size;

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
				'productImagesSort'=>array(
					self::HAS_MANY,
					'ProductImage',
					'productId',
					'order'=>'sortOrder'
				),
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
					'condition'=>"'" . date('Y-m-d') . "' BETWEEN productPromotion.dateStart AND productPromotion.dateEnd",
				//'order'=>'productPromotionId desc'),
				),
				'brand'=>array(
					self::BELONGS_TO,
					'ProductBrand',
					'brandId'),
				'margin'=>array(
					self::BELONGS_TO,
					'UserCertificateFile',
					array(
						'marginId'=>'id')),
				'productSpecGroupsTypeSpecs'=>array(
					self::HAS_MANY,
					'ProductSpecGroup',
					'productId',
					'condition'=>'type=2'),
				'productSpecGroupsTypeDetails'=>array(
					self::HAS_MANY,
					'ProductSpecGroup',
					'productId',
					'condition'=>'type=1'),
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
		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->name = $this->searchText;
			$this->description = $this->searchText;
			$this->status = $this->searchText;
		}

		$criteria->compare("categoryId", $this->categoryId);
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
//		if(Yii::app()->user->id > 0 && isset(Yii::app()->user->id))
//		{
//			$user = User::model()->findByPk(Yii::app()->user->id);
//			if($user->type == 3)
//			{
//				$criteria->compare('supplierId', User::model()->getSupplierId(Yii::app()->user->id));
//			}
//		}

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

	public function calProductPrice($productId = NULL, $provinceId = NULL)
	{
		if(!isset($provinceId))
		{
			$daiibuy = new DaiiBuy();
			$daiibuy->loadCookie();
			$provinceId = $daiibuy['provinceId'];
		}

		$product = (isset($productId)) ? Product::model()->findByPk($productId) : $this;
		$price = $product->price;

		$priceModel = Price::model()->find("provinceId=:provinceId AND priceGroupId=:priceGroupId", array(
			":provinceId"=>$provinceId,
			':priceGroupId'=>$product->priceGroupId));

		if(isset($priceModel))
		{
			$price = $price * ((100 + $priceModel->priceRate) / 100);
		}
		else
		{
			$price = $price * ((100 + $product->priceGroup->priceRate) / 100);
		}

		return floor($price);
	}

	public function calProductPromotionPrice($productId = NULL, $provinceId = NULL)
	{
		if(!isset($provinceId))
		{
			$daiibuy = new DaiiBuy();
			$daiibuy->loadCookie();
			$provinceId = $daiibuy['provinceId'];
		}

		$product = (isset($productId)) ? Product::model()->findByPk($productId) : $this;

		if(isset($product->productPromotion))
		{
			$price = $product->productPromotion->price;
			$priceModel = Price::model()->find("provinceId=:provinceId AND priceGroupId=:priceGroupId", array(
				":provinceId"=>$provinceId,
				':priceGroupId'=>$product->priceGroupId));

			if(isset($priceModel))
			{
				$price = $price * ((100 + $priceModel->priceRate) / 100);
			}
			else
			{
				$price = $price * ((100 + $product->priceGroup->priceRate) / 100);
			}

			return floor($price);
		}
		else
		{
			return 0;
		}
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

	public function calculateItemSetFenzer($categoryId, $length, $provinceId, $productIdNew = NULL)
	{
//		throw new Exception(print_r($categoryId,true));
		$type = Category2ToProduct::model()->findProductType($categoryId);
		$category = Category::model()->findByPk($categoryId);
		$height = $category->description;
		$products = Product::model()->findAll('categoryId = ' . $categoryId . ' AND status = 2');
		$res = array();
		$res['categoryId'] = $categoryId;
		$res['height'] = $height;
		$res['length'] = $length;


		if($type==3){
			$span = self::SPAN_BLOCK;
		}else{
			$span = self::SPAN_FENZER;
		}
		$noSpanSet = ceil(intval($length)/$span);
		$totalPrice = 0.00;

		foreach($products as $product)
		{
			$productId = strval($product->productId);
			$category2toProduct = Category2ToProduct::model()->find('productId = ' . $productId . ' AND category2Id = ' . $product->categoryId . ' AND status = 1');
			$quantity = $category2toProduct->quantity;
			//product
			$res['items'][$productId] = $product;
			$type = Category2ToProduct::model()->findProductType($categoryId,$productId);

			//quantity
			if($noSpanSet == 0)
			{
				//default Qty = 1
				$res['items'][$productId]['quantity'] = 1;
			}
			else
			{
				$res['items'][$productId]['quantity'] = ($quantity * $noSpanSet)+ ($type==2? 1 : 0);
			}

			//price
			$productPromotion = ProductPromotion::model()->find("productId=:productId AND ('" . date("Y-m-d") . "' BETWEEN dateStart AND dateEnd)", array(
				":productId"=>$productId));
			if(isset($productPromotion))
			{
				//promotion price
				$res['items'][$productId]['price'] = $this->calProductPromotionTotalPrice($productId, $res['items'][$productId]['quantity'], $provinceId);
			}
			else
			{
				//normal price
				$res['items'][$productId]['price'] = $this->calProductTotalPrice($productId, $res['items'][$productId]['quantity'], $provinceId);
			}
			$totalPrice = $totalPrice + $res['items'][$productId]['price'];
		}
		$res['totalPrice'] = $totalPrice;



		return $res;
	}


	public function calculateItemSetFenzerManualAndSave($categoryId, $productItems, $provinceId, $length, $isSave, $oldOrderId)
	{
		$category = Category::model()->findByPk($categoryId);
		$height = $category->description;
		$res = array();
		$res['categoryId'] = $categoryId;
		$totalPrice = 0.00;
		unset($productItems['categoryId']);
		if(isset($isSave)&&$isSave==TRUE){
				//SAVE NEW ORDER
				if($oldOrderId==NULL){
					$orderModel = new Order();
					$orderModel->userId = isset(Yii::app()->user->id)? Yii::app()->user->id:0;
					$orderModel->title = $category->title;
					$orderModel->supplierId = 1;
					$orderModel->provinceId = $provinceId;
					$orderModel->type = 1;
					$orderModel->status = 1;
					$orderModel->createDateTime = new CDbExpression("NOW()");
					if($orderModel->save()){
						$orderId = Yii::app()->db->lastInsertID;
					}else{
					throw new Exception(print_r($orderModel->errors, True));
					}
				}else{
					$orderModel = Order::model()->findByPk($oldOrderId);
			}
		}

		foreach($productItems as $productId=> $qty)
		{
			$product = Product::model()->findByPk($productId);
			//product
			$res['items'][$productId] = $product;

			//quantity
			$res['items'][$productId]['quantity'] = intval($qty['quantity']);
//			print_r($qty);

			//price
			$productPromotion = ProductPromotion::model()->find("productId=:productId AND ('" . date("Y-m-d") . "' BETWEEN dateStart AND dateEnd)", array(
			":productId"=>$productId));
			if(isset($productPromotion)){
				//promotion price
				$res['items'][$productId]['price'] = $this->calProductPromotionTotalPrice($productId, $res['items'][$productId]['quantity'] ,$provinceId)*1;
			}else{
				//normal price
				$res['items'][$productId]['price'] = $this->calProductTotalPrice($productId, $res['items'][$productId]['quantity'] ,$provinceId)*1;
			}
			$totalPrice = $totalPrice+$res['items'][$productId]['price'];
			if(isset($isSave)&&$isSave==TRUE){
				if($oldOrderId==NULL){
					$orderItemModel = new OrderItems();
					$orderItemModel->orderId = $orderId;
					$orderItemModel->productId = $productId;
					$orderItemModel->title = substr($product->name, 0, 44);
					$orderItemModel->createDateTime = new CDbExpression("NOW()");
				}else{
					$orderItemModel = OrderItems::model()->find('productId = '.$productId.' AND orderId = '. $oldOrderId);
				}
				$orderItemModel->price = $res['items'][$productId]['price']/$res['items'][$productId]['quantity'];
				$orderItemModel->quantity = $res['items'][$productId]['quantity'];
				$orderItemModel->total = $res['items'][$productId]['price'];
				$orderItemModel->updateDateTime = new CDbExpression("NOW()");
				if(!($orderItemModel->save())){
					throw new Exception(print_r($orderItemModel->errors, True));
				}
			}
		}
		$res['totalPrice'] = $totalPrice;
		$res['orderId'] = isset($orderId)? $orderId : $oldOrderId;

		if(isset($isSave)&&$isSave==TRUE){
			//SAVE NEW ORDER
			$orderModel->totalIncVAT = $totalPrice;
			$orderModel->total = $totalPrice/1.07;
			if($orderModel->save()){
				if($oldOrderId==NULL){
				$orderDetail = new OrderDetail();
				$orderDetail->orderId = $orderId;
				$orderDetailTemplate = OrderDetailTemplate::model()->findOrderDetailTemplateBySupplierId(1);
				$orderDetail->orderDetailTemplateId = $orderDetailTemplate->orderDetailTemplateId;
				$orderDetail->createDateTime = new CDbExpression("NOW()");
					if($orderDetail->save()){
						$orderDetailId = Yii::app()->db->lastInsertID;
						foreach($orderDetailTemplate->orderDetailTemplateFields as $item)
						{
							$orderDetailValue = new OrderDetailValue();
							$orderDetailValue->orderDetailId = $orderDetailId;
							$orderDetailValue->orderDetailTemplateFieldId = $item->orderDetailTemplateFieldId;
							$orderDetailValue->value = $item->title=='height'? $height : ($item->title=='length'? $length : $categoryId);
							$orderDetailValue->createDateTime = new CDbExpression("NOW()");
							$orderDetailValue->updateDateTime = new CDbExpression("NOW()");
							if(!($orderDetailValue->save())){
								throw new Exception(print_r($orderDetailValue->errors, True));
							}
						}
					}else{
					throw new Exception(print_r($orderDetail->errors, True));
				}
				}else{
					$orderDetail = OrderDetail::model()->find('orderId = '.$oldOrderId);
					$orderDetailTemplate = OrderDetailTemplate::model()->findOrderDetailTemplateBySupplierId(1);
					$orderDetailValue = OrderDetailValue::model()->findAll('orderDetailId = '.$orderDetail->orderDetailId);

					foreach($orderDetailValue as $item)
						{
							$item->value = $item->orderDetailTemplateFieldId==1? $height : ($item->orderDetailTemplateFieldId==2? $length : $categoryId);
							$item->updateDateTime = new CDbExpression("NOW()");
							if(!($item->save())){
								throw new Exception(print_r($item->errors, True));
							}
						}
					}
				}
			}
		return $res;
	}

	public function calculateNewItemFenzer($productId, $provinceId)
	{
		$res = array();
		$productIdNew = intval($productId);
		$newProduct = Product::model()->findByPk($productIdNew);
		$res["item"] = $newProduct;
		//default Qty = 1
		$res["item"]['quantity'] = 1;

		$productPromotion = ProductPromotion::model()->find("productId=:productId AND ('" . date("Y-m-d") . "' BETWEEN dateStart AND dateEnd)", array(
			":productId"=>$productIdNew));
		if(isset($productPromotion))
		{
			//promotion price
			$res["item"]['price'] = $this->calProductPromotionTotalPrice($productIdNew, 1, $provinceId) * 1;
		}
		else
		{
			//normal price
			$res["item"]['price'] = $this->calProductTotalPrice($productIdNew, 1, $provinceId) * 1;
		}
		return $res;
	}

	public function findAllProductBySupplierId($supplierId)
	{
		$result = array();
		$criteria = new CDbCriteria();
		$criteria->condition = 'status = 2 ';

		if(Yii::app()->user->userType != 4)
		{
			$criteria->condition .=" AND supplierId = :supplierId ";
			$criteria->params[":supplierId"] = $supplierId;
		}
		$models = Product::model()->findAll($criteria);

		foreach($models as $item)
		{
			$result[$item->productId] = $item->name;
		}

		return $result;
	}

	public function findAllProductArraySupplierIdAndCategoryId($supplierId, $categoryId)
	{
		$products = Product::model()->findAll('supplierId =' . $supplierId . ' AND Status = 1 AND CategoryId = ' . $categoryId);
		$res = array();
		foreach($products as $item)
		{
			$res[$item->isbn] = $item->productId;
		}
		return $res;
	}

    public function ginzaPriceByCategory1IdAndCategory2Id($category1Id, $category2Id)
    {
        $c2tops = Category2ToProduct::model()->findAll(array(
            'condition' => 'category1Id=:category1Id AND category2Id=:category2Id',
            'params' => array(
                'category1Id' => $category1Id,
                'category2Id' => $category2Id,
            ),
        ));

        $price = 0;
        foreach ($c2tops as $c2top) {
            $price += ($c2top->product->calProductPromotionPrice() != 0) ? $c2top->product->calProductPromotionPrice() : $c2top->product->calProductPrice();
        }

        return $price;
    }

	public function findAllAtechSizeArray(){
		$criteria = new CDbCriteria();
		$criteria->distinct = true;
		$criteria->select = 'CONCAT(width, " x ", height) AS size';
		$criteria->condition = 'status = 2 AND supplierId = 2';
		$model = $this->findAll($criteria);
//		throw new Exception($model->size,true);
		$res=array();
		foreach($model as $item){
			$res[$item['size']] = $item['size'];
		}
		return $res;
	}

	public function calculatePriceFromCriteriaAtech($criteria, $brandModelId, $provinceId){
		$res = array();
		$total = 0.00;
//		throw new Exception(print_r($criteria,true));
		foreach($criteria as $item){
//	throw new Exception(print_r($item,true));
			$categoryArray = $this->getCategory2IdByBrandModelIdAndCategory1($brandModelId,$item['category'],$item['type']);

			if(count($categoryArray)>0){
			$category1Id = $categoryArray['cate1'];
			$category2Id = $categoryArray['cate2'];
//			throw new Exception(print_r($category1Id.', '.$category2Id,true));
			$value = $item['size'];
			$size = explode(" x ", $value);
			$width = $size[0];
			$height = $size[1];
			$productModel = Product::model()->find('supplierId = 2 AND brandModelId = '.$brandModelId . ' AND categoryId = '.$category2Id.' AND width = '.$width.' AND height = '.$height);

			if(isset($productModel)){
			$productPromotion = ProductPromotion::model()->find("productId=:productId AND ('" . date("Y-m-d") . "' BETWEEN dateStart AND dateEnd)", array(
			":productId"=>$productModel->productId));
			$res["items"][$productModel->productId]['productId'] = $productModel->productId;
			$res["items"][$productModel->productId]['code'] = $productModel->code;
			$res["items"][$productModel->productId]['width'] = $width;
			$res["items"][$productModel->productId]['height'] = $height;
			$res["items"][$productModel->productId]['category'] = $item['category'];
			$res["items"][$productModel->productId]['type'] = $item['type'];
			$res["items"][$productModel->productId]['description'] = $productModel->description;
			$res["items"][$productModel->productId]['quantity'] = $item['quantity'];
			if(isset($productPromotion))
			{
			//promotion price
				$res["items"][$productModel->productId]['price'] = $this->calProductPromotionTotalPrice($productModel->productId, 1, $provinceId);
			}
			else
			{
			//normal price
				$res["items"][$productModel->productId]['price'] = $this->calProductTotalPrice($productModel->productId, 1, $provinceId);
			}
			$subTotal = $res["items"][$productModel->productId]['price']*$res["items"][$productModel->productId]['quantity'];
			$res["items"][$productModel->productId]['subTotal'] = $subTotal;

			$total = $subTotal+$total;
			}
			}
		}

		$res["total"] = $total;
		$res["brandModelId"] = $brandModelId;
//		throw new Exception(print_r($res,true));
//		$res["brandModelId"] = $brand->brandModelId;
//		$res["category1Id"] = $category1Id;
//		$res["category2Id"] = $category2Id;
		return $res;
	}

	public function calculatePriceFromEstimateAtech($brandModelId, $provinceId, $productArray){
		$res = array();
		$total = 0.00;
//		throw new Exception(print_r($criteria,true));
		foreach($productArray as $item){

			$productPromotion = ProductPromotion::model()->find("productId=:productId AND ('" . date("Y-m-d") . "' BETWEEN dateStart AND dateEnd)", array(
			":productId"=>$item->productId));
			$res["items"][$item->productId]['productId'] = $item->productId;
			$res["items"][$item->productId]['code'] = $item->code;
			$res["items"][$item->productId]['width'] = $item->width;
			$res["items"][$item->productId]['height'] = $item->height;
//			$res["items"][$item->productId]['category'] = $item['category'];
//			$res["items"][$item->productId]['type'] = $item['type'];
			$res["items"][$item->productId]['description'] = $item->description;
			$res["items"][$item->productId]['quantity'] = $item->quantity;
			$res["items"][$item->productId]['name'] = $item->name;
			if(isset($productPromotion))
			{
			//promotion price
				$res["items"][$item->productId]['price'] = $this->calProductPromotionTotalPrice($item->productId, 1, $provinceId);
			}
			else
			{
			//normal price
				$res["items"][$item->productId]['price'] = $this->calProductTotalPrice($item->productId, 1, $provinceId);
			}
			$subTotal = $res["items"][$item->productId]['price']*$res["items"][$item->productId]['quantity'];
			$res["items"][$item->productId]['subTotal'] = $subTotal;

			$total = $subTotal+$total;
			}


		$res["total"] = $total;
		$res["brandModelId"] = $brandModelId;
//		throw new Exception(print_r($res,true));
//		$res["brandModelId"] = $brand->brandModelId;
//		$res["category1Id"] = $category1Id;
//		$res["category2Id"] = $category2Id;
		return $res;
	}

	public function getCategory2IdByBrandModelIdAndCategory1($brandModelId,$cate1Title,$cate2Title){
		$res = array();
		$brandModel = BrandModel::model()->findByPk($brandModelId);
		foreach($brandModel->categorys as $item){
			if($item->title == $cate1Title){
				$cate1 = $item;
				break;
			}
		}
		if(isset($cate1)){
//throw new Exception(print_r($cate1,true));
		foreach($cate1->subCategorys as $subCat){
			if($subCat->title == $cate2Title){
				$cate2 = $subCat;
				break;
			}
		}
		if(isset($cate1))
			$res['cate1'] = $cate1->categoryId;
		if(isset($cate2))
			$res['cate2'] = $cate2->categoryId;
		}
		return $res;
	}
}
