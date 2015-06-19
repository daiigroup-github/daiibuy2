<?php

class CategoryToSub extends CategoryToSubMaster
{

	public $categoryTitle;
	public $subCategoryTitle;
	public $brandModelId;

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
				array(
					'subCategoryTitle, categoryTitle, searchText. brandModelId',
					'safe',
					'on'=>'search'),
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
				'brandModel'=>array(
					self::BELONGS_TO,
					'BrandModel',
					'brandModelId'),
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
		$criteria->join = " LEFT JOIN category c ON c.categoryId = t.categoryId ";
		$criteria->join .=" LEFT JOIN category s ON s.categoryId = t.subCategoryId ";
		if(isset($this->searchText) && !empty($this->searchText))
		{
			if(isset($this->categoryId))
			{

//				$subCat = Category::model()->find("title = '" . $this->searchText . "'");
//				$this->subCategoryId = $subCat->categoryId;
				$this->subCategoryTitle = $this->searchText;
			}
			else
			{
//				$cat = Category::model()->find("title = '" . $this->searchText . "'");
//				$this->categoryId = $cat->categoryId;
				$this->categoryTitle = $this->searchText;
			}
		}
//		$criteria->compare('id', $this->id, true, 'OR');
		$criteria->compare("t.categoryId", $this->categoryId);
		$criteria->compare('c.title', $this->categoryTitle, TRUE, 'OR');
		$criteria->compare('s.title', $this->subCategoryTitle, TRUE, 'OR');
		$criteria->compare('t.brandModelId', $this->brandModelId, FALSE, "AND");
//		$criteria->compare('isTheme', $this->isTheme);
//		$criteria->compare('isSet', $this->isSet);
//		$criteria->compare('status', $this->status);
//		$criteria->compare('createDateTime', $this->createDateTime, true, 'OR');
//		$criteria->compare('updateDateTime', $this->updateDateTime, true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.sortOrder ASC'
			)
		));
	}

	public function findSetAndTheme($categoryId = null)
	{
//		$criteria = new CDbCriteria;
		if(!isset($categoryId))
		{
//			$criteria->compare("t.categoryId", $categoryId);
//		}
//		else
//		{
//			$criteria->compare("t.categoryId", $this->categoryId);
			$categoryId = $this->categoryId;
		}
//		$criteria->compare("t.isType", "0");
//
//		$criteria->addCondition(" (isSet = 1 OR isTheme = 1) ", "AND");
		return $this->find('categoryId = ' . $categoryId . ' and isType = 0');
	}

	public function findSubCatArrayByBrandModelIdAndCategoryId($brandModelId, $categoryId)
	{
		$result = array();
		$models = $this->findAll("brandModelId =" . $brandModelId . " AND categoryId =" . $categoryId);
		foreach($models as $item)
		{
			$result[$item->subCategoryId] = $item->subCategory->title;
		}

		return $result;
	}

}
