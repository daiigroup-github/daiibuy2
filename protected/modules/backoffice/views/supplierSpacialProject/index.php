<?php
/* @var $this SupplierSpacialProjectController */
/* @var $model SupplierSpacialProject */

$this->breadcrumbs = array(
	'Supplier Spacial Projects'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List SupplierSpacialProject',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create SupplierSpacialProject',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#supplier-spacial-project-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Supplier Spacial Projects
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
	</div>

	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'supplier-spacial-project-grid',
		'dataProvider'=>$model->search(),
//			'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
//			'supplierSpacialProjectId',
//			'supplierId',
			array(
				'name'=>'image',
				'type'=>'html',
				'value'=>'CHtml::image(Yii::app()->baseUrl.$data->image, "", array("style"=>"width:50px"))',
				'htmlOptions'=>array(
					'width'=>'50px'
				)
			),
			'code',
			'title',
			'description',
			/*
			  'status',
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


