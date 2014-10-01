<?php
/* @var $this BrandModelImageController */
/* @var $model BrandModelImage */

$this->breadcrumbs = array(
	'Brand Model Images'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List BrandModelImage',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create BrandModelImage',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#brand-model-image-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Brand Model Images
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?brandModelId=' . $_GET["brandModelId"]), array(
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
	<h3><?php echo isset($model->brandModel) ? $model->brandModel->title : "-" ?></h3>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'brand-model-image-grid',
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


