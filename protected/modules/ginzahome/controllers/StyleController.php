<?php

class StyleController extends MasterGinzahomeController
{

	public function actionIndex($id)
	{
		/**
		 * Ginza style CategoryToSub::isTheme=1
		 */
		$supplierModel = Supplier::model()->find(array(
			'condition'=>'url=:url',
			'params'=>array(
				':url'=>$this->module->id)));

		//find all styles
		$categoryIds = CategoryToSub::model()->findAll(array(
			'condition' => 'brandModelId=' . $id . ' AND isTheme=1',
			'order' => 'sortOrder',
			'select' => 'distinct categoryId'
		));
		$catText = "";
		$i = 1;
		foreach ($categoryIds as $cat)
		{
			$catText = $catText . $cat->categoryId;
			if ($i < count($categoryIds))
				$catText .= ", ";
			$i++;
		}
		$styles = Category::model()->findAll('categoryId in (' . $catText . ' ) order by sortOrder');




		$this->render('index', array(
			'supplierModel'=>$supplierModel,
			'styles'=>$styles,
			'brandModelId'=>$id
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
