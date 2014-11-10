<?php

class ContentController extends MasterMadridController
{

	public function actionView($id)
	{
		$model = SupplierContent::model()->findByPk($id);

		$this->render("view", array(
			'model'=>$model));
	}

}
