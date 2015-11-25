<?php
/* @var $this OrderGroupController */
/* @var $model OrderGroup */

$this->breadcrumbs=array(
	'Order Groups'=>array('index'),
	$model->orderGroupId=>array('view','id'=>$model->orderGroupId),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrderGroup', 'url'=>array('index')),
	array('label'=>'Create OrderGroup', 'url'=>array('create')),
	array('label'=>'View OrderGroup', 'url'=>array('view', 'id'=>$model->orderGroupId)),
	array('label'=>'Manage OrderGroup', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update OrderGroup <?php echo $model->orderGroupId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>