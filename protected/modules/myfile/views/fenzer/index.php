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
			<h4 class="pull-left">My Files Fenzer</h4>
			<div class="pull-right">
				<a class="col-lg-6 col-md-6 col-sm-6 glyphicon glyphicon-chevron-left button" onclick="javascript:history.back();"></a>
				<a class="col-lg-6 col-md-6 col-sm-6 glyphicon glyphicon-chevron-right button" onclick="javascript:history.forward();"></a>
			</div>
		</div>
	</div>
	<!-- /Heading -->
</div>
<div class="row">
	<ul class="nav nav-tabs" role="tablist">
		<li class="active green"><a href="#"><h5>ไฟล์ของฉัน</h5></a></li>
		<li class="orange"><a href="#"><h5 style="color: white;">+ สร้างใหม่</h5></a></li>
	</ul>
	<?php $i = 0; ?>
	<?php foreach($suppliers as $key=> $value): ?>
		<div class='col-lg-3 col-md-3 col-sm-12'>
			<div class="blog-item">
				<a href="<?php echo Yii::app()->createUrl($key); ?>"><?php echo CHtml::image(Yii::app()->baseUrl . '/images/myfiles/' . $key . '.png'); ?>
					<div class="button" style="text-align: center;background-clip: border-box;
						 background-color: rgb(52, 152, 219);"><?php echo $value; ?></div>
				</a>
			</div>

		</div>
		<?php $i++; ?>
	<?php endforeach; ?>

</div>