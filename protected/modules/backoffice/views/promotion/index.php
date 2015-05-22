<?php
/* @var $this PromotionController */
/* @var $model Promotion */

$this->breadcrumbs = array(
	'Promotions'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List Promotion',
		'url'=>array(
			'admin')),
	array(
		'label'=>'Create Promotion',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form').submit(function(){
	$('#promotion-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="module">
	<div class="module-head">
		<h3>Manage Promotions</h3>
	</div>
	<div class="module-option clearfix">
		<div class="pull-left">
			<?php
			$this->renderPartial('_search', array(
				'model'=>$model,
			));
			?>
		</div>
		<div class="btn-group pull-right">
			<?php
			echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('create'), array(
				'class'=>'btn btn-small btn-primary'));
			?>
		</div>
	</div>
	<div class="module-body">
		<?php
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'promotion-grid',
			'dataProvider'=>$model->search(),
			//'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered',
			'columns'=>array(
				array(
					'class'=>'IndexColumn'),
				'partnerTypeId',
				'title',
				'description:html',
				'creatorId',
				'startDateTime',
				'endDateTime',
				/*
				  'percent',
				  'value',
				  'accumulation',
				  'type',
				  array(
				  'name'=>'image',
				  'type'=>'image',
				  'value'=>'Yii::app()->baseUrl.$data->image',
				  'htmlOptions'=>array('style'=>'width:150px;'),
				  ),
				  array(
				  'name'=>'status',
				  'value'=>'$data->getStatusText($data->status)',
				  ),
				  'createDateTime',
				  'updateDateTime',
				 */
				array(
					'class'=>'CButtonColumn',
				),
			),
		));
		?>

	</div>
</div>