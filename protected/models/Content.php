<?php

/**
 * This is the model class for table "content".
 *
 * The followings are the available columns in table 'content':
 * @property string $contentId
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $subview
 * @property string $parentId
 * @property integer $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Content extends ContentMaster
{

	const CONTENT_TYPE_INDEX_SLIDE = 0;
	const CONTENT_TYPE_SELECT_PROVINCE_IMAGE = 1;
	const CONTENT_TYPE_SELECT_PROVINCE_VIDEO = 2;
	const CONTENT_TYPE_FOOTER = 3;
	const CONTENT_TYPE_FOOTER_SOCIAL = 4;
	const CONTENT_TYPE_FOOTER_COMPANY = 5;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Content the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(
				'title, type, createDateTime',
				'required'),
			array(
				'type, status',
				'numerical',
				'integerOnly'=>true),
			array(
				'title',
				'length',
				'max'=>500),
			array(
				'image',
				'length',
				'max'=>300),
			array(
				'subview',
				'length',
				'max'=>100),
			array(
				'parentId',
				'length',
				'max'=>20),
			array(
				'description, updateDateTime',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'contentId, title, description, image, subview, parentId, type, status, createDateTime, updateDateTime',
				'safe',
				'on'=>'search'),
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
			'parent'=>array(
				self::BELONGS_TO,
				'Content',
				array(
					'contentId'=>'parentId')),
			'childs'=>array(
				self::HAS_MANY,
				'Content',
				array(
					'parentId')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'contentId'=>'Content',
			'title'=>'Title',
			'description'=>'Description',
			'image'=>'Image',
			'subview'=>'Controller/Action or Ext. Link',
			'parentId'=>'Parent',
			'type'=>'Type',
			'status'=>'Status',
			'createDateTime'=>'Create Date Time',
			'updateDateTime'=>'Update Date Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('contentId', $this->contentId, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('image', $this->image, true);
		$criteria->compare('subview', $this->subview, true);
		$criteria->compare('parentId', $this->parentId);
		$criteria->compare('type', $this->type);
		$criteria->compare('status', $this->status);
		$criteria->compare('createDateTime', $this->createDateTime, true);
		$criteria->compare('updateDateTime', $this->updateDateTime, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getTypeArray()
	{
		return array(
			self::CONTENT_TYPE_INDEX_SLIDE=>'รูปโปรโมชั่นหน้าหลัก',
			self::CONTENT_TYPE_SELECT_PROVINCE_IMAGE=>'Image หน้าเลือกจังหวัด',
			self::CONTENT_TYPE_SELECT_PROVINCE_VIDEO=>'Video หน้าเลือกจังหวัด',
			self::CONTENT_TYPE_FOOTER=>'ลิ้งค์ที่ Content เกี่ยวกับ Daiibuy',
			self::CONTENT_TYPE_FOOTER_SOCIAL=>'Social ที่ Footer',
			self::CONTENT_TYPE_FOOTER_COMPANY=>'Company ที่ Footer',
		);
	}

	public function getTypeText()
	{
		$typeArray = $this->getTypeArray();
		return $typeArray[$this->type];
	}

	public function getAllParentContent($status = 1)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'status&:status>0 AND parentId=0';
		$criteria->params = array(
			':status'=>$status);

		$models = Content::model()->findAll($criteria);
		$res = array(
			);

		foreach($models as $model)
		{
			$res[$model->contentId] = $model->title;

			//find child
			$criteria2 = new CDbCriteria();
			$criteria2->condition = 'status&:status>0 AND parentId=:parentId';
			$criteria2->params = array(
				':parentId'=>$model->contentId,
				':status'=>$status);

			$modelChilds = Content::model()->findAll($criteria2);

			foreach($modelChilds as $modelChild)
			{
				$res[$modelChild->contentId] = $model->title . ' > ' . $modelChild->title;
			}
		}

		return $res;
	}

	public function findAllChildByParentId($parentId)
	{
		$criteria = new CDbCriteria;

		$criteria->compare('parentId', $parentId);
		$criteria->compare('status', 1);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
