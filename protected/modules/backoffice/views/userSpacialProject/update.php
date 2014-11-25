<?php
/* @var $this UserSpacialProjectController */
/* @var $model UserSpacialProject */

$this->breadcrumbs = array(
	'User Spacial Projects'=>array(
		'index'),
	$model->userSpacialProjectId=>array(
		'view',
		'id'=>$model->userSpacialProjectId),
	'Update',
);

$this->menu = array(
	array(
		'label'=>'List UserSpacialProject',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create UserSpacialProject',
		'url'=>array(
			'create')),
	array(
		'label'=>'View UserSpacialProject',
		'url'=>array(
			'view',
			'id'=>$model->userSpacialProjectId)),
	array(
		'label'=>'Manage UserSpacialProject',
		'url'=>array(
			'admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		UserSpacialProject <?php echo $model->userSpacialProjectId; ?>	</div>
	<div class="panel-body">
<?php $this->renderPartial('_form', array(
	'model'=>$model)); ?>
	</div>
</div>