<?php

/**
 * This is the model class for table "price_group".
 *
 * The followings are the available columns in table 'price_group':
 * @property string $priceGroupId
 * @property string $priceGroupName
 * @property string $priceRate
 * @property integer $status
 */
class PriceGroup extends PriceGroupMaster
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PriceGroup the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'price_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(
				'priceGroupName',
				'required'),
//			array(
//				'status, priceRate',
//				'numerical',
//				'integerOnly' => true),
			array(
				'priceGroupName',
				'length',
				'max'=>500),
			array(
				'priceRate',
				'length',
				'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'priceGroupId, priceGroupName, priceRate, status, searchText',
				'safe',
				'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'price'=>array(
				self::HAS_MANY,
				'Price',
				'priceGroupId',), //	'group' => 'price.provinceId',)
			'priceGroupProvince'=>array(
				self::HAS_MANY,
				'Price',
				'priceGroupId',
				'group'=>'provinceId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'priceGroupId'=>'Price Group',
			'priceGroupName'=>'Price Group Name',
			'priceRate'=>'Price Rate',
			'status'=>'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($supplierId = NULL)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;
		if(isset($this->searchText) && !empty($this->searchText))
		{
//			$this->priceGroupId = $this->searchText;
			$this->priceGroupName = $this->searchText;
//			$this->priceRate = $this->searchText;
//			$this->status = $this->searchText;
		}
		$criteria->compare('priceGroupId', $this->priceGroupId, true, 'OR');
		$criteria->compare('priceGroupName', $this->priceGroupName, true, 'OR');
		$criteria->compare('priceRate', $this->priceRate, true, 'OR');
		$criteria->compare('status', $this->status);
		if(isset(Yii::app()->user->supplierId))
		{
			if(Yii::app()->user->userType != 4)
				$criteria->compare('supplierId', Yii::app()->user->supplierId);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	//custom
	public function getAllPriceGroup($supplierId = NULL)
	{
		$criteria = new CDbCriteria();
		if(isset($supplierId))
			if(!(User::model()->findByPk($supplierId)->type == 4))
			{
				$criteria->compare("supplierId", $supplierId);
			}

		$models = $this->findAll($criteria);

		$res = array(
			);

		foreach($models as $model)
		{
			$res[$model->priceGroupId] = $model->priceGroupName;
		}

		return $res;
	}

}
