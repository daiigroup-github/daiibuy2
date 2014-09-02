<?php
/* @var $this CategoryToSubController */
/* @var $model CategoryToSub */

$this->breadcrumbs=array(
	'Category To Subs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CategoryToSub', 'url'=>array('index')),
	array('label'=>'Create CategoryToSub', 'url'=>array('create')),
	array('label'=>'Update CategoryToSub', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CategoryToSub', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CategoryToSub', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View CategoryToSub #<?php echo $model->id; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'id',
		'categoryId',
		'subCategoryId',
		'isTheme',
		'isSet',
		'status',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
