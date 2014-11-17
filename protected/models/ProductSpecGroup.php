<?php

class ProductSpecGroup extends ProductSpecGroupMaster
{

	const SPEC_TYPE_DETAIL = 1;
	const SPEC_TYPE_SPEC = 2;

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
				'parent'=>array(
					self::BELONGS_TO,
					'ProductSpecGroupMaster',
					'parentId'),
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
	public $productSpecGroupArray = array(
		1=>"Detail",
		2=>'Specification'
	);

	public function getProductSpecGroupArrayText($index)
	{
		return $this->productSpecGroupArray[$index];
	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->title = $this->searchText;
			$this->description = $this->searchText;
			$this->image = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}
		$criteria->compare('productSpecGroupId', $this->productSpecGroupId, true, 'OR');
		$criteria->compare('productId', $this->productId);
		$criteria->compare('title', $this->title, true, 'OR');
		$criteria->compare('description', $this->description, true, 'OR');
		$criteria->compare('image', $this->image, true, 'OR');
		$criteria->compare('parentId', $this->parentId);
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

}
