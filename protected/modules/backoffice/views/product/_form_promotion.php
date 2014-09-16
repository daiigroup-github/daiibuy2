<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label class="control-label col-sm-4"><?php echo $form->labelEx($model, 'dateStart'); ?></label>
            <div class="col-sm-8">
				<?php
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$model,
					'attribute'=>'dateStart',
					'options'=>array(
						'dateFormat'=>'yy-mm-dd',
					),
					'htmlOptions'=>array(
						'size'=>'10', // textField size
						'maxlength'=>'10', // textField maxlength
					),
				));
				?>

            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4"><?php echo $form->labelEx($model, 'price'); ?></label>
            <div class="col-sm-8">
				<?php
				echo $form->textField($model, 'price', array(
				));
				?>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label col-sm-4"><?php echo $form->labelEx($model, 'dateEnd'); ?></label>
            <div class="col-sm-4">
				<?php
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$model,
					'attribute'=>'dateEnd',
					'options'=>array(
						'dateFormat'=>'yy-mm-dd',
					),
					'htmlOptions'=>array(
						'size'=>'10', // textField size
						'maxlength'=>'10', // textField maxlength
					),
				));
				?>

            </div>
        </div>
    </div>
</div>

