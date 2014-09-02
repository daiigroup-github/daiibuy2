<?php
/* @var $this BrandModelController */
/* @var $model BrandModel */

$this->breadcrumbs=array(
	'Brand Models'=>array('index'),
	$model->title=>array('view','id'=>$model->brandModelId),
	'Update',
);

$this->menu=array(
	array('label'=>'List BrandModel', 'url'=>array('index')),
	array('label'=>'Create BrandModel', 'url'=>array('create')),
	array('label'=>'View BrandModel', 'url'=>array('view', 'id'=>$model->brandModelId)),
	array('label'=>'Manage BrandModel', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update BrandModel <?php echo $model->brandModelId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>