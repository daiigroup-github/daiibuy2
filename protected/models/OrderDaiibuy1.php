<?php

class OrderDaiibuy1 extends OrderDaiibuy1Master
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
	  public function search()
	  {
	  }
	 */
	public function findAllOldPurchesedOrder()
	{
		$today = date('Y-m-d');
		$lastYear = date('Y-m-d', strtotime($today . ' -12 months'));
		$criteria = new CDbCriteria;
		$criteria->condition = " orderStatusId > 1  AND updateDateTime BETWEEN :lastYear AND :today AND comment is null";

		if(isset($this->email))
		{
			$criteria->condition.=" AND email like :email";
		}
		$criteria->params = array(
			":lastYear"=>$lastYear,
			':today'=>$today
		);

		if(isset($this->email))
		{
			$criteria->params[":email"] = $this->email;
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function behaviors()
	{
		return array(
			'ERememberFiltersBehavior'=>array(
				'class'=>'application.components.ERememberFiltersBehavior',
				'defaults'=>array(
				),
				/* optional line */
				'defaultStickOnClear'=>false /* optional line */
			),);
	}

}
