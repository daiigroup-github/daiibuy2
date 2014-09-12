<?php

/**
 * This is the model class for table "product_image".
 *
 * The followings are the available columns in table 'product_image':
 * @property string $productImageId
 * @property string $productId
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductImageMaster extends MasterCActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'product_image';
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
                'productId, title',
                'required'
            ),
            array(
                'status',
                'numerical',
                'integerOnly' => true
            ),
            array(
                'productId',
                'length',
                'max' => 20
            ),
            array(
                'title',
                'length',
                'max' => 200
            ),
            array(
                'description, createDateTime, updateDateTime',
                'safe'
            ),
            array(
                'createDateTime, updateDateTime',
                'default',
                'value' => new CDbExpression('NOW()'),
                'on' => 'insert'
            ),
            array(
                'updateDateTime',
                'default',
                'value' => new CDbExpression('NOW()'),
                'on' => 'update'
            ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'productImageId, productId, title, description, status, createDateTime, updateDateTime, searchText',
                'safe',
                'on' => 'search'
            ),
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
            'product' => array(
                self::BELONGS_TO,
                'Product',
                'productId'
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'productImageId' => 'Product Image',
            'productId' => 'Product',
            'title' => 'Title',
            'description' => 'Description',
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

        $criteria = new CDbCriteria;

        if (isset($this->searchText) && !empty($this->searchText)) {
            $this->productImageId = $this->searchText;
            $this->productId = $this->searchText;
            $this->title = $this->searchText;
            $this->description = $this->searchText;
            $this->status = $this->searchText;
            $this->createDateTime = $this->searchText;
            $this->updateDateTime = $this->searchText;
        }

        $criteria->compare('productImageId', $this->productImageId, true, 'OR');
        $criteria->compare('productId', $this->productId, true, 'OR');
        $criteria->compare('title', $this->title, true, 'OR');
        $criteria->compare('description', $this->description, true, 'OR');
        $criteria->compare('status', $this->status);
        $criteria->compare('createDateTime', $this->createDateTime, true, 'OR');
        $criteria->compare('updateDateTime', $this->updateDateTime, true, 'OR');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ProductImageMaster the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}