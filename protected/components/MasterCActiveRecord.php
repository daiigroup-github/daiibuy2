<?php

class MasterCActiveRecord extends CActiveRecord {

	public $searchText;
    public $startDate;
    public $endDate;

	const STATUS_ACTIVE = 0x1;
	const STATUS_INACTIVE = 0x2;

	public $statusArray = array(
		self::STATUS_ACTIVE => 'Active',
		self::STATUS_INACTIVE => 'N/A',
	);

	public function getStatusText($status) {
		return $this->statusArray[$status];
	}

    public function writeToFile($filePath, $string, $mode='w+')
    {
        $handle = fopen($filePath, $mode);
        fwrite($handle, $string);
        fclose($handle);
    }

}
