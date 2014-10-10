<?php

class User extends UserMaster
{

	public $confirmPassword;
	public $company;

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
				'billingAddress'=>array(
					self::BELONGS_TO,
					'Address',
					array(
						'userId'=>'userId'),
					'condition'=>'billingAddress.type=1'),
				'shippingAddress'=>array(
					self::BELONGS_TO,
					'Address',
					array(
						'userId'=>'userId'),
					'condition'=>'shippingAddress.type=2'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return Cmap::mergeArray(parent::attributeLabels(), array(
				//code here
				'confirmPassword'=>'Confirm Password',
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 * public function search()
	 * {
	 * }
	 */
	public function getAllUserType()
	{
		$result = array(
			);
		$result[1] = "User";
		$result[2] = "Distributor";
		$result[3] = "Supplier";
		//if(Yii::app()->isAdmin)
		$result[4] = "Admin";
		$result[5] = "Finance Admin";
		$result[6] = "Assign Admin";

		return $result;
	}

	public function getMarginUserType()
	{
		$result = array(
			);
		$result[1] = "User Reward";
		$result[2] = "Margin to Distributor";
		$result[3] = "Margin to DaiiBuy.com";
		return $result;
	}

	public function getRegisterUserType()
	{
		$result = array(
			);
		if(isset(yii::app()->user->id))
			if(User::model()->findByPk(Yii::app()->user->id)->type == 6)
			{
				$result[2] = "Distributor";
				return $result;
			}

		$result[2] = "Distributor";
		$result[3] = "Supplier";

		return $result;
	}

	public function getAllDealerWithAmphur($amphurId = null)
	{
		$criteria = new CDbCriteria;
		$criteria->select = "t.userId, a.company";
		$criteria->join = "JOIN address a on a.userId = t.userId ";
		$criteria->condition = "t.type = 2 AND t.status = 1 AND t.approved = 1 ";
		if(isset($amphurId))
		{
			$criteria->condition .= "  AND a.amphurId = :amphurId ";
			$criteria->params = array(
				":amphurId"=>$amphurId);
		}

		return $this->findAll($criteria);
	}

	public function validatePassword($password)
	{
		return $this->hashPassword($this->email, $password) === $this->password;
	}

	public function hashPassword($email, $password)
	{
		return md5($email . $password);
	}

	public function showUserType($type)
	{
		switch($type)
		{
			case 1:
				return "User";
				break;
			case 2:
				return "Distributor";
				break;
			case 3:
				return "Supplier";
				break;
			case 4:
				return "Admin";
				break;
			case 5:
				return "Finance Admin";
			case 6:
				return "Assign Admin";
		}
	}

	public function findAllSupplierDataByAmphurIdAndSubCategoryId($amphurId, $searchText = '', $categoryId = null, $brandId = null, $dateNow)
	{
		$criteria = new CDbCriteria();
		$criteria->select = "t.userId , t.firstname ,t.lastname ,t.logo ,t.description ,a.type , a.company as company";
		$criteria->join = "LEFT JOIN address a ON t.userId = a.userId ";
		$criteria->join .= "LEFT JOIN product pr ON t.userId = pr.supplierId ";
		$criteria->join .= 'LEFT JOIN price_group pg ON pr.priceGroupId=pg.priceGroupId ';
		$criteria->join .= 'LEFT JOIN price p ON p.priceGroupId=pg.priceGroupId';
		$criteria->condition = 'pr.status = 2 AND p.amphurId=:amphurId AND pr.quantity > 0 AND t.approved = 1 AND pr.dateAvailable <= ' . $dateNow;

		if(isset($categoryId))
			$criteria->condition .= ' AND pr.categoryId=' . $categoryId;

		if(isset($brandId))
			$criteria->condition .= ' AND pr.brandId=' . $brandId;

		$criteria->params = array(
			':amphurId'=>$amphurId,
			//':searchText' => '%' . $searchText . '%'
		);
		$criteria->group = "t.userId";
		$criteria->order = 'pr.productId';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>12),
		));
	}

	public function showUserCompany($id)
	{
		$criteria = new CDbCriteria();
		$criteria->select = "a.company as company ";
		$criteria->join = "LEFT JOIN address a ON t.userId = a.userId ";
		$criteria->condition = 't.userId = ' . $id;
		$result = $this->findAll($criteria);
		return $result[0]["company"];
	}

	public function showUserAddress($id)
	{
//		$user = User::model()->findByPk($id);
		$userAddress = Address::model()->find('userId = ' . $id . ' and type=1');
		$result = $userAddress->address_1 . " " . $userAddress->district->districtName . " " . $userAddress->amphur->amphurName . " " . $userAddress->province->provinceName . " " . $userAddress->postcode;
		return $result;
	}

	public function findAllDistributorByAmphurId($amphurId)
	{
		//$amphurs = Amphur::model()->findAll("provinceId=:provinceId", array(":provinceId" => (int)$provinceId));
		$criteria = new CDbCriteria();
		$criteria->join = " JOIN address a ON a.userId = t.userId ";
		$criteria->condition = "a.Type = 2 AND a.amphurId = :amphurId AND t.approved = 1 AND t.type = 2";
		$criteria->params = array(
			":amphurId"=>$amphurId);
		return User::model()->findAll($criteria);
	}

	public function findAllDistributorByProvinceId($provinceId, $isCheckOut = FALSE)
	{
		//$amphurs = Amphur::model()->findAll("provinceId=:provinceId", array(":provinceId" => (int)$provinceId));
		$criteria = new CDbCriteria();
		if($isCheckOut)
		{
			$criteria->select = "t.userId, a.company";
		}
		$criteria->join = " JOIN address a ON a.userId = t.userId ";
		$criteria->condition = "a.Type = 2 AND a.provinceId = :provinceId AND t.approved = 1 AND t.type = 2";
		$criteria->params = array(
			":provinceId"=>$provinceId);
		return User::model()->findAll($criteria);
	}

	public function findAllSupplierApprovedArray()
	{
		$result = array();
		$criteria = new CDbCriteria();
		$criteria->select = " t.userId , a.company as company , t.email ";
		$criteria->join = " LEFT JOIN address a ON a.userId = t.userId";
		$criteria->compare("t.status", 1);
		$criteria->compare("t.approved", 1);
		$criteria->compare("t.type", 3);
		$criteria->compare("a.type", 1);
		$suppliers = $this->findAll($criteria);
		foreach($suppliers as $item)
		{
			$result[$item->userId] = $item->company . "->" . $item->email;
		}

		return $result;
	}

	public function findAllAdminAssignArray()
	{
		$res = array();
		foreach($this->findAll('status =1 AND approved = 1 AND type = 6') as $item)
		{
			$res[$item->userId] = $item->firstname . " " . $item->lastname;
		}
		return $res;
	}

	public function findAllSupplierHasRedirectURL()
	{
		$res = array();
		$i = 0;
		foreach($this->findAll('redirectURL is not null') as $item)
		{
			$res[$i] = $item->userId;
			$i++;
		}
		return $res;
	}

	public function findAllSupplierArray($returnEmail = false)
	{
		$result = array();
		if(!$returnEmail)
		{
			foreach($this->findAll('status = 1 and type = 3') as $item)
			{
				$result[$item->userId] = User::model()->showUserCompany($item->userId);
			}
		}
		else
		{
			foreach($this->findAll('status = 1 and type = 3') as $item)
			{
				$result[$item->userId] = $item->email;
			}
		}

		return $result;
	}

}
