<?php

class Category2ToProduct extends Category2ToProductMaster
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
				'category2'=>array(
					self::BELONGS_TO,
					'Category',
					'category2Id'),
				'category'=>array(
					self::BELONGS_TO,
					'Category',
					'category1Id'),
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
			$this->id = $this->searchText;
			$this->categoryId = $this->searchText;
			$this->productId = $this->searchText;
			$this->groupName = $this->searchText;
			$this->quantity = $this->searchText;
			$this->type = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('id', $this->id, true, 'OR');
		$criteria->compare('category2Id', $this->category2Id);
		$criteria->compare('category1Id', $this->category1Id);
		$criteria->compare('productId', $this->productId, true, 'OR');
		$criteria->compare('groupName', $this->groupName, true, 'OR');
		$criteria->compare('quantity', $this->quantity);
		$criteria->compare('type', $this->type);
		$criteria->compare('status', $this->status);
		$criteria->compare('createDateTime', $this->createDateTime, true, 'OR');
		$criteria->compare('updateDateTime', $this->updateDateTime, true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'sortOrder ASC'
			)
		));
	}

	public function findProductType($categoryId, $productId = NULL)
	{
		if(isset($productId))
		{
			$cate = $this->find('category2Id = ' . $categoryId . ' AND productId = ' . $productId . ' AND status=1');
		}
		else
		{
			$cate = $this->find('category2Id = ' . $categoryId . ' AND status=1');
		}
		return $cate->type;
	}

}
