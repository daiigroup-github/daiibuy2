<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class MasterController extends Controller
{

	public $layout = '//layouts/cl2';
	public $pageTitle;
	public $nav = array();
	public $navColor = array(
		'green',
		'blue',
		'red',
		'orange'
	);
	public $sideBarCategories = array();
	public $sideBarContents = array();
	public $sideBarCompare = array();
	public $sideBarCarousel = array();
	public $sideBarBestSellers = array();
	public $sideBarTag = array();
	public $sideBarSpecials = array();
	public $cookie;
	public $province;
	//category
	public $cat1 = array();
	public $cat2 = array();

	public function init()
	{
		parent::init();
		$this->cookie = new DaiiBuy();
		$this->cookie->loadCookie();
		$this->province = isset($this->cookie['provinceId']) && !empty($this->cookie['provinceId']) ? Province::model()->findByPk($this->cookie['provinceId'])->provinceName : '';
	}

	public function writeToFile($filePath, $string, $mode = 'w+')
	{
		$handle = fopen($filePath, $mode);
		fwrite($handle, $string);
		fclose($handle);
	}

}
