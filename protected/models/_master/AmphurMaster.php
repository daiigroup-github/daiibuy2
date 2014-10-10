<?php

/**
 * This is the model class for table "amphur".
 *
 * The followings are the available columns in table 'amphur':
 * @property string $amphurId
 * @property string $amphurCode
 * @property string $amphurName
 * @property integer $geographyId
 * @property integer $provinceId
 *
 * The followings are the available model relations:
 * @property Address[] $addresses
 */
class AmphurMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'amphur';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('amphurCode, amphurName', 'required'),
			array('geographyId, provinceId', 'numerical', 'integerOnly'=>true),
			array('amphurCode', 'length', 'max'=>4),
			array('amphurName', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('amphurId, amphurCode, amphurName, geographyId, provinceId, searchText', 'safe', 'on'=>'search'),
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
			'addresses' => array(self::HAS_MANY, 'Address', 'amphurId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'amphurId' => 'Amphur',
			'amphurCode' => 'Amphur Code',
			'amphurName' => 'Amphur Name',
			'geographyId' => 'Geography',
			'provinceId' => 'Province',
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
			$this->amphurId = $this->searchText;
			$this->amphurCode = $this->searchText;
			$this->amphurName = $this->searchText;
			$this->geographyId = $this->searchText;
			$this->provinceId = $this->searchText;
		}

		$criteria->compare('amphurId',$this->amphurId,true, 'OR');
		$criteria->compare('amphurCode',$this->amphurCode,true, 'OR');
		$criteria->compare('amphurName',$this->amphurName,true, 'OR');
		$criteria->compare('geographyId',$this->geographyId);
		$criteria->compare('provinceId',$this->provinceId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AmphurMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
