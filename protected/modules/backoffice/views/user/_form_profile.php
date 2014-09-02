<div class="row">
	<div class="span12">
		<?php echo $form->errorSummary($model); ?>
		<div class="row">
			<div class="span11">
				<div id="attechFile"></div>
				<div class="control-group">
					<label class="control-label"><?php echo $form->labelEx($model, 'logo : '); ?></label>
					<div class="controls"><img src="<?php
						if(isset($model->logo))
							echo Yii::app()->request->baseUrl . "/" . $model->logo;
						else
							echo Yii::app()->request->baseUrl . "/images/NoLogo.png";
						?>" class="img-polaroid" style="height: 200px"/>
					</div>
					<div class="controls">
						<?php
						echo CHtml::activeFileField($model, "logo", array(
							'name'=>"uploadLogo"));
						?>
						<?php echo $form->error($model, 'logo'); ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo $form->labelEx($model, 'map : '); ?></label>
					<div class="controls">
						<img src="<?php
						if(isset($model->map))
							echo Yii::app()->request->baseUrl . "/" . $model->map;
						else
							echo Yii::app()->request->baseUrl . "/images/NoMap.png";
						?>" class="img-polaroid" />
					</div>
					<label class="control-label"><?php echo $form->labelEx($model, 'map'); ?></label>
					<div class="controls">
						<?php
						echo CHtml::activeFileField($model, "map", array(
							'name'=>"uploadMap"));
						?>
						<?php echo $form->error($model, 'map'); ?>
					</div>
				</div>
				<?php if(isset($model->userId)): ?>
					<div class="row">
						<div class="span12">
							<div class="control-group">
								<label class="control-label"><?php echo $form->labelEx($model, 'description : '); ?></label>
								<div class="controls">
									<?php
									$this->widget('ext.editMe.widgets.ExtEditMe', array(
										'model'=>$model,
										'attribute'=>'description',
										//'filebrowserImageUploadUrl' => Yii::app()->createUrl('admin/product/uploadFile'),
										'filebrowserImageBrowseUrl'=>Yii::app()->request->baseUrl . '/ext/kcfinder/browse.php?type=files&cms=yii',
									));
									?>
									<?php echo $form->error($model, 'description'); ?>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>