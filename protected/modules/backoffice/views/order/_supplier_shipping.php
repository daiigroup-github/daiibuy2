<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'confirm-transfer-form',
		//'enableAjaxValidation' => true,
//		'enableClientValidation'=>true,
//		'clientOptions'=>array(
//			'validateOnSubmit'=>true,
//		),
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',
			'class'=>'form-horizontal well'),
	));
	?>
	<h2>ผู้ผลิตสินค้าส่งสินค้า</h2>
	<h4>กรุณาเลือกวันเวลาที่สินค้าจะไปถึงตัวแทนกระจายสินค้า...</h4>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-sm-3"><?php echo $form->labelEx($orderModel, "supplierShippingDateTime"); ?></label>
			<div class="col-sm-9">
				<?php
				$this->widget('ext.timepicker.BJuiDateTimePicker', array(
					'model'=>$orderModel,
					'attribute'=>'supplierShippingDateTime',
					'type'=>'datetime', // available parameter is datetime or time
					//'language'=>'de', // default to english
					'themeName'=>'sunny', // jquery ui theme, file is under assets folder
					'options'=>array(
						// put your js options here check http://trentrichardson.com/examples/timepicker/#slider_examples for more info
						'timeFormat'=>'HH:mm:ss',
						'dateFormat'=>'yy/mm/dd',
						'showSecond'=>FALSE,
						'hourGrid'=>1,
						'minuteGrid'=>10,
					),
					'htmlOptions'=>array(
						'class'=>'input-medium'
					)
				));
				?>
				<?php echo $form->error($orderModel, 'supplierShippingDateTime'); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-sm-offset-3">
				<?php echo CHtml::submitButton('ยืนยันการส่งสินค้า'); ?>
			</div>
		</div>

	</div>
	<?php $this->endWidget(); ?>

</div><!-- form -->
