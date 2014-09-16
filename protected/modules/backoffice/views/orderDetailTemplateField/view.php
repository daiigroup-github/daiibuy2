<?php
/* @var $this OrderDetailTemplateFieldController */
/* @var $model OrderDetailTemplateField */

$this->breadcrumbs=array(
	'Order Detail Template Fields'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List OrderDetailTemplateField', 'url'=>array('index')),
	array('label'=>'Create OrderDetailTemplateField', 'url'=>array('create')),
	array('label'=>'Update OrderDetailTemplateField', 'url'=>array('update', 'id'=>$model->orderDetailTemplateFieldId)),
	array('label'=>'Delete OrderDetailTemplateField', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->orderDetailTemplateFieldId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrderDetailTemplateField', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View OrderDetailTemplateField #<?php echo $model->orderDetailTemplateFieldId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'orderDetailTemplateFieldId',
		'orderDetailTemplateId',
		'title',
		'description',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
