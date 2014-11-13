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
				'label'=>'Product<i class="fa fa-arrow-circle-o-down"></i>',
				'url'=>array(
					'#'),
//				'active'=>$this->id == 'controllerId',
				'items'=>array(
					array(
						'label'=>'Brand',
						'url'=>array(
							'/backoffice/brand',
						)),
					array(
						'label'=>'Product',
						'url'=>array(
							'/backoffice/product/index')
					),
					array(
						'label'=>'PriceList',
						'url'=>array(
							'/backoffice/priceGroup',
						)),
//					array(
//						'label'=>'Sub 2',
//						'url'=>array(
//							'/brand/view',
//							'id'=>2)),
				),
				'itemOptions'=>array(
					'class'=>'dropdown'),
				'submenuOptions'=>array(
					'class'=>'dropdown-menu'),
				'linkOptions'=>array(
					'class'=>'dropdown-toggle',
					'data-toggle'=>'dropdown',
				),
				'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->userType == 3 || Yii::app()->user->userType == 4)
			),
			array(
				'label'=>'Order',
				'url'=>array(
					'/backoffice/order',
				),
				'visible'=>!Yii::app()->user->isGuest),
			array(
				'label'=>'Myfile',
				'url'=>array(
					'/backoffice/myfile',
				),
				'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->userType == 3 || Yii::app()->user->userType == 4)
			),
			array(
				'label'=>'User<i class="fa fa-arrow-circle-o-down"></i>',
				'url'=>array(
					'#'),
//				'active'=>$this->id == 'controllerId',
				'items'=>array(
					array(
						'label'=>'User',
						'url'=>array(
							'/backoffice/user/index',
						),
						'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->userType == 4)),
					array(
						'label'=>'User File',
						'url'=>array(
							'/backoffice/userFile/index',
						),
						'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->userType == 4)),
					array(
						'label'=>'Supplier',
						'url'=>array(
							'/backoffice/supplier/index')
					),
				),
				'itemOptions'=>array(
					'class'=>'dropdown'),
				'submenuOptions'=>array(
					'class'=>'dropdown-menu'),
				'linkOptions'=>array(
					'class'=>'dropdown-toggle',
					'data-toggle'=>'dropdown',
				),
				'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->userType == 3 || Yii::app()->user->userType == 4)
			),
			array(
				'label'=>'ข้อมูลหลัก<i class="fa fa-arrow-circle-o-down"></i>',
				'url'=>array(
					'#'),
//				'active'=>$this->id == 'controllerId',
				'items'=>array(
					array(
						'label'=>'Bank',
						'url'=>array(
							'/backoffice/bank',
						)),
					array(
						'label'=>'Bank Name',
						'url'=>array(
							'/backoffice/bankName',
						)),
					array(
						'label'=>'Content',
						'url'=>array(
							'/backoffice/content',
						)),
				),
				'itemOptions'=>array(
					'class'=>'dropdown'),
				'submenuOptions'=>array(
					'class'=>'dropdown-menu'),
				'linkOptions'=>array(
					'class'=>'dropdown-toggle',
					'data-toggle'=>'dropdown',
				),
				'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->userType == 4)
			),
			array(
				'label'=>'รายงาน<i class="fa fa-arrow-circle-o-down"></i>',
				'url'=>array(
					'#'),
//				'active'=>$this->id == 'controllerId',
				'items'=>array(
					array(
						'label'=>'รายงานสรุปยอดขาย',
						'url'=>array(
							'/backoffice/report/viewSummaryReport',
						)),
//					array(
//						'label'=>'รายงานยอดค้างชำระผู้ผลิตสินค้า',
//						'url'=>array(
//							'/backoffice/report/viewSupplierReport',
//						)),
//					array(
//						'label'=>'รายงานยอดค้างชำระผู้กระจายสินค้า',
//						'url'=>array(
//							'/backoffice/report/viewDealerReport',
//						)),
				),
				'itemOptions'=>array(
					'class'=>'dropdown'),
				'submenuOptions'=>array(
					'class'=>'dropdown-menu'),
				'linkOptions'=>array(
					'class'=>'dropdown-toggle',
					'data-toggle'=>'dropdown',
				),
				'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->userType == 4)
			),
			array(
				'label'=>'Configuration',
				'url'=>array(
					'/backoffice/configuration',
				),
				'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->userType == 4)
			),
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

	public function actionSortItem()
	{
		$res = array(
			);
		if(isset($_GET["action"]))
			$action = $_GET["action"];
		if(isset($_GET["id"]))
			$id = $_GET["id"];
		if(isset($action) && isset($id))
		{
			$model = $this->loadModel($id);
			if($action == "up")
			{
				$model->sortOrder = intval($model->sortOrder) - 1;
				$existing = $model->find("sortOrder =:sortOrder", array(
					":sortOrder"=>intval($model->sortOrder)));
				if(isset($existing))
				{
					$existing->sortOrder = $existing->sortOrder + 1;
					$existing->save(false);
				}
			}
			else if($action == "down")
			{
				$model->sortOrder = intval($model->sortOrder) + 1;
				$existing = $model->find("sortOrder =:sortOrder", array(
					":sortOrder"=>intval($model->sortOrder)));
				if(isset($existing))
				{
					$existing->sortOrder = $existing->sortOrder - 1;
					$existing->save(false);
				}
			}
			else if($action == "custom")
			{
				$oldSortOrder = $model->sortOrder;
				$model->sortOrder = intval($_GET["orderIndex"]);
				if($model->sortOrder > $oldSortOrder)
				{
					$morethan = $model->findAll("sortOrder >:oldSortOrder AND sortOrder <=:sortOrder ORDER BY sortOrder ASC", array(
						":sortOrder"=>$model->sortOrder,
						":oldSortOrder"=>$oldSortOrder));
					if(isset($morethan))
					{
						foreach($morethan as $item)
						{
							$item->sortOrder = $item->sortOrder - 1;
							$item->save(false);
						}
					}
				}
				else
				{
					$lessthan = $model->findAll("sortOrder <:oldSortOrder AND sortOrder >=:sortOrder ORDER BY sortOrder ASC", array(
						":sortOrder"=>$model->sortOrder,
						":oldSortOrder"=>$oldSortOrder));
					if(isset($lessthan))
					{
						foreach($lessthan as $item)
						{
							$item->sortOrder = $item->sortOrder + 1;
							$item->save(false);
						}
					}
				}
			}

			if($model->save(false))
			{
				$res["status"] = 1;
			}
			else
			{
				throw new Exception(print_r($model->errors, true));
				$res["status"] = 0;
			}
		}
		else
		{
			$res["status"] = 0;
			$res["error"] = "Parameter Incorrect!!";
		}
		echo CJSON::encode($res);
	}

	function ThaiBahtConversion($amount_number)
	{
		$amount_number = number_format($amount_number, 2, ".", "");
		//echo "<br/>amount = " . $amount_number . "<br/>";
		$pt = strpos($amount_number, ".");
		$number = $fraction = "";
		if($pt === false)
			$number = $amount_number;
		else
		{
			$number = substr($amount_number, 0, $pt);
			$fraction = substr($amount_number, $pt + 1);
		}

		//list($number, $fraction) = explode(".", $number);
		$ret = "";
		$baht = $this->ReadNumber($number);
		if($baht != "")
			$ret .= $baht . "บาท";

		$satang = $this->ReadNumber($fraction);
		if($satang != "")
			$ret .= $satang . "สตางค์";
		else
			$ret .= "ถ้วน";
		//return iconv("UTF-8", "TIS-620", $ret);
		return $ret;
	}

	function ReadNumber($number)
	{
		$position_call = array(
			"แสน",
			"หมื่น",
			"พัน",
			"ร้อย",
			"สิบ",
			"");
		$number_call = array(
			"",
			"หนึ่ง",
			"สอง",
			"สาม",
			"สี่",
			"ห้า",
			"หก",
			"เจ็ด",
			"แปด",
			"เก้า");
		$number = $number + 0;
		$ret = "";
		if($number == 0)
			return $ret;
		if($number > 1000000)
		{
			$ret .= $this->ReadNumber(intval($number / 1000000)) . "ล้าน";
			$number = intval(fmod($number, 1000000));
		}

		$divider = 100000;
		$pos = 0;
		while($number > 0)
		{
			$d = intval($number / $divider);
			$ret .= (($divider == 10) && ($d == 2)) ? "ยี่" :
				((($divider == 10) && ($d == 1)) ? "" :
					((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
			$ret .= ($d ? $position_call[$pos] : "");
			$number = $number % $divider;
			$divider = $divider / 10;
			$pos++;
		}
		return $ret;
	}

	public function checkSupplierAndAdminAccessMenu()
	{
		if(Yii::app()->user->id > 0 && isset(Yii::app()->user->id))
		{
			$user = User::model()->findByPk(Yii::app()->user->id);
			if($user->type == 1 || $user->type == 2)
			{
				throw new CHttpException("ไม่สามารถเข้าถึงส่วนนี้ได้");
				//$this->redirect(Yii::app()->createUrl("site/index"));
			}
			else if($user->type == 3)
			{
//				$sup = UserToSupplier::model()->find("userId =" . Yii::app()->user->id);
				return User::model()->getSupplierId(Yii::app()->user->id);
			}
		}
		else
		{
			$this->redirect(Yii::app()->createUrl("backoffice/login"));
		}
	}

	public function checkAdminAccessMenu()
	{
		if(Yii::app()->user->id > 0 && isset(Yii::app()->user->id))
		{
			$user = User::model()->findByPk(Yii::app()->user->id);
			if($user->type == 1 || $user->type == 2 || $user->type == 3)
			{
				throw new CHttpException("ไม่สามารถเข้าถึงส่วนนี้ได้");
				//$this->redirect(Yii::app()->createUrl("site/index"));
			}
		}
		else
		{
			$this->redirect(Yii::app()->createUrl("backoffice/login"));
		}
	}

}
