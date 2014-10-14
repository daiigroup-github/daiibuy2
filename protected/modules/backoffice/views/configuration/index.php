<?php
/* @var $this ConfigurationController */
/* @var $model Configuration */

$this->breadcrumbs = array(
	'Configurations'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List Configuration',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Configuration',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#configuration-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Configurations
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array(
				'class'=>'btn btn-xs btn-primary'));
			?>
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<?php
				$this->renderPartial('_search', array(
					'model'=>$model,
				));
				?>
			</div>
		</div>

		<?php
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'configuration-grid',
			'dataProvider'=>$model->search(),
			'itemsCssClass'=>'table table-striped table-bordered table-condensed table-hover',
			'columns'=>array(
				'name',
				'description',
				'value',
//				'status',
//				'createDateTime',
				/*
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
