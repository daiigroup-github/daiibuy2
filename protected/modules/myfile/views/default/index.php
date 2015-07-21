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
	<?php
	foreach($suppliers as $value):
		$key = $value->name;
		?>
		<?php
		$class = 'col-lg-4 col-md-4 col-sm-12';
		$class .= ($i==3) ? 'col-lg-offset-2 col-md-offset-2' : '';
		//$class = ($i==0) ? 'col-lg-12 col-md-12 col-sm-12' : 'col-lg-4 col-md-4 col-sm-12';
		//$class = 'col-lg-6 col-md-6 col-sm-12';
		?>
		<div class="<?php echo $class; ?>">
			<div class="blog-item">
				<?php
				switch(strtolower($value->url))
				{
					case "atechwindow":
						$url = "atechWindow";
						break;
					case "ginzahome":
						$url = "ginzaHome";
						break;
					case "ginzatown":
						$url = "ginzaTown";
						break;
					default :
						$url = $value->url;
						break;
				}
				?>
				<a href="<?php echo Yii::app()->createUrl('index.php/myfile/' . $url); ?>"><?php
					echo CHtml::image(Yii::app()->baseUrl . $value->logo, $value->name, array(
						"style"=>"height:180px"));
					?>
					<div class="button blue" style="text-align: center;background-clip: border-box;color:white"><?php echo $value->name; ?></div>
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