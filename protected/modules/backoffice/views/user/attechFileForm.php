

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'user-file-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',
			'class'=>'form-horizontal well'),
	));
	?>
	<?php
	if(count($userFiles) > 0)
	{
		foreach($userFiles as $item)
		{
			?>
			<div class="control-group">
				<label class="control-label"><?php echo $item->isShowInProductView == 1 ? $item->userFileName . "(แสดงในหน้า Product) : " : $item->userFileName . " : "; ?></label>
				<div class="controls">
					<?php
					if(isset($userUserFileList))
					{
						if(count($userUserFileList) > 0)
						{
							foreach($userUserFileList as $uUserFileItem)
							{
								if($item->userFileId == $uUserFileItem->userFileId)
								{
									//echo $uUserFileItem->filePath;
									$url = Yii::app()->baseUrl . "/" . $uUserFileItem->filePath;
									echo "<a class=fancybox href=$url> >>view<< </a>";
									echo CHtml::hiddenField("oldFilePath[$item->userFileId]", $uUserFileItem->filePath);
								}
							}
							echo CHtml::activeFileField($userUserFileModel, "filePath", array(
								'name'=>"UserUserFile[filePath][$item->userFileId]"));
						}
						else
						{
							echo CHtml::activeFileField($userUserFileModel, "filePath", array(
								'name'=>"UserUserFile[filePath][$item->userFileId]"));
						}
					}
					else
					{
						echo CHtml::activeFileField($userUserFileModel, "filePath", array(
							'name'=>"UserUserFile[filePath][$item->userFileId]"));
					}
					?>
					<?php //echo $form->error($item,'approved');   ?>
				</div>
			</div>
			<?php
		}
	}
	?>


	<?php $this->endWidget(); ?>

</div><!-- form -->
