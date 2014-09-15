<?php
/* @var $this OrderDetailTemplateFieldController */
/* @var $model OrderDetailTemplateField */

$this->breadcrumbs=array(
	'Order Detail Template Fields'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List OrderDetailTemplateField', 'url'=>array('admin')),
	array('label'=>'Create OrderDetailTemplateField', 'url'=>array('create')),
	array('label'=>'Update OrderDetailTemplateField', 'url'=>array('update', 'id'=>$model->orderDetailTemplateFieldId)),
	array('label'=>'Delete OrderDetailTemplateField', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->orderDetailTemplateFieldId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrderDetailTemplateField', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>View OrderDetailTemplateField #<?php echo $model->orderDetailTemplateFieldId; ?></h3>
	</div>
	<div class="module-option clearfix">
		<div class="btn-group pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i>', $this->createUrl('create'), array('class'=>'btn btn-small btn-primary'));?>
			<?php echo CHtml::link('<i class="icon-edit"></i>', $this->createUrl('update', array('id'=>$model->orderDetailTemplateFieldId)), array('class'=>'btn btn-small btn-warning'));?>
		</div>
	</div>
	<div class="module-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'htmlOptions'=>array('class'=>'table table-striped table-border table-hover', 'style'=>'margin-top:20px;'),
			'attributes'=>array(
				'orderDetailTemplateId',
		'title',
		'description:html',
		'createDateTime',
		'updateDateTime',
			),
		)); ?>
	</div>
</div>