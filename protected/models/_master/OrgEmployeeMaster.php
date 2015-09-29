<?php

/**
 * This is the model class for table "org_employee".
 *
 * The followings are the available columns in table 'org_employee':
 * @property string $orgEmployeeId
 * @property string $orgId
 * @property string $code
 * @property string $email
 * @property string $name
 * @property string $employeeCode
 * @property string $image
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class OrgEmployeeMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'org_employee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orgId, email, name, employeeCode, image, createDateTime, updateDateTime', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('orgId', 'length', 'max'=>20),
			array('code, employeeCode', 'length', 'max'=>45),
			array('email, name', 'length', 'max'=>200),
			array('image', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('orgEmployeeId, orgId, code, email, name, employeeCode, image, status, createDateTime, updateDateTime', 'safe', 'on'=>'search'),
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
			'orgEmployeeId' => 'Org Employee',
			'orgId' => 'Org',
			'code' => 'Code',
			'email' => 'Email',
			'name' => 'Name',
			'employeeCode' => 'Employee Code',
			'image' => 'Image',
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

		$criteria->compare('orgEmployeeId',$this->orgEmployeeId,true);
		$criteria->compare('orgId',$this->orgId,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('employeeCode',$this->employeeCode,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('createDateTime',$this->createDateTime,true);
		$criteria->compare('updateDateTime',$this->updateDateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->org;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrgEmployeeMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
