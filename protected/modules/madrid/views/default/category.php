<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>

<?php $this->renderPartial('//layouts/_product_list', array('title'=>$title));?>
