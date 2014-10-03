<?php
/* @var $this ContentController */
/* @var $model Content */

$this->breadcrumbs = array(
	'Contents'=>array(
		'index'),
	$model->title=>array(
		'view',
		'id'=>$model->contentId),
	'Update',
);

$this->menu = array(
	array(
		'label'=>'List Content',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Content',
		'url'=>array(
			'create')),
	array(
		'label'=>'View Content',
		'url'=>array(
			'view',
			'id'=>$model->contentId)),
	array(
		'label'=>'Manage Content',
		'url'=>array(
			'admin')),
);
?>

<h1>Update Content <?php echo $model->contentId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>