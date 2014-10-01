<?php
/* @var $this CategoryImageController */
/* @var $model CategoryImage */

$this->breadcrumbs=array(
	'Category Images'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List CategoryImage', 'url'=>array('index')),
	array('label'=>'Create CategoryImage', 'url'=>array('create')),
	array('label'=>'Update CategoryImage', 'url'=>array('update', 'id'=>$model->categoryImageId)),
	array('label'=>'Delete CategoryImage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->categoryImageId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CategoryImage', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View CategoryImage #<?php echo $model->categoryImageId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'categoryImageId',
		'categoryId',
		'title',
		'description',
		'image',
		'sortOrder',
		'status',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
