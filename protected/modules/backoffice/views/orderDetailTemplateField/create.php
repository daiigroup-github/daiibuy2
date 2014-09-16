<?php
/* @var $this OrderDetailTemplateFieldController */
/* @var $model OrderDetailTemplateField */

$this->breadcrumbs=array(
	'Order Detail Template Fields'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrderDetailTemplateField', 'url'=>array('index')),
	array('label'=>'Manage OrderDetailTemplateField', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create OrderDetailTemplateField</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>