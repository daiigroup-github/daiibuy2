<?php

class CategoryController extends MasterGinzahomeController
{

	public $layout = '//layouts/cl1';

	public function actionIndex($id)
	{
		$brandModel = BrandModel::model()->findByPk($id);
//        foreach ($brandModel->categorys as $category) {
//            echo $category->title . ' ' . $category->categoryId . '<br />';
//
//            foreach ($category->subCategorys as $sub) {
//                echo $sub->title . ' ' . $sub->categoryId . '<br />';
//                echo Product::model()->ginzaPriceByCategory1IdAndCategory2Id($category->categoryId, $sub->categoryId);
//                echo '<hr />';
//            }
//        }

		$this->render('index', array(
			'brandModel'=>$brandModel));
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
