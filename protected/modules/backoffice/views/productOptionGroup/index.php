<?php
/* @var $this ProductOptionGroupController */
/* @var $model ProductOptionGroup */

$this->breadcrumbs = array(
	'Product Option Groups'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List ProductOptionGroup',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create ProductOptionGroup',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#product-option-group-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Product Option Groups
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?productId=' . $_GET["productId"]), array(
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
	<h3><?php echo $model->product->name; ?></h3>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-option-group-grid',
		'dataProvider'=>$model->search(),
//			'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
			array(
				'class'=>'SortColumn'),
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
			'sortOrder',
			/*
			  'status',
			  'createDateTime',
			  'updateDateTime',
			 */
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view} {update} {delete} {items}',
				'buttons'=>array(
					'items'=>array(
						'label'=>'<br><u>Items</u>',
						'url'=>'Yii::app()->createUrl("backoffice/productOption?productOptionGroupId=".$data->productOptionGroupId)'
					)
				)
			),
		),
	));
	?>

</div>


