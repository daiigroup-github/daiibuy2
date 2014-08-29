<?php

class DefaultController extends MasterBackofficeController
{
	public function actionIndex()
	{
		$this->render('index');
	}
}