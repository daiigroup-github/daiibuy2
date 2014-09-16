<?php
/* @var $this OrderDetailTemplateFieldController */
/* @var $model OrderDetailTemplateField */

$this->breadcrumbs=array(
	'Order Detail Template Fields'=>array('index'),
	$model->title=>array('view','id'=>$model->orderDetailTemplateFieldId),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrderDetailTemplateField', 'url'=>array('index')),
	array('label'=>'Create OrderDetailTemplateField', 'url'=>array('create')),
	array('label'=>'View OrderDetailTemplateField', 'url'=>array('view', 'id'=>$model->orderDetailTemplateFieldId)),
	array('label'=>'Manage OrderDetailTemplateField', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update OrderDetailTemplateField <?php echo $model->orderDetailTemplateFieldId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>