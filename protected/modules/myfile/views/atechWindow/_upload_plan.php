<div class="navbar navbar-default navbar-fixed-top">
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
				$dataProvider = new CActiveDataProvider('OrderFiles');
				$dataProvider->setData($model->orderFiles);
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
							'url'=>'backoffice/productImage/sortOrder'),
						array(
							'name'=>'image',
							'type'=>'html',
							'value'=>'CHtml::image(Yii::app()->baseUrl.$data->image, "image", array("style"=>"width:200px;"))',
						),
						array(
							'class'=>'CButtonColumn',
							'template'=>'{delete}'
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
			<p style="color: red;">**คุณสามารถอัพโหลดแปลนได้มากสุด 10 รูป**</p>
			<?php echo $form->error($model, 'orderFiles'); ?>
		</div>
	</div>
</div>
</div>