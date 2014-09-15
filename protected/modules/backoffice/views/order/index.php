<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Order', 'url'=>array('admin')),
	array('label'=>'Create Order', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form').submit(function(){
	$('#order-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="module">
	<div class="module-head">
		<h3>Manage Orders</h3>
	</div>
	<div class="module-option clearfix">
		<div class="pull-left">
			<?php $this->renderPartial('_search',array(
				'model'=>$model,
			)); ?>
		</div>
		<div class="btn-group pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i>', $this->createUrl('create'), array('class'=>'btn btn-small btn-primary'));?>
		</div>
	</div>
	<div class="module-body">
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'order-grid',
			'dataProvider'=>$model->search(),
			//'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered',
			'columns'=>array(
				array('class'=>'IndexColumn'),
				'supplierId',
		'title',
		'type',
		array(
					'name'=>'status',
					'value'=>'$data->getStatusText($data->status)',
			),
		'createDateTime',
		'updateDateTime',
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>

	</div>
</div>