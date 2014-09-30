<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property string $orderId
 * @property string $supplierId
 * @property string $title
 * @property integer $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property User $supplier
 * @property OrderGroupToOrder[] $orderGroupToOrders
 */
class Order extends OrderMaster
{

	/**
	 * @return string the associated database table name
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
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
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

	public function findAllMyFileBySupplierId($userId, $supplierId, $type, $status, $token)
	{
		$criteria = new CDbCriteria();
		if(($this->userId == 0))
		{
			$criteria->condition = 'userId = :userId AND supplierId = :supplierId AND type = :type AND status = :status';
			$criteria->params = array(
				':userId'=>$userId,
				':supplierId'=>$supplierId,
				':type'=>$type,
				':status'=>$status,);
		}
		else
		{
			$criteria->condition = 'token = :token AND supplierId = :supplierId AND type = :type AND status = :status';
			$criteria->params = array(
				':token'=>$token,
				':supplierId'=>$supplierId,
				':type'=>$type,
				':status'=>$status,);
		}

		$res = $this->findAll($criteria);

		return $res;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 * public function search()
	 * {
	 * }
	 */
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
}
