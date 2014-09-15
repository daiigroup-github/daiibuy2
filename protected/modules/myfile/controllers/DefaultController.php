<?php

class DefaultController extends MasterController
{

	public $layout = '//layouts/cl1';

	public function actionIndex()
	{
		$suppliers = array(
			'atechwindow'=>'Atech Window',
			'fenzer'=>'Fenzer',
			'ginzahome'=>'Ginza Home',
			'madrid'=>'Madrid Bathroom',
		);
		$this->render('index', array(
			'suppliers'=>$suppliers));
	}

}
