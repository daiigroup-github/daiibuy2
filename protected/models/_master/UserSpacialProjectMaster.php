<?php

/**
 * This is the model class for table "user_spacial_project".
 *
 * The followings are the available columns in table 'user_spacial_project':
 * @property string $userSpacialProjectId
 * @property string $supplierId
 * @property string $userId
 * @property string $orderGroupId
 * @property string $orderId
 * @property string $supplierSpacialProjectId
 * @property string $spacialCode
 * @property string $spacialPercent
 * @property string $image
 * @property string $remark
 * @property integer $reQuestNo
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class UserSpacialProjectMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_spacial_project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('supplierId, userId, orderGroupId, orderId, supplierSpacialProjectId, createDateTime, updateDateTime', 'required'),
			array('reQuestNo, status', 'numerical', 'integerOnly'=>true),
			array('supplierId, userId, orderGroupId, orderId, supplierSpacialProjectId', 'length', 'max'=>20),
			array('spacialCode', 'length', 'max'=>50),
			array('spacialPercent', 'length', 'max'=>5),
			array('image', 'length', 'max'=>255),
			array('remark', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('userSpacialProjectId, supplierId, userId, orderGroupId, orderId, supplierSpacialProjectId, spacialCode, spacialPercent, image, remark, reQuestNo, status, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
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
			'userSpacialProjectId' => 'User Spacial Project',
			'supplierId' => 'Supplier',
			'userId' => 'User',
			'orderGroupId' => 'Order Group',
			'orderId' => 'Order',
			'supplierSpacialProjectId' => 'Supplier Spacial Project',
			'spacialCode' => 'Spacial Code',
			'spacialPercent' => 'Spacial Percent',
			'image' => 'Image',
			'remark' => 'Remark',
			'reQuestNo' => 'Re Quest No',
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

		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->userSpacialProjectId = $this->searchText;
			$this->supplierId = $this->searchText;
			$this->userId = $this->searchText;
			$this->orderGroupId = $this->searchText;
			$this->orderId = $this->searchText;
			$this->supplierSpacialProjectId = $this->searchText;
			$this->spacialCode = $this->searchText;
			$this->spacialPercent = $this->searchText;
			$this->image = $this->searchText;
			$this->remark = $this->searchText;
			$this->reQuestNo = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('userSpacialProjectId',$this->userSpacialProjectId,true, 'OR');
		$criteria->compare('supplierId',$this->supplierId,true, 'OR');
		$criteria->compare('userId',$this->userId,true, 'OR');
		$criteria->compare('orderGroupId',$this->orderGroupId,true, 'OR');
		$criteria->compare('orderId',$this->orderId,true, 'OR');
		$criteria->compare('supplierSpacialProjectId',$this->supplierSpacialProjectId,true, 'OR');
		$criteria->compare('spacialCode',$this->spacialCode,true, 'OR');
		$criteria->compare('spacialPercent',$this->spacialPercent,true, 'OR');
		$criteria->compare('image',$this->image,true, 'OR');
		$criteria->compare('remark',$this->remark,true, 'OR');
		$criteria->compare('reQuestNo',$this->reQuestNo);
		$criteria->compare('status',$this->status);
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
	 * @return UserSpacialProjectMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
