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
//			'class'=>'form-inline well'
		),
	));
	?>
	<div class="input-group">
		<span class="input-group-btn">
			<button class="btn btn-default" type="submit">Search</button>
		</span>
		<div class="row">
			<div class="col-lg-12">
				<?php
				echo $form->textField($model, 'searchText', array(
					'class'=>'form-control',
					'placeholder'=>'คำค้น เช่น ชื่อธนาคาร สาขา',));
				?>
			</div>
		</div>

	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->