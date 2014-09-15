<?php
/* @var $this CategoryToSubController */
/* @var $model CategoryToSub */

$this->breadcrumbs = array(
	'Category To Subs'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List CategoryToSub',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage CategoryToSub',
		'url'=>array(
			'admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create CategoryToSub</div>
	<div class="panel-body">
		<?php
		$this->renderPartial('_form', array(
			'model'=>$model,
			'cat'=>$cat));
		?>
	</div>
</div>