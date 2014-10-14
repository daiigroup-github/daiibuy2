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
		'id'=>'search-form',
	));
	?>

	<div class="input-group">
		<span class="input-group-btn">
            <button class="btn btn-default" type="submit">Search</button>
		</span>
		<?php
		echo $form->textField($model, 'searchText', array(
			'class'=>'form-control'));
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->