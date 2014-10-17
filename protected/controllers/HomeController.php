<?php

class HomeController extends MasterController
{
	public $layout = '//layouts/home';
	public function actionIndex()
	{
        $suppliers = Supplier::model()->findAll('status=1');
        shuffle($suppliers);

		$this->render('index', array('suppliers'=>$suppliers));
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

    public function actionUnsetCookie()
    {
        $daiibuy = new DaiiBuy();
        $daiibuy->unsetCookie();
    }
}