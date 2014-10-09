<?php

/**
 * This is the model class for table "supplier_epayment".
 *
 * The followings are the available columns in table 'supplier_epayment':
 * @property string $id
 * @property string $supplierId
 * @property integer $enableEPayment
 * @property string $ePaymentTel
 * @property string $ePaymentMerchantId
 * @property string $ePaymentOrgId
 * @property string $ePaymentUrl
 * @property string $ePaymentAccessKey
 * @property string $ePaymentProfileId
 * @property string $ePaymentSecretKey
 * @property integer $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property Supplier $supplier
 */
class SupplierEpaymentMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'supplier_epayment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('supplierId, ePaymentTel, ePaymentMerchantId, ePaymentOrgId, ePaymentUrl, ePaymentAccessKey, ePaymentProfileId, ePaymentSecretKey, createDateTime, updateDateTime', 'required'),
			array('enableEPayment, type, status', 'numerical', 'integerOnly'=>true),
			array('supplierId', 'length', 'max'=>20),
			array('ePaymentTel', 'length', 'max'=>30),
			array('ePaymentMerchantId, ePaymentOrgId, ePaymentProfileId', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, supplierId, enableEPayment, ePaymentTel, ePaymentMerchantId, ePaymentOrgId, ePaymentUrl, ePaymentAccessKey, ePaymentProfileId, ePaymentSecretKey, type, status, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
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
			'supplier' => array(self::BELONGS_TO, 'Supplier', 'supplierId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'supplierId' => 'Supplier',
			'enableEPayment' => 'Enable Epayment',
			'ePaymentTel' => 'E Payment Tel',
			'ePaymentMerchantId' => 'E Payment Merchant',
			'ePaymentOrgId' => 'E Payment Org',
			'ePaymentUrl' => 'E Payment Url',
			'ePaymentAccessKey' => 'E Payment Access Key',
			'ePaymentProfileId' => 'E Payment Profile',
			'ePaymentSecretKey' => 'E Payment Secret Key',
			'type' => 'Type',
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
			$this->id = $this->searchText;
			$this->supplierId = $this->searchText;
			$this->enableEPayment = $this->searchText;
			$this->ePaymentTel = $this->searchText;
			$this->ePaymentMerchantId = $this->searchText;
			$this->ePaymentOrgId = $this->searchText;
			$this->ePaymentUrl = $this->searchText;
			$this->ePaymentAccessKey = $this->searchText;
			$this->ePaymentProfileId = $this->searchText;
			$this->ePaymentSecretKey = $this->searchText;
			$this->type = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('id',$this->id,true, 'OR');
		$criteria->compare('supplierId',$this->supplierId,true, 'OR');
		$criteria->compare('enableEPayment',$this->enableEPayment);
		$criteria->compare('ePaymentTel',$this->ePaymentTel,true, 'OR');
		$criteria->compare('ePaymentMerchantId',$this->ePaymentMerchantId,true, 'OR');
		$criteria->compare('ePaymentOrgId',$this->ePaymentOrgId,true, 'OR');
		$criteria->compare('ePaymentUrl',$this->ePaymentUrl,true, 'OR');
		$criteria->compare('ePaymentAccessKey',$this->ePaymentAccessKey,true, 'OR');
		$criteria->compare('ePaymentProfileId',$this->ePaymentProfileId,true, 'OR');
		$criteria->compare('ePaymentSecretKey',$this->ePaymentSecretKey,true, 'OR');
		$criteria->compare('type',$this->type);
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
	 * @return SupplierEpaymentMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
