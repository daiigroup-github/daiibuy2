<?php

class MasterAtechwindowController extends MasterController
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

		$supplier = Supplier::model()->find(array(
			'condition'=>'url=:url',
			'params'=>array(
				':url'=>$this->module->id,
			),
		));

		$categorys = Category::model()->findAll(array(
			'condition'=>'supplierId=:supplierId AND isRoot=1',
			'params'=>array(
				':supplierId'=>$supplier->supplierId,
			),
			'order'=>'title'
		));

		$i = 0;
		foreach($categorys as $category)
		{
			$this->nav[$i] = array(
				'url'=>$this->createUrl('default/index/id/' . $category->categoryId),
				'caption'=>strtoupper($category->title),
				'description'=>'Company Profile',
				'color'=>$this->navColor[$i % 4],
			);

			if($category->subCategorys !== array())
			{
				$dropdown = array();
				$j = 0;
				foreach($category->subCategorys as $subCategory)
				{
					$dropdown[$j] = array(
						'url'=>$this->createUrl('category/index/id/' . $subCategory->categoryId),
						'caption'=>strtoupper($subCategory->title),
					);
					$j++;
				}
				$this->nav[$i]['dropdown'] = $dropdown;
			}

			$i++;
		}

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

}
