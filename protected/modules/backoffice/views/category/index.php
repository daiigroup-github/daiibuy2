<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs = array(
	'Categories'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List Category',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Category',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#category-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Categories
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?brandModelId=' . $_GET["brandModelId"]), array(
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
		'id'=>'category-grid',
		'dataProvider'=>$brandToCat->search(),
//		'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
			array(
				'name'=>'image',
				'type'=>'html',
				'value'=>'isset($model->category)?CHtml::image(Yii::app()->baseUrl.$data->category->image, "", array("style"=>"width:50px")):"-"',
				'htmlOptions'=>array(
					'width'=>'50px'
				)
			),
			'category1Id',
			'title',
			'description',
			'sortOrder',
			'status',
			/*
			  'createDateTime',
			  'updateDatetime',
			 */
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view} {update} {delete} {subCat}',
				'buttons'=>array(
					'subCat'=>array(
						'label'=>'<br><u>Sub Category</u>',
						'url'=>'Yii::app()->createUrl("/backoffice/categoryToSub?category1Id=".$data->category1Id)'
					)
				)
			),
		),
	));
	?>

</div>


