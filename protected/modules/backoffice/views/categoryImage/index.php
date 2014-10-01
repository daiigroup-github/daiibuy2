<?php
/* @var $this CategoryImageController */
/* @var $model CategoryImage */

$this->breadcrumbs = array(
	'Category Images'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List CategoryImage',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create CategoryImage',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#category-image-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Category Images
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?categoryId=' . $_GET["categoryId"]), array(
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
		'id'=>'category-image-grid',
		'dataProvider'=>$model->search(),
//		'filter'=>$model,
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


