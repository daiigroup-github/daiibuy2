<?php
/* @var $this FurnitureItemSubController */
/* @var $model FurnitureItemSub */

$this->breadcrumbs=array(
	'Furniture Item Subs'=>array('index'),
	$model->furnitureItemSubId,
);

$this->menu=array(
array('label'=>'List FurnitureItemSub', 'url'=>array('index')),
array('label'=>'Create FurnitureItemSub', 'url'=>array('create')),
array('label'=>'Update FurnitureItemSub', 'url'=>array('update', 'id'=>$model->furnitureItemSubId)),
array('label'=>'Delete FurnitureItemSub', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->furnitureItemSubId),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage FurnitureItemSub', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View FurnitureItemSub #<?php echo $model->furnitureItemSubId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
	'attributes'=>array(
			'furnitureItemSubId',
		'furnitureItemId',
		'code',
		'description:html',
		array( 
			'name'=>'image' ,
			'type'=>'html', 
			'value'=>CHtml::image(Yii::app()->baseUrl.$model->image, '', array('style'=>'width:50px')),
		 ),
		'quantity',
		'unit',

		array( 
			'name'=>'status', 
			'value'=>$model->statusArray[$model->status],
		 ),
		'createDateTime',
		'updateDateTime',
	),
	)); ?>
</div>
