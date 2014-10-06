

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
			<div class="form-group">
				<label class="col-sm-4 control-label"><?php echo $item->isShowInProductView == 1 ? $item->userFileName . "(แสดงในหน้า Product) : " : $item->userFileName . " : "; ?></label>
				<div class="col-sm-4" >
					<?php
					if(isset($userUserFileList))
					{
						if(count($userUserFileList) > 0)
						{
							foreach($userUserFileList as $uUserFileItem)
							{
								if($item->userFileId == $uUserFileItem->userFileId)
								{
									$url = Yii::app()->baseUrl . "/" . $uUserFileItem->filePath;
									if(isset($uUserFileItem->filePath) && !empty($uUserFileItem->filePath))
									{
										echo "<a class='fancybox btn btn-success btn-xs' href=$url> view </a>";
									}
									else
									{
										echo CHtml::link("N/A", "", array(
											'class'=>'btn btn-danger btn-xs'));
									}
									echo CHtml::hiddenField("oldFilePath[$item->userFileId]", $uUserFileItem->filePath);
								}
							}
							?>
							&nbsp;&nbsp;or
							<?php
							echo CHtml::activeFileField($userUserFileModel, "filePath", array(
								'name'=>"UserUserFile[filePath][$item->userFileId]",
								'class'=>'pull-right'));
							?>
							<?php
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
					<?php //echo $form->error($item,'approved');        ?>
				</div>
			</div>
			<?php
		}
	}
	?>


	<?php $this->endWidget(); ?>

</div><!-- form -->
