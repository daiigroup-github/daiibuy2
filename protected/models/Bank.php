<?php

class Bank extends BankMaster
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
	public function getAllBankAccType()
	{
		return array(
			'ออมทรัพย์'=>'ออมทรัพย์',
			'กระแสรายวัน'=>'กระแสรายวัน'
		);
	}

	public function findAllBankModelBySupplier($supplierId)
	{
		$result = $this->findAll('supplierId = ' . $supplierId . ' and status = 1');
		return $result;
	}

	public function findAllBankBySupplier($supplierId)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('bankNameId', $this->bankNameId);
		$criteria->compare('branch', $this->branch, true);
		$criteria->compare('compCode', $this->compCode, true);
		$criteria->compare('supplierId', $supplierId, true);
		$criteria->compare('status', 1);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
//			'sort'=>array(
//				'defaultOrder'=>'t.updateDateTime DESC ,t.createDateTime DESC',
//			),
			'pagination'=>array(
				'pageSize'=>10
			),
		));
	}

}
