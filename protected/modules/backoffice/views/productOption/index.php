<?php
/* @var $this ProductOptionController */
/* @var $model ProductOption */

$this->breadcrumbs = array(
	'Product Options'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List ProductOption',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create ProductOption',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#product-option-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Product Options
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?productOptionGroupId=' . $_GET["productOptionGroupId"]), array(
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
	<h3>Group <?php echo $model->productOptionGroup->title; ?></h3>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-option-grid',
		'dataProvider'=>$model->search(),
//		'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
			array(
				'header'=>'Image',
				'name'=>'image',
				'type'=>'html',
				'value'=>'CHtml::image(Yii::app()->request->baseUrl.$data->image, "image", array("style"=>"width:100px;"))',
				'htmlOptions'=>array(
					'style'=>'width:100px'
				)
			),
			'title',
			'description',
			'priceValue',
			/*
			  'pricePercent',
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


