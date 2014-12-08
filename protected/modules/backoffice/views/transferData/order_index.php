<?php
/* @var $this BankNameController */
/* @var $model BankName */


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
		Manage Transfer Order
		<div class="pull-right">
			<?php
//			echo CHtml::link('<i class="icon-plus-sign icon-white"></i>  Create', array(
//				'create'), array(
//				'class'=>'btn btn-xs btn-primary'));
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
		'dataProvider'=>$model->findAllOldPurchesedOrder(),
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
			'email',
			'firstname',
			'lastname',
			array(
				'name'=>'summary',
				'value'=>'number_format($data->totalIncVAT-$data->usedPoint)',
			),
			'updateDateTime',
			array(
				'class'=>'CButtonColumn',
				'template'=>'{transfer}<br><br> {testData}',
				'buttons'=>array(
					'transfer'=>array(
						'label'=>'<u>Transfer</u>',
						'url'=>'Yii::app()->createUrl("/backoffice/transferData/transferPurchesedOrder?orderId=".$data->orderId)',
						'options'=>array(
							'onClick'=>'return confirm("คุณต้องการ ย้ายข้อมูลหรือไม่")',
							'class'=>'label label-success',
						)
					),
					'testData'=>array(
						'label'=>'<u>Is Test Data</u>',
						'url'=>'Yii::app()->createUrl("/backoffice/transferData/isTestData?orderId=".$data->orderId)',
						'options'=>array(
							'onClick'=>'return confirm("คุณต้องการแจ้งว่าเป็นข้อมูล ทดสอบหรือไม่")',
							'class'=>'label label-danger',
						)
					)
				)
			),
		),
	));
	?>

</div>
