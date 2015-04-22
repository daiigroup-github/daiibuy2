<?php

class TypeController extends MasterMadridController
{

	public $layout = '//layouts/cl1';

	public function actionIndex()
	{
		$title = "Type";

		$categoryToSub = CategoryToSub::model()->findAll(array(
//			'condition'=>'categoryId=:categoryId AND isTheme=1',
			'condition'=>' isType=1',
//			'params'=>array(
//				':categoryId'=>$id,
//			),
		));

		//$subCategorys = CHtml::listData($category->subCategorys, 'categoryId', 'categoryId');
		$subCategorysId = implode(',', CHtml::listData($categoryToSub, 'categoryId', 'categoryId'));

//		$category2ToProducts = Category2ToProduct::model()->findAll(array(
////			'condition'=>'category1Id=:category1Id AND category2Id IN (:category2Id)',
//			'condition'=>'category2Id IN (:category2Id)',
//			'params'=>array(
////				':category1Id'=>$id,
//				':category2Id'=>$subCategorysId,
//			),
//		));
//		$category2ToProducts = Category2ToProduct::model()->findAll("category2Id in (" . $subCategorysId . ")");
//
//
////		$products = Product::model()->findAll(array(
////			'condition'=>'productId IN (:productsId)',
////			'params'=>array(
////				':productsId'=>implode(',', CHtml::listData($category2ToProducts, 'productId', 'productId')),
////			),
////		));
////		$categorys = Category::model()->findAll(array(
////			'condition'=>'categoryId IN (:categoryIds)',
////			'params'=>array(
////				':categoryIds'=>implode(',', CHtml::listData($category2ToProducts, 'category2Id', 'category2Id')),
////			),
////		));
//		$cat2Ids = implode(',', CHtml::listData($category2ToProducts, 'category2Id', 'category2Id'));
		$categorys = Category::model()->findAll("categoryId IN (" . $subCategorysId . ")");
//		throw new Exception(print_r($categorys, true));
		$items = $this->showType($categorys);
//		throw new Exception(print_r($items, true));
		$dataProvider = new CArrayDataProvider($items, array(
			'keyField'=>'id'));
		$dataProvider->pagination->pageSize = 12;
		$template = "<div class='row'>
			<div class='col-lg-6 col-md-6 col-sm-6'>{summary}</div>\n
			<div class='col-lg-6 col-md-6 col-sm-6'>{pager}</div>\n
		</div>
		<div class='row'>
			{items}
		</div>
		<div class='row'>
			<div class='col-lg-6 col-md-6 col-sm-6'>{summary}</div>\n
			<div class='col-lg-6 col-md-6 col-sm-6'>{pager}</div>\n
		</div>";
		$summaryText = '<p>Display {start}-{end} of {count} items (page {page} of {pages})</p>';
		$itemClass = 'col-lg-3 col-md-3 col-sm-4';

		$this->render('index', array(
			'title'=>$title,
			'dataProvider'=>$dataProvider,
			'itemView'=>'_product_item',
			'template'=>$template,
			'summaryText'=>$summaryText,
			'itemClass'=>$itemClass
		));
	}

	public function showType($categorys)
	{
		$items = [];
		$i = 1;
		/*
		  foreach ($this->scanDir(Yii::app()->basePath . '/../images/madrid/tile') as $file) {
		  if(substr($file, 0, 1) == '.') continue;

		  $items[$i] = [
		  'id' => $i,
		  'image' => Yii::app()->baseUrl . '/images/madrid/tile/' . $file,
		  'url' => Yii::app()->createUrl('madrid/product/index/id/' . $i),
		  'title' => substr($file, 0, -4),
		  'price' => rand(1000, 99999),
		  'buttons' => [
		  'favorites'
		  ],
		  'isQuickView'=>true
		  ];

		  $i++;
		  }
		 */
		foreach($categorys as $category)
		{
			$image = '';
			if(isset($category->categoryImages))
			{
				foreach($category->categoryImages as $categoryImage)
				{
					$image = $categoryImage->image;
					break;
				}
			}

			$items[$i] = array(
				'id'=>$category->categoryId,
				'image'=>Yii::app()->baseUrl . $category->image,
				'url'=>Yii::app()->createUrl('madrid/theme/index/id/' . $category->categoryId),
				'category2Id'=>$category->categoryId,
				'title'=>$category->title,
				//'price' => rand(1000, 99999),
//				'buttons'=>[
//					'favorites'
//				],
				'isQuickView'=>true
			);
			$i++;
		}

		return $items;
	}

	// Uncomment the following methods and override them if needed
	/*
	  public function filters()
	  {
	  // return the filter configuration for this controller, e.g.:
	  return array(
	  'inlineFilterName',
	  array(
	  'class'=>'path.to.FilterClass',
	  'propertyName'=>'propertyValue',
	  ),
	  );
	  }

	  public function actions()
	  {
	  // return external action classes, e.g.:
	  return array(
	  'action1'=>'path.to.ActionClass',
	  'action2'=>array(
	  'class'=>'path.to.AnotherActionClass',
	  'propertyName'=>'propertyValue',
	  ),
	  );
	  }
	 */
}
