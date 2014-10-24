<?php

class MasterMyFileController extends MasterController
{

	public function init()
	{
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/wizard.create.myfile.js');
		parent::init();

		$this->nav = array(
			array(
				'url'=>'#',
				'color'=>'green',
				'caption'=>'FENZER',
				'description'=>'Fence and wall'
			),
			array(
				'url'=>'#',
				'color'=>'blue',
				'caption'=>'ATECH WINDOW',
				'description'=>'Atech Doors and Windows'
			),
			array(
				'url'=>'#',
				'color'=>'red',
				'caption'=>'GINZA HOME',
				'description'=>'Ginza Home'
			),
			array(
				'url'=>'#',
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

}
