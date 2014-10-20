<?php

/**
 * This is the model class for table "user_reward".
 *
 * The followings are the available columns in table 'user_reward':
 * @property string $userRewardId
 * @property string $userId
 * @property string $orderId
 * @property string $description
 * @property integer $points
 * @property integer $remainingPoints
 * @property integer $status
 * @property string $expiredDate
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class UserRewardMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_reward';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, orderId, points, remainingPoints, expiredDate, updateDateTime', 'required'),
			array('points, remainingPoints, status', 'numerical', 'integerOnly'=>true),
			array('userId, orderId', 'length', 'max'=>20),
			array('description, createDateTime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('userRewardId, userId, orderId, description, points, remainingPoints, status, expiredDate, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
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
			'userRewardId' => 'User Reward',
			'userId' => 'User',
			'orderId' => 'Order',
			'description' => 'Description',
			'points' => 'Points',
			'remainingPoints' => 'Remaining Points',
			'status' => 'Status',
			'expiredDate' => 'Expired Date',
			'createDateTime' => 'Create Date Time',
			'updateDateTime' => 'Update Date Time',
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
			$this->userRewardId = $this->searchText;
			$this->userId = $this->searchText;
			$this->orderId = $this->searchText;
			$this->description = $this->searchText;
			$this->points = $this->searchText;
			$this->remainingPoints = $this->searchText;
			$this->status = $this->searchText;
			$this->expiredDate = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('userRewardId',$this->userRewardId,true, 'OR');
		$criteria->compare('userId',$this->userId,true, 'OR');
		$criteria->compare('orderId',$this->orderId,true, 'OR');
		$criteria->compare('description',$this->description,true, 'OR');
		$criteria->compare('points',$this->points);
		$criteria->compare('remainingPoints',$this->remainingPoints);
		$criteria->compare('status',$this->status);
		$criteria->compare('expiredDate',$this->expiredDate,true, 'OR');
		$criteria->compare('createDateTime',$this->createDateTime,true, 'OR');
		$criteria->compare('updateDateTime',$this->updateDateTime,true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserRewardMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
