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
		$criteria->join = " LEFT JOIN model_to_category1 m ON m.categoryId = t.categoryId ";
		$criteria->join .= " LEFT JOIN category c ON c.categoryId = t.categoryId ";
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
		$criteria->compare('m.brandModelId', $this->brandModelId);

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

}
