<?php
/* @var $this BrandModelImageController */
/* @var $model BrandModelImage */

$this->breadcrumbs=array(
	'Brand Model Images'=>array('index'),
	$model->title=>array('view','id'=>$model->brandModelImageId),
	'Update',
);

$this->menu=array(
	array('label'=>'List BrandModelImage', 'url'=>array('index')),
	array('label'=>'Create BrandModelImage', 'url'=>array('create')),
	array('label'=>'View BrandModelImage', 'url'=>array('view', 'id'=>$model->brandModelImageId)),
	array('label'=>'Manage BrandModelImage', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update BrandModelImage <?php echo $model->brandModelImageId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>