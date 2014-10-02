<?php
/* @var $this UserFileController */
/* @var $model UserFile */

$this->breadcrumbs = array(
	'User Files'=>array(
		'index'),
	$model->userFileId,
);

$this->menu = array(
	array(
		'label'=>'List UserFile',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create UserFile',
		'url'=>array(
			'create')),
	array(
		'label'=>'Update UserFile',
		'url'=>array(
			'update',
			'id'=>$model->userFileId)),
	array(
		'label'=>'Delete UserFile',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->userFileId),
			'confirm'=>'Are you sure you want to delete this item?')),
	array(
		'label'=>'Manage UserFile',
		'url'=>array(
			'admin')),
);
?>

<h1>View UserFile #<?php echo $model->userFileId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'userFileName',
		'type',
		'isShowInProductView',
		'isPublic',
		'status',
		'createDateTime',
	),
));
?>
