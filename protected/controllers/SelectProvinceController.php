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

			//$this->writeToFile('/tmp/selectprovince', print_r($this->cookie, true));
			echo json_encode($this->cookie);
		}
	}
}

