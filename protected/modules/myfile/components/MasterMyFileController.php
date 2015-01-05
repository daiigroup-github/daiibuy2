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
			array(
				'url'=>Yii::app()->createUrl("/myfile/order"),
				'color'=>'blue',
				'caption'=>'Order',
				'description'=>'Order Management'
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

	public function actionRequestSpacialProject($id)
	{
		$model = Order::model()->findByPk($id);
		$model->isRequestSpacialProject = 1;
		if($model->save())
		{
			$userSpacialProject = UserSpacialProject::model()->find("orderId = " . $id);
			if(!isset($userSpacialProject))
			{
				$userSpacialProject = new UserSpacialProject();
				$userSpacialProject->userId = Yii::app()->user->id;
				$userSpacialProject->supplierId = $model->supplierId;
				$userSpacialProject->orderId = $id;
				$userSpacialProject->createDateTime = new CDbExpression("NOW()");
			}
			else
			{
				$userSpacialProject->reQuestNo = $userSpacialProject->reQuestNo + 1;
			}
			if(isset($_POST["orderGroupId"]))
			{
				$model->orderGroupId = $_POST["orderGroupId"];
			}
			$userSpacialProject->status = 1;
			$userSpacialProject->updateDateTime = new CDbExpression("NOW()");
			$userSpacialProject->save(false);
		}
		$this->redirect(array(
			'view',
			'id'=>$id));
	}

	public function myfileColorClass($status, $requestSP = null)
	{
		switch($status)
		{
			case 0:
				return "warning";
				break;
			case 1:
				return "info";
				break;
			case 2:
				return "primary";
				break;
			case 3:
				return "success";
				break;
			default:
				break;
		}
	}

	public function actionDuplicateMyfile($id)
	{
		$this->layout = '//layouts/cl1';
		$model = Order::model()->findByPk($id);
		$orderOld = $model;
		if(isset($_POST["Order"]))
		{
			try
			{
				$transaction = Yii::app()->db->beginTransaction();
				$flag = FALSE;

				$model->isNewRecord = true;
				if(isset($_POST["Order"]["title"]))
				{
					$model->title = $_POST["Order"]["title"];
				}
				else
				{
					$model->title .= " Copy";
				}
				if(isset($_POST["Order"]["provinceId"]))
				{
					$model->provinceId = $_POST["Order"]["provinceId"];
				}
				$model->type = 1;
				$model->status = 2;
				$model->isRequestSpacialProject = 0;
				$model->spacialProjectDiscount = null;
				$model->orderId = null;
				$model->createDateTime = new CDbExpression("NOW()");
				$model->updateDateTime = new CDbExpression("NOW()");
				if($model->save())
				{
					$flag = true;
					$orderId = Yii::app()->db->lastInsertID;
					$orderItems = OrderItems::model()->findAll("orderId=" . $id);
					if(count($orderItems) > 0)
					{
						foreach($orderItems as $item)
						{
							$item->isNewRecord = true;
							$item->orderId = $orderId;
							$item->orderItemsId = null;
							$item->createDateTime = new CDbExpression("NOW()");
							$item->updateDateTime = new CDbExpression("NOW()");
							if(!$item->save())
							{
								$flag = FALSE;
								break;
							}
						}
					}
					else
					{
						$flag = FALSE;
					}
				}

				if(!$flag)
				{
					throw new Exception("Can't Duplicate MyFile");
				}
				else
				{
					$transaction->commit();
					$this->redirect(array(
						'index',
					));
				}
			}
			catch(Exception $exc)
			{
				$transaction->rollback();
				echo $exc->getTraceAsString();
			}
		}
		$this->render("/share/_duplicate_form", array(
			'model'=>$model));
	}

}
