<script>
	$(document).ready(function () {
		var modelErrors = <?php echo isset($model->Errors) ? count($model->Errors) : 0; ?>;
		var promotionErrors = <?php echo isset($productPromotion->Errors) ? count($productPromotion->Errors) : 0; ?>;
		if (modelErrors || promotionErrors)
		{
			if ((modelErrors > 0 && promotionErrors > 0) || modelErrors > 0) {
				//document.getElementById("t3").style.display = "inline";
				$("#t3").removeClass("active");
				$("#t1").addClass("active");
				$("#tab3").removeClass("active");
				$("#tab1").addClass("active");
			} else {
				$("#t1").removeClass("active");
				$("#t3").addClass("active");
				$("#tab1").removeClass("active");
				$("#tab3").addClass("active");
			}
		}
	});
</script>
<div class="form">
	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'product-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',
			'class'=>'form-horizontal'
		),
	));
	?>


	<?php
//	if($model->status == 3)
//	{
//
	?>
	<!--	<div class="alert alert-danger">
			กรุณาแก้ไขข้อมูล Product ใหม่ และ บันทึก เพื่อส่ง ข้อมูลกลับให้ ผู้ดูแลระบบ ตรวจสอบอีกครั้ง
		</div>-->
	<?php
	echo $form->errorSummary($model, '', '', array(
		'class'=>'alert alert-danger'));
	?>
	<div class="tabbable"> <!-- Only required for left/right tabs -->
		<ul class="nav nav-tabs nav-justified">
			<li class="" id="t1"><a  href="#tab1" data-toggle="tab">รายละเอียดสินค้า</a></li>
			<?php if($this->action->id == "update"): ?>
				<li id="t3"><a href="#tab3" data-toggle="tab">โปรโมชั่น</a></li>
				<li><a href="#tab2" data-toggle="tab">คุณสมบัติ</a></li>
				<li class="active" id="t4"><a  href="#tab4" data-toggle="tab">ตัวเลือก</a></li>
			<?php endif; ?>
		</ul>

		<div class="tab-content">
			<div class="tab-pane " id="tab1">
				<?php
				$this->renderPartial('_form_product', array(
					'model'=>$model,
					'form'=>$form,));
				?>
			</div>
			<?php if($this->action->id == "update"): ?>
				<div class="tab-pane" id="tab2">
					<?php
//			$this->renderPartial('_form_attribute', array(
//				'model'=>$model,
//				'productAttributeModel'=>$productAttributeModel,
//				'productAttributeValueModel'=>$productAttributeValueModel,
//				'form'=>$form,));
					?>
				</div>
				<div class="tab-pane" id="tab3">
					<?php
					$this->renderPartial('_form_promotion', array(
						'model'=>$productPromotion,
						'form'=>$form,));
					?>
				</div>
				<div class="tab-pane active" id="tab4">
					<?php
					$this->renderPartial('/share/_form_group_item', array(
						'model'=>$productOption,
						'modelGroup'=>$productOptionGroup,
						'form'=>$form,
						'groupName'=>"Option Group"));
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
			<?php
			echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
				'class'=>'btn btn-primary'));
			?>
		</div>
	</div>

	<?php $this->endWidget(); ?>
</div>