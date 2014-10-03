<?php
/* @var $this BankController */
/* @var $model Bank */

$this->breadcrumbs = array(
	'Banks'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List Bank',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage Bank',
		'url'=>array(
			'admin')),
);

$this->pageHeader = "สร้างบัญชีธนาคาร";
?>


<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>