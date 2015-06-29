<?php
/* @var $this FurnitureItemController */
/* @var $model FurnitureItem */

$this->breadcrumbs=array(
	'Furniture Items'=>array('index'),
	$model->title,
);

$this->menu=array(
array('label'=>'List FurnitureItem', 'url'=>array('index')),
array('label'=>'Create FurnitureItem', 'url'=>array('create')),
array('label'=>'Update FurnitureItem', 'url'=>array('update', 'id'=>$model->furnitureItemId)),
array('label'=>'Delete FurnitureItem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->furnitureItemId),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage FurnitureItem', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View FurnitureItem #<?php echo $model->furnitureItemId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
	'attributes'=>array(
			'furnitureItemId',
		'furnitureId',
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
