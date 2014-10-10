<style>
	.tong {
		/*		position: fixed;
				bottom : 0%;
				right: 10px;
				min-width: 200px;
				max-width: 500px;*/
		border:2px black solid;
	}

	@media all and (max-width: 500px) {
		.tong {
			position: initial;
		}
	}
</style>
<div class="form-group">
	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'product-form',
		'enableAjaxValidation'=>true,
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',
			'class'=>'form-horizontal img-rounded well tong',
		),
	));
	if(isset($pageText[$model->status]["description"]))
	{
		echo "<h4 class='alert'>" . $pageText[$model->status]["description"] . "</h4>";
	}
	if(isset($user))
	{
		if(Yii::app()->user->userType == 3 && !($model->status == 2))
		{
			echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์ใบส่งสินค้า', Yii::app()->createUrl((isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/print", array(
					"id"=>$model->orderId)), array(
				'class'=>'btn btn-warning',
				'target'=>'_blank',));
		}
		else
		{
			echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์', Yii::app()->createUrl((isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/print", array(
					"id"=>$model->orderId)), array(
				'class'=>'btn btn-warning',
				'target'=>'_blank',));
			if(Yii::app()->user->userType == 1 && $model->status >= 2)
			{
				echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์รายการสินค้า', Yii::app()->createUrl((isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/printProductList", array(
						"id"=>$model->orderId)), array(
					'class'=>'btn btn-info',
					'target'=>'_blank',));
			}
		}

		if($model->status > 2 && (Yii::app()->user->userType == 3 || Yii::app()->user->userType == 4 || Yii::app()->user->userType == 5))
			echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์ใบสั่งซื้อสินค้า', Yii::app()->createUrl((isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/viewOrder", array(
					"id"=>$model->orderId)), array(
				'class'=>'btn btn-info',
				'target'=>'_blank',));
	}
	else
	{

		echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์', Yii::app()->createUrl((isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/print", array(
				"id"=>$model->orderId)), array(
			'class'=>'btn btn-warning',
			'target'=>'_blank',));
	}
	if(((!isset(Yii::app()->user->userType) && ($model->status == 0)) || ( Yii::app()->user->userType == 1) && ($model->status == 0)))
	{
		echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์ใบ Pay-in', Yii::app()->createUrl((isset($this->action->controller->module->id) ? $this->action->controller->module->id . "/" : "") . "order/printPayForm", array(
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

	$this->endWidget();
	?>
</div>