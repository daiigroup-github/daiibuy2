<?php

/**
 * This is the model class for table "user_file".
 *
 * The followings are the available columns in table 'user_file':
 * @property string $userFileId
 * @property string $userFileName
 * @property integer $type
 * @property integer $status
 * @property integer $isShowInProductView
 * @property integer $isPublic
 * @property string $createDateTime
 */
class UserFileMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userFileName, type, status, createDateTime', 'required'),
			array('type, status, isShowInProductView, isPublic', 'numerical', 'integerOnly'=>true),
			array('userFileName', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('userFileId, userFileName, type, status, isShowInProductView, isPublic, createDateTime, searchText', 'safe', 'on'=>'search'),
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
			'userFileId' => 'User File',
			'userFileName' => 'User File Name',
			'type' => 'Type',
			'status' => 'Status',
			'isShowInProductView' => 'Is Show In Product View',
			'isPublic' => 'Is Public',
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
			$this->userFileId = $this->searchText;
			$this->userFileName = $this->searchText;
			$this->type = $this->searchText;
			$this->status = $this->searchText;
			$this->isShowInProductView = $this->searchText;
			$this->isPublic = $this->searchText;
			$this->createDateTime = $this->searchText;
		}

		$criteria->compare('userFileId',$this->userFileId,true, 'OR');
		$criteria->compare('userFileName',$this->userFileName,true, 'OR');
		$criteria->compare('type',$this->type);
		$criteria->compare('status',$this->status);
		$criteria->compare('isShowInProductView',$this->isShowInProductView);
		$criteria->compare('isPublic',$this->isPublic);
		$criteria->compare('createDateTime',$this->createDateTime,true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserFileMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
