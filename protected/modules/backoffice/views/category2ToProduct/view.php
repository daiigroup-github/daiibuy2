<?php
/* @var $this Category2ToProductController */
/* @var $model Category2ToProduct */

$this->breadcrumbs=array(
	'Category2 To Products'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Category2ToProduct', 'url'=>array('index')),
	array('label'=>'Create Category2ToProduct', 'url'=>array('create')),
	array('label'=>'Update Category2ToProduct', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Category2ToProduct', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Category2ToProduct', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View Category2ToProduct #<?php echo $model->id; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'id',
		'categoryId',
		'productId',
		'groupName',
		'quantity',
		'type',
		'sortOrder',
		'status',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
