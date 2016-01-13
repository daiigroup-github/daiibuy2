<?php

/**
 * This is the model class for table "order_group_history".
 *
 * The followings are the available columns in table 'order_group_history':
 * @property string $orderGroupHistoryId
 * @property string $orderGroupId
 * @property string $decision
 * @property string $description
 * @property string $reasonCode
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class OrderGroupHistory extends OrderGroupHistoryMaster
{

    /**
     * @return string the associated database table name
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return CMap::mergeArray(parent::rules(), array(
                //code here
        ));
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return CMap::mergeArray(parent::relations(), array(
                //code here
                'orderItemOptions' => array(
                    self::HAS_MANY,
                    "OrderItemOption",
                    'orderItemId',
                    'limit' => 1)
        ));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return Cmap::mergeArray(parent::attributeLabels(), array(
                //code here
        ));
    }

}
