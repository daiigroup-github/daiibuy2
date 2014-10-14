<?php
/* @var $this ContentController */
/* @var $model Content */

$this->breadcrumbs = array(
	'Contents'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List Content',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage Content',
		'url'=>array(
			'admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create Content</div>
	<div class="panel-body">
		<?php
		$this->renderPartial('_form', array(
			'model'=>$model));
		?>
	</div>
</div>