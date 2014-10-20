<?php

/**
 * This is the model class for table "order_group".
 *
 * The followings are the available columns in table 'order_group':
 * @property string $orderGroupId
 * @property string $userId
 * @property string $Ordercol
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * The followings are the available model relations:
 * @property OrderGroupToOrder[] $orderGroupToOrders
 *
 * @property inetger $sumTotal
 */
class OrderGroup extends OrderGroupMaster
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
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return CMap::mergeArray(parent::rules(), array(//code here
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
            'orders' => array(
                self::MANY_MANY,
                'Order',
                'order_group_to_order(orderGroupId, orderId)'
            ),
        ));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return Cmap::mergeArray(parent::attributeLabels(), array(//code here
        ));
    }

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
     * @return OrderGroup the static model class
     */

    public function sumOrderLastTwelveMonth()
    {
        $today = date('Y-m-d');
        $lastYear = date('Y-m-d', strtotime($today . ' -12 months'));

        $model = $this->findAll(array(
            'condition' => 'userId=:userId AND (updateDateTime BETWEEN :today AND :lastYear)',
            'select'=>'sum(summary) as sumTotal',
            'params' => array(
                ':userId' => Yii::app()->user->id,
                ':today' => $today,
                ':lastYear' => $lastYear,
            ),
        ));

        return $model->sumTotal;
    }
}
