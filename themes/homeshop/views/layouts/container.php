<?php $this->beginContent('//layouts/main');?>
<!-- Container -->
<div class="container">
	<?php $this->renderPartial('//layouts/_header');?>

	<?php echo $content;?>
</div>
<!-- Container -->
<?php $this->endContent();?>