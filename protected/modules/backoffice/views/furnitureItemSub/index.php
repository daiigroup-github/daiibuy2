<?php
/* @var $this FurnitureItemSubController */
/* @var $model FurnitureItemSub */

$this->breadcrumbs = array(
	'Furniture Item Subs'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List FurnitureItemSub',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create FurnitureItemSub',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#furniture-item-sub-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Furniture Item Subs
		<div class="pull-right">
				<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?furnitureItemId=' . $_GET["furnitureItemId"]), array(
					'class'=>'btn btn-xs btn-primary')); ?>
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
		'id'=>'furniture-item-sub-grid',
		'dataProvider'=>$model->search(),
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
			array(
				'class'=>'SortColumn'),
			/*
			  'furnitureItemSubId',
			 */
			'furnitureItemId',
			'code',
			'description:html',
			array(
				'name'=>'image',
				'type'=>'html',
				'value'=>'CHtml::image(Yii::app()->baseUrl.$data->image,"", array("style"=>"width:50px"))',
			),
			'quantity',
			'unit',
			/*

			  array(
			  'name'=>'status',
			  'value'=>'$data->statusArray[$data->status]',
			  ),
			  'createDateTime',
			  'updateDateTime',
			 */
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view} {update} {delete}'
			),
		),
	));
	?>

</div>


