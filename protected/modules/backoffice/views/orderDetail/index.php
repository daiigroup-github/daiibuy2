<?php
/* @var $this OrderDetailController */
/* @var $model OrderDetail */

$this->breadcrumbs=array(
	'Order Details'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List OrderDetail', 'url'=>array('index')),
array('label'=>'Create OrderDetail', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#order-detail-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Order Details
		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<?php $this->renderPartial('_search',array(
					'model'=>$model,
				)); ?>
			</div>
		</div>
	</div>

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'order-detail-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered table-hover',
			'columns'=>array(
				array('class'=>'IndexColumn'),
				'orderDetailId',
				'orderId',
				'createDateTime',
				'updateDateTime',
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>

	</div>


