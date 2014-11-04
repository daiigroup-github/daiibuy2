<?php

class DefaultController extends MasterMyFileController
{

//	public $layout = '//layouts/cl1';

	public function actionIndex()
	{


//		$suppliers = array(
//			'fenzer'=>'Fenzer',
//			'atechwindow'=>'Atech Window',
//			'ginzahome'=>'Ginza Home',
//			'madrid'=>'Madrid Bathroom',
//		);
		$suppliers = Supplier::model()->findAll("status = 1");

		$this->render('index', array(
			'suppliers'=>$suppliers));
	}

}
