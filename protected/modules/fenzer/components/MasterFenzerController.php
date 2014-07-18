<?php

class MasterFenzerController extends MasterController
{
	public function init()
	{
		parent::init();

		$this->nav = array(
			array(
				'url'=>'#',
				'color'=>'green',
				'caption'=>'Madrid Tile',
				'description'=>'Description'
			),
			array(
				'url'=>'#',
				'color'=>'blue',
				'caption'=>'Madrid Sanitary',
				'description'=>'Description'
			),
			array(
				'url'=>'#',
				'color'=>'red',
				'caption'=>'Tile Theme',
				'description'=>'Description'
			),
			array(
				'url'=>'#',
				'color'=>'orange',
				'caption'=>'Sanitary Set',
				'description'=>'Description'
			),
			array(
				'url'=>'#',
				'caption'=>'About Madrid',
				'description'=>'Company Profile'
			),
		);

		$this->sideBarCategories = array(
			'title'=>'Fenzer Categories',
		    'items'=>array(
				array(
					'link'=>'M-Wall',
				    'url'=>'#'
				),
				array(
					'link'=>'Double S',
					'url'=>'#'
				),
				array(
					'link'=>'Sandy',
					'url'=>'#'
				),
				array(
					'link'=>'Brick',
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
	}

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
		foreach ($this->scanDir(Yii::app()->basePath . '/../images/fenzer') as $file) {
			$items[$i] = [
				'id' => $i,
				'image' => Yii::app()->baseUrl . '/images/fenzer/' . $file,
				'url' => Yii::app()->createUrl('fenzer/product/index/id/' . $i),
				'title' => substr($file, 0, -4),
				'price' => rand(1000, 99999),
				'buttons' => [
					'cart',
					//'favorites'
				]
			];

			$i++;
		}

		return $items;
	}
}