<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property string $productId
 * @property string $supplierId
 * @property string $brandId
 * @property string $brandModelId
 * @property string $categoryId
 * @property string $categoryId2
 * @property string $code
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
 * @property string $otherPrice
 * @property integer $noPerBox
 * @property string $priceGroupId
 * @property string $points
 * @property string $taxClassId
 * @property string $dateAvailable
 * @property string $weight
 * @property string $length
 * @property string $width
 * @property string $height
 * @property string $area
 * @property string $dimensionUnits
 * @property string $metricUnits
 * @property integer $subtract
 * @property string $minimum
 * @property integer $sortOrder
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $viewed
 * @property string $marginId
 * @property string $description
 * @property string $payCondition
 *
 * The followings are the available model relations:
 * @property Category2ToProduct[] $category2ToProducts
 * @property OrderItems[] $orderItems
 * @property Supplier $supplier
 * @property ProductImage[] $productImages
 * @property ProductOptionGroup[] $productOptionGroups
 * @property ProductSpecGroup[] $productSpecGroups
 */
class ProductMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('supplierId, code, quantity, productUnits, price, priceGroupId, dateAvailable, length, width, height, dimensionUnits, metricUnits, updateDateTime', 'required'),
			array('quantity, stockStatusId, shipping, noPerBox, subtract, sortOrder, status', 'numerical', 'integerOnly'=>true),
			array('supplierId, brandId, brandModelId, categoryId, categoryId2, code, isbn, taxClassId, marginId', 'length', 'max'=>20),
			array('name', 'length', 'max'=>80),
			array('sku', 'length', 'max'=>64),
			array('upc', 'length', 'max'=>12),
			array('location', 'length', 'max'=>40),
			array('productUnits, dimensionUnits, metricUnits', 'length', 'max'=>45),
			array('image', 'length', 'max'=>255),
			array('price, otherPrice, weight, length, width, height, area', 'length', 'max'=>15),
			array('priceGroupId', 'length', 'max'=>10),
			array('points', 'length', 'max'=>8),
			array('minimum', 'length', 'max'=>11),
			array('viewed', 'length', 'max'=>5),
			array('createDateTime, description, payCondition', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('productId, supplierId, brandId, brandModelId, categoryId, categoryId2, code, name, isbn, sku, upc, location, quantity, productUnits, stockStatusId, image, shipping, price, otherPrice, noPerBox, priceGroupId, points, taxClassId, dateAvailable, weight, length, width, height, area, dimensionUnits, metricUnits, subtract, minimum, sortOrder, status, createDateTime, updateDateTime, viewed, marginId, description, payCondition', 'safe', 'on'=>'search'),
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
			'category2ToProducts' => array(self::HAS_MANY, 'Category2ToProduct', 'productId'),
			'orderItems' => array(self::HAS_MANY, 'OrderItems', 'productId'),
			'supplier' => array(self::BELONGS_TO, 'Supplier', 'supplierId'),
			'productImages' => array(self::HAS_MANY, 'ProductImage', 'productId'),
			'productOptionGroups' => array(self::HAS_MANY, 'ProductOptionGroup', 'productId'),
			'productSpecGroups' => array(self::HAS_MANY, 'ProductSpecGroup', 'productId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productId' => 'Product',
			'supplierId' => 'Supplier',
			'brandId' => 'Brand',
			'brandModelId' => 'Brand Model',
			'categoryId' => 'Category',
			'categoryId2' => 'Category Id2',
			'code' => 'Code',
			'name' => 'Name',
			'isbn' => 'Isbn',
			'sku' => 'Sku',
			'upc' => 'Upc',
			'location' => 'Location',
			'quantity' => 'Quantity',
			'productUnits' => 'Product Units',
			'stockStatusId' => 'Stock Status',
			'image' => 'Image',
			'shipping' => 'Shipping',
			'price' => 'Price',
			'otherPrice' => 'Other Price',
			'noPerBox' => 'No Per Box',
			'priceGroupId' => 'Price Group',
			'points' => 'Points',
			'taxClassId' => 'Tax Class',
			'dateAvailable' => 'Date Available',
			'weight' => 'Weight',
			'length' => 'Length',
			'width' => 'Width',
			'height' => 'Height',
			'area' => 'Area',
			'dimensionUnits' => 'Dimension Units',
			'metricUnits' => 'Metric Units',
			'subtract' => 'Subtract',
			'minimum' => 'Minimum',
			'sortOrder' => 'Sort Order',
			'status' => 'Status',
			'createDateTime' => 'Create Date Time',
			'updateDateTime' => 'Update Date Time',
			'viewed' => 'Viewed',
			'marginId' => 'Margin',
			'description' => 'Description',
			'payCondition' => 'Pay Condition',
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

		$criteria->compare('productId',$this->productId,true);
		$criteria->compare('supplierId',$this->supplierId,true);
		$criteria->compare('brandId',$this->brandId,true);
		$criteria->compare('brandModelId',$this->brandModelId,true);
		$criteria->compare('categoryId',$this->categoryId,true);
		$criteria->compare('categoryId2',$this->categoryId2,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('isbn',$this->isbn,true);
		$criteria->compare('sku',$this->sku,true);
		$criteria->compare('upc',$this->upc,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('productUnits',$this->productUnits,true);
		$criteria->compare('stockStatusId',$this->stockStatusId);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('shipping',$this->shipping);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('otherPrice',$this->otherPrice,true);
		$criteria->compare('noPerBox',$this->noPerBox);
		$criteria->compare('priceGroupId',$this->priceGroupId,true);
		$criteria->compare('points',$this->points,true);
		$criteria->compare('taxClassId',$this->taxClassId,true);
		$criteria->compare('dateAvailable',$this->dateAvailable,true);
		$criteria->compare('weight',$this->weight,true);
		$criteria->compare('length',$this->length,true);
		$criteria->compare('width',$this->width,true);
		$criteria->compare('height',$this->height,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('dimensionUnits',$this->dimensionUnits,true);
		$criteria->compare('metricUnits',$this->metricUnits,true);
		$criteria->compare('subtract',$this->subtract);
		$criteria->compare('minimum',$this->minimum,true);
		$criteria->compare('sortOrder',$this->sortOrder);
		$criteria->compare('status',$this->status);
		$criteria->compare('createDateTime',$this->createDateTime,true);
		$criteria->compare('updateDateTime',$this->updateDateTime,true);
		$criteria->compare('viewed',$this->viewed,true);
		$criteria->compare('marginId',$this->marginId,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('payCondition',$this->payCondition,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
