<?php

class MasterMyFileController extends MasterController
{

	public function init()
	{
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/daiibuy.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/wizard.create.myfile.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/madrid.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/ginzahome.js');
		parent::init();

		$this->nav = array(
			array(
				'url'=>Yii::app()->createUrl("/myfile/fenzer"),
				'color'=>'green',
				'caption'=>'FENZER',
				'description'=>'Fence and wall'
			),
			array(
				'url'=>Yii::app()->createUrl("/myfile/atechWindow"),
				'color'=>'blue',
				'caption'=>'ATECH WINDOW',
				'description'=>'Atech Doors and Windows'
			),
			array(
				'url'=>Yii::app()->createUrl("/myfile/ginzaHome"),
				'color'=>'red',
				'caption'=>'GINZA HOME',
				'description'=>'Ginza Home'
			),
			array(
				'url'=>Yii::app()->createUrl("/myfile/madrid"),
				'color'=>'orange',
				'caption'=>'MADRID BATHROOM',
				'description'=>'Madrid Bathroom'
			),
		);

		$this->sideBarCategories = array(
			'title'=>'Madrid Categories',
			'items'=>array(
				array(
					'link'=>'Madrid 1',
					'url'=>'#'
				),
				array(
					'link'=>'Madrid 2',
					'url'=>'#'
				),
				array(
					'link'=>'Madrid 3',
					'url'=>'#'
				),
				array(
					'link'=>'Madrid 4',
					'url'=>'#'
				),
				array(
					'link'=>'Madrid 5',
					'url'=>'#'
				),
				array(
					'link'=>'Madrid 6',
					'url'=>'#'
				),
				array(
					'link'=>'Madrid 7',
					'url'=>'#',
					'items'=>array(
						array(
							'link'=>'Madrid sub 1',
							'url'=>'#'
						),
						array(
							'link'=>'Madrid sub 2',
							'url'=>'#'
						),
						array(
							'link'=>'Madrid sub 3',
							'url'=>'#'
						),
						array(
							'link'=>'Madrid sub 4',
							'url'=>'#'
						),
						array(
							'link'=>'Madrid sub 5',
							'url'=>'#'
						),
						array(
							'link'=>'Madrid sub 6',
							'url'=>'#'
						),
						array(
							'link'=>'Madrid sub 7',
							'url'=>'#'
						),
						array(
							'link'=>'Madrid sub 8',
							'url'=>'#'
						),
					),
				),
			)
		);
		if(Yii::app()->user->isGuest)
		{
			$this->redirect(array(
				"/site/login"));
		}
	}

	//temp function
	public function scanDir($dir)
	{
		$files = scandir($dir);
		array_shift($files);
		array_shift($files);
		return $files;
	}

	public function showSanitary()
	{
		/*
		  $item = [
		  'id'=>'',
		  'image'=>'',
		  'url'=>'',
		  'title'=>'',
		  'price'=>'',
		  'pricePromotion'=>'',
		  'buttons'=>[
		  'cart',
		  'favorites',
		  'compare',
		  ],
		  ];
		 */
		$items = [];
		$i = 1;
		foreach($this->scanDir(Yii::app()->basePath . '/../images/madrid/sanitary') as $file)
		{
			$items[$i] = [
				'id'=>$i,
				'image'=>Yii::app()->baseUrl . '/images/madrid/sanitary/' . $file,
				'url'=>Yii::app()->createUrl('madrid/product/index/id/' . $i),
				'title'=>substr($file, 0, -4),
				'price'=>rand(1000, 99999),
				'buttons'=>[
					'cart',
				//'favorites'
				],
				'isQuickView'=>true,
			];

			$i++;
		}

		return $items;
	}

	public function formatMoney($number, $fractional = false)
	{
		if($fractional)
		{
			$number = sprintf('%.2f', $number);
		}
		while(true)
		{
			$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
			if($replaced != $number)
			{
				$number = $replaced;
			}
			else
			{
				break;
			}
		}
		return $number;
	}

	public $orderDetailId = null;

	public function saveOrderDetail($orderId, $orderDetailTemplateFieldId)
	{
		$orderDetail = new OrderDetail();
		$orderDetail->orderId = $orderId;
		$orderDetail->orderDetailTemplateId = $orderDetailTemplateFieldId;
		$orderDetail->createDateTime = new CDbExpression("NOW()");
		$orderDetail->updateDateTime = new CDbExpression("NOW()");
		if($orderDetail->save())
		{
			$this->orderDetailId = Yii::app()->db->lastInsertID;
		}
	}

	public function dateThai($date, $format, $showTime = false)
	{
		// Full month array
		$monthFormat1 = array(
			"0001"=>"มกราคม",
			"02"=>"กุมภาพันธ์",
			"03"=>"มีนาคม",
			"04"=>"เมษายน",
			"05"=>"พฤษภาคม",
			"06"=>"มิถุนายน",
			"07"=>"กรกฎาคม",
			"08"=>"สิงหาคม",
			"09"=>"กันยายน",
			"10"=>"ตุลาคม",
			"11"=>"พฤศจิกายน",
			"12"=>"ธันวาคม");

		// Quick month array
		$monthFormat2 = array(
			"01"=>"ม.ค.",
			"02"=>"ก.พ.",
			"03"=>"มี.ค.",
			"04"=>"เม.ย.",
			"05"=>"พ.ค.",
			"06"=>"มิ.ย.",
			"07"=>"ก.ค.",
			"08"=>"ส.ค.",
			"09"=>"ก.ย.",
			"10"=>"ต.ค.",
			"11"=>"พ.ย.",
			"12"=>"ธ.ค.");

		$monthFormat3 = array(
			"01"=>"01",
			"02"=>"02",
			"03"=>"03",
			"04"=>"04",
			"05"=>"05",
			"06"=>"06",
			"07"=>"07",
			"08"=>"08",
			"09"=>"09",
			"10"=>"10",
			"11"=>"11",
			"12"=>"12");

		$monthFormat4 = array(
			"01"=>"JAN",
			"02"=>"FEB",
			"03"=>"MAR",
			"04"=>"APR",
			"05"=>"MAY",
			"06"=>"JUN",
			"07"=>"JUL",
			"08"=>"AUG",
			"09"=>"SEP",
			"10"=>"OCT",
			"11"=>"NOV",
			"12"=>"DEC");

		if($date == '0000-00-00' || $date == '0000-00-00 00:00:00')
		{
			return "-";
		}
		$isDateTime = explode(' ', $date);
		if(count($isDateTime) == 2)
		{
			$timeStr = $isDateTime[1];
			$d = explode('-', $isDateTime[0]);
		}
		else
		{
			$d = explode('-', $date);
		}

		$monthFormat = null;
		if($format == 1)
		{
			$monthFormat = $monthFormat1[$d[1]];
			$strReturn = $d[2] . ' ' . $monthFormat . ' ' . ($d[0] + 543);
		}
		else if($format == 2)
		{
			$monthFormat = $monthFormat2[$d[1]];
			$strReturn = $d[2] . ' ' . $monthFormat . ' ' . ($d[0] + 543);
		}
		else if($format == 3)
		{
			$monthFormat = $monthFormat3[$d[1]];
			$strReturn = $d[2] . '/' . $monthFormat . '/' . ($d[0] + 543);
		}
		else if($format == 4)
		{
			$monthFormat = $monthFormat4[$d[1]];
			$strReturn = $monthFormat . '/' . ($d[0] + 543);
			return $strReturn;
		}

		//return $d[2].' '.(($format=1) ? $monthFormat1[$d[1]] : $monthFormat2[$d[1]]).' '.($d[0]+543);
		if(isset($timeStr) && $showTime)
		{
			$strReturn = $strReturn . " " . $timeStr;
		}

		return $strReturn;
	}

}
