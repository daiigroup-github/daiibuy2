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


<div class="panel panel-default">
	<div class="panel-heading">Update Bank</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array(
			'model'=>$model)); ?>
	</div>
</div>