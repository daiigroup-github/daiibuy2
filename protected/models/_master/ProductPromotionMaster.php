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
class ProductPromotionMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_promotion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productId', 'required'),
			array('quantity, priority', 'numerical', 'integerOnly'=>true),
			array('productId, userGroupId', 'length', 'max'=>20),
			array('price', 'length', 'max'=>15),
			array('dateStart, dateEnd', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('productPromotionId, productId, userGroupId, quantity, priority, price, dateStart, dateEnd, searchText', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productPromotionId' => 'Product Promotion',
			'productId' => 'Product',
			'userGroupId' => 'User Group',
			'quantity' => 'Quantity',
			'priority' => 'Priority',
			'price' => 'Price',
			'dateStart' => 'Date Start',
			'dateEnd' => 'Date End',
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
			$this->productPromotionId = $this->searchText;
			$this->productId = $this->searchText;
			$this->userGroupId = $this->searchText;
			$this->quantity = $this->searchText;
			$this->priority = $this->searchText;
			$this->price = $this->searchText;
			$this->dateStart = $this->searchText;
			$this->dateEnd = $this->searchText;
		}

		$criteria->compare('productPromotionId',$this->productPromotionId,true, 'OR');
		$criteria->compare('productId',$this->productId,true, 'OR');
		$criteria->compare('userGroupId',$this->userGroupId,true, 'OR');
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('price',$this->price,true, 'OR');
		$criteria->compare('dateStart',$this->dateStart,true, 'OR');
		$criteria->compare('dateEnd',$this->dateEnd,true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductPromotionMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
