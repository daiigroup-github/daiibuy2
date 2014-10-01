<?php
/* @var $this ModelToCategory1Controller */
/* @var $model ModelToCategory1 */

$this->breadcrumbs=array(
	'Model To Category1s'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ModelToCategory1', 'url'=>array('index')),
	array('label'=>'Create ModelToCategory1', 'url'=>array('create')),
	array('label'=>'View ModelToCategory1', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ModelToCategory1', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update ModelToCategory1 <?php echo $model->id; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>