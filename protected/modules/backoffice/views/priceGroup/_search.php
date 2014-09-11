<?php
/* @var $this PriceGroupController */
/* @var $model PriceGroup */
/* @var $form CActiveForm */
?>

<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	));
	?>

	<div class="row">
		<?php echo $form->label($model, 'priceGroupId'); ?>
		<?php
		echo $form->textField($model, 'priceGroupId', array(
			'size'=>10,
			'maxlength'=>10));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'priceGroupName'); ?>
		<?php
		echo $form->textField($model, 'priceGroupName', array(
			'size'=>60,
			'maxlength'=>500));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'priceRate'); ?>
		<?php
		echo $form->textField($model, 'priceRate', array(
			'size'=>5,
			'maxlength'=>5));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'status'); ?>
		<?php echo $form->textField($model, 'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->