<?php

class SaleGroupQueue extends SaleGroupQueueMaster
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Product the static model class
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
        return array(
        );
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

    public function nextQueue($saleGroupQueueId, $sortOrder)
    {
        $thisQueue = SaleQueue::model()->find(array(
            'condition' => 'status=1 AND saleGroupQueueId=:saleGroupQueueId AND sortOrder=:sortOrder',
            'params' => array(
                ':saleGroupQueueId' => $saleGroupQueueId,
                ':sortOrder' => $sortOrder),
            'limit' => 1,
        ));
        $thisQueue->status = 2;

        $nextQueue = SaleQueue::model()->find(array(
            'condition' => 'status=2 AND saleGroupQueueId=:saleGroupQueueId AND sortOrder>:sortOrder',
            'params' => array(
                ':saleGroupQueueId' => $saleGroupQueueId,
                ':sortOrder' => $sortOrder),
            'order' => 'sortOrder',
            'limit' => 1,
        ));

        if ($nextQueue == null) {
            $nextQueue = SaleQueue::model()->find(array(
                'condition' => 'status=2 AND saleGroupQueueId=:saleGroupQueueId',
                'params' => array(
                    ':saleGroupQueueId' => $saleGroupQueueId),
                'order' => 'sortOrder',
                'limit' => 1,
            ));

            if ($nextQueue == NULL) {
                $nextQueue = $thisQueue;
            }
        }

        if (isset($nextQueue)) {
            $nextQueue->status = 1;
        }

        return $thisQueue->save() && $nextQueue->save();
    }

}
