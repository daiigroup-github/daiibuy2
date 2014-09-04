<?php
/* @var $this BrandModelController */
/* @var $model BrandModel */

$this->breadcrumbs=array(
	'Brand Models'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List BrandModel', 'url'=>array('index')),
array('label'=>'Create BrandModel', 'url'=>array('create')),
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
			'id'=>'brand-model-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered table-hover',
			'columns'=>array(
				array('class'=>'IndexColumn'),
				'brandModelId',
				'supplierId',
				'title',
				'description',
				'image',
				'sortOrder',
				/*
				'status',
				'createDateTime',
				'updateDateTime',
				*/
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>

	</div>


