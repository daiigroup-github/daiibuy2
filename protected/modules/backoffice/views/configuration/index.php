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

<h1>Manage Configurations</h1>
<div class="btn-toolbar">
	<div class="btn-group">
		<?php
		echo CHtml::link('<i class="icon-plus-sign icon-white"></i> เพิ่ม Configuration', array(
			'create'), array(
			'class'=>'btn btn-primary'));
		?>
	</div>
</div>
<div class="search-form" >
	<?php
	$this->renderPartial('_search', array(
		'model'=>$model,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'configuration-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'table table-striped table-bordered table-condensed table-hover',
	'columns'=>array(
		'name',
		'description',
		'value',
		'status',
		'createDateTime',
		/*
		  'updateDateTime',
		 */
		array(
			'class'=>'CButtonColumn',
		),
	),
));
?>
