<?php
/* @var $this BrandController */
/* @var $model Brand */

$this->breadcrumbs = array(
	'Brands'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List Brand',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Brand',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#brand-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Brands
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array(
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

		<?php
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'brand-grid',
			'dataProvider'=>$model->search(),
//		'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered table-hover',
			'columns'=>array(
				array(
					'class'=>'IndexColumn'),
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
				'sortOrder',
				/*
				  'status',
				  'createDateTime',
				  'updateDateTime',
				 */
				array(
					'class'=>'CButtonColumn',
					'template'=>'{view} {update} {delete} {model} {image}',
					'buttons'=>array(
						'model'=>array(
							'label'=>'<br><u>Model</u>',
							'url'=>'Yii::app()->createUrl("/backoffice/brandModel?brandId=$data->brandId")'
						),
						'image'=>array(
							'label'=>'<br><u>Image</u>',
							'url'=>'Yii::app()->createUrl("/backoffice/brandImage?brandId=$data->brandId")'
						)
					)
				),
			),
		));
		?>
    </div>

</div>

