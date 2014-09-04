<script>
	$(document).ready(function() {
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
<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data',
		'class'=>'form-horizontal well'),
	));
?>
<div class="control-group">
    <div class="controls">
		<?php
		echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
			'class'=>'btn btn-primary pull-right')); //'onclick'=>"validatePromotion()" ));
		?>
    </div>
</div>

<p class="note">
    Fields with <span class="required">*</span> are required.
</p>

<?php
if($model->status == 3)
{
	?>
	<div class="alert alert-danger">
		กรุณาแก้ไขข้อมูล Product ใหม่ และ บันทึก เพื่อส่ง ข้อมูลกลับให้ ผู้ดูแลระบบ ตรวจสอบอีกครั้ง
	</div>
	<?php
}
echo $form->errorSummary($model, '', '', array(
	'class'=>'alert alert-error'));
//echo $form->errorSummary($productPromotion, '', '', array(
//	'class'=>'alert alert-error'));
?>
<div class="tabbable"> <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
        <li class="active" id="t1"><a href="#tab1" data-toggle="tab">รายละเอียดสินค้า</a></li>
        <li id="t3"><a href="#tab3" data-toggle="tab">โปรโมชั่น</a></li>
        <li><a href="#tab2" data-toggle="tab">คุณสมบัติ</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
			<?php
			$this->renderPartial('_form_product', array(
				'model'=>$model,
				'form'=>$form,));
			?>
        </div>
        <div class="tab-pane" id="tab2">
			<?php
			$this->renderPartial('_form_attribute', array(
				'model'=>$model,
				'productAttributeModel'=>$productAttributeModel,
				'productAttributeValueModel'=>$productAttributeValueModel,
				'form'=>$form,));
			?>
        </div>
        <div class="tab-pane" id="tab3">
			<?php
			$this->renderPartial('_form_promotion', array(
				'model'=>$productPromotion,
				'form'=>$form,));
			?>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>