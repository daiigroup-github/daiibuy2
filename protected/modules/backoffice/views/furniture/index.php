<?php
/* @var $this FurnitureController */
/* @var $model Furniture */

$this->breadcrumbs=array(
	'Furnitures'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Furniture', 'url'=>array('index')),
array('label'=>'Create Furniture', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#furniture-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Furnitures
		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<?php $this->renderPartial('_search',array(
					'model'=>$model,
				)); ?>
			</div>
		</div>
	</div>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'furniture-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'itemsCssClass'=>'table table-striped table-bordered table-hover',
	'columns'=>array(
	array('class'=>'IndexColumn'),
	array('class'=>'SortColumn'),
					/*
				'furnitureId',
				*/
				'furnitureGroupId',
				'title',
				'description:html',

				array( 
					'name'=>'image' ,
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
	'template'=>'{view} {update} {delete}'
	),
	),
	)); ?>

</div>


