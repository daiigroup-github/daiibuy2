<?php
/* @var $this BankController */
/* @var $model Bank */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'order-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',
			'class'=>'form-horizontal'),
	));
	?>
	<div class="row sidebar-box blue">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="carousel-heading">
				<h4>Duplicate Myfile <?php echo $model->title; ?></h4>
			</div>
			<div class="sidebar-box-content sidebar-padding-box">
				<p class="note">Fields with <span class="required">*</span> are required.</p>

				<?php echo $form->errorSummary($model); ?>


				<div class="form-group">
					<div class="control-label col-sm-2"><?php echo "ระบุชื่อใหม่"; ?></div>
					<div class="col-sm-10">
						<?php
						echo $form->textField($model, 'title', array(
							'prompt'=>'กรุณาระบุชื่อใหม่',
						));
						?>
						<?php echo $form->error($model, 'title'); ?>
					</div>
				</div>

				<div class="form-group">
					<div class="control-label col-sm-2"><?php echo "เลือกจังหวัด"; ?></div>
					<div class="col-sm-10">
						<?php
						echo $form->dropDownList($model, 'provinceId', Province::model()->findAllProvinceArray(), array(
							'class'=>'form-control',
							'prompt'=>'-- เลือกจังหวัด --',
						));
						?>
						<?php echo $form->error($model, 'provinceId'); ?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-9">
						<?php
						echo CHtml::submitButton('สร้างสำเนา', array(
							'class'=>'btn btn-primary'));
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->endWidget(); ?>

</div><!-- form -->