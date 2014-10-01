<?php
/* @var $this BrandImageController */
/* @var $model BrandImage */

$this->breadcrumbs = array(
	'Brand Images'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List BrandImage',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create BrandImage',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#brand-image-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Brand Images
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
	<h3><?php echo isset($model->brand) ? $model->brand->title : "-"; ?></h3>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'brand-image-grid',
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
//			'sortOrder',
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


