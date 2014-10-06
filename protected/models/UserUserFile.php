<?php

/**
 * This is the model class for table "user_user_file".
 *
 * The followings are the available columns in table 'user_user_file':
 * @property string $id
 * @property string $userId
 * @property string $userFileId
 * @property string $filePath
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class UserUserFile extends UserUserFileMaster
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserUserFile the static model class
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
		return 'user_user_file';
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
				'userId, userFileId, status, createDateTime',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly'=>true),
			array(
				'userId, userFileId',
				'length',
				'max'=>20),
			array(
				'filePath',
				'length',
				'max'=>2000),
			array(
				'updateDateTime',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'id, userId, userFileId, filePath, status, createDateTime, updateDateTime',
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
			'userFile'=>array(
				self::BELONGS_TO,
				'UserFile',
				'userFileId'),
			'user'=>array(
				self::BELONGS_TO,
				'User',
				'userId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'=>'ID',
			'userId'=>'User',
			'userFileId'=>'User File',
			'filePath'=>'File Path',
			'status'=>'Status',
			'createDateTime'=>'Create Date Time',
			'updateDateTime'=>'Update Date Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('userId', $this->userId, true);
		$criteria->compare('userFileId', $this->userFileId, true);
		$criteria->compare('filePath', $this->filePath, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('createDateTime', $this->createDateTime, true);
		$criteria->compare('updateDateTime', $this->updateDateTime, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
