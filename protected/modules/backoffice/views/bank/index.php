<?php
/* @var $this BankController */
/* @var $model Bank */

$this->breadcrumbs = array(
	'Banks'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List Bank',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Bank',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#bank-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->pageHeader = "การจัดการ บัญชีธนาคาร"
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Bank
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign icon-white"></i>  เพิ่ม บัญชี', array(
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
		'id'=>'bank-grid',
		'itemsCssClass'=>'table table-striped table-bordered table-condensed',
		'dataProvider'=>$model->search(),
		'columns'=>array(
			array(
				'name'=>'logo',
				'type'=>'html',
				'htmlOptions'=>array(
					'style'=>'width:110px'),
				'value'=>'CHtml::image(Yii::app()->request->baseUrl.$data->bankName->logo, "logo", array("style"=>"width:100px;"))',
			),
			array(
				'name'=>'bankNameId',
				'value'=>'isset($data->bankName)?$data->bankName->title:"-"',
			),
			'branch',
			'compCode',
			'accNo',
			'accName',
			'accType',
			array(
				'name'=>'supplierId',
				'value'=>'isset($data->supplier)?$data->supplier->showUserCompany($data->supplierId):"-"',
			),
//			array(
//				'name'=>'status',
//				'value'=>'$data->getStatusName()',
//			),
			/*
			  'createDateTime',
			 */
			array(
				'class'=>'CButtonColumn',
			),
		),
	));
	?>
</div>

