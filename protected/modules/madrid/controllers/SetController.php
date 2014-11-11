<?php

class SetController extends MasterMadridController
{

	public $layout = '//layouts/cl1';

	public function actionIndex()
	{
//		$category = Category::model()->findByPk($id);
//		$title = $category->title;
		$title = "Sanitary Set";

		$categoryToSub = CategoryToSub::model()->findAll(array(
//			'condition'=>'categoryId=:categoryId AND isSet=1',
			'condition'=>' isSet=1',
//			'params'=>array(
//				':categoryId'=>$id,
//			),
		));
		//$subCategorys = CHtml::listData($category->subCategorys, 'categoryId', 'categoryId');
		$subCategorysId = implode(',', CHtml::listData($categoryToSub, 'subCategoryId', 'subCategoryId'));

		$category2ToProducts = Category2ToProduct::model()->findAll(array(
//			'condition'=>'category1Id=:category1Id AND category2Id IN (:category2Id)',
			'condition'=>'category2Id IN (:category2Id)',
			'params'=>array(
//				':category1Id'=>$id,
				':category2Id'=>$subCategorysId,
			),
		));

		$categorys = Category::model()->findAll(array(
			'condition'=>'categoryId IN (:categoryIds)',
			'params'=>array(
				':categoryIds'=>implode(',', CHtml::listData($category2ToProducts, 'category2Id', 'category2Id')),
			),
		));

		$items = $this->showSanitarySet($categorys);
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

	public function actionDetail()
	{
		$images = [];
		foreach($this->scanDir(Yii::app()->basePath . '/../images/madrid/sanitary') as $k=> $image)
		{
			$images[$k] = Yii::app()->baseUrl . '/images/madrid/sanitary/' . $image;
		}
		$product = array(
			'title'=>'Madrid Sanitary #',
			'code'=>'PBS173',
			'category'=>'Sanitary',
			'stock'=>'20',
			'dimension'=>array(
				'w'=>100.00,
				'h'=>100.00,
				'l'=>100.00,
			),
			'weight'=>80.50,
			'price'=>300,
			'pricePromotion'=>280,
			'productId'=>1,
			'options'=>array(
				array(
					'option1'),
				array(
					'option2'),
			),
			'images'=>$images,
			'tabs'=>array(
				array(
					'title'=>'Description',
					'detail'=>'Detail Tab1'
				),
				array(
					'title'=>'Reviews',
					'detail'=>'Detail Tab2'
				),
				array(
					'title'=>'Comments',
					'detail'=>'Detail Tab3'
				),
			),
		);

		$this->render('detail', array(
			'product'=>$product));
	}

	public function actionView($id)
	{
		$model = Category::model()->findByPk($id);
		$cat2Product = Category2ToProduct::model()->findAll("category2Id=:category2Id", array(
			":category2Id"=>$id));
		$this->render('view', array(
			'model'=>$model,
			'cat2Product'=>$cat2Product));
	}

	public function showSanitarySet($categorys)
	{
		$items = [];
		$i = 1;
		foreach($categorys as $category)
		{
			$image = '';
			if(isset($category->productImages))
			{
				foreach($category->categoryImages as $categoryImage)
				{
					$image = $categoryImage->image;
					break;
				}
			}

			$items[$i] = array(
				'id'=>$category->categoryId,
				'image'=>Yii::app()->baseUrl . $image,
				'url'=>Yii::app()->createUrl('madrid/set/view/id/' . $category->categoryId),
				'category2Id'=>$category->categoryId,
				'title'=>$category->title,
				//'price' => rand(1000, 99999),
				'buttons'=>[
					'favorites'
				],
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


	public function actionAddFavourite()
	{
		$model = new UserFavourite();
		$model->userId = $_POST["userId"];
		$model->category2Id = $_POST["category2Id"];
		$model->createDateTime = new CDbExpression("NOW()");
		$model->updateDateTime = new CDbExpression("NOW()");
		if($model->save())
		{
			echo 1;
		}
		else
		{
			echo 2;
		}
	}

}
