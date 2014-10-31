<?php
/* @var $this SupplierContentController */
/* @var $model SupplierContent */

$this->breadcrumbs = array(
	'Supplier Contents'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List SupplierContent',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create SupplierContent',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#supplier-content-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Supplier Contents
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?supplierContentGroupId=' . $_GET["supplierContentGroupId"]), array(
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
	<h3>Items of <?php echo $model->supplierContentGroup->title; ?></h3>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'supplier-content-grid',
		'dataProvider'=>$model->search(),
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
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
			),
		),
	));
	?>

</div>


