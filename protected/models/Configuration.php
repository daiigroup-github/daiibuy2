<?php

class Configuration extends ConfigurationMaster
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
	 * public function search()
	 * {
	 * }
	 */
	public function getSystemMultiply()
	{
		$res = $this->find('name = "systemMultiply"');
		return $res;
	}

	public function getRewardExpiredDate()
	{
		$res = $this->find('name = "pointCollectExpiredDate"');
		return $res;
	}

	public function getOrderExpiredDate()
	{
		$res = $this->find('name = "orderCollectExpiredDate"');
		return $res;
	}

	public function getTaxNumber()
	{
		$res = $this->find('name = "TaxNumber"');
		return $res->value;
	}

	public function getMinPointToUse()
	{
		$res = $this->find('name = "minPointToUse"');
		return $res;
	}

	public function getMaxPointToUse()
	{
		$res = $this->find('name = "maxPointToUse"');
		return $res;
	}

	public function getPointToBaht()
	{
		$res = $this->find('name = "pointToBaht"');
		return $res;
	}

	public function getPaymentDay()
	{
		$res = $this->find('name = "paymentDay"');
		return $res;
	}

}
