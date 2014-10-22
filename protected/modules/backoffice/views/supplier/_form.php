<?php
/* @var $this SupplierController */
/* @var $model Supplier */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'supplier-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>true,
		'htmlOptions'=>array(
			'class'=>'form-horizontal',
		//'enctype' => 'multipart/form-data',
		),
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php
	echo $form->errorSummary($model, '', '', array(
		'class'=>'alert alert-danger'));
	?>

	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'name', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'name', array(
				'size'=>60,
				'maxlength'=>200,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'name'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'companyName', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'companyName', array(
				'size'=>60,
				'maxlength'=>200,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'companyName'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'description', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textArea($model, 'description', array(
				'rows'=>6,
				'cols'=>50,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'description'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'address1', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textArea($model, 'address1', array(
				'rows'=>6,
				'cols'=>50,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'address1'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'address2', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textArea($model, 'address2', array(
				'rows'=>6,
				'cols'=>50,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'address2'); ?>
		</div>
	</div>
	<?php
	$this->renderPartial("/address/_location", array(
		'model'=>$model,
		'form'=>$form,
		'type'=>'billing'
		), FALSE, TRUE)
	?>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'postcode', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'postcode', array(
				'size'=>60,
				'maxlength'=>20,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'postcode'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'tel', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'tel', array(
				'size'=>25,
				'maxlength'=>25,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'tel'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'fax', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'fax', array(
				'size'=>25,
				'maxlength'=>25,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'fax'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'logo', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			if($this->action->id == 'update')
				echo CHtml::image(Yii::app()->baseUrl . "/" . $model->logo, '', array(
					'style'=>'width:150px;'));
			?>
			<?php
			echo $form->fileField($model, 'logo', array(
				'size'=>60,
				'maxlength'=>255,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'logo'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'taxNumber', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'taxNumber', array(
				'size'=>60,
				'maxlength'=>50,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'taxNumber'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'url', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'url', array(
				'size'=>60,
				'maxlength'=>255,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'url'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'status', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->checkBox($model, 'status', array(
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'status'); ?>
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

</div><!-- form -->