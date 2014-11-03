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

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#product-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Product
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign icon-white"></i> เพิ่มสินค้า', array(
				'create'), array(
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
	</div>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-grid',
		'dataProvider'=>$model->search(),
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-condensed table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'
			),
			array(
				'class'=>'SortColumn',
			),
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
				"veiws : $data->viewed<br />"
				//.$data->getBadgeStatus()
				',
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
				//'template'=>'{view} {update} {delete} {approve}',
				'template'=>'{view} {update} {delete} {option} {detail} {spec}',
				'buttons'=>array(
//					'approve'=>array(
//						'label'=>'<br><u>Approve</u>',
//						'url'=>'Yii::app()->createUrl("admin/product/update", array("id"=>$data->productId))'
//					),
					'option'=>array(
						'label'=>'<br><u>Option</u>',
						'url'=>'Yii::app()->createUrl("backoffice/productOptionGroup/index?productId=".$data->productId)'
					),
					'detail'=>array(
						'label'=>'<br><u>Detail</u>',
						'url'=>'Yii::app()->createUrl("backoffice/productSpecGroup/index?productId=".$data->productId."&type=1")'
					),
					'spec'=>array(
						'label'=>'<br><u>Spec</u>',
						'url'=>'Yii::app()->createUrl("backoffice/productSpecGroup/index?productId=".$data->productId."&type=2")'
					)
				),
			),
		),
	));
	?>
</div>