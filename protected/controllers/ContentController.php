<?php

class ContentController extends MasterController
{

	public $layout = '//layouts/home';

	public function actionView($id)
	{
		$model = Content::model()->findByPk($id);

		$this->render("view", array(
			'model'=>$model));
	}

}
