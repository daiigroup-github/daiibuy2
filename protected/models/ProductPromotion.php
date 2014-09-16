<?php

/**
 * This is the model class for table "product_promotion".
 *
 * The followings are the available columns in table 'product_promotion':
 * @property string $productPromotionId
 * @property string $productId
 * @property string $userGroupId
 * @property integer $quantity
 * @property integer $priority
 * @property string $price
 * @property string $dateStart
 * @property string $dateEnd
 */
class ProductPromotion extends ProductPromotionMaster
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductPromotion the static model class
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
		return CMap::mergeArray(parent::attributeLabels(), array(
				//code here
				'productPromotionId'=>'Product Promotion',
				'productId'=>'Product',
				'userGroupId'=>'User Group',
				'quantity'=>'Quantity',
				'priority'=>'Priority',
				'price'=>'ราคาโปรโมชั่น',
				'dateStart'=>'เริ่ม',
				'dateEnd'=>'สิ้นสุด',
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

		$criteria->compare('productPromotionId', $this->productPromotionId, true);
		$criteria->compare('productId', $this->productId, true);
		$criteria->compare('userGroupId', $this->userGroupId, true);
		$criteria->compare('quantity', $this->quantity);
		$criteria->compare('priority', $this->priority);
		$criteria->compare('price', $this->price, true);
		$criteria->compare('dateStart', $this->dateStart, true);
		$criteria->compare('dateEnd', $this->dateEnd, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function checkDate($attribute, $params)
	{
		$record = Admin::model()->findByAttributes(array(
			'pwd'=>$this->pwd));

		if($record === null)
		{
			$this->addError($attribute, 'Invalid password');
		}
	}

}
