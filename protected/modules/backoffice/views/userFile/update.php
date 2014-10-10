<?php
/* @var $this UserFileController */
/* @var $model UserFile */

$this->breadcrumbs=array(
	'User Files'=>array('index'),
	$model->userFileId=>array('view','id'=>$model->userFileId),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserFile', 'url'=>array('index')),
	array('label'=>'Create UserFile', 'url'=>array('create')),
	array('label'=>'View UserFile', 'url'=>array('view', 'id'=>$model->userFileId)),
	array('label'=>'Manage UserFile', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update UserFile <?php echo $model->userFileId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>