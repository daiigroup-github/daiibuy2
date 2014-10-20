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
				<?php //echo $form->textField($orderModel, "supplierShippingDateTime"); ?>
				<?php
				$this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker', array(
//					'name'=>'OrderGroup[supplierShippingDateTime]',
					'model'=>$orderModel,
					'attribute'=>'supplierShippingDateTime',
					'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'yy-mm-dd',
						'changeMonth'=>'true',
						'changeYear'=>'true',
					),
					'language'=>'th',
					'htmlOptions'=>array(
						'style'=>'height:20px;'
					),
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
