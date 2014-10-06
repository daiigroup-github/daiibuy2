<?php
/* @var $this OrderController */
/* @var $model Order */
$baseUrl = Yii::app()->baseUrl;

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/fancyBox/fancyBox.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery-1.7.2.min.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.js?v=2.0.6');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.js?v=1.0.2');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-media.js?v=1.0.0');
$cs->registerCssFile($baseUrl . '/js/fancyBox/fancyBox.css');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.css?v=2.0.6');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');

$this->breadcrumbs = array(
	'Orders'=>array(
		'index'),
	$model->orderId,
);

$supplier = user::model()->findByPk($model->supplierId);
//$dealer = user::model()->findByPk($model->dealerId);
$supplierAddr = Address::model()->find("userId=:userId", array(
	":userId"=>$model->supplierId));
//$dealerAddr = Address::model()->find("userId=:userId", array(
//	":userId"=>$model->dealerId));
//$daiiAddr = Address::model()->findByPk(1);
$daiiAddr = Configuration::model()->find("name = 'daii-address'");
if(isset(Yii::app()->user->id))
{
	$user = User::model()->findByPk(Yii::app()->user->id);
}
$discount = isset($daiibuy->discount[$model->supplierId]) ? $daiibuy->discount[$model->supplierId] : $model->usedPoint;
$pointToBahtConfig = Configuration::model()->getPointToBaht();
$pointToBaht = (float) $pointToBahtConfig->value;
//$margin = $model->getSupplierMarginToDaiiBuy();
?>

<div class="row-fluid">
	<div class="span12">
		<div class="controls">

			<?php
			if((Yii::app()->controller->action->id == "view" || Yii::app()->controller->action->id == "UserConfirmFromMail") && Yii::app()->controller->id == "order")
			{
				$form = $this->beginWidget('CActiveForm', array(
					'id'=>'product-form',
					'enableAjaxValidation'=>true,
					'htmlOptions'=>array(
						'enctype'=>'multipart/form-data',
						'class'=>'form-horizontal well'),
				));
				if(isset($user))
				{
					if(Yii::app()->user->userType == 3 && !($model->status == 2))
					{
						echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์ใบส่งสินค้า', Yii::app()->createUrl("order/print", array(
								"id"=>$model->orderId)), array(
							'class'=>'btn btn-warning',
							'target'=>'_blank',));
					}
					else
					{
						echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์', Yii::app()->createUrl("order/print", array(
								"id"=>$model->orderId)), array(
							'class'=>'btn btn-warning',
							'target'=>'_blank',));
						if(Yii::app()->user->userType == 1 && $model->status >= 2)
						{
							echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์รายการสินค้า', Yii::app()->createUrl("order/printProductList", array(
									"id"=>$model->orderId)), array(
								'class'=>'btn btn-info',
								'target'=>'_blank',));
						}
					}

					if($model->status > 2 && (Yii::app()->user->userType == 3 || Yii::app()->user->userType == 4 || Yii::app()->user->userType == 5))
						echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์ใบสั่งซื้อสินค้า', Yii::app()->createUrl("order/viewOrder", array(
								"id"=>$model->orderId)), array(
							'class'=>'btn btn-info',
							'target'=>'_blank',));
				}
				else
				{

					echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์', Yii::app()->createUrl("order/print", array(
							"id"=>$model->orderId)), array(
						'class'=>'btn btn-warning',
						'target'=>'_blank',));
				}
				if(((!isset(Yii::app()->user->userType) && ($model->status == 0)) || ( Yii::app()->user->userType == 1) && ($model->status == 0)))
				{
					echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์ใบ Pay-in', Yii::app()->createUrl("order/printPayForm", array(
							"id"=>$model->orderId)), array(
						'class'=>'btn btn-info',
						'target'=>'_blank',));
				}
				if(isset($pageText[$model->status]['optionButtonText']))
				{
					$status = $model->status;

					if(isset($pageText[$model->status]['defaultStatus']) && $model->status == $pageText[$model->status]['defaultStatus'])
					{
						$optionButton = array(
							'class'=>'btn btn-success');
						if(isset($pageText[$model->status]['comfirmText']))
						{
							$optionButton['confirm'] = $pageText[$model->status]['comfirmText'];
						}
						echo CHtml::link('<i class="icon-share icon-white"></i>' . $pageText[$model->status]['optionButtonText'], Yii::app()->createUrl(isset($pageText[$model->status]['actionUrl']) ? $pageText[$model->status]['actionUrl'] : "", array(
								"id"=>$model->orderId,
								"token"=>$token)), $optionButton);
					}
				}
				if(isset($pageText[$model->status]['optionButtonText2']))
				{
					if(isset(Yii::app()->user->id))
					{
						if($model->status == 3 && $user->type == 2)
						{
							?>
							<a href = "#remarkModal2" role = "button" class = "btn btn-danger icon-remove icon-white" data-toggle = "modal">ตีกลับสินค้า</a>

							<div id = "remarkModal2" class = "modal hide fade" tabindex = "-1" role = "dialog" aria-labelledby = "myModalLabel" aria-hidden = "true">
								<div class = "modal-header">
									<button type = "button" class = "close btn-small" data-dismiss = "modal" aria-hidden = "true">close x</button>
									<h3 id = "myModalLabel">ตีกลับสินค้าไปยังผู้ผลิต</h3>
								</div>
								<div class = "modal-body">
									<label class = "control-label">กรุณาระบุเหตุผล : </label>
									<div class = "controls">
										<textarea id = "returnText2" rows = "4" class = "input-xlarge" name = "remark2"></textarea>
									</div>
								</div>
								<div class = "modal-footer">
									<button class = "btn btn-primary" name = "action" value = "return2" >Submit</button>
								</div>
							</div>
							<?php
						}
						if($model->status == 1 && $user->type == 5)
						{
							?>
							<a href="#remarkModal" role="button" class="btn btn-danger icon-remove icon-white" data-toggle="modal">ให้ผู้สั่งซื้อยืนยันโอนเงินอีกครั้ง</a>

							<div id="remarkModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close btn-small" data-dismiss="modal" aria-hidden="true">close x</button>
									<h3 id="myModalLabel">หลักฐานการโอนไม่ผ่านการตรวจสอบ</h3>
								</div>
								<div class="modal-body">
									<label class="control-label">กรุณาระบุเหตุผล : </label>
									<div class="controls">
										<textarea id="returnText" rows="4" class="input-xlarge" name="remark"></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<button class="btn btn-primary" name="action" value="return" >Submit</button>
								</div>
							</div>
							<?php
						}
						else if(isset($pageText[$model->status]['defaultStatus']) && $model->status == $pageText[$model->status]['defaultStatus'] && $model->status <> 3 && $user->type <> 2 && $user->type <> 3)
						{
							$optionButton2 = array(
								'class'=>'btn btn-danger');
							if(isset($pageText[$model->status]['comfirmText2']))
							{
								$optionButton2['confirm'] = $pageText[$model->status]['comfirmText2'];
							}
							echo CHtml::link('<i class="icon-remove icon-white"></i>' . $pageText[$model->status]['optionButtonText2'], Yii::app()->createUrl(isset($pageText[$model->status]['actionUrl2']) ? $pageText[$model->status]['actionUrl2'] : "", array(
									"id"=>$model->orderId,
									"token"=>$token)), $optionButton2);
						}
						else
						{
							$optionButton2 = array(
								'class'=>'btn btn-primary');
							if(isset($pageText[$model->status]['comfirmText2']))
							{
								$optionButton2['confirm'] = $pageText[$model->status]['comfirmText2'];
							}
							echo CHtml::link('<i class="icon-list-alt icon-white"></i>' . $pageText[$model->status]['optionButtonText2'], Yii::app()->createUrl(isset($pageText[$model->status]['actionUrl2']) ? $pageText[$model->status]['actionUrl2'] : "", array(
									"id"=>$model->orderId,
									"token"=>$token)), $optionButton2);
						}
					}
					else if(isset($pageText[$model->status]['defaultStatus']) && $model->status == $pageText[$model->status]['defaultStatus'])
					{
						$optionButton2 = array(
							'class'=>'btn btn-danger');
						if(isset($pageText[$model->status]['comfirmText2']))
						{
							$optionButton2['confirm'] = $pageText[$model->status]['comfirmText2'];
						}
						echo CHtml::link('<i class="icon-remove icon-white"></i>' . $pageText[$model->status]['optionButtonText2'], Yii::app()->createUrl(isset($pageText[$model->status]['actionUrl2']) ? $pageText[$model->status]['actionUrl2'] : "", array(
								"id"=>$model->orderId,
								"token"=>$token)), $optionButton2);
					}
				}
				if(isset($pageText[$model->status]['optionButtonText3']))
				{
					if(isset($pageText[$model->status]['defaultStatus']) && $model->status == $pageText[$model->status]['defaultStatus'])
					{

						$optionButton2 = array(
							'class'=>'btn btn-primary');
						if(isset($pageText[$model->status]['comfirmText3']))
						{
							$optionButton2['confirm'] = $pageText[$model->status]['comfirmText3'];
						}
						if($model->isSentToCustomer == 1)
						{
							?>
							<a href="#editReserveModal" role="button" class="btn btn-info icon-pencil icon-white" data-toggle="modal"><?php echo $pageText[$model->status]['optionButtonText3']; ?></a>
							<!-- Modal -->

							<div id="editReserveModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close btn-small" data-dismiss="modal" aria-hidden="true">close x</button>
									<h3 id="myModalLabel">แก้ไขรายชื่อผู้รับสินค้าแทน</h3>
								</div>
								<div class="modal-body">



									<label>รายชื่อผู้รับสินค้าแทน</label>
									<?php $customerReserve = @unserialize(urldecode($model->customerReserve)); ?>
									<input name='r1' class="input-medium" type="text" <?php echo isset($customerReserve[0]) ? "value='$customerReserve[0]'" : "placeholder='ผู้รับแทนคนที่ 1'"; ?>><br>
									<input name='r2' class="input-medium" type="text" <?php echo isset($customerReserve[1]) ? "value='$customerReserve[1]'" : "placeholder='ผู้รับแทนคนที่ 2'"; ?>><br>
									<input name='r3' class="input-medium" type="text" <?php echo isset($customerReserve[2]) ? "value='$customerReserve[2]'" : "placeholder='ผู้รับแทนคนที่ 3'"; ?>>

									<label>กรุณากรอก E-mail ของท่านเพื่อยืนยันการแก้ไขข้อมูล</label>
									<input name='m1' class="input-medium" type="text" placeholder="e-mail ของคุณ..">


								</div>
								<div class="modal-footer">
									<button class="btn btn-primary" name="action" value="editReserve" >ยืนยัน</button>
								</div>
							</div>
							<?php
						}
						else
						{
							if(isset($pageText[$model->status]['actionUrl3']))
							{
								echo CHtml::link('<i class="icon-remove icon-white" ></i>' . $pageText[$model->status]['optionButtonText3'], Yii::app()->createUrl(isset($pageText[$model->status]['actionUrl3']) ? $pageText[$model->status]['actionUrl3'] : "", array(
										"id"=>$model->orderId,
										"token"=>$token)), $optionButton2);
							}
						}
						?>
						<div class="errorMessage"><?php echo CHtml::errorSummary($model); ?></div>
						<?php
					}
				}
				if(isset($pageText[$model->status]["description"]))
				{
					echo "<h4 class='alert'>" . $pageText[$model->status]["description"] . "</h4>";
				}
				?>

				<?php
				if(isset(Yii::app()->user->userType))
				{
					$i = 0;
					if(count($model->orderFile) > 0)
					{
						if(Yii::app()->user->userType == 4 || Yii::app()->user->userType == 5)
						{
							?>
							<div class="row-fluid">
								<h4>ไฟล์แนบ</h4>
								<table class="table table-striped table-bordered table-condensed">
									<thead>
									<th width="5%">ลำดับ</th>
									<th>ชื่อไฟล์</th>
									<th width="15%">ประเภทผู้ใช้งาน</th>
									<th width="15%">เอกสาร</th>
									<th width="10%">วันที่สร้าง</th>
									</thead>
									<?php
									foreach($model->orderFile as $file)
									{
										$userType = "";
										if(isset($file->userType))
										{

											switch($file->userType)
											{
												case 1:
													$userType = "เอกสารของผู้สั่งซื้อ";
													break;
												case 2:
													$userType = "เอกสารของตัวแทนกระจายสินค้า";
													break;
												case 3:
													$userType = "เอกสารของผู้ผลิตสินค้า";
													break;
												case 4:
													$userType = "เอกสารของผู้ดูแลระบบ";
													break;
											}
										}
										?>
										<tbody>
										<td><?php echo $i . ". "; ?></td>
										<td><?php echo $file->fileName; ?></td>
										<td><?php echo!empty($userType) ? $userType : ""; ?></td>
										<td><?php echo showImage($file->filePath, $file->fileName); ?></td>
										<td><?php echo $file->createDateTime; ?></td>
										</tbody>
										<br/>
										<?php
										$i++;
									}
									?>
								</table>
							</div>
							<div class="row-fluid">
								<h4>หลักฐานการโอนเงิน ผู้ผลิต/ผู้กระจายสินค้า</h4>
								<table class="table table-striped table-bordered table-condensed">
									<thead>
									<th width="5%">ลำดับ</th>
									<th>ชื่อไฟล์</th>
									<th width="15%">เอกสาร</th>
									</thead>
									<?php
									$i = 1;
									$slipFile = BalanceTransaction::model()->findSlipByOrderId($model->orderId);
									foreach($slipFile as $slip)
									{
										?>
										<tbody>
										<td><?php echo $i . ". "; ?></td>
										<td><?php echo $slip['fileName'] ?></td>
										<td><?php echo showImage($slip['file'], $slip['fileName']); ?></td>
										</tbody>
										</br>
										<?php
										$i++;
									}
									?>
								</table>
							</div>
							<?php
						}
						else if(Yii::app()->user->userType == 2 || Yii::app()->user->userType == 3)
						{
							if(Yii::app()->user->userType == 3 && $model->isSentToCustomer == 1)
							{
								$customerReserve = @unserialize(urldecode($model->customerReserve));
								if(count($customerReserve) > 0)
								{
									?>
									<div class="row-fluid">
										<h4>รายชื่อผู้ที่สามารถรับสินค้าแทนได้</h4>
										<table class="table table-striped table-bordered table-condensed">
											<thead>
											<th width="5%">ลำดับ</th>
											<th width="40%">ชื่อ-นามสกุล</th>
											</thead>
											<?php
											$i = 0;
											for(;
											;
											)
											{
												if($i > (count($customerReserve) - 1))
												{
													break;
												}
												?>
												<tbody>
												<td><?php echo $i + 1; ?></td>
												<td><?php echo $customerReserve[$i]; ?></td>
												</tbody>
												<?php
												$i++;
											}
											?>
										</table>
									</div>
									<?php
								}
							}
							$slipFile = BalanceTransaction::model()->findSlipByOrderId($model->orderId);
							if(count($slipFile) > 0)
							{
								?>
								<div class="row-fluid">
									<h4>หลักฐานการโอนเงิน ผู้ผลิต/ผู้กระจายสินค้า</h4>
									<table class="table table-striped table-bordered table-condensed">
										<thead>
										<th width="5%">ลำดับ</th>
										<th>ชื่อไฟล์</th>
										<th width="15%">เอกสาร</th>
										</thead>
										<?php
										$i = 1;

										foreach($slipFile as $slip)
										{
											?>
											<tbody>
											<td><?php echo $i . ". "; ?></td>
											<td><?php echo $slip['fileName'] ?></td>
											<td><?php echo showImage($slip['file'], $slip['fileName']); ?></td>
											</tbody>
											<?php
											$i++;
										}
										?>
									</table>
								</div>
								<?php
							}
						}
					}
				}
				$this->endWidget();
			}
			?>
		</div>

		<style type="text/css">
			<!--
			@media print {
				div.page  {
					height: 100%;
					margin: 0px 0px 0px 0px;
				}
			}
			-->
		</style>
		<?php
		if(isset($user))
		{
			if(!(Yii::app()->controller->action->id == "printPayForm"))
			{
				if($user->type == 1)
				{
					if($model->status == 0)
					{
						$this->renderPartial("_viewOrderUser", array(
							'model'=>$model,
							'pageText'=>$pageText,
							'daiibuy'=>$daiibuy,
							'token'=>isset($token) ? $token : null,
							'supplier'=>$supplier,
//							'dealer'=>$dealer,
							'supplierAddr'=>$supplierAddr,
//							'dealerAddr'=>$dealerAddr,
							'daiiAddr'=>$daiiAddr,
							'user'=>isset($user) ? $user : null,
							'discount'=>$discount,
							'margin'=>$margin));
					}
					else
					{
						$this->renderPartial("_viewOrderUser", array(
							'model'=>$model,
							'pageText'=>$pageText,
							'daiibuy'=>$daiibuy,
							'token'=>isset($token) ? $token : null,
							'supplier'=>$supplier,
//							'dealer'=>$dealer,
							'supplierAddr'=>$supplierAddr,
//							'dealerAddr'=>$dealerAddr,
							'daiiAddr'=>$daiiAddr,
							'user'=>isset($user) ? $user : null,
							'discount'=>$discount,
							'margin'=>$margin));
					}
				}
				else
				{
					$this->renderPartial("_viewOrderUser", array(
						'model'=>$model,
						'pageText'=>$pageText,
						'daiibuy'=>$daiibuy,
						'token'=>isset($token) ? $token : null,
						'supplier'=>$supplier,
//						'dealer'=>$dealer,
						'supplierAddr'=>$supplierAddr,
//						'dealerAddr'=>$dealerAddr,
						'daiiAddr'=>$daiiAddr,
						'user'=>isset($user) ? $user : null,
						'discount'=>$discount,
						'margin'=>$margin));
				}
			}
		}
		else
		{
			if(!(Yii::app()->controller->action->id == "printPayForm"))
			{
				$this->renderPartial("_viewOrderUser", array(
					'model'=>$model,
					'pageText'=>$pageText,
					'daiibuy'=>$daiibuy,
					'token'=>$token,
					'supplier'=>$supplier,
//					'dealer'=>$dealer,
					'supplierAddr'=>$supplierAddr,
//					'dealerAddr'=>$dealerAddr,
					'daiiAddr'=>$daiiAddr,
					'user'=>isset($user) ? $user : null,
					'discount'=>$discount,
					'margin'=>$margin));
			}
		}
		?>
	</div><?php
	if(Yii::app()->controller->action->id == "printPayForm")
	{
		?>

		<div class="row-fluid">
			<?php
			if($model->status == 0)
			{
				?>

				<?php
				if(isset($model->supplierId))
				{
					$this->renderPartial("transfer_form_print", array(
						'supplierId'=>$model->supplierId,
						'model'=>$model,
						'title'=>"ส่วนที่ 1 สำหรับธนาคาร"));
					?>
					<p style="margin-bottom: 10px"><image src = "<?php echo Yii::app()->request->baseUrl . "/images/payin-cut.png"; ?>" style = "width: 750px" /><p>
						<?php
						$this->renderPartial("transfer_form_print", array(
							'supplierId'=>$model->supplierId,
							'model'=>$model,
							'title'=>"ส่วนที่ 2 สำหรับลูกค้า"));
					}
					?>
					<?php
				}
			}
			?>
	</div>
</div>
<!--</div>-->
<?php

function showImage($imageUrl, $title)
{
	$image = "";
	if(!empty($imageUrl) && isset($imageUrl))
	{
		if(strpos($imageUrl, ".pdf"))
		{
			$imageUrl = Yii::app()->baseUrl . "/" . $imageUrl;
			$image = "<a class='pdf' Title='$title' href='$imageUrl'>ดูเอกสาร</a>";
		}
		else
		{
			$imageUrl = Yii::app()->baseUrl . "/" . $imageUrl;
			//$image = "<a class='fancyFrame' Title='$title' href='$imageUrl'><img src='$imageUrl' width='50px' alt='' /></a>";
			$image = "<a class='fancyFrame' Title='$title' href='$imageUrl'>ดูเอกสาร</a>";
		}
	}
	return $image;
}
?>