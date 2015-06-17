<?php

class ModelToCategory1 extends ModelToCategory1Master
{

	public $categoryTitle;

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
					'categoryTitle',
					'safe',
					'on'=>'search')
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
			$this->categoryTitle = $this->searchText;
//			$this->id = $this->searchText;
//			$this->brandModelId = $this->searchText;
//			$this->categoryId = $this->searchText;
//			$this->sortOrder = $this->searchText;
//			$this->status = $this->searchText;
//			$this->createDateTime = $this->searchText;
//			$this->updateDateTime = $this->searchText;
		}
		$criteria->join = " LEFT JOIN category c ON c.categoryId = t.categoryId ";
		$criteria->compare('c.title', $this->categoryTitle, true, 'OR');
		$criteria->compare('id', $this->id, true, 'OR');
		$criteria->compare('brandModelId', $this->brandModelId);
		$criteria->compare('categoryId', $this->categoryId, true, 'OR');
//		$criteria->compare('sortOrder', $this->sortOrder);
//		$criteria->compare('status', $this->status);
		$criteria->compare('createDateTime', $this->createDateTime, true, 'OR');
		$criteria->compare('updateDateTime', $this->updateDateTime, true, 'OR');


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'sortOrder ASC'),
		));
	}

	public function findAllCatArrayFromBrandModelId($brandModelId)
	{
		$result = array();
		$models = $this->findAll("brandModelId =" . $brandModelId);

		foreach($models as $item)
		{
			$result[$item->categoryId] = $item->category->title;
		}
		return $result;
	}

}
