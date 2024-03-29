<?php
/* @var $this ProductSpecGroupController */
/* @var $model ProductSpecGroup */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'product-spec-group-form',
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
		echo $form->labelEx($model, 'productId', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php echo isset($model->product) ? $model->product->name : "-"; ?>
			<?php echo $form->error($model, 'productId'); ?>
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
//				'filebrowserImageUploadUrl'=>Yii::app()->createUrl('/../images/upload/supplierImage' . Yii::app()->user->supplierId),
				'filebrowserImageBrowseUrl'=>Yii::app()->request->baseUrl . '/ext/kcfinder/browse.php?type=files&cms=yii',
			));
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
				'size'=>60,
				'maxlength'=>255,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'image'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'parentId', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo isset($model->parent) ? $model->parent->title : "Is Parent";
			?>
			<?php echo $form->error($model, 'parentId'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'type', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php echo $model->getProductSpecGroupArrayText($model->type); ?>
			<?php echo $form->error($model, 'type'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'sortOrder', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->numberField($model, 'sortOrder', array(
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'sortOrder'); ?>
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