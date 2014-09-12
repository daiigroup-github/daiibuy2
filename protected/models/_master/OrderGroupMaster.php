<?php

/**
 * This is the model class for table "order_group".
 *
 * The followings are the available columns in table 'order_group':
 * @property string $orderGroupId
 * @property string $userId
 * @property string $Ordercol
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property OrderGroupToOrder[] $orderGroupToOrders
 */
class OrderGroupMaster extends MasterCActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(
				'userId',
				'required'
			),
			array(
				'userId',
				'length',
				'max'=>20
			),
			array(
				'Ordercol',
				'length',
				'max'=>45
			),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array(
				'orderGroupId, userId, Ordercol, searchText',
				'safe',
				'on'=>'search'
			),
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
			'orderGroupToOrders'=>array(
				self::HAS_MANY,
				'OrderGroupToOrder',
				'orderGroupId'
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'orderGroupId'=>'Order Group',
			'userId'=>'User',
			'Ordercol'=>'Ordercol',
			'createDateTime'=>'Create Date Time',
			'updateDateTime'=>'Update Date Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;
		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->orderGroupId = $this->searchText;
			$this->userId = $this->searchText;
			$this->Ordercol = $this->searchText;
		}

		$criteria->compare('orderGroupId', $this->orderGroupId, true, 'OR');
		$criteria->compare('userId', $this->userId, true, 'OR');
		$criteria->compare('Ordercol', $this->Ordercol, true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderGroupMaster the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

}
