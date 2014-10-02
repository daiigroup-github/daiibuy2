<?php
/* @var $this ConfigurationController */
/* @var $model Configuration */
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
			'class'=>'input-medium search-query',
			'placeholder'=>'Search'));

		echo CHtml::submitButton('Search', array(
			'class'=>'btn'));
		?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->