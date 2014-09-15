<?php
/* @var $this OrderDetailTemplateController */
/* @var $model OrderDetailTemplate */

$this->breadcrumbs=array(
	'Order Detail Templates'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List OrderDetailTemplate', 'url'=>array('admin')),
	array('label'=>'Create OrderDetailTemplate', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form').submit(function(){
	$('#order-detail-template-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="module">
	<div class="module-head">
		<h3>Manage Order Detail Templates</h3>
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
			'id'=>'order-detail-template-grid',
			'dataProvider'=>$model->search(),
			//'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered',
			'columns'=>array(
				array('class'=>'IndexColumn'),
				'orderDetailId',
		'supplierId',
		'title',
		'createDateTime',
		'updateDateTime',
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>

	</div>
</div>