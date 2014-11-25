<?php
/* @var $this UserSpacialProjectController */
/* @var $model UserSpacialProject */

$this->breadcrumbs = array(
	'User Spacial Projects'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List UserSpacialProject',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create UserSpacialProject',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#user-spacial-project-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage User Spacial Projects
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
	</div>

	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'user-spacial-project-grid',
		'dataProvider'=>$model->search(),
//			'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
//			'userSpacialProjectId',
//			'supplierId',
			array(
				'name'=>'userId',
				'type'=>'html',
				'value'=>'$data->user->email."<br> โทร.".$data->user->telephone'
				. '."<br>Order No.".(isset($data->orderGroup)?$data->orderGroup->orderNo." <br><span class=text-danger>ยอดซื้อ ".number_format($data->orderGroup->summary,2)." บาท</span>":"-")'
				. '."<br> Order ".(isset($data->order)?$data->order->title."<br> วันที่สร้าง :".$data->order->createDateTime." <br><span class=text-danger>ยอดซื้อ ".number_format($data->order->totalIncVAT,2)." บาท</span>":"-")'
			),
//			array(
//				'name'=>'orderGroupId',
//				'value'=>'isset($data->orderGroup)?$data->orderGroup->orderNo:"-"',
//			),
//			array(
//				'name'=>'orderId',
//				'value'=>'isset($data->order)?$data->order->title." วันที่สร้าง :".$data->order->createDateTime:"-"',
//			),
//			'supplierSpacialProjectId',
			'spacialCode',
			'spacialPercent',
			/*
			  'spacialCode',
			  'spacialPercent',
			  'image',
			  'status',
			  'createDateTime',
			  'updateDateTime',
			 */
			array(
				'class'=>'CButtonColumn',
				'template'=>'{approve} {reject}',
				'buttons'=>array(
					'approve'=>array(
						'label'=>'<i class="fa fa-check"></i>อนุมัติคำขอ',
						'url'=>'Yii::app()->createUrl("backoffice/userSpacialProject/approve/id/".$data->userSpacialProjectId)',
						'visible'=>'($data->status ==1)',
						'options'=>array(
							'class'=>'text-success')
					),
					'reject'=>array(
						'label'=>'<i class="fa fa-remove"></i>ไม่อนุมัติคำขอ',
						'url'=>'Yii::app()->createUrl("backoffice/userSpacialProject/reject/id/".$data->userSpacialProjectId)',
						'visible'=>'($data->status ==1)',
						'options'=>array(
							'class'=>'text-danger')
					)
				),
				'htmlOptions'=>array(
					'style'=>'width:10%;text-align:center;'
				)
			),
		),
	));
	?>

</div>


