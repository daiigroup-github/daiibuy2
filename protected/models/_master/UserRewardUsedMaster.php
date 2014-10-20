<?php

/**
 * This is the model class for table "user_reward_used".
 *
 * The followings are the available columns in table 'user_reward_used':
 * @property string $id
 * @property string $userRewardId
 * @property string $orderId
 * @property integer $usedPoints
 * @property string $createDateTime
 */
class UserRewardUsedMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_reward_used';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userRewardId, orderId, usedPoints', 'required'),
			array('usedPoints', 'numerical', 'integerOnly'=>true),
			array('userRewardId, orderId', 'length', 'max'=>20),
			array('createDateTime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, userRewardId, orderId, usedPoints, createDateTime, searchText', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userRewardId' => 'User Reward',
			'orderId' => 'Order',
			'usedPoints' => 'Used Points',
			'createDateTime' => 'Create Date Time',
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

		$criteria=new CDbCriteria;

		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->id = $this->searchText;
			$this->userRewardId = $this->searchText;
			$this->orderId = $this->searchText;
			$this->usedPoints = $this->searchText;
			$this->createDateTime = $this->searchText;
		}

		$criteria->compare('id',$this->id,true, 'OR');
		$criteria->compare('userRewardId',$this->userRewardId,true, 'OR');
		$criteria->compare('orderId',$this->orderId,true, 'OR');
		$criteria->compare('usedPoints',$this->usedPoints);
		$criteria->compare('createDateTime',$this->createDateTime,true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserRewardUsedMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
