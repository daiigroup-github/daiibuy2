<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'confirm-transfer-form',
		//'enableAjaxValidation' => true,
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,),
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',
			'class'=>'form-horizontal well'),
	));
	?>
	<h2>กรุณาส่งสินค้า ภายใน <?php echo $model->supplierShippingDateTime; ?></h2>
	<!--<h4>กรุณาพิมพ์ใบส่งของ 2 ฉบับเพื่อนำเอกสาร 1 ฉบับ กลับมา อัพโหลดขึ้นระบบ หลังจากส่งของให้ตัวแทนกระจายสินค้าเสร็จสิน และ ให้ไว้แก่ตัวแทนกระจายสินค้าอีก 1 ฉบับ...</h4>-->
	<div class="row">

		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				<?php
				echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์ใบส่งสินค้า', Yii::app()->createUrl(isset($this->action->controller->module) ? $this->action->controller->module->id . "/order/print" : "order/print", array(
						"id"=>$model->orderGroupId)), array(
					'class'=>'btn btn-warning',
					'target'=>'_blank',));
				?>
				<?php
				echo CHtml::link('<i class="icon-search icon-white"></i> ดูใบสั่งซื้อสินค้า', Yii::app()->createUrl(isset($this->action->controller->module) ? $this->action->controller->module->id . "/order/view" : "order/view", array(
						"id"=>$model->orderGroupId)), array(
					'class'=>'btn btn-primary',
					'target'=>'_blank',));
				?>
				<?php
				echo CHtml::link('<i class="icon-folder-close icon-white"></i> การจัดการสั่งซื้อสินค้า', Yii::app()->createUrl(isset($this->action->controller->module) ? $this->action->controller->module->id . "/order" : "order"), array(
					'class'=>'btn btn-success',));
				?>
			</div>
		</div>

	</div>
	<?php $this->endWidget(); ?>

</div><!-- form -->
