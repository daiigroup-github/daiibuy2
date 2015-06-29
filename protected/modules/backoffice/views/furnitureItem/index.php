<?php
/* @var $this FurnitureItemController */
/* @var $model FurnitureItem */

$this->breadcrumbs = array(
	'Furniture Items'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List FurnitureItem',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create FurnitureItem',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#furniture-item-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Furniture Items
		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?furnitureId=' . $_GET["furnitureId"]), array(
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
		'id'=>'furniture-item-grid',
		'dataProvider'=>$model->search(),
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
			array(
				'class'=>'SortColumn'),
			/*
			  'furnitureItemId',
			 */
			'furnitureId',
			'title',
			'description:html',
			array(
				'name'=>'image',
				'type'=>'html',
				'value'=>'CHtml::image(Yii::app()->baseUrl.$data->image,"", array("style"=>"width:50px"))',
			),
			array(
				'name'=>'status',
				'value'=>'$data->statusArray[$data->status]',
			),
			'createDateTime',
			/*
			  'updateDateTime',
			 */
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view} {update} {delete} {furnitureItemSub}',
				'buttons'=>array(
					'furnitureItemSub'=>array(
						'label'=>'<u>Furniture Item Sub</u>',
						'url'=>'Yii::app()->createUrl("backoffice/furnitureItemSub/index?furnitureItemId=".$data->furnitureItemId)'
					)
				)
			),
		),
	));
	?>

</div>


