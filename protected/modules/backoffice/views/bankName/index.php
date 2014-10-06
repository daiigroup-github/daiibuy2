<?php
/* @var $this BankNameController */
/* @var $model BankName */

$this->breadcrumbs = array(
	'Bank Names'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List BankName',
		'url'=>array(
			'admin')),
	array(
		'label'=>'Create BankName',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form').submit(function(){
	$('#bank-name-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Product
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign icon-white"></i>  Create', array(
				'create'), array(
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
		'id'=>'bank-name-grid',
		'dataProvider'=>$model->search(),
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
			array(
				'name'=>'logo',
				'type'=>'html',
				'htmlOptions'=>array(
					'style'=>'width:110px'),
				'value'=>'CHtml::image(Yii::app()->request->baseUrl.$data->logo, "logo", array("style"=>"width:100px;"))',
			),
			'title',
//				'description:html',
			array(
				'name'=>'status',
				'value'=>'$data->getStatusText($data->status)',
			),
			'createDateTime',
			'updateDateTime',
			array(
				'class'=>'CButtonColumn',
			),
		),
	));
	?>

</div>
