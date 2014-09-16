<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="js/jquery.bootstrap.wizard.min.js"></script>

<style>
    body {
		padding-top:4em;
    }
</style>

<div class="row">
	<!-- Heading -->
	<div class="col-lg-12 col-md-12 col-sm-12">

		<div class="carousel-heading">
			<h4>My Files Madrid Bathroom : Create My File</h4>
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
		<li class="active orange"><a href="<?php echo Yii::app()->request->baseUrl . "/index.php/myfile/fenzer/"; ?>"><h5 style="color: white;">ไฟล์ของฉัน</h5></a></li>
		<li class="green"><a href="<?php echo Yii::app()->request->baseUrl . "/index.php/myfile/fenzer/create"; ?>"><h5 style="color: white;">+ สร้างใหม่</h5></a></li>
	</ul>
</div>


<div id="rootwizard">

	<!-- 1. Create the tabs themselves  -->
	<!-- data-toggle required. -->
	<ul class="nav nav-tabs" role="tablist">
		<li><a href="#step1" role="tab" data-toggle="tab">step1</a></li>
		<li><a href="#step2" role="tab" data-toggle="tab">step2</a></li>
		<li><a href="#step3" role="tab" data-toggle="tab">step3</a></li>
	</ul>

	<!-- 2. Create progress bar -->
	<!-- div class="progress" required. -->
	<!-- on div id="progressBar" class="progress" required. -->
	<div class="progress">
		<div id="progressBar" class="progress-bar progress-bar-striped"  >
			<div class="bar">
				<span></span>
			</div>
		</div>
	</div>

	<!-- 3. Create a matching tab pane for each tab. Content goes within these panes -->
	<div class="tab-content">
		<div class="tab-pane active" id="step1">
			<h1>Step 1: Beginning</h1>
			<p>You're making some progress</p>
		</div>
		<div class="tab-pane" id="step2">
			<h1>Step 2: Middle</h1>
			<p>You're part way through</p>
		</div>
		<div class="tab-pane" id="step3">
			<h1>Step 3: End</h1>
			<p>You're Done!</p>
		</div>

		<!-- 4. Declare buttons used by the wizard. -->
		<!-- "pager wizard" required. -->
		<ul class="pager wizard">
			<!-- These show as disabled on first tab. Add style="display:none;" to make the First button disappear when first tab.      -->
			<li class="first previous"><a href="#" accesskey="f">First</a></li>
			<li class="previous"><a href="#" accesskey="p">Previous</a></li>
			<li class="last" style="display:none;" ><a href="#">Done</a></li>
			<li class="next"><a href="#" accesskey="n">Next</a></li>
		</ul>
	</div><!-- ./tab-content -->

</div><!-- ./rootwizard -->



<!--********old code-->
<!--<div class="form">

<?php
//	$form = $this->beginWidget('CActiveForm', array(
//		'id'=>'order-create-form',
// Please note: When you enable ajax validation, make sure the corresponding
// controller action is handling ajax validation correctly.
// See class documentation of CActiveForm for details on this,
// you need to use the performAjaxValidation()-method described there.
//		'enableAjaxValidation'=>false,
//	));
?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php // echo $form->errorSummary($model); ?>

	<div class="row">
<?php // echo $form->labelEx($model, 'supplierId'); ?>
<?php // echo $form->textField($model, 'supplierId'); ?>
<?php // echo $form->error($model, 'supplierId'); ?>
	</div>

	<div class="row">
<?php // echo $form->labelEx($model, 'type'); ?>
<?php // echo $form->textField($model, 'type'); ?>
<?php // echo $form->error($model, 'type'); ?>
	</div>

	<div class="row">
<?php // echo $form->labelEx($model, 'status'); ?>
<?php // echo $form->textField($model, 'status'); ?>
<?php // echo $form->error($model, 'status'); ?>
	</div>

	<div class="row">
<?php // echo $form->labelEx($model, 'title'); ?>
<?php // echo $form->textField($model, 'title'); ?>
<?php // echo $form->error($model, 'title'); ?>
	</div>


	<div class="row buttons">
<?php // echo CHtml::submitButton('Submit'); ?>
	</div>

<?php // $this->endWidget(); ?>

</div>-->
<!-- form -->

<script>
	$(document).ready(function() {
		$('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {

				// Dynamically change percentage completion on progress bar
				var tabCount = navigation.find('li').length;
				var current = index + 1;
				var percentDone = (current / tabCount) * 100;
				$('#rootwizard').find('#progressBar').css({width: percentDone + '%'});

				// Optional: Show Done button when on last tab;
				// It is invisible by default.
				$('#rootwizard').find('.last').toggle(current >= tabCount);

				// Optional: Hide Next button if on last tab;
				// otherwise it shows but is disabled
				$('#rootwizard').find('.next').toggle(current < tabCount);
			}});
	});</script>