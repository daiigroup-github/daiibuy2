<?php

class Employee extends EmployeeMaster
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
				'manager'=>array(
					self::BELONGS_TO,
					"Employee",
					array(
						'managerId'=>'employeeId')),
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
	public function validatePassword($password)
	{
		return $this->hashPassword($this->username, $password) === $this->password;
	}

	public function hashPassword($username, $password)
	{
		return md5($username . $password);
	}

	public function findAllSaleArray($branchId = null)
	{
		$result = array(
			);
		if(!isset($branchId))
		{
			$sales = $this->findAll('isSale=1 AND status=1 AND companyId in (?)', array(
				Yii::app()->params['companyId']));
		}
		else
		{
			$sales = $this->findAll('isSale=1 AND status=1 AND companyId in (?) AND branchId =?', array(
				Yii::app()->params['companyId'],
				$branchId));
		}

		foreach($sales as $item)
		{
			$result[$item->employeeId] = $item->fnTh . " " . $item->lnTh;
		}
		return $result;
	}

	public function findEmployeeByUsernameAndCompany($username, $companyStr)
	{
		$criteria = new CDbCriteria();
		$criteria->addCondition("username = '$username'");
		$criteria->addCondition("companyId in ($companyStr)");

		return $this->find($criteria);
	}

}
