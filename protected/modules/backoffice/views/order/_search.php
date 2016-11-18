<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'id' => 'search-form',
));
?>
<div class="input-group">
    <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Search</button>
    </span>
    <?php // echo $form->textField($model,'searchText', array('class'=>'form-control'));  ?>
    <?php echo CHtml::textField('searchText', isset($_GET["searchText"]) ? $_GET["searchText"] : NULL, array('class' => 'form-control')) ?>
</div>
<?php $this->endWidget(); ?>
