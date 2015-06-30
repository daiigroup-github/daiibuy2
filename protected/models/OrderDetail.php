<?php

/**
 * This is the model class for table "order_detail".
 *
 * The followings are the available columns in table 'order_detail':
 * @property string $orderDetailId
 * @property string $orderId
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property OrderDetailTemplate[] $orderDetailTemplates
 * @property OrderDetailValue[] $orderDetailValues
 */
class OrderDetail extends OrderDetailMaster {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return CMap::mergeArray(parent::rules(), array(
                        //code here
        ));
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return CMap::mergeArray(parent::relations(), array(
                        //code here
        ));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return Cmap::mergeArray(parent::attributeLabels(), array(
                        //code here
        ));
    }

    public function getOrderDetailTemplateIdBySupplierId($supplierId) {
        $criteria = new CDbCriteria();
        $criteria->condition = 'supplierId = :supplierId AND status = :status AND title = :title';
        $criteria->params = array(
            ':supplierId' => $supplierId,
            ':status' => 1,
            ':title' => "myFile");

        $orderDetailTemplate = OrderDetailTemplate::model()->find($criteria);
        return $orderDetailTemplate->orderDetailTemplateId;
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
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     * public function search()
     * {
     * }
     */
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OrderDetail the static model class
     */
}
