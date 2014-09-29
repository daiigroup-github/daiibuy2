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
 * @property string $priceGroupId
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
 * @property string $minimum
 * @property integer $sortOrder
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $viewed
 * @property string $marginId
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Category2ToProduct[] $category2ToProducts
 * @property Category $category
 * @property User $supplier
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
			array('supplierId, quantity, productUnits, price, priceGroupId, dateAvailable, length, width, height, dimensionUnits, metricUnits', 'required'),
			array('quantity, stockStatusId, shipping, subtract, sortOrder, status', 'numerical', 'integerOnly'=>true),
			array('supplierId, brandId, brandModelId, categoryId, categoryId2, isbn, taxClassId, marginId', 'length', 'max'=>20),
			array('name', 'length', 'max'=>80),
			array('sku', 'length', 'max'=>64),
			array('upc', 'length', 'max'=>12),
			array('location', 'length', 'max'=>40),
			array('productUnits, dimensionUnits, metricUnits', 'length', 'max'=>45),
			array('image', 'length', 'max'=>255),
			array('price, weight, length, width, height', 'length', 'max'=>15),
			array('priceGroupId', 'length', 'max'=>10),
			array('points', 'length', 'max'=>8),
			array('minimum', 'length', 'max'=>11),
			array('viewed', 'length', 'max'=>5),
			array('createDateTime, updateDateTime, description', 'safe'),
			array('createDateTime, updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'insert'),
			array('updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('productId, supplierId, brandId, brandModelId, categoryId, categoryId2, name, isbn, sku, upc, location, quantity, productUnits, stockStatusId, image, shipping, price, priceGroupId, points, taxClassId, dateAvailable, weight, length, width, height, dimensionUnits, metricUnits, subtract, minimum, sortOrder, status, createDateTime, updateDateTime, viewed, marginId, description, searchText', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Category', 'categoryId'),
			'supplier' => array(self::BELONGS_TO, 'User', 'supplierId'),
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
			'priceGroupId' => 'Price Group',
			'points' => 'Points',
			'taxClassId' => 'Tax Class',
			'dateAvailable' => 'Date Available',
			'weight' => 'Weight',
			'length' => 'Length',
			'width' => 'Width',
			'height' => 'Height',
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
			$this->productId = $this->searchText;
			$this->supplierId = $this->searchText;
			$this->brandId = $this->searchText;
			$this->brandModelId = $this->searchText;
			$this->categoryId = $this->searchText;
			$this->categoryId2 = $this->searchText;
			$this->name = $this->searchText;
			$this->isbn = $this->searchText;
			$this->sku = $this->searchText;
			$this->upc = $this->searchText;
			$this->location = $this->searchText;
			$this->quantity = $this->searchText;
			$this->productUnits = $this->searchText;
			$this->stockStatusId = $this->searchText;
			$this->image = $this->searchText;
			$this->shipping = $this->searchText;
			$this->price = $this->searchText;
			$this->priceGroupId = $this->searchText;
			$this->points = $this->searchText;
			$this->taxClassId = $this->searchText;
			$this->dateAvailable = $this->searchText;
			$this->weight = $this->searchText;
			$this->length = $this->searchText;
			$this->width = $this->searchText;
			$this->height = $this->searchText;
			$this->dimensionUnits = $this->searchText;
			$this->metricUnits = $this->searchText;
			$this->subtract = $this->searchText;
			$this->minimum = $this->searchText;
			$this->sortOrder = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
			$this->viewed = $this->searchText;
			$this->marginId = $this->searchText;
			$this->description = $this->searchText;
		}

		$criteria->compare('productId',$this->productId,true, 'OR');
		$criteria->compare('supplierId',$this->supplierId,true, 'OR');
		$criteria->compare('brandId',$this->brandId,true, 'OR');
		$criteria->compare('brandModelId',$this->brandModelId,true, 'OR');
		$criteria->compare('categoryId',$this->categoryId,true, 'OR');
		$criteria->compare('categoryId2',$this->categoryId2,true, 'OR');
		$criteria->compare('name',$this->name,true, 'OR');
		$criteria->compare('isbn',$this->isbn,true, 'OR');
		$criteria->compare('sku',$this->sku,true, 'OR');
		$criteria->compare('upc',$this->upc,true, 'OR');
		$criteria->compare('location',$this->location,true, 'OR');
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('productUnits',$this->productUnits,true, 'OR');
		$criteria->compare('stockStatusId',$this->stockStatusId);
		$criteria->compare('image',$this->image,true, 'OR');
		$criteria->compare('shipping',$this->shipping);
		$criteria->compare('price',$this->price,true, 'OR');
		$criteria->compare('priceGroupId',$this->priceGroupId,true, 'OR');
		$criteria->compare('points',$this->points,true, 'OR');
		$criteria->compare('taxClassId',$this->taxClassId,true, 'OR');
		$criteria->compare('dateAvailable',$this->dateAvailable,true, 'OR');
		$criteria->compare('weight',$this->weight,true, 'OR');
		$criteria->compare('length',$this->length,true, 'OR');
		$criteria->compare('width',$this->width,true, 'OR');
		$criteria->compare('height',$this->height,true, 'OR');
		$criteria->compare('dimensionUnits',$this->dimensionUnits,true, 'OR');
		$criteria->compare('metricUnits',$this->metricUnits,true, 'OR');
		$criteria->compare('subtract',$this->subtract);
		$criteria->compare('minimum',$this->minimum,true, 'OR');
		$criteria->compare('sortOrder',$this->sortOrder);
		$criteria->compare('status',$this->status);
		$criteria->compare('createDateTime',$this->createDateTime,true, 'OR');
		$criteria->compare('updateDateTime',$this->updateDateTime,true, 'OR');
		$criteria->compare('viewed',$this->viewed,true, 'OR');
		$criteria->compare('marginId',$this->marginId,true, 'OR');
		$criteria->compare('description',$this->description,true, 'OR');

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
