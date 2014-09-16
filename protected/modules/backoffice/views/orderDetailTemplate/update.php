<?php
/* @var $this OrderDetailTemplateController */
/* @var $model OrderDetailTemplate */

$this->breadcrumbs=array(
	'Order Detail Templates'=>array('index'),
	$model->title=>array('view','id'=>$model->orderDetailTemplateId),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrderDetailTemplate', 'url'=>array('index')),
	array('label'=>'Create OrderDetailTemplate', 'url'=>array('create')),
	array('label'=>'View OrderDetailTemplate', 'url'=>array('view', 'id'=>$model->orderDetailTemplateId)),
	array('label'=>'Manage OrderDetailTemplate', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update OrderDetailTemplate <?php echo $model->orderDetailTemplateId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>