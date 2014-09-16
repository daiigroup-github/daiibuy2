<?php

class MasterBackofficeController extends MasterController
{

	public $pageHeader;

	public function init()
	{
		parent::init();

		$this->layout = '//layouts/column1';

		$this->nav = array(
			array(
				'label'=>'Brand',
				'url'=>array(
					'brand/index')
			),
			array(
				'label'=>'Product',
				'url'=>array(
					'product/index')
			),
			array(
				'label'=>'User',
				'url'=>array(
					'user/index')
			),
			array(
				'label'=>'PriceList',
				'url'=>array(
					'/backoffice/priceGroup',
				)),
//			array(
//				'label'=>'Setting',
//				'url'=>array(
//					'#'),
////				'active'=>$this->id == 'controllerId',
//				'items'=>array(
//					array(
//						'label'=>'PriceList',
//						'url'=>array(
//							'/backoffice/pricelist',
//							'id'=>1)),
////					array(
////						'label'=>'Sub 2',
////						'url'=>array(
////							'/brand/view',
////							'id'=>2)),
//				),
//				'itemOptions'=>array(
//					'class'=>'dropdown'),
//				'submenuOptions'=>array(
//					'class'=>'dropdown-menu'),
//			),
//            array(
//                'label' => 'Home',
//                'url' => array('/site/index')
//            ),
//            array(
//                'label' => 'About',
//                'url' => array(
//                    '/site/page',
//                    'view' => 'about'
//                )
//            ),
//            array(
//                'label' => 'Contact',
//                'url' => array('/site/contact')
//            ),
			array(
				'label'=>'Login',
				'url'=>array(
					'login/index'),
				'visible'=>Yii::app()->user->isGuest
			),
			array(
				'label'=>'Logout (' . Yii::app()->user->name . ')',
				'url'=>array(
					'login/logout'
				),
				'visible'=>!Yii::app()->user->isGuest
			)
		);

		$this->sideBarCategories = array(
			'title'=>'Atech Window',
			'items'=>array(
				array(
					'link'=>'ประตูบานเปิดคู่',
					'url'=>'#'
				),
				array(
					'link'=>'ประตูบานเปิดเดี่ยว',
					'url'=>'#'
				),
				array(
					'link'=>'หน้าต่างบานเปิดคู่',
					'url'=>'#'
				),
				array(
					'link'=>'บานช่องแสง',
					'url'=>'#'
				),
			/*
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
			 */
			)
		);

		$this->cat1 = array(
			array(
				'title'=>'M-Wall'),
			array(
				'title'=>'Double S'),
			array(
				'title'=>'Sandy'),
			array(
				'title'=>'Bricks')
		);

		$this->cat2 = array(
			'1.50',
			'1.75',
			'2.00',
			'2.25',
			'2.50',
			'2.75',
			'3.00'
		);
	}

	public function scanDir($dir)
	{
		$files = scandir($dir);
		array_shift($files);
		array_shift($files);
		return $files;
	}

	public function showCategory()
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
		foreach($this->scanDir(Yii::app()->basePath . '/../images/atechwindow') as $file)
		{
			$items[$i] = [
				'id'=>$i,
				'image'=>Yii::app()->baseUrl . '/images/atechwindow/' . $file,
				'url'=>Yii::app()->createUrl('atechwindow/category/index/id/' . $i),
				'title'=>substr($file, 0, -4),
				'price'=>'ราคาต่อเมตร ' . number_format(rand(1000, 2999), 2) . ' บาท',
				'description'=>'bla bla bla ...',
				'isQuickView'=>false
			];

			$i++;
		}

		return $items;
	}

	public function dateThai($date, $format, $showTime = false)
	{
		// Full month array
		$monthFormat1 = array(
			"01"=>"มกราคม",
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
