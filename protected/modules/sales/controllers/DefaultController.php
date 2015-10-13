<?php

class DefaultController extends MasterSalesController
{

	public $layout = '//layouts/cl1';

	public function actionIndex()
	{
		$model = new LoginForm();
		$this->render('index', array(
			'model'=>$model));
	}

}
