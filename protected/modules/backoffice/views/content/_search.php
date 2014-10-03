<?php
/* @var $this ContentController */
/* @var $model Content */
/* @var $form CActiveForm */
?>


<?php
$form = $this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array(
		'class'=>'form-search well'
	),
	));
?>

<div class="input-append">
	<?php
	echo $form->textField($model, 'title', array(
		'size'=>60,
		'maxlength'=>500,
		'placeholder'=>'ชื่อ Content'));
	?>
	<?php
	echo $form->textField($model, 'description', array(
		'placeholder'=>'รายละเอียด'));
	?>
	<?php
	echo CHtml::submitButton('Search', array(
		'class'=>'btn'));
	?>
</div>

<?php $this->endWidget(); ?>
