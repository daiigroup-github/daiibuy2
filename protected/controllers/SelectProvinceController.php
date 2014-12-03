<?php

class SelectProvinceController extends MasterController
{

	public function actionSaveProvince()
	{
			if(isset($_POST['provinceId']))
			{
//				if($_POST['flag'] && isset(Yii::app()->user->id)){
//					$this->redirect(Yii::app()->baseUrl . "/checkout/step/2");
					$this->cookie = new DaiiBuy();
					$this->cookie->loadCookie();
					$this->cookie->provinceId = $_POST['provinceId'];
					$this->cookie->saveCookie();
				echo json_encode($this->cookie);

		}
	}
}

