<?php

class ContentController extends MasterController
{

	public $layout = '//layouts/home';

	public function actionView($id)
	{
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/daiibuy.js');
		$model = Content::model()->findByPk($id);

		$this->render("view", array(
			'model'=>$model));
	}

}
