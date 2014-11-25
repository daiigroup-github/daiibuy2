<?php
/* @var $this UserSpacialProjectController */
/* @var $model UserSpacialProject */

$this->breadcrumbs=array(
	'User Spacial Projects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserSpacialProject', 'url'=>array('index')),
	array('label'=>'Manage UserSpacialProject', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create UserSpacialProject</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>