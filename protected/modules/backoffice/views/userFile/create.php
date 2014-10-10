<?php
/* @var $this UserFileController */
/* @var $model UserFile */

$this->breadcrumbs=array(
	'User Files'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserFile', 'url'=>array('index')),
	array('label'=>'Manage UserFile', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create UserFile</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>