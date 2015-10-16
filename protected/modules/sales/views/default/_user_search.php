<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions'=>array(
//		'class'=>'form-signin',
//		'role'=>'form'
	),
	));
?>
<div class="row sidebar-box red">

	<div class="col-lg-12 col-md-12 col-sm-12">

		<div class="sidebar-box-heading">
			<i class="icons icon-box-2"></i>
			<h4>ค้นหาลูกค้า</h4>
		</div>

		<div class="sidebar-box-content sidebar-padding-box" style="border:1px black solid">
			<div class="row">
				<div class="col-lg-12">
					<?php
					echo $form->emailField($model, 'username', array(
						'class'=>'form-control',
						'placeholder'=>'Username'));
					?>
					<?php echo $form->error($model, 'username'); ?>
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-lg btn-success btn-block" type="submit">ค้นหา</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>