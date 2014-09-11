<?php
/* @var $this PriceGroupController */
/* @var $model PriceGroup */

$this->breadcrumbs = array(
	'Price Groups'=>array(
		'index'),
	$model->priceGroupId,
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
	array(
		'label'=>'Update PriceGroup',
		'url'=>array(
			'update',
			'id'=>$model->priceGroupId)),
	array(
		'label'=>'Delete PriceGroup',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->priceGroupId),
			'confirm'=>'Are you sure you want to delete this item?')),
	array(
		'label'=>'Manage PriceGroup',
		'url'=>array(
			'admin')),
);

$this->pageHeader = 'View PriceGroup #' . $model->priceGroupId;
?>

<div class="row-fluid">
	<div class="span12 well">
		<?php
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'priceGroupId',
				'priceGroupName',
				'priceRate',
				'status',
			),
		));
		?>
	</div>
</div>

<div class="page-header">
	<h3>ราคาของแต่ละพื้นที่</h3>
</div>
<?php foreach($model->priceGroupProvince as $priceModel): ?>
	<div class="row-fluid">
		<div class="span10 offset1 alert alert-info">
			<!--<h3><?php // echo $priceModel->province->provinceName;   ?></h3>-->
			<?php
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'price-group-grid' . $priceModel->provinceId,
				'dataProvider'=>Price::model()->getAllPriceByPriceGroupIdAndProvinceId($model->priceGroupId, $priceModel->provinceId),
				//'filter'=>$model,
				'itemsCssClass'=>'table table-striped table-bordered table-condensed table-hover',
				'columns'=>array(
					array(
						'name'=>'provinceName',
						'value'=>'isset($data->province->provinceName) ? $data->province->provinceName : "-"',
						'htmlOptions'=>array(
							'style'=>'width:50%;'),
					),
					array(
						'name'=>'priceRate',
						'value'=>'$data->priceRate',
						'htmlOptions'=>array(
							'style'=>'text-align:right;'),
					),
				),
			));
			?>
		</div>
	</div>
<?php endforeach; ?>