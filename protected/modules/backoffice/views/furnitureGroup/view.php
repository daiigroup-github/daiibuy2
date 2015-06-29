<?php
/* @var $this FurnitureGroupController */
/* @var $model FurnitureGroup */

$this->breadcrumbs=array(
	'Furniture Groups'=>array('index'),
	$model->title,
);

$this->menu=array(
array('label'=>'List FurnitureGroup', 'url'=>array('index')),
array('label'=>'Create FurnitureGroup', 'url'=>array('create')),
array('label'=>'Update FurnitureGroup', 'url'=>array('update', 'id'=>$model->furnitureGroupId)),
array('label'=>'Delete FurnitureGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->furnitureGroupId),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage FurnitureGroup', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View FurnitureGroup #<?php echo $model->furnitureGroupId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
	'attributes'=>array(
			'furnitureGroupId',
		'categoryId',
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
