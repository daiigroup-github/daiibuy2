<?php

class MasterMadridController extends MasterController
{

	public function init()
	{
		parent::init();

		Yii::app()->clientScript->registerCSSFile(Yii::app()->baseUrl . '/css/madrid.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/daiibuy.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/madrid.js');

		$supplier = Supplier::model()->find(array(
			'condition'=>'url=:url',
			'params'=>array(
				':url'=>$this->module->id,
			),
		));

		$categorys = Category::model()->findAll(array(
			'condition'=>'supplierId=:supplierId AND isRoot=1',
			'params'=>array(
				':supplierId'=>$supplier->supplierId
			),
		));

		$nav = array();
		$i = 1;
		$this->nav[0] = array(
			'url'=>$this->createUrl('/madrid'),
			'caption'=>"<i class='icon icon-home'></i>",
//                        'description' => 'Company Profile',
			'color'=>$this->navColor[0],
			'class'=>' nav-search'
		);
		foreach($categorys as $category)
		{

			$categoryToSub = CategoryToSub::model()->findSetAndTheme($category->categoryId);
			if(isset($categoryToSub))
			{
				if($categoryToSub->isTheme == 1)
				{
					$nav['theme'] = array(
						'url'=>$this->createUrl('theme/index/id/' . $category->categoryId),
						//'url' => $this->createUrl($this->module->id.'/../theme'),
						'color'=>'orange',
						'caption'=>$category->title,
//                        'description' => 'Description'
					);
				}

				if($categoryToSub->isSet == 1)
				{
					$nav['set'] = array(
						'url'=>$this->createUrl('set/index/id/' . $category->categoryId),
//                        'url' => $this->createUrl($this->module->id.'/../set'),
						'color'=>'red',
						'caption'=>$category->title,
//                        'description' => 'Description'
					);
				}
			}
			else
			{
				$this->nav[$i] = array(
					'url'=>$this->createUrl('category/index/id/' . $category->categoryId),
					'color'=>$this->navColor[$i % 4],
					'caption'=>$category->title,
					'description'=>'Description'
				);

				$i++;
			}
		}

		$this->nav[$i++] = $nav['theme'];
		$this->nav[$i++] = $nav['set'];
	}

	//temp function
	public function scanDir($dir)
	{
		$files = scandir($dir);
		array_shift($files);
		array_shift($files);
		return $files;
	}

	public function showSanitary($type = 1)
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

		$productType = ($type == 1) ? 'sanitary' : 'tile';

		$items = [];
		$i = 1;
		foreach($this->scanDir(Yii::app()->basePath . '/../images/madrid/' . $productType) as $file)
		{
			if(substr($file, 0, 1) == '.')
				continue;

			$items[$i] = [
				'id'=>$i,
				'image'=>Yii::app()->baseUrl . '/images/madrid/' . $productType . '/' . $file,
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

	public function sideBarCategories($categoryId)
	{
		$res = array();
		$category = Category::model()->findByPk($categoryId);
		$items[0] = array(
			'link'=>'All',
			'url'=>$this->createUrl('category/index/id/' . $category->categoryId),
		);
		$res['title'] = $category->title;

		$i = 1;
		foreach($category->subCategorys as $subCategory)
		{
			$items[$i] = array(
				'link'=>$subCategory->title,
				'url'=>$this->createUrl('category/index/id/' . $category->categoryId . '/id2/' . $subCategory->categoryId),
			);
			$i++;
		}

		$res['items'] = $items;
		return $res;
	}

}
