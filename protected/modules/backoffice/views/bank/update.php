<?php
/* @var $this BankController */
/* @var $model Bank */

$this->breadcrumbs = array(
	'Banks'=>array(
		'index'),
	'Update',
);

$this->pageHeader = "แก้ไขบัญชีธนาคาร " . $model->id;
?>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>