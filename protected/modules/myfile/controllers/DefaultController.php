<?php

class DefaultController extends MasterController
{

//	public $layout = '//layouts/cl1';

	public function actionIndex()
	{
		$this->nav = array(
			array(
				'url'=>'#',
				'color'=>'green',
				'caption'=>'M-WALL',
				'description'=>'Description'
			),
			array(
				'url'=>'#',
				'color'=>'blue',
				'caption'=>'DOUBLE-S',
				'description'=>'Description'
			),
			array(
				'url'=>'#',
				'color'=>'red',
				'caption'=>'SANDY',
				'description'=>'Description'
			),
			array(
				'url'=>'#',
				'color'=>'orange',
				'caption'=>'BRICKS',
				'description'=>'Description'
			),
			array(
				'url'=>'#',
				'caption'=>'ABOUT FENZER',
				'description'=>'Company Profile'
			),
		);


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

}
