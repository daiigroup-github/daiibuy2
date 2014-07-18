<style>
	body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
	}
</style>

<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<?php require_once 'tpl_header.php'; ?>

<div class="container">
	<?php echo $content; ?>
</div>

<?php require_once 'tpl_footer.php'; ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/navbar-fixed-top.css'); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/style.css'); ?>
<?php $this->endContent(); ?>