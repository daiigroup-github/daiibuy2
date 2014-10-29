<?php

/**
 * This is the model class for table "user_favourite".
 *
 * The followings are the available columns in table 'user_favourite':
 * @property string $userFavouriteId
 * @property string $userId
 * @property string $brandId
 * @property string $brandModelId
 * @property string $category1Id
 * @property string $category2Id
 * @property string $productId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property Category $category2
 */
class UserFavouriteMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_favourite';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, createDateTime, updateDateTime', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('userId, brandId, brandModelId, category1Id, category2Id, productId', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('userFavouriteId, userId, brandId, brandModelId, category1Id, category2Id, productId, status, createDateTime, updateDateTime, searchText', 'safe', 'on'=>'search'),
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
			'category2' => array(self::BELONGS_TO, 'Category', 'category2Id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userFavouriteId' => 'User Favourite',
			'userId' => 'User',
			'brandId' => 'Brand',
			'brandModelId' => 'Brand Model',
			'category1Id' => 'Category1',
			'category2Id' => 'Category2',
			'productId' => 'Product',
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
			$this->userFavouriteId = $this->searchText;
			$this->userId = $this->searchText;
			$this->brandId = $this->searchText;
			$this->brandModelId = $this->searchText;
			$this->category1Id = $this->searchText;
			$this->category2Id = $this->searchText;
			$this->productId = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
		}

		$criteria->compare('userFavouriteId',$this->userFavouriteId,true, 'OR');
		$criteria->compare('userId',$this->userId,true, 'OR');
		$criteria->compare('brandId',$this->brandId,true, 'OR');
		$criteria->compare('brandModelId',$this->brandModelId,true, 'OR');
		$criteria->compare('category1Id',$this->category1Id,true, 'OR');
		$criteria->compare('category2Id',$this->category2Id,true, 'OR');
		$criteria->compare('productId',$this->productId,true, 'OR');
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
	 * @return UserFavouriteMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
