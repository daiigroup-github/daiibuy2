<?php
/* @var $this SupplierDiscountRangeController */
/* @var $model SupplierDiscountRange */

$this->breadcrumbs = array(
	'Supplier Discount Ranges'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List SupplierDiscountRange',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create SupplierDiscountRange',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#supplier-discount-range-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Supplier Discount Ranges
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?supplierId=' . $_GET["supplierId"]), array(
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
	<h3>Discount of <?php echo $model->supplier->companyName; ?></h3>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'supplier-discount-range-grid',
		'dataProvider'=>$model->search(),
//			'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
//				'id',
//				'supplierId',
			'min',
			'max',
			'percentDiscount',
			'status',
			/*
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


