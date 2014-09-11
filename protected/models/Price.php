<?php

/**
 * This is the model class for table "price".
 *
 * The followings are the available columns in table 'price':
 * @property string $priceId
 * @property string $priceGroupId
 * @property string $provinceId
 * @property string $amphurId
 * @property string $priceRate
 * @property integer $status
 */
class Price extends PriceMaster
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Price the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'price';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(
				'priceGroupId, provinceId, amphurId',
				'required'),
//			array(
//				'status, priceRate',
//				'numerical',
//				'integerOnly' => true),
			array(
				'priceGroupId',
				'length',
				'max'=>10),
			array(
				'provinceId, amphurId',
				'length',
				'max'=>5),
			array(
				'priceRate',
				'length',
				'max'=>15),
			array(
				'status',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'priceId, priceGroupId, provinceId, amphurId, priceRate, status',
				'safe',
				'on'=>'search'),
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
			'amphur'=>array(
				self::BELONGS_TO,
				'Amphur',
				'amphurId'),
			'province'=>array(
				self::BELONGS_TO,
				'Province',
				'provinceId'),
			'priceGroup'=>array(
				self::BELONGS_TO,
				'PriceGroup',
				'priceGroupId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'priceId'=>'Price',
			'priceGroupId'=>'Price Group',
			'provinceId'=>'Province',
			'amphurId'=>'Amphur',
			'priceRate'=>'Price Rate',
			'status'=>'Status',
		);
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

		$criteria->compare('priceId', $this->priceId, true);
		$criteria->compare('priceGroupId', $this->priceGroupId, true);
		$criteria->compare('provinceId', $this->provinceId, true);
		$criteria->compare('amphurId', $this->amphurId, true);
		$criteria->compare('priceRate', $this->priceRate, true);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getAllPriceByPriceGroupIdAndProvinceId($priceGroupId, $provinceId)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'priceGroupId=:priceGroupId AND t.provinceId=:provinceId AND amphurId = 0';
		$criteria->params = array(
			':priceGroupId'=>$priceGroupId,
			':provinceId'=>$provinceId);
//		$criteria->with = array(
//			'amphur');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>60,
			),
			'sort'=>array(
//				'defaultOrder'=>'amphur.amphurName'
		)));
	}

}
