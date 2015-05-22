<?php
/* @var $this PromotionController */
/* @var $model Promotion */

$this->breadcrumbs=array(
	'Promotions'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Promotion', 'url'=>array('admin')),
	array('label'=>'Create Promotion', 'url'=>array('create')),
	array('label'=>'Update Promotion', 'url'=>array('update', 'id'=>$model->promotionId)),
	array('label'=>'Delete Promotion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->promotionId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Promotion', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>View Promotion #<?php echo $model->promotionId; ?></h3>
	</div>
	<div class="module-option clearfix">
		<div class="btn-group pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i>', $this->createUrl('create'), array('class'=>'btn btn-small btn-primary'));?>
			<?php echo CHtml::link('<i class="icon-edit"></i>', $this->createUrl('update', array('id'=>$model->promotionId)), array('class'=>'btn btn-small btn-warning'));?>
		</div>
	</div>
	<div class="module-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'htmlOptions'=>array('class'=>'table table-striped table-border table-hover', 'style'=>'margin-top:20px;'),
			'attributes'=>array(
				'partnerTypeId',
		'title',
		'description:html',
		'creatorId',
		'startDateTime',
		'endDateTime',
		'percent',
		'value',
		'accumulation',
		'type',
		array(
					'name'=>'image',
					'type'=>'image',
					'value'=>Yii::app()->baseUrl.$model->image,
				),
		array(
					'name'=>'status',
					'type'=>'raw',
					'value'=>$model->getStatusText($model->status),
					),
		'createDateTime',
		'updateDateTime',
			),
		)); ?>
	</div>
</div>