<div class="row">
	<!-- Heading -->
	<div class="col-lg-12 col-md-12 col-sm-12">

		<div class="carousel-heading">
			<h4>My Files MADRID BATHROOM : Create My File</h4>
			<?php /*
			<div class="pull-right">
				<a class="col-lg-6 col-md-6 col-sm-6 glyphicon glyphicon-chevron-left button" onclick="javascript:history.back();"></a>
				<a class="col-lg-6 col-md-6 col-sm-6 glyphicon glyphicon-chevron-right button" onclick="javascript:history.forward();"></a>
			</div>
 			*/?>
		</div>

	</div>
	<!-- /Heading -->
</div>
<div class="row" >
	<div class="col-md-12">
	<ul class="nav nav-pills" role="tablist" >
		<li class="active orange"><a href="<?php echo Yii::app()->request->baseUrl . "/index.php/myfile/madrid/"; ?>"><h5 >ไฟล์ของฉัน</h5></a></li>
		<?php if($this->action->id != "create"): ?>
			<li class="green"><a href="<?php echo Yii::app()->request->baseUrl . "/index.php/myfile/madrid/create"; ?>"><h5 >+ สร้างใหม่</h5></a></li>
			<?php endif; ?>
	</ul>
	</div>
</div>