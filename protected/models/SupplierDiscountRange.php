<?php

class SupplierDiscountRange extends SupplierDiscountRangeMaster
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
	private function findMaxRange($supplierId)
	{
		return $this->find(array(
				'condition'=>'supplierId=:supplierId',
				'params'=>array(
					':supplierId'=>$supplierId,
				),
				'order'=>'max DESC'
		));
	}

	private function findMinRange($supplierId)
	{
		return $this->find(array(
				'condition'=>'supplierId=:supplierId',
				'params'=>array(
					':supplierId'=>$supplierId,
				),
				'order'=>'min'
		));
	}

	public function findDiscountPercent($supplierId, $total)
	{
		$max = $this->findMaxRange($supplierId);
		$min = $this->findMinRange($supplierId);

		if($total > $min->min)
		{
			if($total > $max->max)
			{
				return $max->percentDiscount;
			}
			else
			{
				$model = $this->find(array(
					'condition'=>'supplierId=:supplierId AND (:total BETWEEN min AND max)',
					'params'=>array(
						':total'=>$total,
						':supplierId'=>$supplierId,
					)
				));

				return $model->percentDiscount;
			}
		}

		return 0;
	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->min = $this->searchText;
			$this->max = $this->searchText;
			$this->percentDiscount = $this->searchText;
		}

		$criteria->compare('id', $this->id, true, 'OR');
		$criteria->compare('supplierId', $this->supplierId);
		$criteria->compare('min', $this->min, true, 'OR');
		$criteria->compare('max', $this->max, true, 'OR');
		$criteria->compare('percentDiscount', $this->percentDiscount);
		$criteria->compare('status', $this->status);
		$criteria->compare('createDateTime', $this->createDateTime, true, 'OR');
		$criteria->compare('updateDateTime', $this->updateDateTime, true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
