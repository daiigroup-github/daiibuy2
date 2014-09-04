<div class="row">
    <div class="span4">
        <div class="control-group">
            <label class="control-label"><?php echo $form->labelEx($model, 'dateStart'); ?></label>
            <div class="controls">
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

				<?php echo $form->error($model, 'dateStart'); ?>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo $form->labelEx($model, 'price'); ?></label>
            <div class="controls">
				<?php
				echo $form->textField($model, 'price', array(
				));
				?>
				<?php echo $form->error($model, 'price'); ?>
            </div>
        </div>
    </div>

    <div class="span6">
        <div class="control-group">
            <label class="control-label"><?php echo $form->labelEx($model, 'dateEnd'); ?></label>
            <div class="controls">
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

				<?php echo $form->error($model, 'dateEnd'); ?>
            </div>
        </div>
    </div>
</div>

