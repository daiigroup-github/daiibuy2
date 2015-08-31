<?php

class CategoryController extends MasterFenzerController
{

	public function actionIndex($id)
	{
		$categoryModel = Category::model()->findByPk($id);
		$images = [];
		if(isset($categoryModel->image) && !empty($categoryModel->image))
		{
			$i = 1;
			$images[0] = Yii::app()->baseUrl . $categoryModel->image;
		}
		else
		{
			$i = 0;
		}
		if(count($categoryModel->images) > 0)
		{
			foreach($categoryModel->images as $catImage)
			{
				$images[$i] = $catImage->image;
				$i++;
			}
		}
		else
		{
			$images[0] = "";
		}
//		foreach($this->scanDir(Yii::app()->basePath . '/../images/fenzer') as $k=> $image)
//		{
//			$images[$k] = Yii::app()->baseUrl . '/images/fenzer/' . $image;
//		}

		$product = array(
			'title'=>'Madrid Sanitary #' . $id,
			'code'=>'PBS173',
			'category'=>'Sanitary',
			'stock'=>'20',
			'dimension'=>array(
				'w'=>100.00,
				'h'=>100.00,
				'l'=>100.00,
			),
			'weight'=>80.50,
			'productId'=>1,
			'options'=>array(
				array(
					'option1'),
				array(
					'option2'),
			),
			'images'=>$images,
			'description'=>'Control simulated sensors like battery, GPS, and accelerometer with a the user-friendly interface.<br /><br />Powerful command line tools allow you to build complex tests.',
			'tabs'=>array(
				array(
					'title'=>'Items',
					'detail'=>'No items',
					'id'=>'items'
				),
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



		$fenzerArray = array();
		foreach($categoryModel->fenzerToProductsCategory1 as $f)
		{
			$productModel = Product::model()->findByPk($f->productId);
			if(isset($productModel))
				if($productModel->status <> 5)
					$fenzerArray[$f->productId] = $f->product->name;
		}

		$this->render('index', array(
			'product'=>$product,
			'categoryModel'=>$categoryModel,
			'fenzerArray'=>$fenzerArray,
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
