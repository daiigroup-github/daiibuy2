<?php

class Supplier extends SupplierMaster
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
				'brands'=>array(
					self::HAS_MANY,
					'Brand',
					'supplierId',
				),
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
	  public function search()
	  {
	  }
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->supplierId = $this->searchText;
			$this->name = $this->searchText;
			$this->prefix = $this->searchText;
			$this->description = $this->searchText;
			$this->companyName = $this->searchText;
			$this->address1 = $this->searchText;
			$this->address2 = $this->searchText;
			$this->districtId = $this->searchText;
			$this->amphurId = $this->searchText;
			$this->provinceId = $this->searchText;
			$this->postcode = $this->searchText;
			$this->taxNumber = $this->searchText;
			$this->email = $this->searchText;
			$this->tel = $this->searchText;
			$this->fax = $this->searchText;
			$this->logo = $this->searchText;
			$this->url = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		if(Yii::app()->user->userType == 3)
		{
			$criteria->compare('supplierId', Yii::app()->user->supplierId);
		}
		else
		{
			$criteria->compare('supplierId', $this->supplierId, true, 'OR');
		}
		$criteria->compare('name', $this->name, true, 'OR');
		$criteria->compare('prefix', $this->prefix, true, 'OR');
		$criteria->compare('description', $this->description, true, 'OR');
		$criteria->compare('companyName', $this->companyName, true, 'OR');
		$criteria->compare('address1', $this->address1, true, 'OR');
		$criteria->compare('address2', $this->address2, true, 'OR');
		$criteria->compare('districtId', $this->districtId, true, 'OR');
		$criteria->compare('amphurId', $this->amphurId, true, 'OR');
		$criteria->compare('provinceId', $this->provinceId, true, 'OR');
		$criteria->compare('postcode', $this->postcode, true, 'OR');
		$criteria->compare('taxNumber', $this->taxNumber, true, 'OR');
		$criteria->compare('email', $this->email, true, 'OR');
		$criteria->compare('tel', $this->tel, true, 'OR');
		$criteria->compare('fax', $this->fax, true, 'OR');
		$criteria->compare('logo', $this->logo, true, 'OR');
		$criteria->compare('url', $this->url, true, 'OR');
		$criteria->compare('status', $this->status);
		$criteria->compare('createDateTime', $this->createDateTime, true, 'OR');
		$criteria->compare('updateDateTime', $this->updateDateTime, true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function findAllSupplierArray()
	{
		$res = array();
		foreach($this->findAll("status = 1") as $item)
		{
			$res[$item->supplierId] = $item->name;
		}
		return $res;
	}

}
