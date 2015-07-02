<?php

/**
 * This is the model class for table "order_group_send_work".
 *
 * The followings are the available columns in table 'order_group_send_work':
 * @property string $orderGroupSendWorkId
 * @property string $orderGroupId
 * @property integer $seq
 * @property string $title
 * @property string $image
 * @property string $remark
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class OrderGroupSendWorkMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_group_send_work';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orderGroupId, seq, title, image, createDateTime, updateDateTime', 'required'),
			array('seq, status', 'numerical', 'integerOnly'=>true),
			array('orderGroupId', 'length', 'max'=>20),
			array('title', 'length', 'max'=>200),
			array('image', 'length', 'max'=>255),
			array('remark', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('orderGroupSendWorkId, orderGroupId, seq, title, image, remark, status, createDateTime, updateDateTime', 'safe', 'on'=>'search'),
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
			'orderGroupSendWorkId' => 'Order Group Send Work',
			'orderGroupId' => 'Order Group',
			'seq' => 'Seq',
			'title' => 'Title',
			'image' => 'Image',
			'remark' => 'Remark',
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

		$criteria->compare('orderGroupSendWorkId',$this->orderGroupSendWorkId,true);
		$criteria->compare('orderGroupId',$this->orderGroupId,true);
		$criteria->compare('seq',$this->seq);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('remark',$this->remark,true);
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
	 * @return OrderGroupSendWorkMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
