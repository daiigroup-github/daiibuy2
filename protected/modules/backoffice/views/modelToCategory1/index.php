<?php
/* @var $this ModelToCategory1Controller */
/* @var $model ModelToCategory1 */

$this->breadcrumbs=array(
	'Model To Category1s'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List ModelToCategory1', 'url'=>array('index')),
array('label'=>'Create ModelToCategory1', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#model-to-category1-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Model To Category1s
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
			'id'=>'model-to-category1-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered table-hover',
			'columns'=>array(
				array('class'=>'IndexColumn'),
				'id',
				'brandModelId',
				'categoryId',
				'sortOrder',
				'status',
				'createDateTime',
				/*
				'updateDateTime',
				*/
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>

	</div>


