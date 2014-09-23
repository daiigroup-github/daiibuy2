<?php
/* @var $this ProductSpecController */
/* @var $model ProductSpec */

$this->breadcrumbs=array(
	'Product Specs'=>array('index'),
	$model->title=>array('view','id'=>$model->productSpecId),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductSpec', 'url'=>array('index')),
	array('label'=>'Create ProductSpec', 'url'=>array('create')),
	array('label'=>'View ProductSpec', 'url'=>array('view', 'id'=>$model->productSpecId)),
	array('label'=>'Manage ProductSpec', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update ProductSpec <?php echo $model->productSpecId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>