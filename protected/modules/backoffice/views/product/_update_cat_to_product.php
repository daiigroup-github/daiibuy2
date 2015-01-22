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
		<?php if(Yii::app()->user->userType == 4 || Yii::app()->user->supplierId == 3 || Yii::app()->user->supplierId == 2): ?>
			<div class="form-group" style="margin-top: 10px">
				<div class="control-label col-lg-2">Group Name</div>
				<div class="col-lg-10">
					<?php
					echo $form->textField($model, "groupName", array(
						'class'=>'form-control'));
					?>
				</div>
			</div>
		<?php endif; ?>
		<?php if(Yii::app()->user->userType == 4 || Yii::app()->user->supplierId == 1 || Yii::app()->user->supplierId == 2 ):

			?>
			<div class="form-group" style="margin-top: 10px">
				<div class="control-label col-lg-2">Quantity</div>
				<div class="col-lg-10">
					<?php
					echo CHtml::numberField("Category2ToProduct[quantity]", $model->quantity, array(
						'class'=>'form-control'));
					?>
				</div>
			</div>
		<?php
		endif;
		if(isset(Yii::app()->user->supplierId) && Yii::app()->user->supplierId == 1) {  ?>
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
		<?php }
		if(Yii::app()->user->userType == 4 || (isset(Yii::app()->user->supplierId) && Yii::app()->user->supplierId == 2)) {
			$isAtech = UserToSupplier::model()->find('userId = '.Yii::app()->user->id.' and supplierId = 2 and status = 1');
		if(Yii::app()->user->userType==4 || (Yii::app()->user->userType==3 and isset($isAtech)) ){  ?>
		<div class="form-group">
		<?php
		echo $form->labelEx($model, 'type', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->dropDownList($model,'type', array(1=>'Aluminium Anodize',2=>'Aluminium Powder Coat',3=>'UPVC'), array(
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'type'); ?>
		</div>
	</div>
	<?php } ?>
		<?php } ?>

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