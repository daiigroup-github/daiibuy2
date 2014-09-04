<?php

class LoginController extends MasterBackofficeController
{

	public function actionIndex()
	{
		$this->layout = '//layouts/login';

		$model = new LoginForm;

		if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				if(User::model()->findByPk(Yii::app()->user->id)->isFirstLogin == 1)
					$this->redirect(Yii::app()->baseUrl . "/index.php/Site/changePassword");
				else
				{
					throw new Exception(Yii::app()->request->urlReferrer);
					$this->redirect(Yii::app()->request->urlReferrer);
				}
		}

		$this->render('index', array(
			'model'=>$model));
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect("index");
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
