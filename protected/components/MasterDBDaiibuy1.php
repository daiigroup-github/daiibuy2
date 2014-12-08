<?php

class MasterDBDaiibuy1 extends MasterCActiveRecord
{

	//change db to your db connection name
	private static $dbDaiibuy1 = null;
	public $searchText;

	public function getDbConnection()
	{
		if(self::$dbDaiibuy1 !== null)
			return self::$dbDaiibuy1;
		else
		{
			self::$dbDaiibuy1 = Yii::app()->dbDaiibuy1;
			if(self::$dbDaiibuy1 instanceof CDbConnection)
			{
				self::$dbDaiibuy1->setActive(true);
				return self::$dbDaiibuy1;
			}
			else
				throw new CDbException(Yii::t('yii', 'Active Record requires a "dbDaiibuy1" CDbConnection application component.'));
		}
	}

}
