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
class UserFile extends UserFileMaster
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserFile the static model class
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
			array(
				'userFileName, type, status, createDateTime',
				'required'),
			array(
				'type, status, isShowInProductView, isPublic',
				'numerical',
				'integerOnly'=>true),
			array(
				'userFileName',
				'length',
				'max'=>500),
			// The following rule is used by search().
// Please remove those attributes that should not be searched.
			array(
				'userFileId, userFileName, type, status, isShowInProductView, isPublic, createDateTime',
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
			);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userFileId'=>'User File',
			'userFileName'=>'User File Name',
			'type'=>'Type',
			'status'=>'Status',
			'isShowInProductView'=>'แสดงในหน้าดูสินค้า',
			'isPublic'=>'แสดงต่อคนอื่น',
			'createDateTime'=>'Create Date Time',
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

		$criteria->compare('userFileId', $this->userFileId, true);
		$criteria->compare('userFileName', $this->userFileName, true);
		$criteria->compare('type', $this->type);
		$criteria->compare('status', $this->status);
		$criteria->compare('isShowInProductView', $this->isShowInProductView);
		$criteria->compare('isPublic', $this->isPublic);
		$criteria->compare('createDateTime', $this->createDateTime, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getProductViewFromUserFile($id)
	{
//		$criteria = new CDbCriteria();
//		$criteria->join = "JOIN user_user_file uf ON uf.userFileId = t.userFileId JOIN user u ON u.userId = uf.userId";
//		$criteria->select = "t.userFileName, uf.filePath";
//		$criteria->condition = "t.isShowInProductView = 1 AND u.userId = :userId";
//		$criteria->params = array(
//			":userId" => $id);
//		$res = $this->findAll($criteria);




		$res = Yii::app()->db->createCommand()
			->select('t.userFileName as fileName, uf.filePath as filePath')
			->from('user_file t')
			->join('user_user_file uf', 't.userFileId = uf.userFileId')
			->join('user u', 'u.userId = uf.userId')
			->where('t.isShowInProductView = 1 and uf.filePath is not null and u.userId = :userId', array(
				':userId'=>$id))
			->queryAll();
		return $res;
	}

}
