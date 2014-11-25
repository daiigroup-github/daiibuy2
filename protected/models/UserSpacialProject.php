<?php

class UserSpacialProject extends UserSpacialProjectMaster
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
				'user'=>array(
					self::BELONGS_TO,
					"User",
					'userId'),
				'supplier'=>array(
					self::BELONGS_TO,
					"Supplier",
					'supplierId'),
				'order'=>array(
					self::BELONGS_TO,
					"Order",
					'orderId'),
				'orderGroup'=>array(
					self::BELONGS_TO,
					"OrderGroup",
					'orderGroupId'),
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
			$this->spacialCode = $this->searchText;
			$this->spacialPercent = $this->searchText;
			$this->image = $this->searchText;
		}

		$criteria->compare('userSpacialProjectId', $this->userSpacialProjectId, true, 'OR');
		$criteria->compare('supplierId', $this->supplierId);
		$criteria->compare('userId', $this->userId, true, 'OR');
		$criteria->compare('orderGroupId', $this->orderGroupId, true, 'OR');
		$criteria->compare('orderId', $this->orderId, true, 'OR');
		$criteria->compare('supplierSpacialProjectId', $this->supplierSpacialProjectId, true, 'OR');
		$criteria->compare('spacialCode', $this->spacialCode, true, 'OR');
		$criteria->compare('spacialPercent', $this->spacialPercent, true, 'OR');
		$criteria->compare('image', $this->image, true, 'OR');
		$criteria->compare('status', $this->status);
		$criteria->compare('createDateTime', $this->createDateTime, true, 'OR');
		$criteria->compare('updateDateTime', $this->updateDateTime, true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
