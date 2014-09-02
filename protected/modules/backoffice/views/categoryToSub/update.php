<?php
/* @var $this CategoryToSubController */
/* @var $model CategoryToSub */

$this->breadcrumbs=array(
	'Category To Subs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CategoryToSub', 'url'=>array('index')),
	array('label'=>'Create CategoryToSub', 'url'=>array('create')),
	array('label'=>'View CategoryToSub', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CategoryToSub', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update CategoryToSub <?php echo $model->id; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>