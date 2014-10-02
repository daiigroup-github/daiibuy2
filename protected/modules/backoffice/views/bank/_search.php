<?php
/* @var $this BankController */
/* @var $model Bank */
/* @var $form CActiveForm */
?>

<div class="wide form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
		'htmlOptions'=>array(
			'class'=>'form-inline well'
		),
	));
	?>

	<div class="input-append">
		<?php
		echo $form->textField($model, 'searchText', array(
			'size'=>100,
			'maxlength'=>100,
			'placeholder'=>'คำค้น เช่น ชื่อธนาคาร สาขา',
			'class'=>' search-query'));
		?>

		<?php echo CHtml::submitButton('Search'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->