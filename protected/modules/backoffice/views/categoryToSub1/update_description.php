<?php
/* @var $this CategoryToSubController */
/* @var $model CategoryToSub */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'category-to-sub-form',
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
	<hr><h3 class="alert alert-info">Sub Category Description</h3>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php
	echo $form->errorSummary($model, '', '', array(
		'class'=>'alert alert-danger'));
	?>

	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'description', array(
			'class'=>'control-label col-sm-2'));
		?>
		<div class="col-sm-10">
			<?php
//				if ($pDescription == FALSE)
//				{
			$this->widget('ext.editMe.widgets.ExtEditMe', array(
				'model'=>$model,
				'attribute'=>'description',
				//'filebrowserImageUploadUrl' => Yii::app()->createUrl('admin/product/uploadFile'),
				'filebrowserImageBrowseUrl'=>Yii::app()->request->baseUrl . '/ext/kcfinder/browse.php?type=files&cms=yii',
			));
//				}
//				else
//				{
//					echo $model->description;
//				}
			?>

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