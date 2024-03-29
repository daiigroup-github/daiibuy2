<?php
/* @var $this BrandModelController */
/* @var $model BrandModel */

$this->breadcrumbs = array(
	'Brand Models'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List BrandModel',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create BrandModel',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#brand-model-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Brand Models
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?brandId=' . $_GET["brandId"]), array(
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
	<h3><?php echo $model->brand->title; ?></h3>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'brand-model-grid',
		'dataProvider'=>$model->search(),
//		'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
			array(
				'class'=>'SortColumn',
				'url'=>'backoffice/modelToCategory1/sortItem'
			),
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
			'sortOrder',
			/*
			  'status',
			  'createDateTime',
			  'updateDateTime',
			 */
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view} {update} {delete} {cat} {image}',
				'buttons'=>array(
					'cat'=>array(
						'label'=>'<br><u>Category</u>',
						'url'=>'(isset(Yii::app()->user->supplierId) && Yii::app()->user->supplierId == 4)?Yii::app()->createUrl("/backoffice/category?brandModelId=".$data->brandModelId."&isTheme=1"):Yii::app()->createUrl("/backoffice/category?brandModelId=".$data->brandModelId)'
					),
					'image'=>array(
						'label'=>'<br><u>Image</u>',
						'url'=>'Yii::app()->createUrl("/backoffice/brandModelImage?brandModelId=".$data->brandModelId)'
					)
				)
			),
		),
	));
	?>

</div>


