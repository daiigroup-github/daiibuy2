<?php
/* @var $this OrderDetailTemplateController */
/* @var $model OrderDetailTemplate */

$this->breadcrumbs=array(
	'Order Detail Templates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrderDetailTemplate', 'url'=>array('index')),
	array('label'=>'Manage OrderDetailTemplate', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create OrderDetailTemplate</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>