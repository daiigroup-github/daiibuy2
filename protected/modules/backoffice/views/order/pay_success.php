<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'id' => 'search-form',
));
?>
<h3 class="text-center">Update Order To Paysuccess</h3>
<div class="input-group">
    <span class="input-group-btn">
        <button class="btn btn-default" type="submit">OrderId</button>
    </span>

    <?php echo CHtml::textField('orderId', isset($_GET["orderId"]) ? $_GET["orderId"] : NULL, array('class' => 'form-control')) ?>
</div>
<?php $this->endWidget(); ?>