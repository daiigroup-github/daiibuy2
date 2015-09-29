<?php

/**
 * This is the model class for table "link_items".
 *
 * The followings are the available columns in table 'link_items':
 * @property string $linkItemId
 * @property integer $status
 * @property string $supplierId
 * @property integer $discountType
 * @property double $value
 * @property string $linkId
 *
 * The followings are the available model relations:
 * @property Link $link
 */
class LinkItemsMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'link_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('supplierId, discountType, value, linkId', 'required'),
			array('status, discountType', 'numerical', 'integerOnly'=>true),
			array('value', 'numerical'),
			array('supplierId', 'length', 'max'=>10),
			array('linkId', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('linkItemId, status, supplierId, discountType, value, linkId', 'safe', 'on'=>'search'),
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
			'link' => array(self::BELONGS_TO, 'Link', 'linkId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'linkItemId' => 'Link Item',
			'status' => 'Status',
			'supplierId' => 'Supplier',
			'discountType' => 'Discount Type',
			'value' => 'Value',
			'linkId' => 'Link',
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

		$criteria->compare('linkItemId',$this->linkItemId,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('supplierId',$this->supplierId,true);
		$criteria->compare('discountType',$this->discountType);
		$criteria->compare('value',$this->value);
		$criteria->compare('linkId',$this->linkId,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->wow;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LinkItemsMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
