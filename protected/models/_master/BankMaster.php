<?php

/**
 * This is the model class for table "bank".
 *
 * The followings are the available columns in table 'bank':
 * @property string $id
 * @property string $bankNameId
 * @property string $branch
 * @property string $accNo
 * @property string $accName
 * @property string $accType
 * @property string $supplierId
 * @property string $compCode
 * @property integer $status
 * @property string $createDateTime
 *
 * The followings are the available model relations:
 * @property BankName $bankName
 */
class BankMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bank';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bankNameId, branch, accNo, accName, accType, supplierId, status, createDateTime', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('bankNameId, supplierId', 'length', 'max'=>20),
			array('branch', 'length', 'max'=>25),
			array('accName', 'length', 'max'=>300),
			array('accType', 'length', 'max'=>100),
			array('compCode', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, bankNameId, branch, accNo, accName, accType, supplierId, compCode, status, createDateTime, searchText', 'safe', 'on'=>'search'),
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
			'bankName' => array(self::BELONGS_TO, 'BankName', 'bankNameId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'bankNameId' => 'Bank Name',
			'branch' => 'Branch',
			'accNo' => 'Acc No',
			'accName' => 'Acc Name',
			'accType' => 'Acc Type',
			'supplierId' => 'Supplier',
			'compCode' => 'Comp Code',
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
			$this->id = $this->searchText;
			$this->bankNameId = $this->searchText;
			$this->branch = $this->searchText;
			$this->accNo = $this->searchText;
			$this->accName = $this->searchText;
			$this->accType = $this->searchText;
			$this->supplierId = $this->searchText;
			$this->compCode = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
		}

		$criteria->compare('id',$this->id,true, 'OR');
		$criteria->compare('bankNameId',$this->bankNameId,true, 'OR');
		$criteria->compare('branch',$this->branch,true, 'OR');
		$criteria->compare('accNo',$this->accNo,true, 'OR');
		$criteria->compare('accName',$this->accName,true, 'OR');
		$criteria->compare('accType',$this->accType,true, 'OR');
		$criteria->compare('supplierId',$this->supplierId,true, 'OR');
		$criteria->compare('compCode',$this->compCode,true, 'OR');
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
	 * @return BankMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
