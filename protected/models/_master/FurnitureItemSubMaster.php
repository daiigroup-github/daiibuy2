<?php

/**
 * This is the model class for table "furniture_item_sub".
 *
 * The followings are the available columns in table 'furniture_item_sub':
 * @property string $furnitureItemSubId
 * @property string $furnitureItemId
 * @property string $code
 * @property string $description
 * @property string $image
 * @property integer $quantity
 * @property string $unit
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property FurnitureItem $furnitureItem
 */
class FurnitureItemSubMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'furniture_item_sub';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('furnitureItemId, code, quantity, unit, createDateTime, updateDateTime', 'required'),
			array('quantity, status', 'numerical', 'integerOnly'=>true),
			array('furnitureItemId', 'length', 'max'=>20),
			array('code', 'length', 'max'=>200),
			array('image', 'length', 'max'=>255),
			array('unit', 'length', 'max'=>45),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('furnitureItemSubId, furnitureItemId, code, description, image, quantity, unit, status, createDateTime, updateDateTime', 'safe', 'on'=>'search'),
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
			'furnitureItem' => array(self::BELONGS_TO, 'FurnitureItem', 'furnitureItemId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'furnitureItemSubId' => 'Furniture Item Sub',
			'furnitureItemId' => 'Furniture Item',
			'code' => 'Code',
			'description' => 'Description',
			'image' => 'Image',
			'quantity' => 'Quantity',
			'unit' => 'Unit',
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

		$criteria->compare('furnitureItemSubId',$this->furnitureItemSubId,true);
		$criteria->compare('furnitureItemId',$this->furnitureItemId,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('unit',$this->unit,true);
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
	 * @return FurnitureItemSubMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
