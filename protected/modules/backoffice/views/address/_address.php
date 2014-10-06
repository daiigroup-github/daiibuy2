
<?php
//$type is type of address ex. business , billing
if(isset($type))
{
	$type = $type;
}
else
{
	$type = "";
}
?>

<div class="form-group">
	<label class="control-label col-sm-2"><?php echo $form->labelEx($model, "[$type]" . 'firstname'); ?></label>
	<div class="col-sm-10">
		<?php
		echo $form->textField($model, "[$type]" . 'firstname', array(
			'class'=>'form-control',
			'placeholder'=>'ชื่อ',
			'value'=>$model->firstname));
		?>
		<?php echo $form->error($model, "[$type]" . 'firstname'); ?>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-sm-2"><?php echo $form->labelEx($model, "[$type]" . 'lastname'); ?></label>
	<div class="col-sm-10">
		<?php
		echo $form->textField($model, "[$type]" . 'lastname', array(
			'class'=>'form-control',
			'placeholder'=>'นามสกุล'));
		?>
		<?php echo $form->error($model, "[$type]" . 'lastname'); ?>
	</div>
</div>

<div class="form-group">
	<label class="control-label col-sm-2"><?php echo $form->labelEx($model, "[$type]" . 'company'); ?></label>
	<div class="col-sm-10">
		<?php
		echo $form->textField($model, "[$type]" . 'company', array(
			'class'=>'form-control'));
		?>
		<?php echo $form->error($model, "[$type]" . 'company'); ?>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label"><?php echo $form->labelEx($model, "[$type]" . 'taxNo'); ?></label>
	<div class="col-sm-10">
		<?php
		echo $form->textField($model, "[$type]" . 'taxNo', array(
			'class'=>'form-control'));
		?>
		<?php echo $form->error($model, "[$type]" . 'taxNo'); ?>
	</div>
</div>

<?php
//if($type == "billing")
//{
//
?>
<!--	<div class="control-group">
		<label class="control-label">//<?php // echo $form->labelEx($model, "[$type]" . 'taxNo');                                     ?></label>
		<div class="controls">-->
<?php
//			echo $form->textField($model, "[$type]" . 'taxNo', array(
//				'class'=>'input-xlarge'));
//
?>
<?php // echo $form->error($model, "[$type]" . 'taxNo');  ?>
<!--		</div>
	</div>-->
<?php // }  ?>

<div class="form-group">
	<label class="control-label col-sm-2"><?php echo $form->labelEx($model, "[$type]" . 'address_1'); ?></label>
	<div class="col-sm-10">
		<?php
		echo $form->textField($model, "[$type]" . 'address_1', array(
			'class'=>'form-control'));
		?>
		<?php echo $form->error($model, "[$type]" . 'address_1'); ?>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-sm-2"><?php echo $form->labelEx($model, "[$type]" . 'address_2'); ?></label>
	<div class="col-sm-10">
		<?php
		echo $form->textField($model, "[$type]" . 'address_2', array(
			'class'=>'form-control'));
		?>
		<?php echo $form->error($model, "[$type]" . 'address_2'); ?>
	</div>
</div>

<?php
$this->renderPartial("/address/_location", array(
	"model"=>$model,
	"type"=>$type,
	'form'=>$form));
?>

<div class="form-group">
	<label class="col-sm-2 control-label"><?php echo $form->labelEx($model, "[$type]" . 'postcode'); ?></label>
	<div class="col-sm-10">
		<?php
		echo $form->textField($model, "[$type]" . 'postcode', array(
			'class'=>'form-control'));
		?>
		<?php echo $form->error($model, "[$type]" . 'postcode'); ?>
	</div>
</div>

<?php if((isset($model->type) && $model->type == 2) && Yii::app()->user->userType == 4): ?>
	<div class="form-group">
		<label class="col-sm-2 control-label"><?php echo $form->labelEx($model, "[$type]" . 'latitude'); ?></label>
		<div class="col-sm-4">
			<?php
			echo $form->textField($model, "[$type]" . 'latitude', array(
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, "[$type]" . 'latitude'); ?>
		</div>
		<label class="col-sm-2 control-label"><?php echo $form->labelEx($model, "[$type]" . 'longitude'); ?></label>
		<div class="col-sm-4">
			<?php
			echo $form->textField($model, "[$type]" . 'longitude', array(
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, "[$type]" . 'longitude'); ?>
		</div>
	</div>
<?php endif; ?>
