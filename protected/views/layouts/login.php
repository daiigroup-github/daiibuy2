<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<?php echo $content; ?>
</div>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/signin.css'); ?>
<?php $this->endContent(); ?>