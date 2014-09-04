<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = array(
	'Products'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'Create Product',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->pageHeader = 'Manage Products';
?>

<?php
$this->renderPartial('_search', array(
	'model'=>$model,
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	'columns'=>array(
		'productId',
		'image',
		array(
			'header'=>'Product',
			'name'=>'name',
			'type'=>'html',
			'value'=>'"$data->name<br />".
				"Last Update : $data->updateDateTime<br />".
				"veiws : $data->viewed"',
		),
		'quantity',
		'price',
		array(
			'header'=>'Properties',
			'name'=>'weight',
			'type'=>'html',
			'value'=>'"Dimension : $data->length x $data->width x $data->height<br />".
				"Weight : ".$data->weight."<br />"',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
));
?>
