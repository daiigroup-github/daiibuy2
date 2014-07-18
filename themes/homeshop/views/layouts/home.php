<?php $this->beginContent('//layouts/main'); ?>

<?php //$this->renderPartial('//layouts/_main_header');?>

<!-- Container -->
<div class="container">

	<!-- Header -->
	<?php $this->renderPartial('//layouts/_header');?>
	<!-- /Header -->

	<!-- Content -->
	<div class="row content">

		<!-- Main Content -->
		<section class="main-content col-lg-12 col-md-12 col-sm-12">
			<?php echo $content; ?>
		</section>
		<!--/Main Content -->

	</div>
	<!--/Content -->


	<?php $this->renderPartial('//layouts/_footer'); ?>
	<div id="back-to-top">
		<i class="icon-up-dir"></i>
	</div>
</div>
<!-- Container -->
<?php $this->endContent(); ?>
