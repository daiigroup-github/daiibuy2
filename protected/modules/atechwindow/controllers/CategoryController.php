<?php

class CategoryController extends MasterAtechwindowController
{

	public function actionIndex($id)
	{
		$colors = array(
			'ALL',
			'White',
			'Brown',
			'Black',
			'Gray',
		);

		$category2 = Category::model()->findByPk($id);
		//Tong Loop For Show Side Category By Cat1
		$catToSubs = CategoryToSub::model()->findAll("categoryId=" . $_GET["category1Id"] . " GROUP By subCategoryId");
		$i = 0;
		$sideBar = array();
		foreach($catToSubs as $catToSub)
		{
			$sideBar[$i] = array(
				'url'=>$this->createUrl('category/index?id=' . $catToSub->subCategoryId . "&category1Id=" . $catToSub->categoryId),
				'link'=>strtoupper($catToSub->subCategory->title),
			);
			$i++;
		}
		$this->sideBarCategories = array(
			'title'=>'Atech Window',
			'items'=>$sideBar);

		//Tong Loop For Show Side Category By Cat1
		$images = [];
		if(count($category2->images) > 0):
			foreach($category2->images as $image)
			{
				$images[] = Yii::app()->baseUrl . $image->image;
			}
		else:
			$images[] = Yii::app()->baseUrl . $category2->image;
		endif;

		//Create By Tong
		$widthArray = Product::model()->findAtechWidthGroup($id);
		$heightArray = Product::model()->findAtechHeightGroup($id);

		$this->render('index', array(
			'category2'=>$category2,
			'images'=>$images,
			'colors'=>$colors,
			'widthArray'=>$widthArray,
			'heightArray'=>$heightArray
		));
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

	public function actionViewOtherProduct($id)
	{
		$cat2ToProduct = Category2ToProduct::model()->findByPk($id);

		$models = Category2ToProduct::model()->findAll("brandId=:brandId AND brandModelId=:brandModelId ");
	}

}
