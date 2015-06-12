<?php

class StyleController extends MasterController
{
	public function actionIndex($id)
	{
        /**
         * Ginza style CategoryToSub::isTheme=1
         */
        $supplierModel = Supplier::model()->find(array('condition'=>'url=:url', 'params'=>array(':url'=>$this->module->id)));

        //find all styles
        $styles = CategoryToSub::model()->findAll(array(
            'condition'=>'brandModelId=:brandModelId AND isTheme=:isTheme',
            'params'=>array(
                ':brandModelId'=>$id,
            ),
            'order'=>'sortOrder',
            'select'=>'distinct categoryId'
        ));

        $this->render('index', array(
            'supplierModel'=>$supplierModel,
            'styles'=>$styles,
            'brandModelId'=>$id
        ));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}