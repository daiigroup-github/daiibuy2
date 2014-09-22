<?php
/* @var $this ProductOptionController */
/* @var $model ProductOption */

$this->breadcrumbs=array(
	'Product Options'=>array('index'),
	$model->title=>array('view','id'=>$model->productOptionId),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductOption', 'url'=>array('index')),
	array('label'=>'Create ProductOption', 'url'=>array('create')),
	array('label'=>'View ProductOption', 'url'=>array('view', 'id'=>$model->productOptionId)),
	array('label'=>'Manage ProductOption', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update ProductOption <?php echo $model->productOptionId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>