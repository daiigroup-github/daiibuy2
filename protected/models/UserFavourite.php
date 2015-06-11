<?php

class UserFavourite extends UserFavouriteMaster
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
				'product'=>array(
					self::BELONGS_TO,
					'Product',
					'productId'),
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

	public function findAllThemeByUserId($userId, $theme = TRUE)
	{
		$criteria = new CDbCriteria();
		$criteria->join = " LEFT JOIN category_to_sub c ON c.subCategoryId = t.category2Id ";
		$criteria->compare("t.userId", $userId);
		$criteria->compare("t.category2Id", "<> null");
		if($theme)
		{
			$criteria->compare("c.isTheme", 1);
		}
		else
		{
			$criteria->compare("c.isSet", 1);
		}
		return $this->findAll($criteria);
	}

	public function findAllThemeAndSetByUserIdAndCate2Id($userId, $theme = TRUE, $category2Id = NULL)
	{
		$criteria = new CDbCriteria();
		$criteria->join = " LEFT JOIN category_to_sub c ON c.subCategoryId = t.category2Id ";
		$criteria->compare("t.userId", $userId);
		$criteria->compare("t.category2Id", "<> null");

		if(isset($category2Id))
		{
			$criteria->compare("c.categoryId", $category2Id);
		}
		if($theme)
		{
			$criteria->compare("c.isTheme", 1);
		}
		else
		{
			$criteria->compare("c.isSet", 1);
		}
		return $this->findAll($criteria);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	  public function search()
	  {
	  }
	 */
}
