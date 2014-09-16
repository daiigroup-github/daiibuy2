<?php
/* @var $this OrderDetailTemplateController */
/* @var $model OrderDetailTemplate */

$this->breadcrumbs=array(
	'Order Detail Templates'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List OrderDetailTemplate', 'url'=>array('index')),
	array('label'=>'Create OrderDetailTemplate', 'url'=>array('create')),
	array('label'=>'Update OrderDetailTemplate', 'url'=>array('update', 'id'=>$model->orderDetailTemplateId)),
	array('label'=>'Delete OrderDetailTemplate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->orderDetailTemplateId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrderDetailTemplate', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View OrderDetailTemplate #<?php echo $model->orderDetailTemplateId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'orderDetailTemplateId',
		'orderDetailId',
		'supplierId',
		'title',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
