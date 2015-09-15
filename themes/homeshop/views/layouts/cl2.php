<?php $this->beginContent('//layouts/container'); ?>
<!-- Content -->
<div class="row content">
	<!-- Main Content -->
	<section class="main-content col-lg-9 col-md-9 col-sm-9 col-lg-push-3 col-md-push-3 col-sm-push-3">
		<?php echo $content; ?>
	</section>
	<!-- /Main Content -->

	<!-- Sidebar -->
	<aside class="sidebar col-lg-3 col-md-3 col-sm-3  col-lg-pull-9 col-md-pull-9 col-sm-pull-9">
		<?php $this->renderPartial('//layouts/_sidebar_box'); ?>
	</aside>
	<!-- /Sidebar -->
</div>
<!-- /Content -->
<?php $this->endContent(); ?>