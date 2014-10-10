<?php
/* @var $this UserFileController */
/* @var $model UserFile */

$this->breadcrumbs=array(
	'User Files'=>array('index'),
	$model->userFileId,
);

$this->menu=array(
	array('label'=>'List UserFile', 'url'=>array('index')),
	array('label'=>'Create UserFile', 'url'=>array('create')),
	array('label'=>'Update UserFile', 'url'=>array('update', 'id'=>$model->userFileId)),
	array('label'=>'Delete UserFile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->userFileId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserFile', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View UserFile #<?php echo $model->userFileId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'userFileId',
		'userFileName',
		'type',
		'status',
		'isShowInProductView',
		'isPublic',
		'createDateTime',
		),
	)); ?>
</div>
