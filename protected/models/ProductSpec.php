<?php

class ProductSpec extends ProductSpecMaster
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->productSpecId = $this->searchText;
			$this->productSpecGroupId = $this->searchText;
			$this->title = $this->searchText;
			$this->description = $this->searchText;
			$this->image = $this->searchText;
			$this->videoEmbeded = $this->searchText;
			$this->sortOrder = $this->searchText;
			$this->spanWidth = $this->searchText;
			$this->ShowTitleType = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('productSpecId', $this->productSpecId, true, 'OR');
		$criteria->compare('productSpecGroupId', $this->productSpecGroupId, true, 'OR');
		$criteria->compare('title', $this->title, true, 'OR');
		$criteria->compare('description', $this->description, true, 'OR');
		$criteria->compare('image', $this->image, true, 'OR');
		$criteria->compare('videoEmbeded', $this->videoEmbeded, true, 'OR');
		$criteria->compare('sortOrder', $this->sortOrder);
		$criteria->compare('spanWidth', $this->spanWidth);
		$criteria->compare('showTitleType', $this->showTitleType);
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

	public $showTitleTypeArray = array(
		0=>'NONE',
		1=>'TOP',
		2=>'BOTTOM');

	public function findAllShowTitleType()
	{
		return $this->showTitleTypeArray;
	}

	public function getShowTitleTypeText($index)
	{
		return $this->showTitleTypeArray[$index];
	}

}
