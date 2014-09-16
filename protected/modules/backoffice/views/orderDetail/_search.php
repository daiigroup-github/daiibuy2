<?php
/* @var $this OrderDetailController */
/* @var $model OrderDetail */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
'id'=>'search-form',
)); ?>
	<div class="input-group">
		<span class="input-group-btn">
            <button class="btn btn-default" type="submit">Search</button>
		</span>
		<?php echo $form->textField($model,'searchText', array('class'=>'form-control')); ?>
	</div>
<?php $this->endWidget(); ?>
