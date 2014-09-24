<?php
/* @var $this ProductSpecController */
/* @var $model ProductSpec */

$this->breadcrumbs = array(
	'Product Specs'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List ProductSpec',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create ProductSpec',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#product-spec-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>
<h3><?php echo isset($model->productSpecGroup) ? $model->productSpecGroup->title : "-" ?>Specification</h3>
<div class="panel panel-default">
	<div class="panel-heading">
		Manage Product Specs
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?productSpecGroupId=' . $model->productSpecGroupId), array(
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
		'id'=>'product-spec-grid',
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
			'videoEmbeded',
			'spanWidth',
			array(
				'name'=>'showTitleType',
				'value'=>'$data->getShowTitleTypeText($data->showTitleType)'
			),
//			'status',
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


