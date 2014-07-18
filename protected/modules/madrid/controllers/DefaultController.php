<?php

class DefaultController extends MasterMadridController
{
	public function actionIndex()
	{
		$this->sideBarCategories = array(
			'title'=>'Madrid Categories',
			'items'=>array(
				array(
					'link'=>'Sanitary',
					'url'=>'madrid/category/index/id/1'
				),
				array(
					'link'=>'Tile',
					'url'=>'madrid/category/index/id/2'
				),
			)
		);

		$this->render('index');
	}

	public function actionCategory($id)
	{
		$title = ($id == 1) ? 'Sanitary' : 'Tile';
		$this->render('category', array('title'=>$title));
	}
}