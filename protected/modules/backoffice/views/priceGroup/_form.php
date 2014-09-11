<?php
/* @var $this PriceGroupController */
/* @var $model PriceGroup */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'price-group-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',
			'class'=>'form-horizontal well'),
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php
	echo $form->errorSummary($model, '', '', array(
		'class'=>'alert alert-error'));
	?>
	<?php echo $form->error($model, 'errorMessage'); ?>

	<div class="control-group">
		<label class="control-label">
			<?php echo $form->labelEx($model, 'priceGroupName'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'priceGroupName', array(
				'size'=>60,
				'maxlength'=>500));
			?>
			<?php echo $form->error($model, 'priceGroupName'); ?>
		</div>
	</div>
	<?php if($this->action->id == 'update'): ?>
		<div class="control-group">
			<label class="control-label">
				<?php echo $form->labelEx($model, 'status'); ?></label>
			<div class="controls">
				<?php echo $form->checkBox($model, 'status'); ?>
				<?php echo $form->error($model, 'status'); ?>
			</div>
		</div>
	<?php endif; ?>

	<?php
	$i = 0;
	//foreach (Address::model()->dealerProvince() as $addressProvinceModel):
	foreach(Province::model()->findAll() as $addressProvinceModel):
		?>
		<div class="row-fluid">
			<div class="span10 offset1 alert alert-info">

				<div class="control-group">
					<label class="control-label">
						<?php
						//echo $addressProvinceModel->province->provinceName;
						echo $addressProvinceModel->provinceName;
						?>
					</label>
					<div class="controls">
						<?php
						$p = Price::model()->find(
							"priceGroupId =:priceGroupId AND amphurId=0 AND provinceId=:provinceId", array(
							":priceGroupId"=>$model->priceGroupId,
							":provinceId"=>$addressProvinceModel->provinceId));
						echo $form->textField($priceModel, '[' . $i . ']priceRate', array(
							'class'=>'input-small',
							'value'=>(isset($p->priceRate) ? $p->priceRate : 0.00),
							'id'=>'province' . $addressProvinceModel->provinceId,
						));
						echo '   %';

//						echo CHtml::button('copy price', array(
//							'class'=>'btn btn-primary btn-mini',
//							'onclick'=>'js:updatePrice("province' . $addressProvinceModel->provinceId . '")',
//						));

						echo $form->hiddenField($priceModel, '[' . $i . ']priceId', array(
							'value'=>isset($p->priceId) ? $p->priceId : 0));
						?>
						<?php echo $form->error($priceModel, 'status'); ?>
						<?php
						echo $form->hiddenField($priceModel, '[' . $i . ']amphurId', array(
							'value'=>'0'));
						?>
						<?php
						echo $form->hiddenField($priceModel, '[' . $i . ']provinceId', array(
							'value'=>$addressProvinceModel->provinceId));
						?>
					</div>
				</div>
				<!--<hr />-->

				<?php
				//foreach (Address::model()->dealerAmphur($addressProvinceModel->provinceId) as $addressAmphurModel):
//				foreach(Amphur::model()->findAll("provinceId = :provinceId", array(
//					":provinceId"=>$addressProvinceModel->provinceId)) as $addressAmphurModel):
//
				?>

				<?php // $i++;  ?>
				<!--<div class="control-group">-->
				<!--<label class="control-label">-->
				<?php
//							$p = Price::model()->find(
//								"priceGroupId =:priceGroupId AND amphurId=:amphurId", array(
//								":priceGroupId"=>$model->priceGroupId,
//								":amphurId"=>$addressAmphurModel->amphurId));
//
//							if(isset($p->status))
//							{
//								echo $form->checkbox($p, '[' . $i . ']status');
//							}
//							else
//								echo $form->checkbox($priceModel, '[' . $i . ']status');
//
//							echo '&nbsp;';
//							echo $addressAmphurModel->amphurName;
//
				?>
				<!--</label>-->
				<!--<div class="controls">-->
				<?php
//							echo '+ ';
//							echo $form->textField($priceModel, '[' . $i . ']priceRate', array(
//								'class'=>'input-small province' . $addressProvinceModel->provinceId,
//								'value'=>(isset($p->priceRate) ? $p->priceRate : 0.00)));
//							echo '   %';
//							echo $form->hiddenField($priceModel, '[' . $i . ']priceId', array(
//								'value'=>isset($p->priceId) ? $p->priceId : 0));
//
				?>
				<?php // echo $form->error($priceModel, 'status'); ?>
				<?php
//							echo $form->hiddenField($priceModel, '[' . $i . ']amphurId', array(
//								'value'=>$addressAmphurModel->amphurId));
//
				?>
				<?php
//							echo $form->hiddenField($priceModel, '[' . $i . ']provinceId', array(
//								'value'=>$addressProvinceModel->provinceId));
//
				?>
				<!--</div>-->
				<!--</div>-->
				<?php // endforeach; ?>

			</div>
		</div>

		<?php $i++; ?>
	<?php endforeach; ?>

	<div class="control-group">
		<div class="controls">
			<?php
			echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
				'class'=>'btn btn-primary'));
			?>
		</div>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	function updatePrice(pv)
	{
		$('.' + pv).val($('#' + pv).val());
	}
</script>