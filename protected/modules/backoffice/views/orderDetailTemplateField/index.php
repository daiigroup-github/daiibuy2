<?php
/* @var $this OrderDetailTemplateFieldController */
/* @var $model OrderDetailTemplateField */

$this->breadcrumbs=array(
	'Order Detail Template Fields'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List OrderDetailTemplateField', 'url'=>array('admin')),
	array('label'=>'Create OrderDetailTemplateField', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form').submit(function(){
	$('#order-detail-template-field-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="module">
	<div class="module-head">
		<h3>Manage Order Detail Template Fields</h3>
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
			'id'=>'order-detail-template-field-grid',
			'dataProvider'=>$model->search(),
			//'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered',
			'columns'=>array(
				array('class'=>'IndexColumn'),
				'orderDetailTemplateId',
		'title',
		'description:html',
		'createDateTime',
		'updateDateTime',
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>

	</div>
</div>