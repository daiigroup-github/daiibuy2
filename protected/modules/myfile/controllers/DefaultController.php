<?php

class DefaultController extends MasterMyFileController
{

//	public $layout = '//layouts/cl1';

	public function actionIndex()
	{
		$this->sideBarCategories = array(
			'title'=>'MyFile Categories',
			'items'=>array(
				array(
					'link'=>'Atechwindow',
					'url'=>'#'
				),
				array(
					'link'=>'Fenzer',
					'url'=>'#'
				),
				array(
					'link'=>'Ginza Home',
					'url'=>'#'
				),
				array(
					'link'=>'Madrid Bathroom',
					'url'=>'#'
				),
			)
		);


		$suppliers = array(
			'atechwindow'=>'Atech Window',
			'fenzer'=>'Fenzer',
			'ginzahome'=>'Ginza Home',
			'madrid'=>'Madrid Bathroom',
		);
		$this->render('index', array(
			'suppliers'=>$suppliers));
	}

	public function actionHome($id)
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

}
