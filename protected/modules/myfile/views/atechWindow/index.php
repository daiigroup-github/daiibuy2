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
			<h4>My Files Atech Window</h4>
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
		<li class="active green"><a href="<?php echo Yii::app()->request->baseUrl . "/index.php/myfile/atechWindow/index"; ?>"><h5 style="color: white;">ไฟล์ของฉัน</h5></a></li>
		<li class="orange"><a href="<?php echo Yii::app()->request->baseUrl . "/index.php/myfile/atechWindow/create"; ?>"><h5 style="color: white;">+ สร้างใหม่</h5></a></li>
	</ul>
	<?php $i = 0; ?>
	<div class='col-lg-3 col-md-3 col-sm-12'>
		<?php
			foreach($myfileArray as $myfile): ?>
			<div class="blog-item">
					<a href="<?php echo Yii::app()->createUrl('/index.php/myfile/atechWindow/views/id/' . $myfile->orderId); ?>"><?php echo CHtml::image(Yii::app()->baseUrl . '/images/myfiles/' . $myfile->title . '.png'); ?>
						<div class="button blue" style="text-align: center;background-clip: border-box;color: white" name="<?php echo $myfile->title; ?>"><?php echo $myfile->title; ?></div>
					</a>
				</div>
		<?php $i++; ?>
	<?php endforeach;?>
	</div>
</div>