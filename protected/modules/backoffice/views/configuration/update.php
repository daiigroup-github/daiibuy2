<?php
/* @var $this ConfigurationController */
/* @var $model Configuration */

$this->breadcrumbs = array(
	'Configurations'=>array(
		'index'),
	$model->name=>array(
		'view',
		'id'=>$model->id),
	'Update',
);

$this->menu = array(
	array(
		'label'=>'List Configuration',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Configuration',
		'url'=>array(
			'create')),
	array(
		'label'=>'View Configuration',
		'url'=>array(
			'view',
			'id'=>$model->id)),
	array(
		'label'=>'Manage Configuration',
		'url'=>array(
			'admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update Configuration <?php echo $model->id; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array(
			'model'=>$model));
		?>
	</div>
</div>