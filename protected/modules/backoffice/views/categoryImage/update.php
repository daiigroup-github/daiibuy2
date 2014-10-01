<?php
/* @var $this CategoryImageController */
/* @var $model CategoryImage */

$this->breadcrumbs=array(
	'Category Images'=>array('index'),
	$model->title=>array('view','id'=>$model->categoryImageId),
	'Update',
);

$this->menu=array(
	array('label'=>'List CategoryImage', 'url'=>array('index')),
	array('label'=>'Create CategoryImage', 'url'=>array('create')),
	array('label'=>'View CategoryImage', 'url'=>array('view', 'id'=>$model->categoryImageId)),
	array('label'=>'Manage CategoryImage', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update CategoryImage <?php echo $model->categoryImageId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>