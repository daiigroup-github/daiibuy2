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
}
