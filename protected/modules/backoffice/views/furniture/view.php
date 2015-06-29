<?php
/* @var $this FurnitureController */
/* @var $model Furniture */

$this->breadcrumbs=array(
	'Furnitures'=>array('index'),
	$model->title,
);

$this->menu=array(
array('label'=>'List Furniture', 'url'=>array('index')),
array('label'=>'Create Furniture', 'url'=>array('create')),
array('label'=>'Update Furniture', 'url'=>array('update', 'id'=>$model->furnitureId)),
array('label'=>'Delete Furniture', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->furnitureId),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Furniture', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View Furniture #<?php echo $model->furnitureId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
	'attributes'=>array(
			'furnitureId',
		'furnitureGroupId',
		'title',
		'description:html',
		array( 
			'name'=>'image' ,
			'type'=>'html', 
			'value'=>CHtml::image(Yii::app()->baseUrl.$model->image, '', array('style'=>'width:50px')),
		 ),

		array( 
			'name'=>'status', 
			'value'=>$model->statusArray[$model->status],
		 ),
		'createDateTime',
		'updateDateTime',
	),
	)); ?>
</div>
