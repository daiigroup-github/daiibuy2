<?php

class ContentController extends MasterAtechwindowController
{

	public function actionView($id)
	{
		$model = SupplierContent::model()->findByPk($id);

		$this->render("view", array(
			'model'=>$model));
	}

}
