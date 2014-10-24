<?php

/**
 * This is the model class for table "order_file".
 *
 * The followings are the available columns in table 'order_file':
 * @property string $orderFileId
 * @property string $orderId
 * @property string $fileName
 * @property string $filePath
 * @property string $senderId
 * @property string $receiverId
 * @property integer $userType
 * @property integer $status
 * @property string $createDateTime
 *
 * The followings are the available model relations:
 * @property Order $order
 */
class OrderFileMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orderId, fileName, filePath, senderId, receiverId, userType, createDateTime', 'required'),
			array('userType, status', 'numerical', 'integerOnly'=>true),
			array('orderId, senderId, receiverId', 'length', 'max'=>20),
			array('fileName', 'length', 'max'=>200),
			array('filePath', 'length', 'max'=>1000),
			array('createDateTime', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('orderFileId, orderId, fileName, filePath, senderId, receiverId, userType, status, createDateTime, searchText', 'safe', 'on'=>'search'),
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
			'order' => array(self::BELONGS_TO, 'Order', 'orderId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'orderFileId' => 'Order File',
			'orderId' => 'Order',
			'fileName' => 'File Name',
			'filePath' => 'File Path',
			'senderId' => 'Sender',
			'receiverId' => 'Receiver',
			'userType' => 'User Type',
			'status' => 'Status',
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
			$this->orderFileId = $this->searchText;
			$this->orderId = $this->searchText;
			$this->fileName = $this->searchText;
			$this->filePath = $this->searchText;
			$this->senderId = $this->searchText;
			$this->receiverId = $this->searchText;
			$this->userType = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
		}

		$criteria->compare('orderFileId',$this->orderFileId,true, 'OR');
		$criteria->compare('orderId',$this->orderId,true, 'OR');
		$criteria->compare('fileName',$this->fileName,true, 'OR');
		$criteria->compare('filePath',$this->filePath,true, 'OR');
		$criteria->compare('senderId',$this->senderId,true, 'OR');
		$criteria->compare('receiverId',$this->receiverId,true, 'OR');
		$criteria->compare('userType',$this->userType);
		$criteria->compare('status',$this->status);
		$criteria->compare('createDateTime',$this->createDateTime,true, 'OR');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderFileMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
