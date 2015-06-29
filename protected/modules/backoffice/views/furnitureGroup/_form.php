<?php
/* @var $this FurnitureGroupController */
/* @var $model FurnitureGroup */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'furniture-group-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
			'class'=>'form-horizontal',
			'enctype'=>'multipart/form-data',
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
		echo $form->labelEx($model, 'categoryId', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php echo $model->category->title; ?>
			<?php echo $form->error($model, 'categoryId'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'category2Id', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php echo $model->category2->title; ?>
			<?php echo $form->error($model, 'category2Id'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'title', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'title', array(
				'size'=>60,
				'maxlength'=>200,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'title'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'description', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			$this->widget('ext.editMe.widgets.ExtEditMe', array(
				'model'=>$model,
				'attribute'=>'description',
				//'filebrowserImageUploadUrl' => Yii::app()->createUrl('admin/product/uploadFile'),
				'filebrowserImageBrowseUrl'=>Yii::app()->request->baseUrl . '/ext/kcfinder/browse.php?type=files&cms=yii',));
			?>
			<?php echo $form->error($model, 'description'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'image', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			if($this->action->id == 'update')
				echo CHtml::image(Yii::app()->baseUrl . $model->image, '', array(
					'style'=>'width:150px;'));
			?>
			<?php
			echo $form->fileField($model, 'image', array(
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'image'); ?>
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