<?php
/* @var $this Category2ToProductController */
/* @var $model Category2ToProduct */

$this->breadcrumbs=array(
	'Category2 To Products'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Category2ToProduct', 'url'=>array('index')),
	array('label'=>'Create Category2ToProduct', 'url'=>array('create')),
	array('label'=>'View Category2ToProduct', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Category2ToProduct', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update Category2ToProduct <?php echo $model->id; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>