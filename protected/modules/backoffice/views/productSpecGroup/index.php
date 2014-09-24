<?php
/* @var $this ProductSpecGroupController */
/* @var $model ProductSpecGroup */

$this->breadcrumbs = array(
	'Product Spec Groups'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List ProductSpecGroup',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create ProductSpecGroup',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#product-spec-group-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Product Spec Groups
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?productId=' . $model->productId . "&type=" . $model->type . "&parentId=" . $model->parentId), array(
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
	<h3><?php echo isset($model->product) ? $model->product->name : "-"; ?> Spec Group</h3>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'product-spec-group-grid',
		'dataProvider'=>$model->search(),
//			'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
			array(
				'class'=>'sortColumn',
				'htmlOptions'=>array(
					'style'=>'width:7%'
				)
			),
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
			'parentId',
			/*
			  'type',
			  'status',
			  'createDateTime',
			  'updateDateTime',
			 */
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view} {update} {delete} {child} {item}',
				'buttons'=>array(
					'child'=>array(
						'label'=>'<br><u>Child</u>',
						'url'=>'Yii::app()->createUrl("backoffice/productSpecGroup?parentId=".$data->productSpecGroupId)'
					),
					'item'=>array(
						'label'=>'<br><u>Item</u>',
						'url'=>'Yii::app()->createUrl("backoffice/productSpec?productSpecGroupId=".$data->productSpecGroupId)'
					)
				)
			),
		),
	));
	?>

</div>


