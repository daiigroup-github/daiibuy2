<?php
/* @var $this UserFileController */
/* @var $model UserFile */

$this->breadcrumbs = array(
	'User Files'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List UserFile',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage UserFile',
		'url'=>array(
			'admin')),
);
?>

<h1>Create UserFile</h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>