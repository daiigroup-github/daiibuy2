<?php

/**
 * This is the model class for table "price".
 *
 * The followings are the available columns in table 'price':
 * @property string $priceId
 * @property string $priceGroupId
 * @property string $provinceId
 * @property string $amphurId
 * @property string $priceRate
 * @property integer $status
 */
class PriceMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'price';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('priceGroupId, provinceId, amphurId, priceRate', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('priceGroupId', 'length', 'max'=>10),
			array('provinceId, amphurId', 'length', 'max'=>5),
			array('priceRate', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('priceId, priceGroupId, provinceId, amphurId, priceRate, status, searchText', 'safe', 'on'=>'search'),
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
			'priceId' => 'Price',
			'priceGroupId' => 'Price Group',
			'provinceId' => 'Province',
			'amphurId' => 'Amphur',
			'priceRate' => 'Price Rate',
			'status' => 'Status',
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
			$this->priceId = $this->searchText;
			$this->priceGroupId = $this->searchText;
			$this->provinceId = $this->searchText;
			$this->amphurId = $this->searchText;
			$this->priceRate = $this->searchText;
			$this->status = $this->searchText;
		}

		$criteria->compare('priceId',$this->priceId,true, 'OR');
		$criteria->compare('priceGroupId',$this->priceGroupId,true, 'OR');
		$criteria->compare('provinceId',$this->provinceId,true, 'OR');
		$criteria->compare('amphurId',$this->amphurId,true, 'OR');
		$criteria->compare('priceRate',$this->priceRate,true, 'OR');
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PriceMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
