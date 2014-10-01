<?php
/* @var $this ModelToCategory1Controller */
/* @var $model ModelToCategory1 */

$this->breadcrumbs=array(
	'Model To Category1s'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ModelToCategory1', 'url'=>array('index')),
	array('label'=>'Create ModelToCategory1', 'url'=>array('create')),
	array('label'=>'Update ModelToCategory1', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ModelToCategory1', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ModelToCategory1', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View ModelToCategory1 #<?php echo $model->id; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'id',
		'brandModelId',
		'categoryId',
		'sortOrder',
		'status',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
