<?php

/**
 * This is the model class for table "user_partner".
 *
 * The followings are the available columns in table 'user_partner':
 * @property string $userPartnerId
 * @property string $userId
 * @property string $partnerId
 * @property string $partnerCode
 * @property integer $partnerType
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class UserPartnerMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_partner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, partnerCode, createDateTime, updateDateTime', 'required'),
			array('partnerType, status', 'numerical', 'integerOnly'=>true),
			array('userId, partnerId', 'length', 'max'=>20),
			array('partnerCode', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('userPartnerId, userId, partnerId, partnerCode, partnerType, status, createDateTime, updateDateTime', 'safe', 'on'=>'search'),
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
			'userPartnerId' => 'User Partner',
			'userId' => 'User',
			'partnerId' => 'Partner',
			'partnerCode' => 'Partner Code',
			'partnerType' => 'Partner Type',
			'status' => 'Status',
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

		$criteria->compare('userPartnerId',$this->userPartnerId,true);
		$criteria->compare('userId',$this->userId,true);
		$criteria->compare('partnerId',$this->partnerId,true);
		$criteria->compare('partnerCode',$this->partnerCode,true);
		$criteria->compare('partnerType',$this->partnerType);
		$criteria->compare('status',$this->status);
		$criteria->compare('createDateTime',$this->createDateTime,true);
		$criteria->compare('updateDateTime',$this->updateDateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserPartnerMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
