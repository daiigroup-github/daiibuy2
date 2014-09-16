<?php

class MadridController extends MasterMyFileController
{

	public function actionIndex()
	{
		$this->layout = '//layouts/cl1';

		$suppliers = array(
			'myfile1'=>'myfile1',
			'myfile2'=>'myfile2',
			'myfile3'=>'myfile3',
			'myfile4'=>'myfile4',
		);
		$this->render('index', array(
			'suppliers'=>$suppliers));
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
