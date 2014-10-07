<?php
/* @var $this HomeController */

$this->breadcrumbs = array(
	'Home',
);
?>

<?php $this->renderPartial('//layouts/_ios_slider'); ?>

<div class="row">
	<div class="col-md-12">

		<div class="row sidebar-box blue">

			<div class="col-lg-12 col-md-12 col-sm-12">

				<div class="carousel-heading no-margin">
					<h4>ผู้ผลิต</h4>
				</div>

				<div class="page-content">

					<div class="row">

						<?php $i = 0; ?>
						<?php foreach($suppliers as $supplier): ?>
							<?php
							$class = 'col-lg-3 col-md-3 col-sm-12';
							//$class = ($i==0) ? 'col-lg-12 col-md-12 col-sm-12' : 'col-lg-4 col-md-4 col-sm-12';
							//$class = 'col-lg-6 col-md-6 col-sm-12';
							?>
							<div class="<?php echo $class; ?>">
								<div class="blog-item">

									<a href="<?php echo Yii::app()->createUrl($supplier->url); ?>"><?php echo CHtml::image(Yii::app()->baseUrl . '/' . $supplier->logo); ?></a>

									<div class="blog-info">
										<h3>
											<a href="<?php echo Yii::app()->createUrl($supplier->url); ?>"><?php echo $supplier->name; ?></a>
										</h3>
										<?php
										/*
										<div class="blog-meta">
											<span class="date"><i class="icons icon-clock"></i> 21 December 2012</span>
											<span class="cat"><i class="icons icon-tag"></i> <a href="#">lorem</a>, <a href="#">tablet</a></span>
											<span class="views"><i class="icons icon-eye-1"></i> 11 times</span>
										</div>
										*/
										?>
										<p><?php echo $supplier->description;?></p>
									</div>
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

				</div>

			</div>
		</div>
	</div>
</div>


<?php
/*
<!-- Banner -->
<section class="banner">

	<div class="left-side-banner banner-item icon-on-right gray">
		<h4>8(802)234-5678</h4>
		<p>Monday - Saturday: 8am - 5pm PST</p>
		<i class="icons icon-phone-outline"></i>
	</div>

	<a href="#">
		<div class="middle-banner banner-item icon-on-left light-blue">
			<h4>Free shipping</h4>
			<p>on all orders over $99</p>
			<span class="button">Learn more</span>
			<i class="icons icon-truck-1"></i>
		</div>
	</a>

	<a href="#">
		<div class="right-side-banner banner-item orange">
			<h4>Crazy sale!</h4>
			<p>on selected items</p>
			<span class="button">Shop now</span>
		</div>
	</a>

</section>
<!-- /Banner -->
 */
?>