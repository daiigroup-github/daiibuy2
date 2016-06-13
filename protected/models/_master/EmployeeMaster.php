<?php

/**
 * This is the model class for table "employee".
 *
 * The followings are the available columns in table 'employee':
 * @property string $employeeId
 * @property string $employeeCode
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $isFirstLogin
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $prefix
 * @property string $prefixOther
 * @property string $fnTh
 * @property string $lnTh
 * @property string $nickName
 * @property string $fnEn
 * @property string $lnEn
 * @property integer $gender
 * @property string $citizenId
 * @property string $citizenIdExpire
 * @property string $accountNo
 * @property string $ext
 * @property string $mobile
 * @property integer $employeeLevelId
 * @property string $position
 * @property integer $companyId
 * @property string $companyValue
 * @property integer $branchId
 * @property string $branchValue
 * @property integer $companyDivisionId
 * @property string $managerId
 * @property string $startDate
 * @property string $proDate
 * @property string $transferDate
 * @property string $endDate
 * @property string $birthDate
 * @property integer $isSale
 * @property integer $isEngineer
 * @property integer $leaveQuota
 * @property string $leaveRemain
 * @property integer $isManager
 * @property string $lastChangePasswordDateTime
 * @property integer $loginFailed
 */
class EmployeeMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employeeCode, createDateTime, updateDateTime, username, password, email, prefix, fnTh, lnTh, fnEn, lnEn, gender, employeeLevelId, position, companyId, companyValue, branchId, branchValue, companyDivisionId, managerId, startDate, proDate, transferDate, endDate, birthDate, lastChangePasswordDateTime, loginFailed', 'required'),
			array('status, isFirstLogin, prefix, gender, employeeLevelId, companyId, branchId, companyDivisionId, isSale, isEngineer, leaveQuota, isManager, loginFailed', 'numerical', 'integerOnly'=>true),
			array('employeeCode, username, ext, branchValue, managerId', 'length', 'max'=>10),
			array('password, prefixOther', 'length', 'max'=>40),
			array('email, fnTh, fnEn', 'length', 'max'=>80),
			array('lnTh, lnEn, position', 'length', 'max'=>120),
			array('nickName', 'length', 'max'=>45),
			array('citizenId, citizenIdExpire, accountNo', 'length', 'max'=>50),
			array('mobile, companyValue', 'length', 'max'=>20),
			array('leaveRemain', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('employeeId, employeeCode, status, createDateTime, updateDateTime, isFirstLogin, username, password, email, prefix, prefixOther, fnTh, lnTh, nickName, fnEn, lnEn, gender, citizenId, citizenIdExpire, accountNo, ext, mobile, employeeLevelId, position, companyId, companyValue, branchId, branchValue, companyDivisionId, managerId, startDate, proDate, transferDate, endDate, birthDate, isSale, isEngineer, leaveQuota, leaveRemain, isManager, lastChangePasswordDateTime, loginFailed, searchText', 'safe', 'on'=>'search'),
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
			'employeeId' => 'Employee',
			'employeeCode' => 'Employee Code',
			'status' => 'Status',
			'createDateTime' => 'Create Date Time',
			'updateDateTime' => 'Update Date Time',
			'isFirstLogin' => 'Is First Login',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'prefix' => 'Prefix',
			'prefixOther' => 'Prefix Other',
			'fnTh' => 'Fn Th',
			'lnTh' => 'Ln Th',
			'nickName' => 'Nick Name',
			'fnEn' => 'Fn En',
			'lnEn' => 'Ln En',
			'gender' => 'Gender',
			'citizenId' => 'Citizen',
			'citizenIdExpire' => 'Citizen Id Expire',
			'accountNo' => 'Account No',
			'ext' => 'Ext',
			'mobile' => 'Mobile',
			'employeeLevelId' => 'Employee Level',
			'position' => 'Position',
			'companyId' => 'Company',
			'companyValue' => 'Company Value',
			'branchId' => 'Branch',
			'branchValue' => 'Branch Value',
			'companyDivisionId' => 'Company Division',
			'managerId' => 'Manager',
			'startDate' => 'Start Date',
			'proDate' => 'Pro Date',
			'transferDate' => 'Transfer Date',
			'endDate' => 'End Date',
			'birthDate' => 'Birth Date',
			'isSale' => 'Is Sale',
			'isEngineer' => 'Is Engineer',
			'leaveQuota' => 'Leave Quota',
			'leaveRemain' => 'Leave Remain',
			'isManager' => 'Is Manager',
			'lastChangePasswordDateTime' => 'Last Change Password Date Time',
			'loginFailed' => 'Login Failed',
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
			$this->employeeId = $this->searchText;
			$this->employeeCode = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
			$this->isFirstLogin = $this->searchText;
			$this->username = $this->searchText;
			$this->password = $this->searchText;
			$this->email = $this->searchText;
			$this->prefix = $this->searchText;
			$this->prefixOther = $this->searchText;
			$this->fnTh = $this->searchText;
			$this->lnTh = $this->searchText;
			$this->nickName = $this->searchText;
			$this->fnEn = $this->searchText;
			$this->lnEn = $this->searchText;
			$this->gender = $this->searchText;
			$this->citizenId = $this->searchText;
			$this->citizenIdExpire = $this->searchText;
			$this->accountNo = $this->searchText;
			$this->ext = $this->searchText;
			$this->mobile = $this->searchText;
			$this->employeeLevelId = $this->searchText;
			$this->position = $this->searchText;
			$this->companyId = $this->searchText;
			$this->companyValue = $this->searchText;
			$this->branchId = $this->searchText;
			$this->branchValue = $this->searchText;
			$this->companyDivisionId = $this->searchText;
			$this->managerId = $this->searchText;
			$this->startDate = $this->searchText;
			$this->proDate = $this->searchText;
			$this->transferDate = $this->searchText;
			$this->endDate = $this->searchText;
			$this->birthDate = $this->searchText;
			$this->isSale = $this->searchText;
			$this->isEngineer = $this->searchText;
			$this->leaveQuota = $this->searchText;
			$this->leaveRemain = $this->searchText;
			$this->isManager = $this->searchText;
			$this->lastChangePasswordDateTime = $this->searchText;
			$this->loginFailed = $this->searchText;
		}

		$criteria->compare('employeeId',$this->employeeId,true, 'OR');
		$criteria->compare('employeeCode',$this->employeeCode,true, 'OR');
		$criteria->compare('status',$this->status);
		$criteria->compare('createDateTime',$this->createDateTime,true, 'OR');
		$criteria->compare('updateDateTime',$this->updateDateTime,true, 'OR');
		$criteria->compare('isFirstLogin',$this->isFirstLogin);
		$criteria->compare('username',$this->username,true, 'OR');
		$criteria->compare('password',$this->password,true, 'OR');
		$criteria->compare('email',$this->email,true, 'OR');
		$criteria->compare('prefix',$this->prefix);
		$criteria->compare('prefixOther',$this->prefixOther,true, 'OR');
		$criteria->compare('fnTh',$this->fnTh,true, 'OR');
		$criteria->compare('lnTh',$this->lnTh,true, 'OR');
		$criteria->compare('nickName',$this->nickName,true, 'OR');
		$criteria->compare('fnEn',$this->fnEn,true, 'OR');
		$criteria->compare('lnEn',$this->lnEn,true, 'OR');
		$criteria->compare('gender',$this->gender);
		$criteria->compare('citizenId',$this->citizenId,true, 'OR');
		$criteria->compare('citizenIdExpire',$this->citizenIdExpire,true, 'OR');
		$criteria->compare('accountNo',$this->accountNo,true, 'OR');
		$criteria->compare('ext',$this->ext,true, 'OR');
		$criteria->compare('mobile',$this->mobile,true, 'OR');
		$criteria->compare('employeeLevelId',$this->employeeLevelId);
		$criteria->compare('position',$this->position,true, 'OR');
		$criteria->compare('companyId',$this->companyId);
		$criteria->compare('companyValue',$this->companyValue,true, 'OR');
		$criteria->compare('branchId',$this->branchId);
		$criteria->compare('branchValue',$this->branchValue,true, 'OR');
		$criteria->compare('companyDivisionId',$this->companyDivisionId);
		$criteria->compare('managerId',$this->managerId,true, 'OR');
		$criteria->compare('startDate',$this->startDate,true, 'OR');
		$criteria->compare('proDate',$this->proDate,true, 'OR');
		$criteria->compare('transferDate',$this->transferDate,true, 'OR');
		$criteria->compare('endDate',$this->endDate,true, 'OR');
		$criteria->compare('birthDate',$this->birthDate,true, 'OR');
		$criteria->compare('isSale',$this->isSale);
		$criteria->compare('isEngineer',$this->isEngineer);
		$criteria->compare('leaveQuota',$this->leaveQuota);
		$criteria->compare('leaveRemain',$this->leaveRemain,true, 'OR');
		$criteria->compare('isManager',$this->isManager);
		$criteria->compare('lastChangePasswordDateTime',$this->lastChangePasswordDateTime,true, 'OR');
		$criteria->compare('loginFailed',$this->loginFailed);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbDaiichi;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmployeeMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
