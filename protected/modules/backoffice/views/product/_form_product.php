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
//	$pDiWidth = array(
//		'class'=>'input-mini',
//		"readOnly"=>true);
//	$pDiHeight = array(
//		'class'=>'input-mini',
//		"readOnly"=>true);
//	$pDiLenght = array(
//		'class'=>'input-mini',
//		"readOnly"=>true);
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
		'min'=>0
	);
	$pDiWidth = array(
		'class'=>'col-sm-2 input-sm',
		'min'=>0);
	$pDiHeight = array(
		'class'=>'col-sm-2 input-sm',
		'min'=>0);
	$pDiLenght = array(
		'class'=>'col-sm-2 input-sm',
		'min'=>0);
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
	<div class="col-sm-6">

		<div class="form-group">
			<?php
//			echo $form->labelEx($model, 'categoryId', array(
//				'class'=>'col-sm-3 control-label'));
			?>
			<div class="col-sm-9">
				<?php
				if(!$pCat)
				{
//					echo $form->dropDownList($model, 'categoryId', Category::model()->getAllParentCategory(), array(
//						'prompt'=>'----- Select Category ----',
//						'class'=>'form-control'));
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
				<?php // echo $form->error($model, 'categoryId'); ?>
			</div>
		</div>

		<div class="form-group">
			<?php
			echo $form->labelEx($model, 'name', array(
				'class'=>'col-sm-3 control-label'));
			?>
			<div class="col-sm-9">
				<?php echo $form->textField($model, 'name', $pName); ?>
				<?php echo "<p><font color='#FFCC90' >ชื่อสินค้าไม่ควรมีความยาวเกิน 20 ตัวอักษร.</font></p>"; ?>
				<?php echo $form->error($model, 'name');
				?>
			</div>

		</div>

		<div class="form-group">
			<?php
			echo $form->labelEx($model, 'code', array(
				'class'=>'col-sm-3 control-label'));
			?>
			<div class="col-sm-9">
				<?php echo $form->textField($model, 'code', $pCode); ?>
				<?php echo "<p><font color='#FFCC90' >รหัสสินค้าไม่ควรมีความยาวเกิน 20 ตัวอักษร.</font></p>"; ?>
				<?php echo $form->error($model, 'name');
				?>
			</div>

		</div>

		<div class="form-group">
			<?php
			echo $form->labelEx($model, 'quantity', array(
				'class'=>'col-sm-3 control-label'));
			?>
			<div class="col-sm-9">
				<?php
				echo $form->numberField($model, 'quantity', array(
					'min'=>0));
				?>
				<?php echo $form->error($model, 'quantity'); ?>
			</div>
		</div>

		<div class="form-group">
			<?php
			echo $form->labelEx($model, 'productUnits', array(
				'class'=>'col-sm-3 control-label'));
			?>
			<div class="col-sm-9">
				<?php echo $form->textField($model, 'productUnits', $pPUnits); ?>
				<?php echo $form->error($model, 'productUnits'); ?>
			</div>
		</div>

		<div class="form-group">
			<?php
			echo $form->labelEx($model, 'price', array(
				'class'=>'col-sm-3 control-label'));
			?>
			<div class="col-sm-9">
				<?php
				echo $form->numberField($model, 'price', array(
					'class'=>'col-sm-8',
					'min'=>0,
					'step'=>'any'));
				?>
				<span class = "col-sm-1">บาท
				</span>
			</div>
			<p style="color: red;">***ราคาขายต้องรวม VAT 7% แล้วเท่านั้น***</p>
		</div>

		<div class="form-group">
			<?php
			echo $form->labelEx($model, 'priceGroupId', array(
				'class'=>'col-sm-3 control-label'));
			?>
			<div class="col-sm-9">
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
			</div>
		</div>

	</div>

	<div class="col-sm-6">

		<div class="form-group">
			<?php
			echo $form->labelEx($model, 'dateAvailable', array(
				'class'=>'col-sm-3 control-label'));
			?>
			<div class="col-sm-9">
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

			</div>
		</div>
		<!--<div class="form-group">-->
		<?php
//			echo $form->labelEx($model, 'marginId', array(
//				'class'=>'col-sm-3 control-label'));
		?>
		<!--<div class="col-sm-9">-->
		<?php
//				if($pMargin == FALSE)
//				{
//					echo $form->dropdownList($model, "marginId", UserCertificateFile::model()->getUserCertificateFileBySupplierId(Yii::app()->user->id)
//					);
//				}
//				else
//				{
//					echo $model->margin->name . " - " . $model->margin->value . "%";
//				}
		?>
		<!--</div>-->
		<!--</div>-->
		<div class="form-group">
			<?php
			echo $form->labelEx($model, 'weight', array(
				'class'=>'col-sm-3 control-label'));
			?>
			<div class="col-sm-9">
				<?php
				echo $form->numberField($model, 'weight', $pWeight);
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
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Dimension (W x H x L)</label>
			<div class="col-sm-9">
				<?php
				echo $form->numberField($model, 'width', $pDiWidth);
				?>
				<?php echo $form->error($model, 'width'); ?>
				<?php
				echo $form->numberField($model, 'height', $pDiHeight);
				?>
				<?php echo $form->error($model, 'height'); ?>
				<?php
				echo $form->numberField($model, 'length', $pDiLenght);
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
			</div>
		</div>

		<div class="form-group">
			<?php
			echo $form->labelEx($model, 'sortOrder', array(
				'class'=>'col-sm-3 control-label'));
			?>
			<div class="col-sm-9">
				<?php
				echo $form->dropDownList($model, 'sortOrder', range(15, -15), array(
					'prompt'=>'-- Select Sort Order --'));
				?>
			</div>
		</div>
	</div>
</div>
<hr>
<div class="row">
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'image', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-5">
			<?php
			if($this->action->id != 'create')
			{
//					foreach($model->productImages as $image)
//					{
//						echo CHtml::image(Yii::app()->request->baseUrl . $image->image, 'image' . $image->productImageId, array(
//							'style'=>'height:250px;',
//							'class'=>'img-polaroid',
//							'id'=>'image' . $image->productImageId));
//						echo CHtml::ajaxLink('<i class="icon-minus-sign icon-white"></i> ลบ', CController::createUrl("admin/product/deleteProductImage/", array(
//								'id'=>$image->productImageId)), array(
//							'dataType'=>'json',
//							'success'=>'function(data){
//                                                            if(data.status)
//                                                            {
//                                                                var image = document.getElementById("image' . $image->productImageId . '");
//                                                                if(image != null){
//                                                                image.parentNode.removeChild(image); }
//                                                                var delBtn = document.getElementById("del-image' . $image->productImageId . '");
//                                                                if(image != null){
//                                                                delBtn.parentNode.removeChild(delBtn);  }
//                                                            }
//                                                            else
//                                                            {
//                                                                alert("กรุณาลองใหม่อีกครั้ง");
//                                                            }
//                                                        }
//                                                    ',
//							), array(
//							'class'=>'btn btn-danger',
//							'id'=>'del-image' . $image->productImageId,
//							'confirm'=>'คุณต้องการลบรูป ?',
//						));
//						echo '<br />';
//					}
				$dataProvider = ProductImage::model()->findAllProductImageProvider($model->productId);
				$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'product-grid',
					'dataProvider'=>$dataProvider,
					//'filter'=>$model,
					'itemsCssClass'=>'table table-striped table-bordered table-condensed table-hover',
					'columns'=>array(
						array(
							'class'=>'IndexColumn'),
						array(
							'class'=>'SortColumn',
							'url'=>'backoffice/productImage/sortItem'),
						array(
							'name'=>'image',
							'type'=>'html',
							'value'=>'CHtml::image(Yii::app()->baseUrl.$data->image, "image", array("style"=>"width:200px;"))',
						),
						array(
							'class'=>'CButtonColumn',
							'template'=>'{delete}',
							'buttons'=>array(
								'delete'=>array(
									'url'=>'Yii::app()->createUrl("/backoffice/product/deleteProductImage/id/".$data->productImageId)'
								),
							)
						),
					),
				));
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
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="form-group">
			<?php
			echo $form->labelEx($model, 'description', array(
				'class'=>'control-label col-sm-2'));
			?>
			<div class="col-sm-10">
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

			</div>
		</div>
	</div>
</div>