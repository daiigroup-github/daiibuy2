<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data',
		'class'=>'form-horizontal'),
	));
?>
<div class="row  sidebar-box green">
	<div class="sidebar-box-heading">
		<i class="icons icon-box-2"></i>
		<h4>&nbsp; คุณต้องการ ย้าย  เป็น <?php echo ($partnerType == 1) ? "WOW " : " ORG" ?> หมายเลข <?php echo $newCode; ?> หรือไม่?</h4>
	</div>
	<div class="sidebar-box-content sidebar-padding-box ">
		<div class="row">
			<div class="col-lg-12 alert alert-info">
				จาก <?php echo $oldCode; ?>
				ส่วนลด <?php echo "1 %" ?>
				-----------> ใหม่ <?php echo $newCode; ?>
				ส่วนลด <?php echo "2 %" ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 ">
				<input type="radio" name="change" id="yes" value="1"  style="font-size: 24"  />
				<label class="radio-label text-success" for="yes"  style="font-size: 24px"><i class="icons fa fa-check"></i> ใช่</label>
				<br>
				<input type="radio" name="change" id="no" value="/"  style="font-size: 24px" />
				<label class="radio-label text-danger" for="no"  style="font-size: 24px"><i class="icons fa fa-remove"></i> ไม่ใช่</label>
			</div>
		</div>

		<div class="row text-center">
			<div class="col-lg-12">
				<?php
				echo CHtml::submitButton("ตกลง", array(
					'class'=>'btn btn-success'))
				?>
			</div>
		</div>

	</div>
</div>
<?php $this->endWidget(); ?>