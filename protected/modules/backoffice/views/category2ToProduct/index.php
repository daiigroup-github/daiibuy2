<?php
/* @var $this Category2ToProductController */
/* @var $model Category2ToProduct */

$this->breadcrumbs=array(
	'Category2 To Products'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Category2ToProduct', 'url'=>array('index')),
array('label'=>'Create Category2ToProduct', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#category2-to-product-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Category2 To Products
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
			'id'=>'category2-to-product-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered table-hover',
			'columns'=>array(
				array('class'=>'IndexColumn'),
				'id',
				'categoryId',
				'productId',
				'groupName',
				'quantity',
				'type',
				/*
				'sortOrder',
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


