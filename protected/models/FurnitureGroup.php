<?php

class FurnitureGroup extends FurnitureGroupMaster
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
				'category' => array(
					self::BELONGS_TO,
					'Category',
					'categoryId'),
				'category2' => array(
					self::BELONGS_TO,
					'Category',
					'category2Id',),
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

	public function findAllFunitureGroupArray($categoryId)
	{
		$res = array();
		$furnitureGroup = FurnitureGroup::model()->findAll('categoryId = ' . $categoryId);
		foreach ($furnitureGroup as $fur)
		{
			$cate = Category::model()->findByPk($fur->categoryId);
			$cate2 = Category::model()->findByPk($fur->category2Id);
			$res[$fur->furnitureGroupId] = $cate2->title . " " . $fur->title;
		}
//		throw new Exception(print_r($res, true));
		return $res;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	  public function search()
	  {
	  }
	 */
}
