<?php
/* @var $this PriceGroupController */
/* @var $model PriceGroup */

$this->breadcrumbs = array(
	'Price Groups'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List PriceGroup',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create PriceGroup',
		'url'=>array(
			'create')),
);

$this->pageHeader = 'Price Group';
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<?php
		echo CHtml::link('<i class="icon-plus-sign icon-white"></i> เพิ่มกลุ่มราคา', array(
			'create'), array(
			'class'=>'btn btn-primary'));
		?>
	</div>
</div>

<div class="search-form" style="display:none">
	<?php
	$this->renderPartial('_search', array(
		'model'=>$model,
	));
	?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'price-group-grid',
	'dataProvider'=>$model->search(Yii::app()->user->id),
	//'filter'=>$model,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed table-hover',
	'columns'=>array(
//		'priceGroupId',
		'priceGroupName',
//		'priceRate',
		'status',
		array(
			'class'=>'CButtonColumn',
		),
	),
));
?>
