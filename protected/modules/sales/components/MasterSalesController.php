<?php

class MasterSalesController extends MasterController
{

	public function init()
	{
		parent::init();

		Yii::app()->clientScript->registerCSSFile(Yii::app()->baseUrl . '/css/atechwindow.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/daiibuy.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/atechwindow.js');

//        $this->nav = array(
//            array(
//                'url' => '#',
//                'color' => 'green',
//                'caption' => 'Window',
//                'description' => 'Description'
//            ),
//            array(
//                'url' => '#',
//                'color' => 'blue',
//                'caption' => 'Door',
//                'description' => 'Description'
//            ),
//            array(
//                'url' => '#',
//                'caption' => 'ABOUT ATECH WINDOW',
//                'description' => 'Company Profile'
//            ),
//        );
//		$supplier = Supplier::model()->find(array(
//			'condition'=>'url=:url',
//			'params'=>array(
//				':url'=>$this->module->id,
//			),
//		));
//
//		$brands = Brand::model()->findAll(array(
//			'condition'=>'supplierId=:supplierId',
//			'params'=>array(
//				':supplierId'=>$supplier->supplierId,
//			),
//			'order'=>'title ASC',
////            'group by' => 'category2Id',
//		));
//		$this->nav[0] = array(
//			'url'=>$this->createUrl('/atechwindow'),
//			'caption'=>"<i class='icon icon-home'></i>",
////                        'description' => 'Company Profile',
//			'color'=>$this->navColor[0],
//			'class'=>' nav-search'
//		);
//		$i = 1;
//		foreach($brands as $brand)
//		{
//			$this->nav[$i] = array(
//				'url'=>$this->createUrl('default/index/brandId/' . $brand->brandId),
//				'caption'=>strtoupper($brand->title),
//				'description'=>$brand->description,
//				'color'=>$this->navColor[$i % 4],
//			);
//
////			if($category->subCategorys !== array())
////			{
////				$dropdown = array();
////				$j = 0;
////				foreach($category->subCategorys as $subCategory)
////				{
////					$dropdown[$j] = array(
////						'url'=>$this->createUrl('category/index?id=' . $subCategory->categoryId . "&category1Id=" . $category->categoryId),
////						'caption'=>strtoupper($subCategory->title),
////					);
////					$j++;
////				}
////				$this->nav[$i]['dropdown'] = $dropdown;
////			}
//
//			$i++;
//		}
//		$this->sideBarCategories = array(
//			'title'=>'Atech Window',
//			'items'=>$sideBar);

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

}
