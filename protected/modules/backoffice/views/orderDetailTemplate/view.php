<?php
/* @var $this OrderDetailTemplateController */
/* @var $model OrderDetailTemplate */

$this->breadcrumbs=array(
	'Order Detail Templates'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List OrderDetailTemplate', 'url'=>array('admin')),
	array('label'=>'Create OrderDetailTemplate', 'url'=>array('create')),
	array('label'=>'Update OrderDetailTemplate', 'url'=>array('update', 'id'=>$model->orderDetailTemplateId)),
	array('label'=>'Delete OrderDetailTemplate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->orderDetailTemplateId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrderDetailTemplate', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>View OrderDetailTemplate #<?php echo $model->orderDetailTemplateId; ?></h3>
	</div>
	<div class="module-option clearfix">
		<div class="btn-group pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i>', $this->createUrl('create'), array('class'=>'btn btn-small btn-primary'));?>
			<?php echo CHtml::link('<i class="icon-edit"></i>', $this->createUrl('update', array('id'=>$model->orderDetailTemplateId)), array('class'=>'btn btn-small btn-warning'));?>
		</div>
	</div>
	<div class="module-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'htmlOptions'=>array('class'=>'table table-striped table-border table-hover', 'style'=>'margin-top:20px;'),
			'attributes'=>array(
				'orderDetailId',
		'supplierId',
		'title',
		'createDateTime',
		'updateDateTime',
			),
		)); ?>
	</div>
</div>