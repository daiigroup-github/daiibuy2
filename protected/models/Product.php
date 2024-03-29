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
    const SPAN_ZEN = 2;
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
            array(
                'searchText',
                'safe'
            )
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
            'productImagesSort' => array(
                self::HAS_MANY,
                'ProductImage',
                'productId',
                'order' => 'sortOrder'
            ),
            'priceGroup' => array(
                self::BELONGS_TO,
                'PriceGroup',
                'priceGroupId'),
            'productAttributeValue' => array(
                self::HAS_MANY,
                'ProductAttributeValue',
                'productId'),
            'productPromotion' => array(
                self::HAS_ONE,
                'ProductPromotion',
                'productId',
                'condition' => "'" . date('Y-m-d') . "' BETWEEN productPromotion.dateStart AND productPromotion.dateEnd",
            //'order'=>'productPromotionId desc'),
            ),
            'brand' => array(
                self::BELONGS_TO,
                'ProductBrand',
                'brandId'),
            'margin' => array(
                self::BELONGS_TO,
                'UserCertificateFile',
                array(
                    'marginId' => 'id')),
            'productSpecGroupsTypeSpecs' => array(
                self::HAS_MANY,
                'ProductSpecGroup',
                'productId',
                'condition' => 'type=2'),
            'productSpecGroupsTypeDetails' => array(
                self::HAS_MANY,
                'ProductSpecGroup',
                'productId',
                'condition' => 'type=1 AND parentId = 0'),
        ));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {

        return CMap::mergeArray(parent::attributeLabels(), array(
            'productId' => 'ID',
            'brandModelId' => 'รุ่น',
            'name' => 'ชื่อ',
            'isbn' => 'รหัสสินค้า',
            'sku' => 'Sku',
            'upc' => 'Upc',
            'location' => 'Location',
            'quantity' => 'จำนวนคงเหลือ',
            'productUnits' => 'หน่วย',
            'stockStatusId' => 'Stock Status',
            'image' => 'รูปภาพ',
            'shipping' => 'Shipping',
            'price' => 'ราคา',
            'points' => 'คะแนนสะสม',
            'taxClassId' => 'Tax Class',
            'dateAvailable' => 'วันเริ่มขาย',
            'weight' => 'น้ำหนัก',
            'length' => 'Length',
            'width' => 'Width',
            'height' => 'Height',
            'dimensionUnits' => 'Dimension Units',
            'metricUnits' => 'Metric Units',
            'subtract' => 'Subtract',
            'minimum' => 'Minimum',
            'sortOrder' => 'ลำดับ',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
            'viewed' => 'Viewed',
            'categoryId' => 'ประเภท',
            'marginId' => 'Margin',
            'searchText' => 'Search',
            'description' => 'รายละเอียด',
            'priceGroupId' => 'กลุ่มราคาขาย',
            'supplierId' => 'Supplier Id',
            'brandId' => "ยี่ห้อ",
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
        if (isset($this->searchText) && !empty($this->searchText)) {
            $this->code = $this->searchText;
            $this->name = $this->searchText;
            $this->description = $this->searchText;
        }

//		$criteria->compare("categoryId", $this->categoryId);
        $criteria->compare('code', $this->code, true, "OR");
        $criteria->compare('name', $this->name, true, "OR");
        $criteria->compare('description', $this->description, true, "OR");
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
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'sortOrder ASC'
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
            self::STATUS_APPROVED => 'Active',
//			self::STATUS_RETURN=>'Return to Edit',
//			self::STATUS_REJECT=>'Rejected',
            self::STATUS_DELETE => 'Delete',
            self::STATUS_DISABLE => 'Disable',
        );
    }

    public function getStatusText($status)
    {
        $statusArray = $this->getStatusArray();
        return $statusArray[$this->status];
    }

    public function getMetricUnits()
    {
        return array(
            self::METRIC_GRAMS => 'กรัม',
            self::METRIC_KILOGRAMS => 'กิโลกรัม',
            self::METRIC_TONS => 'ตัน',
        );
    }

    public function getMetricText()
    {
        $metricArray = $this->getMetricUnits();
        if (isset($metricArray[$this->metricUnits]))
            return $metricArray[$this->metricUnits];
        else
            return "";
    }

    public function getDimensionUnits()
    {
        return array(
            self::DIMENSION_MM => 'มิลลิเมตร',
            self::DIMENSION_CM => 'เซนติเมตร',
            self::DIMENSION_INCH => 'นิ้ว',
            self::DIMENSION_M => 'เมตร',
        );
    }

    public function getDimensionText()
    {
        $dimensionArray = $this->getDimensionUnits();
        if (isset($dimensionArray[$this->dimensionUnits]))
            return $dimensionArray[$this->dimensionUnits];
        else
            return "";
    }

    public function getBadgeStatus()
    {
        switch ($this->status) {

            case self::STATUS_APPROVED:
                $badge = 'label label-success';
                break;
            case self::STATUS_DISABLE :
                $badge = 'badge-warning';
                break;
            case self::STATUS_DELETE :
                $badge = 'label label-danger';
                break;
        }

        return '<span class=" ' . $badge . '">' . $this->getStatusText($this->status) . '</span>';
    }

    public function calTotalCartBySupplier($cart)
    {
        $daiibuy = new DaiiBuy();
        $daiibuy->loadCookie();
        $products = $cart['products'];
        $subTotal = 0;
        $today = date("Y-m-d");
        foreach ($products as $product) {
            $productModel = $product['productModel'];
            $productTemp = Product::model()->findByPk($productModel->productId);
            if (isset($productTemp->productPromotion)) {

                if ($productTemp->productPromotion->dateStart <= $today && $productTemp->productPromotion->dateEnd >= $today) {
                    $productTotalPrice = Product::model()->calProductPromotionTotalPrice($productTemp->productId, $product['qty'], $daiibuy->provinceId);
                } else {
                    $productTotalPrice = Product::model()->calProductTotalPrice($productModel->productId, $product['qty'], $daiibuy->provinceId);
                }
            } else {
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
        foreach ($items as $productId => $qty) {

            if (isset(Product::model()->findByPk($productId)->productPromotion)) {
                $productTemp = Product::model()->findByPk($productId);
                if ($productTemp->productPromotion->dateStart <= $today && $productTemp->productPromotion->dateEnd >= $today) {
                    $cartTotal += Product::model()->calProductPromotionTotalPrice($productId, $qty, $provinceId);
                } else {
                    $cartTotal += Product::model()->calProductTotalPrice($productId, $qty, $provinceId);
                }
            } else {
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

        foreach ($cart as $supplier => $items) {
            if ($supplier == $supplierId) {
                $cartTotal += $this->cartSum($items, $provinceId);

                $cartItems += array_sum($items);

                $cartRowTotal += count($items);
            }
        }

        return array(
            'cartTotal' => $cartTotal,
            'cartItems' => $cartItems,
            'cartRowTotal' => $cartRowTotal);
    }

    public function cartSummary($cart, $provinceId)
    {
        $cartTotal = 0;
        $cartItems = 0;
        $cartRowTotal = 0;

        foreach ($cart as $items) {
            $cartTotal += $this->cartSum($items, $provinceId);

            $cartItems += array_sum($items);

            $cartRowTotal += count($items);
        }

        return array(
            'cartTotal' => $cartTotal,
            'cartItems' => $cartItems,
            'cartRowTotal' => $cartRowTotal);
    }

    public function cartSum($items, $provinceId)
    {
        $total = 0;
        $today = date("Y-m-d");

        foreach ($items as $productId => $qty) {

            if (isset(Product::model()->findByPk($productId)->productPromotion)) {
                $productTemp = Product::model()->findByPk($productId);
                if ($productTemp->productPromotion->dateStart <= $today && $productTemp->productPromotion->dateEnd >= $today) {
                    $total += Product::model()->calProductPromotionTotalPrice($productId, $qty, $provinceId);
                } else {
                    $total += Product::model()->calProductTotalPrice($productId, $qty, $provinceId);
                }
            } else {
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

    public function calProductPriceGinza($orderId)
    {
        $OrderModel = Order::model()->findByPk($orderId);
        $condition = 'supplierId=:supplierId AND type&' . Order::ORDER_TYPE_CART . ' > 0';
        $params = [':supplierId' => isset($supplierId) ? $supplierId : $OrderModel->supplierId];
        $discountPercent = 0;

        if (isset(Yii::app()->user->id)) {
            $condition .= ' AND userId=:userId';
            $params[':userId'] = Yii::app()->user->id;
        } else {
            $daiibuy = new DaiiBuy();
            $daiibuy->loadCookie();
            $condition .= " AND token='" . $daiibuy->token . "'";
        }

        $models = Order::model()->findAll(array(
            'condition' => $condition,
            'params' => $params,
        ));
        $noOfBuy = 0;
        foreach ($models as $order) {
            foreach ($order->orderItems as $item) {
                $noOfBuy +=$item->quantity;
            }
        }
        $noOfUnits = $OrderModel->countGinzaHomeAndGinzaTownUnits();
        $productPrice = $this->calProductPrice();
        $discountPercent = SupplierDiscountRange::model()->findDiscountPercent($OrderModel->supplierId, $noOfUnits + $noOfBuy);
        $discountPrice = $productPrice * $discountPercent / 100;
        return Order::model()->formatMoney($productPrice - $discountPrice);
    }

    public function calProductPrice($productId = NULL, $provinceId = NULL)
    {
//		throw new Exception(print_r($provinceId,true));
        if (!isset($provinceId)) {
            $daiibuy = new DaiiBuy();
            $daiibuy->loadCookie();
            $provinceId = $daiibuy['provinceId'];
        }

        $product = (isset($productId)) ? Product::model()->findByPk($productId) : $this;
        $price = $product->price;

        $priceModel = Price::model()->find("provinceId=:provinceId AND priceGroupId=:priceGroupId", array(
            ":provinceId" => $provinceId,
            ':priceGroupId' => $product->priceGroupId));
//		throw new Exception(print_r($priceModel,true));
        if (isset($priceModel)) {
            $price = $price * ((100 + $priceModel->priceRate) / 100);
        } else {
            $price = $price * ((100 + $product->priceGroup->priceRate) / 100);
        }

        return floor($price);
    }

    public function calProductPromotionPrice($productId = NULL, $provinceId = NULL)
    {
        if (!isset($provinceId)) {
            $daiibuy = new DaiiBuy();
            $daiibuy->loadCookie();
            $provinceId = $daiibuy['provinceId'];
        }

        $product = (isset($productId)) ? Product::model()->findByPk($productId) : $this;

        if (isset($product->productPromotion)) {
            $price = $product->productPromotion->price;
            $priceModel = Price::model()->find("provinceId=:provinceId AND priceGroupId=:priceGroupId", array(
                ":provinceId" => $provinceId,
                ':priceGroupId' => $product->priceGroupId));
            if (isset($priceModel)) {
                $price = $price * ((100 + $priceModel->priceRate) / 100);
            } else {
                $price = $price * ((100 + $product->priceGroup->priceRate) / 100);
            }

            return floor($price);
        } else {
            return $product->calProductPrice($productId, $provinceId);
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

        if (isset($categoryId))
            $criteria->condition .= ' AND categoryId=' . $categoryId;

        if (isset($brandId))
            $criteria->condition .= ' AND brandId=' . $brandId;

        $criteria->params = array(
            ':provinceId' => $provinceId,
            ':searchText' => '%' . $searchText . '%');
        $criteria->order = 't.productId';

        Controller::writeToFile('/tmp/product', print_r($criteria, true));

        return $this->findAll($criteria);
    }

    public function findFirstImageProduct($productId)
    {
        $productImage = ProductImage::model()->find("productId =:productId AND sortOrder = 1"
        , array(
            ":productId" => $productId));
        if (isset($productImage))
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

        if (isset($categoryId))
            $criteria->condition .= ' AND t.categoryId=' . $categoryId;

        if (isset($brandId))
            $criteria->condition .= ' AND t.brandId=' . $brandId;

        $criteria->params = array(
            ':provinceId' => $provinceId,
            ':searchText' => '%' . $searchText . '%');
        $criteria->order = 't.productId';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 12),
        ));
    }

    public function findAllProductDataByAmphurIdAndCategoryIdAndSupplierId($provinceId, $searchText = '', $categoryId = null, $brandId = null, $dateNow, $supplierId = null)
    {
        $criteria = new CDbCriteria();

        $sort = new CSort('Product');
        $sort->defaultOrder = 't.createDateTime DESC, t.name DESC';
        $sort->attributes = array(
            'createDateTime' => array(
                'asc' => 't.createDateTime ASC',
                'desc' => 't.createDateTime DESC',
            ),
            'name' => array(
                'asc' => 't.name ASC',
                'desc' => 't.name DESC',
            ),
            'price' => array(
                'asc' => 't.price ASC',
                'desc' => 't.price DESC',
            ),
        );
        $sort->applyOrder($criteria);

        $criteria->join = 'LEFT JOIN price_group pg ON t.priceGroupId=pg.priceGroupId ';
        $criteria->join .= 'LEFT JOIN price p ON p.priceGroupId=pg.priceGroupId';
        $criteria->condition = 'p.status = 1 AND t.status = 2 AND p.provinceId=:provinceId AND (LOWER(t.name) LIKE LOWER(:searchText) OR LOWER(t.description) LIKE LOWER(:searchText)) AND t.quantity > 0 AND t.dateAvailable <= ' . $dateNow;

//		if (isset($categoryId))
//			$criteria->condition .= ' AND t.categoryId=' . $categoryId;


        if (isset($brandId))
            $criteria->condition .= ' AND t.brandId=' . $brandId;

        if (isset($supplierId))
            $criteria->condition .= ' AND t.supplierId=' . $supplierId;

        $criteria->params = array(
            ':provinceId' => $provinceId,
            ':searchText' => '%' . $searchText . '%');
//$criteria->order = 't.categoryId =' . $categoryId . " ASC";
//$criteria->order = 't.categoryId ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 12),
            'sort' => $sort,
        ));
    }

    public function behaviors()
    {
        return array(
            'ERememberFiltersBehavior' => array(
                'class' => 'application.components.ERememberFiltersBehavior',
                'defaults' => array(),
                /* optional line */
                'defaultStickOnClear' => false /* optional line */
            ),);
    }

    public function calculateItemSetFenzer($cat1Id, $categoryId, $length, $provinceId, $productIdNew = NULL)
    {
//		throw new Exception(print_r($categoryId,true));
        $type = Category2ToProduct::model()->findProductType($categoryId);
        $category = Category::model()->findByPk($categoryId);
        $height = $category->description;
//		$products = Product::model()->findAll('categoryId = ' . $categoryId . ' AND status = 2');
        $cat2ToProducts = Category2ToProduct::model()->findProductWithCat1AndCat2($cat1Id, $categoryId);
        $res = array();
        $res['categoryId'] = $categoryId;
        $res['height'] = $height;
        $res['length'] = $length;


        if ($type == 3) {
            $span = self::SPAN_BLOCK;
        } else {
            $span = self::SPAN_FENZER;
        }
        $noSpanSet = ceil(intval($length) / $span);
        $totalPrice = 0.00;

        foreach ($cat2ToProducts as $item) {
            $productId = $item->productId;
            $product = Product::model()->findByPk($productId);
            $quantity = $item->quantity;
//product
            $res['items'][$productId] = $product;
            $type = Category2ToProduct::model()->findProductType($categoryId, $productId);

//quantity
            if ($noSpanSet == 0) {
//default Qty = 1
                $res['items'][$productId]['quantity'] = 1;
            } else {
                $res['items'][$productId]['quantity'] = ($quantity * $noSpanSet) + ($type == 2 ? 1 : 0);
            }

//price
            $productPromotion = ProductPromotion::model()->find("productId=:productId AND ('" . date("Y-m-d") . "' BETWEEN dateStart AND dateEnd)", array(
                ":productId" => $productId));
            if (isset($productPromotion)) {
//promotion price
                $res['items'][$productId]['price'] = $this->calProductPromotionTotalPrice($productId, $res['items'][$productId]['quantity'], $provinceId);
            } else {
//normal price
                $res['items'][$productId]['price'] = $this->calProductTotalPrice($productId, $res['items'][$productId]['quantity'], $provinceId);
            }
            $totalPrice = $totalPrice + $res['items'][$productId]['price'];
        }
        $res['totalPrice'] = $totalPrice;
        return $res;
    }

    public function calculateItemSetFenzerManualAndSave($cat1Id, $categoryId, $productItems, $provinceId, $length, $isSave, $oldOrderId, $title)
    {
        $category = Category::model()->findByPk($categoryId);
        $height = $category->description;
        $res = array();
        $res['categoryId'] = $categoryId;
        $totalPrice = 0.00;
        unset($productItems['categoryId']);
        if (isset($isSave) && $isSave == TRUE) {
//SAVE NEW ORDER
            if ($oldOrderId == NULL) {
                $orderModel = new Order();
                $orderModel->userId = isset(Yii::app()->user->id) ? Yii::app()->user->id : 0;
                if (isset($title)) {
                    $orderModel->title = $title;
                }
                $orderModel->supplierId = 1;
                $orderModel->provinceId = $provinceId;
                $orderModel->type = 1;
                $orderModel->status = 2;
                $orderModel->createDateTime = new CDbExpression("NOW()");
                if ($orderModel->save()) {
                    $orderId = Yii::app()->db->lastInsertID;
                } else {
                    throw new Exception(print_r($orderModel->errors, True));
                }
            } else {
                $orderModel = Order::model()->findByPk($oldOrderId);
            }
        }

        foreach ($productItems as $productId => $qty) {
            $product = Product::model()->findByPk($productId);
//product
            $res['items'][$productId] = $product;

//quantity
            $res['items'][$productId]['quantity'] = intval($qty['quantity']);
//			print_r($qty);
//price
            $productPromotion = ProductPromotion::model()->find("productId=:productId AND ('" . date("Y-m-d") . "' BETWEEN dateStart AND dateEnd)", array(
                ":productId" => $productId));
            if (isset($productPromotion)) {
//promotion price
                $res['items'][$productId]['price'] = $this->calProductPromotionTotalPrice($productId, $res['items'][$productId]['quantity'], $provinceId) * 1;
            } else {
//normal price
                $res['items'][$productId]['price'] = $this->calProductTotalPrice($productId, $res['items'][$productId]['quantity'], $provinceId) * 1;
            }
            $totalPrice = $totalPrice + $res['items'][$productId]['price'];
            if (isset($isSave) && $isSave == TRUE) {
                if ($oldOrderId == NULL) {
                    $orderItemModel = new OrderItems();
                    $orderItemModel->orderId = $orderId;
                    $orderItemModel->productId = $productId;
                    $orderItemModel->title = substr($product->name, 0, 44);
                    $orderItemModel->createDateTime = new CDbExpression("NOW()");
                } else {
                    $orderItemModel = OrderItems::model()->find('productId = ' . $productId . ' AND orderId = ' . $oldOrderId);
                }
//				throw new Exception(print_r($res['items'][$productId]['price'] / $res['items'][$productId]['quantity'],true));
                $orderItemModel->price = $res['items'][$productId]['price'] / $res['items'][$productId]['quantity'];
                $orderItemModel->quantity = $res['items'][$productId]['quantity'];
                $orderItemModel->total = $res['items'][$productId]['price'];
                $orderItemModel->updateDateTime = new CDbExpression("NOW()");
                if (!($orderItemModel->save())) {
                    throw new Exception(print_r($orderItemModel->errors, True));
                }
            }
        }
        $res['totalPrice'] = $totalPrice;
        $res['orderId'] = isset($orderId) ? $orderId : $oldOrderId;

        if (isset($isSave) && $isSave == TRUE) {
//SAVE NEW ORDER
            $orderModel->totalIncVAT = $totalPrice;
            $orderModel->total = $totalPrice / 1.07;
            if ($orderModel->save()) {
                if ($oldOrderId == NULL) {
                    $orderDetail = new OrderDetail();
                    $orderDetail->orderId = $orderId;
                    $orderDetailTemplate = OrderDetailTemplate::model()->findOrderDetailTemplateBySupplierId(1);
                    $orderDetail->orderDetailTemplateId = $orderDetailTemplate->orderDetailTemplateId;
                    $orderDetail->createDateTime = new CDbExpression("NOW()");
                    if ($orderDetail->save()) {
                        $orderDetailId = Yii::app()->db->lastInsertID;
                        foreach ($orderDetailTemplate->orderDetailTemplateFields as $item) {
                            $orderDetailValue = new OrderDetailValue();
                            $orderDetailValue->orderDetailId = $orderDetailId;
                            $orderDetailValue->orderDetailTemplateFieldId = $item->orderDetailTemplateFieldId;
                            $orderDetailValue->value = ($item->title == 'height') ? $height : (($item->title == 'length') ? $length : (($item->title == 'category1Id') ? $cat1Id : $categoryId));
                            $orderDetailValue->createDateTime = new CDbExpression("NOW()");
                            $orderDetailValue->updateDateTime = new CDbExpression("NOW()");
                            if (!($orderDetailValue->save())) {
                                throw new Exception(print_r($orderDetailValue->errors, True));
                            }
                        }
                    } else {
                        throw new Exception(print_r($orderDetail->errors, True));
                    }
                } else {
                    $orderDetail = OrderDetail::model()->find('orderId = ' . $oldOrderId);
                    $orderDetailTemplate = OrderDetailTemplate::model()->findOrderDetailTemplateBySupplierId(1);
                    $orderDetailValue = OrderDetailValue::model()->findAll('orderDetailId = ' . $orderDetail->orderDetailId);

                    foreach ($orderDetailValue as $item) {
                        $item->value = $item->orderDetailTemplateFieldId == 1 ? $height : ($item->orderDetailTemplateFieldId == 2 ? $length : $categoryId);
                        $item->updateDateTime = new CDbExpression("NOW()");
                        if (!($item->save())) {
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
            ":productId" => $productIdNew));
        if (isset($productPromotion)) {
//promotion price
            $res["item"]['price'] = $this->calProductPromotionTotalPrice($productIdNew, 1, $provinceId) * 1;
        } else {
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

        if (Yii::app()->user->userType != 4) {
            $criteria->condition .=" AND supplierId = :supplierId ";
            $criteria->params[":supplierId"] = $supplierId;
        }
        $models = Product::model()->findAll($criteria);

        foreach ($models as $item) {
            $result[$item->productId] = $item->name;
        }

        return $result;
    }

    public function findAllProductArraySupplierIdAndCategoryId($supplierId, $categoryId)
    {
        $products = Product::model()->findAll('supplierId =' . $supplierId . ' AND Status = 1 AND CategoryId = ' . $categoryId);
        $res = array();
        foreach ($products as $item) {
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

    public function findAllAtechSizeArray()
    {
        $criteria = new CDbCriteria();
        $criteria->distinct = true;
        $criteria->select = 'CONCAT(width, " x ", height) AS size';
        $criteria->condition = 'status = 2 AND supplierId = 2';
        $model = $this->findAll($criteria);
//		throw new Exception($model->size,true);
        $res = array();
        foreach ($model as $item) {
            $res[$item['size']] = $item['size'];
        }
        return $res;
    }

    public function calculatePriceFromCriteriaAtech($criteria, $brandModelId, $provinceId)
    {
//		throw new Exception(print_r($brandModelId,true));
        $res = array();
        $total = 0.00;
        $i = 0;
//		throw new Exception(print_r($criteria,true));
        foreach ($criteria as $item) {
            $cate2ToProduct = null;
            $productModel = null;
//	throw new Exception(print_r($item,true));
//			$categoryArray = $this->getCategory2IdByBrandModelIdAndCategory1($brandModelId, $item['category'], $item['type']);
//			if(count($categoryArray) > 0)
//			{
//            $category1Id = $item['category'];
            $category2Id = $item['type'];
//			throw new Exception(print_r($category1Id.', '.$category2Id,true));
            $value = $item['size'];
            $size = explode(" x ", $value);
            $width = $size[0];
            if (isset($size[1])) {
                $height = $size[1];

//			throw new Exception(print_r("brandModelId = ".$brandModelId. ", category1Id = ".$category1Id.", category2Id = ".$category2Id,true));
                $cate2ToProduct = Category2ToProduct::model()->findAll('category1Id = ' . $category2Id . ' AND brandModelId = ' . $brandModelId);
                if (isset($cate2ToProduct)) {
//				throw new Exception(print_r($cate2ToProduct,true));
                    foreach ($cate2ToProduct as $cate2) {
                        $product = $cate2->product;
                        if ($product->width == $width && $product->height == $height) {
                            $productModel = $product;
                        }
                    }
                }
//				$productModel = Product::model()->find('supplierId = 2 AND brandModelId = ' . $brandModelId . ' AND categoryId = ' . $category2Id . ' AND width = ' . intval($width) . ' AND height = ' . intval($height));
//				throw new Exception(print_r($brandModelId . ', '. $category2Id. ', '. intval($width).', '. intval($height),true));
                if (isset($productModel)) {
                    $productPromotion = ProductPromotion::model()->find("productId=:productId AND ('" . date("Y-m-d") . "' BETWEEN dateStart AND dateEnd)", array(
                        ":productId" => $productModel->productId));
                    $res["items"][$i]['productId'] = $productModel->productId;
                    $res["items"][$i]['code'] = $productModel->code;
                    $res["items"][$i]['width'] = $productModel->width;
                    $res["items"][$i]['height'] = $productModel->height;
//                    $res["items"][$i]['category'] = $item['category'];
                    $res["items"][$i]['type'] = $item['type'];
                    $res["items"][$i]['description'] = $productModel->name;
                    $res["items"][$i]['quantity'] = $item['quantity'];
                    if (isset($productPromotion)) {
//promotion price
                        $res["items"][$i]['price'] = $this->calProductPromotionTotalPrice($productModel->productId, 1, $provinceId);
                    } else {
//normal price
                        $res["items"][$i]['price'] = $this->calProductTotalPrice($productModel->productId, 1, $provinceId);
                    }
                    $subTotal = $res["items"][$i]['price'] * $res["items"][$i]['quantity'];
                    $res["items"][$i]['subTotal'] = $subTotal;

                    $total = $subTotal + $total;
                }
//			}
                $i++;
            }
        }

        $res["total"] = $total;
        $res["brandModelId"] = $brandModelId;
//		throw new Exception(print_r($res,true));
//		$res["brandModelId"] = $brand->brandModelId;
//		$res["category1Id"] = $category1Id;
//		$res["category2Id"] = $category2Id;
//		throw new Exception(print_r($res,true));

        return $res;
    }

    public function calculatePriceFromEstimateAtech($brandModelId, $provinceId = 1, $productArray, $orderId = null)
    {
        $res = array();
        $total = 0.00;
        $i = 0;

        if (isset($orderId) && ($orderId != 'undefined')) {
//            throw new Exception(print_r($orderId, true));
            $orderDetailModel = OrderDetail::model()->find('orderId = ' . $orderId);
//            if (count($orderDetailModel) > 0) {
//                $orderDetailTemplateValueModel = OrderDetailValue::model()->find('orderDetailId = ' . $orderDetailModel->orderDetailId . ' and orderDetailTemplateFieldId = 9');
//                $category2Id = $orderDetailTemplateValueModel->value;
//            }
        }

        foreach ($productArray as $item) {

//			throw new Exception(print_r($item->quantity, true));

            if (isset($orderId)) {
                $quantity = $item->quantity;
                $productModel = Product::model()->findByPk($item->productId);
                $cate2ToProductItem = Category2ToProduct::model()->find('productId = ' . $item->productId);
                $category2Id = $cate2ToProductItem->category1Id;
                $width = $productModel->width;
                $height = $productModel->height;

                if (isset($category2Id)) {
                    $cate2ToProduct = Category2ToProduct::model()->findAll('category1Id = ' . $category2Id . ' AND brandModelId = ' . $brandModelId);
                    if (isset($cate2ToProduct)) {
                        foreach ($cate2ToProduct as $cate2) {
                            $product = Product::model()->findByPk($cate2->productId);
                            if ($product->width == $width && $product->height == $height) {

                                $item = $product;
                            }
                        }
                    }
                }
            }
//            throw new Exception(print_r($item, true));

            $productPromotion = ProductPromotion::model()->find("productId=:productId AND ('" . date("Y-m-d") . "' BETWEEN dateStart AND dateEnd)", array(
                ":productId" => $item->productId));
            $res["items"][$i]['productId'] = $item->productId;
            $res["items"][$i]['code'] = $item->code;
            $res["items"][$i]['width'] = $item->width;
            $res["items"][$i]['height'] = $item->height;
//			$res["items"][$i]['category'] = $item['category'];
//			$res["items"][$i]['type'] = $item['type'];
            $res["items"][$i]['description'] = $item->name;
            $res["items"][$i]['quantity'] = isset($quantity) ? $quantity : $item->quantity;
            $res["items"][$i]['name'] = $item->name;

            if (isset($productPromotion)) {
//promotion price
                $res["items"][$i]['price'] = $this->calProductPromotionTotalPrice($item->productId, 1, $provinceId);
            } else {
//normal price
                $res["items"][$i]['price'] = $this->calProductTotalPrice($item->productId, 1, $provinceId);
            }
            $subTotal = $res["items"][$i]['price'] * $res["items"][$i]['quantity'];
            $res["items"][$i]['subTotal'] = $subTotal;

            $total = $subTotal + $total;
            $i++;
        }
//		throw new Exception(print_r($res["items"], true));


        $res["total"] = $total;
        $res["brandModelId"] = $brandModelId;

//		$res["brandModelId"] = $brand->brandModelId;
//		$res["category1Id"] = $category1Id;
//		$res["category2Id"] = $category2Id;
        return $res;
    }

    public function getCategory2IdByBrandModelIdAndCategory1($brandModelId, $cate1Title, $cate2Title)
    {
        $res = array();
        $brandModel = BrandModel::model()->findByPk($brandModelId);
        foreach ($brandModel->categorys as $item) {
            if ($item->title == $cate1Title) {
                $cate1 = $item;
                break;
            }
        }
        if (isset($cate1)) {
//throw new Exception(print_r($cate1,true));
            foreach ($cate1->subCategorys as $subCat) {
                if ($subCat->title == $cate2Title) {
                    $cate2 = $subCat;
                    break;
                }
            }
            if (isset($cate1))
                $res['cate1'] = $cate1->categoryId;
            if (isset($cate2))
                $res['cate2'] = $cate2->categoryId;
        }
        return $res;
    }

    public function findAtechWidthGroup($category2Id)
    {
        $criteria = new CDbCriteria();
        $criteria->join = " LEFT JOIN category2_to_product c ON c.productId = t.productId ";
        $criteria->compare("c.category2Id", $category2Id);
        $criteria->group = "t.width";

        return $this->findAll($criteria);
    }

    public function findAtechHeightGroup($category2Id)
    {
        $criteria = new CDbCriteria();
        $criteria->join = " LEFT JOIN category2_to_product c ON c.productId = t.productId ";
        $criteria->compare("c.category2Id", $category2Id);
        $criteria->group = "t.height";

        return $this->findAll($criteria);
    }

    public function findAllProductByWidthHeightCategory2Id($width, $height, $category2Id)
    {
        $criteria = new CDbCriteria();
        $criteria->join = " LEFT JOIN category2_to_product c ON c.productId = t.productId ";
        $criteria->compare("c.category2Id", $category2Id);
        $criteria->compare("t.width", $width);
        $criteria->compare("t.height", $height);
        $criteria->group = "t.price";

        return $this->findAll($criteria);
    }

    public function findAllProductFenzer()
    {
        $productModel = Product::model()->findAll('supplierId =' . 176 . ' AND Status = 2');
        $res = array();
        foreach ($productModel as $item) {
            $res[$item->productId] = $item->name . ' (' . $item->code . ')';
        }
        return $res;
    }

    public function findAllTileArray()
    {
        $res = array();
        $FavTiles = UserFavourite::model()->findAll('userId = ' . Yii::app()->user->id . ' and productId is not null');
        foreach ($FavTiles as $fav) {
            $productModel = Product::model()->findByPk($fav->productId);
            if (isset($productModel->productId))
                $res[$productModel->productId] = $productModel->name;
        }
        return $res;
//        $res = array();
//        $cat = Category2ToProduct::model()->findAll('brandModelId = 19 AND status = 1 and category1Id = ' . $category1Id);
//
//        foreach ($cat as $item) {
//            $res[$item->productId] = $item->product->name;
//        }
//        return $res;
    }

}
