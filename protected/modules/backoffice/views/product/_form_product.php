<?php
if(isset($model->status))
{
//	if ($model->status == 2)
//	{
//		$pCat = TRUE;
//		$pBrand = TRUE;
//		$pName = array(
//			"readOnly" => true);
//		$pPUnits = array(
//			"readOnly" => true);
//		$pPriceGroup = TRUE;
//		$pDescription = TRUE;
//		$pDateAvailable = TRUE;
//		$pMargin = TRUE;
//		$pDiWidth = array(
//			'class' => 'input-mini',
//			"readOnly" => true);
//		$pDiHeight = array(
//			'class' => 'input-mini',
//			"readOnly" => true);
//		$pDiLenght = array(
//			'class' => 'input-mini',
//			"readOnly" => true);
//		$pDiUnits = TRUE;
//		$pMeUnits = TRUE;
//		$pWeight = array(
//			"readOnly" => true);
//	}
//	else
//	{
	$pCat = 0;
	$pBrand = FALSE;
	$pName = array(
		);
	$pCode = array(
		);
	$pQuantity = array(
		);
	$pPUnits = array(
		);
	$pPic = array(
		);
	$pPrice = array(
		);
	$pPriceGroup = array(
		);
	$pDescription = FALSE;
	$pDateAvailable = array(
		);
	$pMargin = array(
		);
	$pWeight = array(
		);
	$pDiWidth = array(
		'class'=>'input-mini');
	$pDiHeight = array(
		'class'=>'input-mini');
	$pDiLenght = array(
		'class'=>'input-mini');
	$pDiUnits = array(
		);
	$pMeUnits = array(
		);
	$pSortOrder = array(
		);
//}
}
?>
<div class="row">
	<div class="span6">

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'categoryId'); ?></label>
			<div class="controls">
				<?php
				if(!$pCat)
				{
					echo $form->dropDownList($model, 'categoryId', Category::model()->getAllParentCategory(), array(
						'prompt'=>'Select Category'));
				}
				else
				{
					$str = "";
					if(isset($model->category->parent))
					{
						$str .= $model->category->parent->categoryName . "->";
					}
					if(isset($model->category))
					{
						$str .= $model->category->categoryName;
					}
					echo $str;
				}
				?>
				<?php echo $form->error($model, 'categoryId'); ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'brandId'); ?></label>
			<div class="controls">
				<?php
				if($pBrand == FALSE)
				{
					echo $form->dropDownList($model, 'brandId', ProductBrand::model()->getAllBrandBySupplierId(Yii::app()->user->id), array(
						'prompt'=>'Select Brand'));
				}
				else
				{
					echo $model->brand->name;
				}
				?>
				<?php echo $form->error($model, 'brandId'); ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'name'); ?></label>
			<div class="controls">
				<?php echo $form->textField($model, 'name', $pName); ?>
				<?php echo "<p><font color='#FFCC90' >ชื่อสินค้าไม่ควรมีความยาวเกิน 20 ตัวอักษร.</font></p>"; ?>
				<?php echo $form->error($model, 'name');
				?>
			</div>

		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'isbn'); ?></label>
			<div class="controls">
				<?php echo $form->textField($model, 'isbn', $pCode); ?>
				<?php echo "<p><font color='#FFCC90' >รหัสสินค้าไม่ควรมีความยาวเกิน 20 ตัวอักษร.</font></p>"; ?>
				<?php echo $form->error($model, 'name');
				?>
			</div>

		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'quantity'); ?></label>
			<div class="controls">
				<?php echo $form->textField($model, 'quantity'); ?>
				<?php echo $form->error($model, 'quantity'); ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'productUnits'); ?></label>
			<div class="controls">
				<?php echo $form->textField($model, 'productUnits', $pPUnits); ?>
				<?php echo $form->error($model, 'productUnits'); ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'image'); ?></label><font color="red">*</font>
			<div class="controls">
				<?php
				if($this->action->id != 'create')
				{
					foreach($model->productImage as $image)
					{
						echo CHtml::image(Yii::app()->request->baseUrl . $image->image, 'image' . $image->productImageId, array(
							'style'=>'height:250px;',
							'class'=>'img-polaroid',
							'id'=>'image' . $image->productImageId));
						echo CHtml::ajaxLink('<i class="icon-minus-sign icon-white"></i> ลบ', CController::createUrl("admin/product/deleteProductImage/", array(
								'id'=>$image->productImageId)), array(
							'dataType'=>'json',
							'success'=>'function(data){
                                                            if(data.status)
                                                            {
                                                                var image = document.getElementById("image' . $image->productImageId . '");
                                                                if(image != null){
                                                                image.parentNode.removeChild(image); }
                                                                var delBtn = document.getElementById("del-image' . $image->productImageId . '");
                                                                if(image != null){
                                                                delBtn.parentNode.removeChild(delBtn);  }
                                                            }
                                                            else
                                                            {
                                                                alert("กรุณาลองใหม่อีกครั้ง");
                                                            }
                                                        }
                                                    ',
							), array(
							'class'=>'btn btn-danger',
							'id'=>'del-image' . $image->productImageId,
							'confirm'=>'คุณต้องการลบรูป ?',
						));
						echo '<br />';
					}
				}

//				echo $form->fileField($model, 'image', array(
//					'value' => $model->image,
//				));
				$this->widget('CMultiFileUpload', array(
					'name'=>'images',
					'accept'=>'jpeg|jpg|gif|png', // useful for verifying files
					'duplicate'=>'Duplicate file!', // useful, i think
					'denied'=>'Invalid file type', // useful, i think
				));
				?>
				<p style="color: red;">**คุณสามารถอัพโหลดรูปได้ มากสุด 10 รูป**</p>
				<?php echo $form->error($model, 'image'); ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'price'); ?></label>
			<div class="controls">
				<?php
				echo $form->textField($model, 'price', array(
				));
				echo "  บาท";
				?>
				<?php echo $form->error($model, 'price'); ?>
				<p style="color: red;">***ราคาขายต้องรวม VAT 7% แล้วเท่านั้น***</p>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'priceGroupId'); ?></label>
			<div class="controls">
				<?php
				if($pPriceGroup == FALSE)
				{
					echo $form->dropDownList($model, 'priceGroupId', PriceGroup::model()->getAllPriceGroup(Yii::app()->user->id), array(
						'prompt'=>'Price Group'));
				}
				else
				{
					echo $model->priceGroup->priceGroupName;
				}
				?>
				<?php echo $form->error($model, 'priceGroupId'); ?>
			</div>
		</div>

	</div>

	<div class="span6">

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'dateAvailable'); ?></label>
			<div class="controls">
				<?php
				if($pDateAvailable == FALSE)
				{
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'model'=>$model,
						'attribute'=>'dateAvailable',
						'options'=>array(
							'dateFormat'=>'yy-mm-dd',
						),
						'htmlOptions'=>array(
							'size'=>'10', // textField size
							'maxlength'=>'10', // textField maxlength
						),
					));
				}
				else
				{
					echo $model->dateAvailable;
				}
				?>

				<?php echo $form->error($model, 'dateAvailable'); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'marginId'); ?></label>
			<div class="controls">
				<?php
				if($pMargin == FALSE)
				{
					echo $form->dropdownList($model, "marginId", UserCertificateFile::model()->getUserCertificateFileBySupplierId(Yii::app()->user->id)
					);
				}
				else
				{
					echo $model->margin->name . " - " . $model->margin->value . "%";
				}
				?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'weight'); ?></label>
			<div class="controls">
				<?php
				echo $form->textField($model, 'weight', $pWeight);
				?>
				<?php
				if($pMeUnits == FALSE)
				{
					echo $form->dropdownList($model, "metricUnits", Product::model()->getMetricUnits(), array(
						'class'=>'input-small',
						'prompt'=>'-หน่วย-'));
				}
				else
				{
					echo $model->getMetricText();
				}
				?>
				<?php echo $form->error($model, 'weight'); ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">Dimension (W x H x L)</label>
			<div class="controls">
				<?php
				echo $form->textField($model, 'width', $pDiWidth);
				?>
				<?php echo $form->error($model, 'width'); ?>
				<?php
				echo $form->textField($model, 'height', $pDiHeight);
				?>
				<?php echo $form->error($model, 'height'); ?>
				<?php
				echo $form->textField($model, 'length', $pDiLenght);
				?>
				<?php echo $form->error($model, 'length'); ?>

				<?php
				if($pDiUnits == FALSE)
				{
					echo $form->dropdownList($model, "dimensionUnits", Product::model()->getDimensionUnits(), array(
						'class'=>'input-small',
						'prompt'=>'-หน่วย-'));
				}
				else
				{
					echo $model->getDimensionText();
				}
				?>
				<?php echo $form->error($model, 'dimensionUnits'); ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'sortOrder'); ?></label>
			<div class="controls">
				<?php echo $form->dropDownList($model, 'sortOrder', range(15, -15)); ?>
				<?php echo $form->error($model, 'sortOrder'); ?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="span12">
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'description'); ?></label>
			<div class="controls">
				<?php
//				if ($pDescription == FALSE)
//				{
				$this->widget('ext.editMe.widgets.ExtEditMe', array(
					'model'=>$model,
					'attribute'=>'description',
					//'filebrowserImageUploadUrl' => Yii::app()->createUrl('admin/product/uploadFile'),
					'filebrowserImageBrowseUrl'=>Yii::app()->request->baseUrl . '/ext/kcfinder/browse.php?type=files&cms=yii',
				));
//				}
//				else
//				{
//					echo $model->description;
//				}
				?>

				<?php echo $form->error($model, 'description'); ?>
			</div>
		</div>
	</div>
</div>