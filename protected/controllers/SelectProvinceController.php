<?php

class SelectProvinceController extends MasterController
{

	public function actionSaveProvince()
	{
		if(isset($_POST['provinceId']))
		{
			$this->cookie = new DaiiBuy();
			$this->cookie->loadCookie();

			$this->cookie->provinceId = $_POST['provinceId'];
			$this->cookie->saveCookie();

			echo json_encode($this->cookie);
		}
	}
}

