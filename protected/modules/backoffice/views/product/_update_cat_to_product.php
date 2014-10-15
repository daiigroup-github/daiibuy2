<div class="panel panel-default">
	<div class="panel-heading">Update <?php echo $model->product->name; ?></div>
	<div class="panel-body">
		<?php
		$form = $this->beginWidget('CActiveForm', array(
			'id'=>'cat2ToProduct-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array(
				'class'=>'form-horizontal',
				'enctype'=>'multipart/form-data',
			),
		));
		?>
		<div class="form-group" style="margin-top: 10px">
			<div class="control-label col-lg-2">Group Name</div>
			<div class="col-lg-10">
				<?php
				echo $form->textField($model, "groupName", array(
					'class'=>'form-control'));
				?>
			</div>
		</div>
		<div class="form-group" style="margin-top: 10px">
			<div class="control-label col-lg-2">Quantity</div>
			<div class="col-lg-10">
				<?php
				echo CHtml::numberField("Category2ToProduct[quantity]", $model->quantity, array(
					'class'=>'form-control'));
				?>
			</div>
		</div>
		<div class="form-group" style="margin-top: 10px">
			<div class="control-label col-lg-2">Type</div>
			<div class="col-lg-10">
				<?php
				echo $form->dropDownList($model, "type", array(
					1=>'Normal',
					2=>'+ 1',), array(
					'class'=>'form-control',
					'prompt'=>'-- Type --'));
				?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-9">
				<?php
				echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
					'class'=>'btn btn-primary'));
				?>
			</div>
		</div>

		<?php $this->endWidget(); ?>
	</div>
</div>