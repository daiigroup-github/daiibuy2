<?php

/**
 * This is the model class for table "district".
 *
 * The followings are the available columns in table 'district':
 * @property string $districtId
 * @property string $districtCode
 * @property string $districtName
 * @property integer $amphurId
 * @property integer $provinceId
 * @property integer $geographyId
 *
 * The followings are the available model relations:
 * @property Address[] $addresses
 */
class DistrictMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'district';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('districtCode, districtName', 'required'),
			array('amphurId, provinceId, geographyId', 'numerical', 'integerOnly'=>true),
			array('districtCode', 'length', 'max'=>6),
			array('districtName', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('districtId, districtCode, districtName, amphurId, provinceId, geographyId, searchText', 'safe', 'on'=>'search'),
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
			'addresses' => array(self::HAS_MANY, 'Address', 'districtId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'districtId' => 'District',
			'districtCode' => 'District Code',
			'districtName' => 'District Name',
			'amphurId' => 'Amphur',
			'provinceId' => 'Province',
			'geographyId' => 'Geography',
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
			$this->districtId = $this->searchText;
			$this->districtCode = $this->searchText;
			$this->districtName = $this->searchText;
			$this->amphurId = $this->searchText;
			$this->provinceId = $this->searchText;
			$this->geographyId = $this->searchText;
		}

		$criteria->compare('districtId',$this->districtId,true, 'OR');
		$criteria->compare('districtCode',$this->districtCode,true, 'OR');
		$criteria->compare('districtName',$this->districtName,true, 'OR');
		$criteria->compare('amphurId',$this->amphurId);
		$criteria->compare('provinceId',$this->provinceId);
		$criteria->compare('geographyId',$this->geographyId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DistrictMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
