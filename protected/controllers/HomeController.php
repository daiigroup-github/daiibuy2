<?php

class HomeController extends MasterController
{

	public $layout = '//layouts/home';

	public function actionIndex()
	{
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/daiibuy.js');
		$suppliers = Supplier::model()->findAll('status=1');
		shuffle($suppliers);

		/**
		 * url
		 * name
		 * description
		 * logo
		 */
		$sup = [];
		$i = 0;
		foreach ($suppliers as $supplier) {
			$sup[$i] = [
				'url'=>$supplier->url,
				'name'=>$supplier->name,
				'description'=>$supplier->description,
				'logo'=>$supplier->logo
			];
			$i++;
		}

		$suppliers = $sup;


		$this->render('index', array(
			'suppliers'=>$suppliers));
	}

	public function actionPartner()
	{
		$login = new LoginForm();
		$user = new User();
		$code = $_GET["code"];
		$codeArray = explode("-", $code);
		$partnerType = NULL;
		if(strtolower($codeArray[0]) == "org")
		{
			$partnerType = 1;
		}
		else if(strtolower($codeArray[0]) == "wow")
		{
			$partnerType = 2;
		}
		else
		{
			$partnerType = 0;
		}

		$promotions = Promotion::model()->findAll("type = $partnerType AND now() BETWEEN startDateTime AND endDateTime");

		if(isset($_POST["User"]))
		{
			$user->attributes = $_POST["User"];
			$user->password = $user->hashPassword($user->email, $user->password);
			$user->approved = 1;
			$user->type = 1;
			$user->status = 1;
			$user->partnerCode = $code;
			if($user->save())
			{
				$this->redirect(array(
					"site/login",
					'message'=>'ลงทะเบียนเสร็จสมบูรณ์ กรุณา เข้าสู่ระบบ เพื่อสั่งซื้อสินค้า'));
			}
		}
		$this->render('partner', array(
			'code'=>$code,
			'partnerType'=>$partnerType,
			'promotions'=>$promotions,
			'login'=>$login,
			'user'=>$user));
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

	public function actionUnsetCookie()
	{
		$daiibuy = new DaiiBuy();
		$daiibuy->unsetCookie();
	}

}
