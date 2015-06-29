<?php
/* @var $this FurnitureGroupController */
/* @var $model FurnitureGroup */

$this->breadcrumbs = array(
	'Furniture Groups'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List FurnitureGroup',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create FurnitureGroup',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#furniture-group-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Furniture Groups
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl("create?categoryId=" . $_GET["categoryId"] . "&category2Id=" . $_GET["category2Id"]), array(
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
		'id'=>'furniture-group-grid',
		'dataProvider'=>$model->search(),
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
			array(
				'class'=>'SortColumn'),
			/*
			  'furnitureGroupId',
			 */
			'categoryId',
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
				'template'=>'{view} {update} {delete} {furniture}',
				'buttons'=>array(
					'furniture'=>array(
						'label'=>'<u>Furniture Color</u>',
						'url'=>'Yii::app()->createUrl("backoffice/furniture/index?furnitureGroupId=".$data->furnitureGroupId)'
					)
				)
			),
		),
	));
	?>

</div>


