<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array(
//		'class'=>'form-search well'
	),
	'id'=>'search-form',
	));
?>
<div class="input-group">
	<span class="input-group-btn">
		<button class="btn btn-default" type="submit">Search</button>
	</span>
	<div class="row">
		<div class="col-lg-6">
			<?php
			echo $form->textField($model, 'searchText', array(
				'class'=>'form-control'));
			?>
		</div>
		<div class="col-lg-6">
			<?php
			echo $form->dropdownList($model, "status", Product::model()->getStatusArray(), array(
				'class'=>'form-control'));
			?>
		</div>
	</div>

</div>

<?php $this->endWidget(); ?>