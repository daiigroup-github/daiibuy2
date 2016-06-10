<?php

class MasterWowModel extends MasterCActiveRecord
{

    //change wow to your wow connection name
    private static $wow = null;
    public $searchText;

    public function getDbConnection()
    {
        if (self::$wow !== null)
            return self::$wow;
        else {
            self::$wow = Yii::app()->wow;
            if (self::$wow instanceof CDbConnection) {
                self::$wow->setActive(true);
                return self::$wow;
            } else
                throw new CDbException(Yii::t('yii', 'Active Record requires a "wow" CDbConnection application component.'));
        }
    }

}
