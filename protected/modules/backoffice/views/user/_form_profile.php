<div class="row">
	<div class="col-sm-12">
		<?php echo $form->errorSummary($model); ?>
		<div class="row">
			<div class="col-sm-12">
				<div id="attechFile"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'logo : '); ?></label>
					<div class="col-sm-4"><img src="<?php
						if(isset($model->logo))
							echo Yii::app()->request->baseUrl . "/" . $model->logo;
						else
							echo Yii::app()->request->baseUrl . "/images/NoLogo.png";
						?>" class="img-polaroid" style="height: 200px"/>
					</div>
					<div class="col-sm-6">
						<h3>เลือกรูป Logo</h3>
						<?php
						echo CHtml::activeFileField($model, "logo", array(
							'name'=>"uploadLogo"));
						?>
						<?php echo $form->error($model, 'logo'); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'map : '); ?></label>
					<div class="col-sm-4">
						<img src="<?php
						if(isset($model->map))
							echo Yii::app()->request->baseUrl . "/" . $model->map;
						else
							echo Yii::app()->request->baseUrl . "/images/NoMap.png";
						?>" class="img-polaroid" />
					</div>
					<div class="col-sm-6">
						<h3>เลือกรูป แผนที่</h3>
						<?php
						echo CHtml::activeFileField($model, "map", array(
							'name'=>"uploadMap"));
						?>
						<?php echo $form->error($model, 'map'); ?>
					</div>
				</div>
				<?php if(isset($model->userId)): ?>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'description : '); ?></label>
								<div class="col-sm-10">
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