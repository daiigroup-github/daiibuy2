<?php

class BrandModel extends BrandModelMaster
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
//				'brand'=>array(
//					self::BELONGS_TO,
//					"Brand",
//					"brandId"),
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
				'categorys'=>array(
					self::MANY_MANY,
					'Category',
					'model_to_category1(brandModelId, categoryId)',
					'order'=>'categorys_categorys.sortOrder ASC'
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
	 * public function search()
	 * {
	 * }
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->title = $this->searchText;
			$this->description = $this->searchText;
		}
//		$criteria->compare('brandModelId', $this->brandModelId, true, 'OR');
		$criteria->compare('brandId', $this->brandId, FALSE, "AND");
//		$criteria->compare('supplierId', $this->supplierId, true, 'OR');
		$criteria->compare('title', $this->title, true, 'OR');
		$criteria->compare('description', $this->description, true, 'OR');
//		$criteria->compare('image', $this->image, true, 'OR');
//		$criteria->compare('sortOrder', $this->sortOrder);
//		$criteria->compare('status', $this->status);
//		$criteria->compare('createDateTime', $this->createDateTime, true, 'OR');
//		$criteria->compare('updateDateTime', $this->updateDateTime, true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function findAllBrandModelArrayBySupplierId($supplierId)
	{
//		$res = array();
		$models = $this->findAll('supplierId = ' . $supplierId);

//		foreach($models as $item)
//		{
//			$res[$item->brandModelId] = $item;
//		}
		return $models;
	}

}
