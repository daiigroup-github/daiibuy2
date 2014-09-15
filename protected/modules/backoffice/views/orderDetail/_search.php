<?php
/* @var $this OrderDetailController */
/* @var $model OrderDetail */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array('class'=>'form-search search-form')
)); ?>


<?php echo $form->textField($model,'searchText', array('class'=>'input-medium search-query')); ?>
<?php echo CHtml::button('Search', array('class'=>'btn', 'type'=>'submit')); ?>

<?php $this->endWidget(); ?>
