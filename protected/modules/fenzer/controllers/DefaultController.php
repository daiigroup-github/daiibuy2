<?php

class DefaultController extends MasterFenzerController
{

	public $layout = '//layouts/cl1';

	public function actionIndex()
	{
		$supplierModel = Supplier::model()->find(array(
			'condition'=>'url=:url',
			'params'=>array(
				':url'=>$this->module->id)));

		$this->render('index', array(
			'supplierModel'=>$supplierModel));
	}

	public function actionIndexCat($id)
	{
		$brandModel = BrandModel::model()->findByPk($id);
		$this->render('index_cat', array(
			'brandModel'=>$brandModel));
	}

}
