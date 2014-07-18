<?php

/**
 * This is the model class for table "province".
 *
 * The followings are the available columns in table 'province':
 * @property integer $provinceId
 * @property string $provinceCode
 * @property string $provinceName
 * @property integer $geographyId
 */
class ProvinceMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'province';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('provinceCode, provinceName', 'required'),
			array('geographyId', 'numerical', 'integerOnly'=>true),
			array('provinceCode', 'length', 'max'=>2),
			array('provinceName', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('provinceId, provinceCode, provinceName, geographyId, searchText', 'safe', 'on'=>'search'),
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
			'provinceId' => 'Province',
			'provinceCode' => 'Province Code',
			'provinceName' => 'Province Name',
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
			$this->provinceId = $this->searchText;
			$this->provinceCode = $this->searchText;
			$this->provinceName = $this->searchText;
			$this->geographyId = $this->searchText;
		}

		$criteria->compare('provinceId',$this->provinceId);
		$criteria->compare('provinceCode',$this->provinceCode,true, 'OR');
		$criteria->compare('provinceName',$this->provinceName,true, 'OR');
		$criteria->compare('geographyId',$this->geographyId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProvinceMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
