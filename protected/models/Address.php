<?php

class Address extends AddressMaster
{
    const ADDRESS_TYPE_BILLING = 1;
    const ADDRESS_TYPE_SHIPPING = 2;

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
	public function dealerProvince()
	{
		$criteria = new CDbCriteria();
		$criteria->with = array(
			'province');
		$criteria->order = 'province.provinceName';
		$criteria->group = 't.provinceId';

		return $this->findAll($criteria);
	}

	public function dealerAmphur($provinceId)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'provinceId=:provinceId';
		$criteria->params = array(
			':provinceId'=>$provinceId);
		$criteria->group = 't.amphurId';

		return $this->findAll($criteria);
	}

	public function getAllDistrict()
	{
		$result = array(
			);
		$district = District::model()->findAll();
		foreach($district as $item)
		{
			$result[$item->districtId] = $item->districtName;
		}

		return $result;
	}

	public function getAllAmphur()
	{
		$result = array(
			);
		$amphur = Amphur::model()->findAll();
		foreach($amphur as $item)
		{
			$result[$item->amphurId] = $item->amphurName;
		}
		return $result;
	}

	public function getAllProvince()
	{
		$result = array(
			);
		$province = Province::model()->findAll();
		foreach($province as $item)
		{
			$result[$item->provinceId] = $item->provinceName;
		}
		return $result;
	}

	public function getProviceById($provinceId)
	{
		$result = array(
			);
		$province = Province::model()->findByPk($provinceId);
		$result[$province->provinceId] = $province->provinceName;
		return $result;
	}

	public function getAmphurById($amphurId)
	{
		$result = array(
			);
		$amphur = Amphur::model()->findByPk($amphurId);
		$result[$amphur->amphurId] = $amphur->amphurName;
		return $result;
	}

	public function getAllAmphurByProvinceId($provinceId)
	{
		$result = array(
			);
		$province = Amphur::model()->findAll("provinceId = :provinceId", array(
			":provinceId"=>$provinceId));
		foreach($province as $item)
		{
			$result[$item->amphurId] = $item->amphurName;
		}
		return $result;
	}

	public function getAllDistrictIdByAmphurId($amphurId)
	{
		$result = array(
			);
		$amphurId = District::model()->findAll("amphurId = :amphurId", array(
			":amphurId"=>$amphurId));
		foreach($amphurId as $item)
		{
			$result[$item->districtId] = $item->districtName;
		}
		return $result;
	}

	//user for select Province when first access application
	public function getAllProvinceHaveDealer()
	{
		$result = array(
			);
		$criteria = new CDbCriteria();
		$criteria->join = " JOIN user u ON u.userId = t.userId ";
		$criteria->condition = "u.Type = 2 AND u.approved = 1 and t.type = 2";
		$criteria->group = "t.provinceId";
		$address = $this->findAll($criteria);
		//$province = Province::model()->findAll();
		foreach($address as $item)
		{
			if(isset($item->province))
			{
				$result[$item->provinceId] = $item->province->provinceName;
			}
		}
		return $result;
	}

	public function getAllProvinceHavePriceList()
	{
		$result = array(
			);
		$criteria = new CDbCriteria();
		$criteria->join = " JOIN user u ON u.userId = t.userId ";
		$criteria->condition = "u.Type = 2 AND u.approved = 1 and t.type = 2";
		$criteria->group = "t.provinceId";
		$address = $this->findAll($criteria);
		//$province = Province::model()->findAll();
		foreach($address as $item)
		{
			$result[$item->provinceId] = $item->province->provinceName;
		}
		return $result;
	}

	public function getAddress()
	{
		$result = $this->address_1 . " " . $this->address_2 . " " . District::model()->findByPk($this->districtId)->districtName . " " . Amphur::model()->findByPk($this->amphurId)->amphurName . " " . Province::model()->findByPk($this->provinceId)->provinceName . " " . $this->postcode;

		return $result;
	}

    public function getAllAddressByType($type)
    {
        $res = [];
        $models = $this->findAll(array(
            'condition' => 'userId=:userId AND type=:type',
            'params' => array(
                ':userId' => Yii::app()->user->id,
                ':type' => $type,
            ),
            'order' => 'addressId'
        ));

        foreach ($models as $model) {
            $company = isset($model->company) ? $model->company . ' ' : '';
            $res[$model->addressId] = $model->firstname . ' ' . $model->lastname . ' :: ' . $company . $model->address_1 . ' ' . $model->address_2 . ' ' .
                $model->district->districtName . ' ' . $model->amphur->amphurName . ' ' . $model->province->provinceName . ' ' . $model->postcode;
        }

        return $res;
    }

}
