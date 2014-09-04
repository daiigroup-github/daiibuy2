<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = array(
	'Products',
);

$this->menu = array(
	array(
		'label'=>'Create Product',
		'url'=>array(
			'create')),
);

//$this->pageHeader = 'Manage Products';
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<?php
		echo CHtml::link('<i class="icon-plus-sign icon-white"></i> เพิ่มสินค้า', array(
			'create'), array(
			'class'=>'btn btn-primary'));
		?>
	</div>
</div>

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
	'itemsCssClass'=>'table table-striped table-bordered table-condensed table-hover',
	'columns'=>array(
		'productId',
		array(
			'header'=>'Image',
			'name'=>'image',
			'type'=>'html',
			'value'=>'CHtml::image(Yii::app()->request->baseUrl.$data->findFirstImageProduct($data->productId), "image", array("style"=>"width:100px;"))',
		),
		array(
			'header'=>'Product',
			'name'=>'name',
			'type'=>'html',
			'value'=>'"$data->name<br />".
				"Last Update : $data->updateDateTime<br />".
				"veiws : $data->viewed<br />".
				$data->getBadgeStatus()',
		),
		array(
			'header'=>'Qty',
			'name'=>'quantity',
			'type'=>'html',
			'value'=>'number_format($data->quantity)',
		),
		array(
			'header'=>'Price',
			'name'=>'price',
			'type'=>'html',
			'value'=>'number_format($data->price, 2)',
		),
		array(
			'header'=>'Properties',
			'name'=>'weight',
			'type'=>'html',
			'value'=>'"Dimension : $data->length x $data->width x $data->height<br />".
				"Weight : ".$data->weight."<br />"',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} {update} {delete} {approve}',
			'buttons'=>array(
				'approve'=>array(
					'label'=>(true) ? '<i class="icon-thumbs-down"></i>' : '',
					'url'=>'Yii::app()->createUrl("admin/product/update", array("id"=>$data->productId))'
				),
			),
		),
	),
));
?>