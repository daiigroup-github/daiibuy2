<?php
/* @var $this CategoryToSubController */
/* @var $model CategoryToSub */

$this->breadcrumbs=array(
	'Category To Subs'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List CategoryToSub', 'url'=>array('index')),
array('label'=>'Create CategoryToSub', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#category-to-sub-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Category To Subs
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
			'id'=>'category-to-sub-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered table-hover',
			'columns'=>array(
				array('class'=>'IndexColumn'),
				'id',
				'categoryId',
				'subCategoryId',
				'isTheme',
				'isSet',
				'status',
				/*
				'createDateTime',
				'updateDateTime',
				*/
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>

	</div>


