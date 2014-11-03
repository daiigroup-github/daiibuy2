<?php

class MasterFenzerController extends MasterController
{

	public function init()
	{
		parent::init();

		Yii::app()->clientScript->registerCSSFile(Yii::app()->baseUrl . '/css/fenzer.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/daiibuy.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/fenzer.js');

		$supplier = Supplier::model()->find(array(
			'condition'=>'url=:url',
			'params'=>array(
				':url'=>$this->module->id,
			),
		));

		$i = 1;
		$i1 = 0;
		$this->nav[0] = array(
			'url'=>$this->createUrl('/fenzer'),
			'caption'=>"<i class='icon icon-home'></i>",
//                        'description' => 'Company Profile',
			'color'=>$this->navColor[0],
			'class'=>' nav-search'
		);
		foreach($supplier->brands as $brand)
		{
			foreach($brand->brandModels as $brandModel)
			{

				$this->nav[$i] = array(
					'url'=>$this->createUrl('default/indexCat/id/' . $brandModel->brandModelId),
					'caption'=>$brandModel->title,
//                        'description' => 'Company Profile',
					'color'=>$this->navColor[$i]
				);
				$i++;
				foreach($brandModel->categorys as $category)
				{

					$this->sideBarCategories["items"][$i1] = array(
						'link'=>$category->title,
						'url'=>$this->createUrl('category/index/id/' . $category->categoryId),
					);
					$i1++;
				}
			}
		}


		$this->sideBarCategories["title"] = "Fenzer Categories";
//		array(
//			'title'=>'Fenzer Categories',
//			'items'=>array(
//				array(
//					'link'=>'M-Wall',
//					'url'=>'#'
//				),
//				array(
//					'link'=>'Double S',
//					'url'=>'#'
//				),
//				array(
//					'link'=>'Sandy',
//					'url'=>'#'
//				),
//				array(
//					'link'=>'Brick',
//					'url'=>'#'
//				),
//			)
//		);

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
		foreach($this->scanDir(Yii::app()->basePath . '/../images/fenzer') as $file)
		{
			$items[$i] = [
				'id'=>$i,
				'image'=>Yii::app()->baseUrl . '/images/fenzer/' . $file,
				'url'=>Yii::app()->createUrl('fenzer/category/index/id/' . $i),
				'title'=>substr($file, 0, -4),
				'price'=>'ราคาต่อเมตร ' . number_format(rand(1000, 2999), 2) . ' บาท',
				'description'=>'bla bla bla ...',
				'isQuickView'=>false
			];

			$i++;
		}

		return $items;
	}

}
