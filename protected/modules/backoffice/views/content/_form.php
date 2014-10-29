<?php
/* @var $this ContentController */
/* @var $model Content */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'content-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',
			'class'=>'form-horizontal'
		),
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
		<div class="control-label col-sm-2">
			<?php echo $form->labelEx($model, 'title'); ?>
		</div>
		<div class='col-sm-10'>
			<?php
			echo $form->textField($model, 'title', array(
				'size'=>60,
				'maxlength'=>500));
			?>
			<?php echo $form->error($model, 'title'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="control-label col-sm-2">
			<?php echo $form->labelEx($model, 'description'); ?>
		</div>
		<div class='col-sm-10'>
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

	<div class="form-group">
		<div class='control-label col-sm-2'>
			<?php echo $form->labelEx($model, 'image'); ?>
		</div>
		<div class='col-sm-10'>
			<?php
			if(strtolower($this->action->id) != 'create')
			{
				echo $this->action->id;
				echo CHtml::image(Yii::app()->request->baseUrl . $model->image, 'image', array(
					'style'=>'height:100px;',
					'class'=>'img-polaroid'));
				echo '<br />';
				echo CHtml::hiddenField("Content[oldImage]", $model->image);
			}

			echo $form->fileField($model, 'image');
			?>
			<!--			<div class="alert-success" style="width: 40%">
							รูป หน้าหลัก ต้องมีขนาด เท่ากับ 1,170px X 300px
						</div>-->
			<?php echo $form->error($model, 'image'); ?>
		</div>
	</div>
	<div class="form-group">
		<div class='control-label col-sm-2'>
			<?php echo $form->labelEx($model, 'subview'); ?>
		</div>
		<div class='col-sm-10'>
			<?php
			echo $form->textField($model, 'subview', array(
				'size'=>60,
				'maxlength'=>100));
			?>
			<?php echo $form->error($model, 'subview'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class='control-label col-sm-2'>
			<?php echo $form->labelEx($model, 'parentId'); ?>
		</div>
		<div class='col-sm-10'>
			<?php
			if(isset($model->parent) && Yii::app()->controller->action->id != "update")
			{
				echo $model->parent->title;
			}
			else
			{
				echo $form->dropDownList($model, 'parentId', $model->getAllParentContent(), array(
					'prompt'=>'Select Parent'));
			}
			?>
			<?php echo $form->error($model, 'parentId'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class='control-label col-sm-2'>
			<?php echo $form->labelEx($model, 'type'); ?>
		</div>
		<div class='col-sm-10'>
			<?php
			if(isset($model->type) && Yii::app()->controller->action->id != "update")
			{
				echo $model->getTypeText($model->type);
			}
			else
			{
				echo $form->dropDownList($model, 'type', $model->getTypeArray(), array(
					'prompt'=>'Select Type'));
			}
			?>
			<?php echo $form->error($model, 'type'); ?>
		</div>
	</div>
	<?php
	if((isset($model->type) && $model->parentId == 0) && Yii::app()->controller->action->id == "update")
	{
		?>
		<div class="control-group">
			<div class='controls'>
				<?php
				echo CHtml::link("สร้าง รายละเอียดเพิ่มเติม", Yii::app()->createUrl("/backoffice/Content/Create/id/" . $model->contentId), array(
					'class'=>'btn btn-success'));
				?>
			</div>
		</div>
		<?php
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'content_item-grid',
			'dataProvider'=>$model->findAllChildByParentId($model->contentId),
			'itemsCssClass'=>'table table-striped table-bordered table-condensed table-hover',
			'columns'=>array(
				array(
					'name'=>'image',
					'type'=>'image',
					'htmlOptions'=>array(
						'width'=>'200px'),
					'value'=>'Yii::app()->baseUrl.$data->image',
				),
				'title',
				array(
					'name'=>'description',
					'type'=>'raw',
					'value'=>'mb_substr($data->description,0,100,"UTF-8")."..."',
				),
				'subview',
				'parentId',
				/*
				  'type',
				  'status',
				  'createDateTime',
				  'updateDateTime',
				 */
				array(
					'class'=>'CButtonColumn',
				),
			),
		));
	}
	?>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
			<?php
			echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
				'class'=>'btn btn-primary'));
			?>
		</div>
	</div>
	<?php $this->endWidget(); ?>

</div><!-- form -->