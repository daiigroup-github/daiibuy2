<?php
/* @var $this BankNameController */
/* @var $model BankName */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array(
		'class'=>'form-search search-form')
	));
?>

<div class="input-group">
	<span class="input-group-btn">
		<button class="btn btn-default" type="submit">Search</button>
	</span>
	<div class="row">
		<div class="col-lg-12">
			<?php
			echo $form->textField($model, 'email', array(
				'class'=>'form-control',
				'placeholder'=>'email',));
			?>
		</div>
	</div>

</div>
<?php $this->endWidget(); ?>
