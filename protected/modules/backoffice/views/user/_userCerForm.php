<div class='form'>
	<?php
	$this->breadcrumbs = array(
		'Users'=>array(
			'index'),
		$userId=>array(
			'update',
			'id'=>$userId),
		'UserCer',
	);
	$this->pageHeader = "สร้างเอกสารสัญญา Margin";
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'userCer-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',
			'class'=>'form-horizontal well'),
	));
	?>
	<div class="alert">
		<h4>คำอธิบาย ประเภทของสัญญา Margin</h4>
		<p>1. User Reward : ส่วนแบ่ง margin เป็น % ที่ได้จาก ส่วนแบ่งของ daiibuy.com โดย จะได้เป็นจำนวน คะแนน โดยคำนวณจาก ค่าที่ตั้งไว้ที่ระบบ</p>
		<p>2. Margin to Distributor : ส่วนแบ่ง margin เป็น % ที่ได้จาก ส่วนแบ่งของ daiibuy.com</p>
		<p>3. Margin to DaiiBuy.com : ส่วนแบ่งเป็น % ที่ได้จากส่วนแบ่งการขายของ Supplier โดยตรง</p>
	</div>
	<?php //echo $form->errorSummary($userCer); ?>
	<div class="control-group">
		<div class="controls">
			<?php
			echo CHtml::submitButton($userCer->isNewRecord ? 'สร้าง' : 'บันทึก', array(
				'class'=>'btn btn-primary pull-right')); //'onclick'=>"validatePromotion()" ));
			?>
		</div>
	</div>
	<div class='row-fluid'>
		<!--		<div class="control-group">
					<label class="control-label"><?php // echo $form->labelEx($userCer, "name");            ?></label>
					<div class="controls">
		<?php // echo $form->textField($userCer, "name"); ?>
		<?php // echo $form->error($userCer, "name"); ?>
					</div>
				</div>-->
		<div class="control-group">
			<div class="control-label">
				<?php echo $form->labelEx($userCer, "forUserType"); ?>
			</div>
			<div class="controls">
				<?php
				echo $form->dropdownList($userCer, "forUserType", User::model()->getMarginUserType(), array(
					'prompt'=>'เลือกประเภท Margin'))
				?>
				<?php echo $form->error($userCer, "forUserType"); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($userCer, "description"); ?></label>
			<div class="controls">
				<?php echo $form->textField($userCer, "description"); ?>
				<?php echo $form->error($userCer, "description"); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($userCer, "file"); ?></label>
			<div class="controls">
				<?php
				if(isset($userCer->file))
				{
					echo CHtml::image(Yii::app()->request->baseUrl . "/" . $userCer->file, "", array(
						'style'=>'height:250px;',
						'class'=>'img-polaroid'));
					echo $form->hiddenField($userCer, "file", array(
						'value'=>$userCer->file,
						'name'=>'UserCertificateFile[oldFile]'));
				}echo "</br>";
				echo CHtml::activeFileField($userCer, "file");
				?>
				<?php echo $form->error($userCer, "file"); ?>
			</div>
		</div>
	</div>
    <div class="control-group">
        <label class="control-label"><?php echo $form->labelEx($userCer, "value"); ?></label>
        <div class="controls">
			<?php echo $form->textField($userCer, "value"); ?>
			<?php echo $form->error($userCer, "value"); ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label"><?php echo $form->labelEx($userCer, "status"); ?></label>
        <div class="controls">
			<?php echo $form->checkBox($userCer, "status"); ?>
        </div>
    </div>

</div>
<?php $this->endWidget(); ?>
</div>