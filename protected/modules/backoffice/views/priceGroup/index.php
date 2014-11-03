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
Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#price-group-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
$this->pageHeader = 'Price Group';
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Brands
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> เพิ่มกลุ่มราคา', $this->createUrl('create'), array(
				'class'=>'btn btn-xs btn-primary'));
			?>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-12">
				<?php
				$this->renderPartial('_search', array(
					'model'=>$model,
				));
				?>
			</div>
		</div>
		<?php
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'price-group-grid',
			'dataProvider'=>$model->search(isset(Yii::app()->user->supplierId) ? Yii::app()->user->supplierId : NULL),
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

	</div>
</div>
