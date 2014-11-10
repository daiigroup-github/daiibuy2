<?php
/* @var $this SupplierContentGroupController */
/* @var $model SupplierContentGroup */

$this->breadcrumbs = array(
	'Supplier Content Groups'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List SupplierContentGroup',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create SupplierContentGroup',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#supplier-content-group-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Supplier Content Groups
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
	<h3>Supplier Content Group Of <?php echo $model->supplier->name; ?></h3>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'supplier-content-group-grid',
		'dataProvider'=>$model->search(),
//			'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
			array(
				'class'=>'SortColumn'),
			array(
				'name'=>'image',
				'type'=>'html',
				'value'=>'CHtml::image(Yii::app()->baseUrl.$data->image, "", array("style"=>"width:50px"))',
				'htmlOptions'=>array(
					'width'=>'50px'
				)
			),
			'title',
			'description',
			'status',
			/*
			  'createDateTime',
			  'updateDateTime',
			 */
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view} {update} {delete} {content}',
				'buttons'=>array(
					'content'=>array(
						'label'=>'<br><u>Items</u>',
						'url'=>'Yii::app()->createUrl("backoffice/supplierContent?supplierContentGroupId=".$data->supplierContentGroupId)'
					)
				)
			),
		),
	));
	?>

</div>


