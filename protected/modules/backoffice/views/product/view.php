<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = array(
	'Products'=>array(
		'index'),
	$model->productId,
);

$this->menu = array(
	array(
		'label'=>'Create Product',
		'url'=>array(
			'create')),
	array(
		'label'=>'Update Product',
		'url'=>array(
			'update',
			'id'=>$model->productId)),
	array(
		'label'=>'Delete Product',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->productId),
			'confirm'=>'Are you sure you want to delete this item?')),
);

$this->pageHeader = 'View Product #' . $model->productId;
?>
<?php
if($model->status == 3)
{
	?>
	<div class="row-fluid">
		<div class="span12">
			<div class="alert alert-danger">
				กรุณาแก้ไขข้อมูล Product ใหม่ และ บันทึก เพื่อส่ง ข้อมูลกลับให้ ผู้ดูแลระบบ ตรวจสอบอีกครั้ง
			</div>
		</div>
	</div>
	<?php
}
?>
<div class="btn-toolbar">
	<div class="btn-group">
		<?php
		echo CHtml::link('<i class="icon-plus-sign icon-white"></i> เพิ่มสินค้า', array(
			'create'), array(
			'class'=>'btn btn-primary'));

		echo CHtml::link('<i class="icon-pencil icon-white"></i> แก้ไข', array(
			'update',
			'id'=>$model->productId), array(
			'class'=>'btn btn-info'));
		if($model->status != 5)
		{
			echo CHtml::link('<i class="icon-minus-sign icon-white"></i> ลบ', array(
				'delete',
				'id'=>$model->productId), array(
				'class'=>'btn btn-danger',
				'confirm'=>'ลบสินค้า ID : ' . $model->productId));
		}
		else
		{
			echo CHtml::link('<i class="icon-refresh icon-white"></i> นำกลับมาขาย', array(
				'reUse',
				'id'=>$model->productId), array(
				'class'=>'btn btn-success',
				'confirm'=>'นำสินค้า ID : ' . $model->productId . " กลับมาขาย ?"));
		}
		?>
	</div>
</div>

<div class="row-fluid">
	<div class="span4">
		<?php
//                 $this->beginWidget('galleria',array(
//                'options' => array(//galleria options
//                        'transition' => 'fade',
//                        #'debug' => true,
//                    )
//                ));
		?>
		<div class="row span12" >
			<?php
			$this->renderPartial("productImage", array(
				'model'=>$model));
			?>
		</div>
	</div>
	<div class="span8">
		<?php
		/*
		 * Approve form
		 * Admin Only
		 */

		$form = $this->beginWidget('CActiveForm', array(
			'id'=>'product-form',
			'enableAjaxValidation'=>true,
			'htmlOptions'=>array(
				'enctype'=>'multipart/form-data',
				'class'=>'form-horizontal well'),
		));
		?>

		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($model, 'margin'); ?></label>
			<div class="controls">
				<?php
				if(isset($model->margin))
				{
					echo showImage($model->margin->file, $model->margin->name);
					echo $model->margin->value;
				}
				else
				{
					echo "ไม่มี Margin กรุณา Return เพื่อให้ Supplier ปรับปรุง Product";
				}
				?>
			</div>
		</div>
		<?php
		if($model->status == 1 && Yii::app()->user->userType == 4)
		{
			?>
			<div class="control-group">
				<div class="controls">
					<a href="#remarkModal" role="button" class="btn btn-info" data-toggle="modal">Return</a>
					<div id="remarkModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel" aria-hidden="true">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">close x</button>
							<h3 id="returnModalLabel">ส่งกลับสินค้า</h3>
						</div>
						<!--						<div class="modal-body">
													<p><label class="control-label">กรุณาระบุเหตุผล : </label></p>

													<p><Textarea id="returnText" rows="4" class="input-xlarge" name="remark"></Textarea></p>
																					</div>-->
						<div class="control-group">
							<label class="control-label">กรุณาระบุเหตุผล : </label>
							<div class="controls">
								<Textarea id="returnText" rows="4" class="input-xlarge" name="returnRemark"></Textarea>
																								</div>
																								</div>
																								<div class="modal-footer">
																									<button class="btn btn-primary" name="action" value="return" >Submit</button>
																								</div>
																							</div>
					<?php
//echo CHtml::href('Return', array(
//	'class' => 'btn btn-info', 'href' => '#remarkModal', 'data-toggle' => 'modal', 'role' => 'button', 'name' => 'action', 'value' => 'return'));
					echo CHtml::submitButton('Approve', array(
						'class'=>'btn btn-success',
						'name'=>'action',
						'value'=>'approve'));
//echo CHtml::submitButton('Reject', array(
//	'class' => 'btn btn-danger', 'name' => 'action', 'value' => 'reject'));
					?>
																							<a href="#rejectModal" role="button" class="btn btn-danger" data-toggle="modal">Reject</a>
																							<!-- Modal -->
																										<div id="rejectModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																											<div class="modal-header">
																												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">close x</button>
																												<h3 id="myModalLabel">ไม่อนุมัติ</h3>
																											</div>
																											<div class="control-group">
																												<label class="control-label">กรุณาระบุเหตุผล : </label>
																												<div class="controls">
																												<Textarea id="rejectText" rows="4" class="input-xlarge" name="rejectRemark"></Textarea>
																											</div>
																											</div>
																											<div class="modal-footer">
																												<button class="btn btn-primary" name="action" value="reject" >Submit</button>
																											</div>
																										</div>
																									</div>
																								</div>
		<?php } ?>
		<?php $this->endWidget(); ?>
		<?php
		/*
		 * /Approve form
		 */
		?>

		<div class="tabbable"> <!-- Only required for left/right tabs -->
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1" data-toggle="tab">รายละเอียดสินค้า</a></li>
				<li><a href="#tab2" data-toggle="tab">คุณสมบัติ</a></li>
				<li><a href="#tab3" data-toggle="tab">Description</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">
					<?php
					$this->widget('zii.widgets.CDetailView', array(
						'data'=>$model,
						'htmlOptions'=>array(
							'class'=>'table table-striped table-hover'
						),
						'attributes'=>array(
							array(
								'label'=>'ประเภท',
								'type'=>'raw',
								'value'=>$model->category->categoryName,
							),
							array(
								'label'=>'สินค้า',
								'type'=>'raw',
								'value'=>$model->name . '<br />
						<em><small>Last update : ' . $model->updateDateTime . '<br />
							views : ' . $model->viewed . '</small></em><br />' .
								$model->getBadgeStatus(),
							),
							array(
								'label'=>'จำนวนคงเหลือ',
								'type'=>'raw',
								'value'=>number_format($model->quantity) . "  " . $model->productUnits,
							),
							array(
								'name'=>'price',
								'type'=>'raw',
								'value'=>number_format($model->price, 2, ".", ",") . '  บาท',
							),
							array(
								'label'=>'กลุ่มราคา',
								'type'=>'raw',
								'value'=>$model->priceGroup->priceGroupName,
							),
							'points',
							//'dateAvailable',
							array(
								'name'=>'dateAvailable',
								'type'=>'raw',
								'value'=>$this->dateThai($model->dateAvailable, 1),
							),
							array(
								'label'=>'Dimension(W x H x L)',
								'type'=>'html',
								'value'=>$model->width . ' x ' . $model->height . ' x ' . $model->length . "  " . $model->getDimensionText(),
							),
							//'weight',
							array(
								'name'=>'weight',
								'type'=>'raw',
								'value'=>$model->weight == null ? '-' : $model->weight . ' ' . $model->getMetricText()
							,
							),
							array(
								'label'=>'Margin',
								'type'=>'html',
								'value'=>isset($model->margin) ? $model->margin->value : '-',
							),
						),
					));
					?>
				</div>
				<div class="tab-pane" id="tab2">
					<?php
					//product attribute
					if($model->productAttributeValue):

						$this->widget('zii.widgets.grid.CGridView', array(
							'dataProvider'=>new CActiveDataProvider('ProductAttributeValue', array(
								'data'=>$model->productAttributeValue)), //new CArrayDataProvider($model->productAttributeValue, array()),
							//'filter'=>$model,
							'itemsCssClass'=>'table table-striped table-bordered table-condensed table-hover',
							'summaryText'=>'',
							'columns'=>array(
								array(
									'header'=>'Name',
									'value'=>'isset($data->productAttribute->attributeName)?$data->productAttribute->attributeName:""'
								),
								array(
									'header'=>'Value',
									'value'=>'isset($data->attributeValue)?$data->attributeValue:""'
								),
						)));

					endif;
					?>
				</div>
				<div class="tab-pane" id="tab3">
					<p>
						<?php echo $model->description; ?>
					</p>
				</div>
			</div>
		</div>

		<hr />

	</div>
</div>

<?php

function showImage($imageUrl, $title)
{
	$image = "";
	if(!empty($imageUrl) && isset($imageUrl))
	{
		if(strpos($imageUrl, ".pdf"))
		{
			$imageUrl = Yii::app()->baseUrl . "/" . $imageUrl;
			$image = "<p><a class='pdf' Title='$title' href='$imageUrl'>ดูไฟล์แนบ</a></p>";
		}
		else
		{
			$imageUrl = Yii::app()->baseUrl . "/" . $imageUrl;
			$image = "<p><a class='fancyFrame' Title='$title' href='$imageUrl'><img src='$imageUrl' width='200px' alt='' /></a></p>";
		}
	}
	return $image;
}
?>