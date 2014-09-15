<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
	$this->module->id,
);
?>
<div class="row">
	<!-- Heading -->
	<div class="col-lg-12 col-md-12 col-sm-12">

		<div class="carousel-heading">
			<h4>My Files</h4>
		</div>

	</div>
	<!-- /Heading -->
</div>
<div class="row">
	<?php $i = 0; ?>
	<?php foreach($suppliers as $key=> $value): ?>
		<?php
		$class = 'col-lg-3 col-md-3 col-sm-12';
		//$class = ($i==0) ? 'col-lg-12 col-md-12 col-sm-12' : 'col-lg-4 col-md-4 col-sm-12';
		//$class = 'col-lg-6 col-md-6 col-sm-12';
		?>
		<div class="<?php echo $class; ?>">
			<div class="blog-item">

				<a href="<?php echo Yii::app()->createUrl($key); ?>"><?php echo CHtml::image(Yii::app()->baseUrl . '/images/myfiles/' . $key . '.png'); ?>
					<div class="button" style="text-align: center;background-clip: border-box;
						 background-color: rgb(52, 152, 219);"><?php echo $value; ?></div>
				</a>
				<?php
				/*
				  <div class="product-actions blog-actions">
				  <span class="product-action dark-blue current">
				  <span class="action-wrapper">
				  <i class="icons icon-doc-text"></i>
				  <span class="action-name">Read more</span>
				  </span>
				  </span>
				  </div>
				 */
				?>
			</div>

		</div>
		<?php $i++; ?>
	<?php endforeach; ?>

</div>