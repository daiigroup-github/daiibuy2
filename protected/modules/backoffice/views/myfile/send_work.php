<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'send-work-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'enctype'=>'multipart/form-data',
	),
	));
?>
<h2>ส่งงาน</h2>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th style="width: 10%">งวดงาน</th>
			<th>รายละเอียด</th>

		</tr>
	</thead>
	<tbody>
		<?php if($model->status == 3 && $model->child->status < 3): ?>
			<tr>
				<td>งวดที่ 1</td>
				<td>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width: 5%;">ลำดับ</th>
								<th>หัวข้อ</th>
								<th>รูป</th>
								<th>เหตุผล</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$orderGroupId = $model->orderGroupId;
							for($i = 1; $i <= 10; $i++):
								$sendWork = OrderGroupSendWork::model()->find("seq = $i AND orderGroupId = $orderGroupId");
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo CHtml::textField("OrderGroupSendWork[$orderGroupId][$i][title]", isset($sendWork) ? $sendWork->title : "") ?></td>

									<td>
										<?php if(isset($sendWork)): ?>
											<?php
											echo CHtml::image(Yii::app()->baseUrl . $sendWork->image, '', array(
												'style'=>'width:150px;'));
											?>
										<?php endif; ?>
										<?php echo CHtml::fileField("OrderGroupSendWork[$orderGroupId][$i][image]") ?></td>

									<td><?php echo CHtml::textArea("OrderGroupSendWork[$orderGroupId][$i][remark]", isset($sendWork) ? $sendWork->remark : "") ?></td>
								</tr>
							<?php endfor; ?>
						</tbody>
					</table>
				</td>
			</tr>
		<?php endif; ?>
		<?php if($model->child->status == 3 && $model->child->child->status < 3): ?>
			<tr>
				<td>งวดที่ 2</td>
				<td>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width: 5%;">ลำดับ</th>
								<th>หัวข้อ</th>
								<th>รูป</th>
								<th>เหตุผล</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$orderGroupId = $model->child->orderGroupId;
							for($i = 1; $i <= 10; $i++):
								$sendWork = OrderGroupSendWork::model()->find("seq = $i AND orderGroupId = $orderGroupId");
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo CHtml::textField("OrderGroupSendWork[$orderGroupId][$i][title]", isset($sendWork) ? $sendWork->title : "") ?></td>

									<td>
										<?php if(isset($sendWork)): ?>
											<?php
											echo CHtml::image(Yii::app()->baseUrl . $sendWork->image, '', array(
												'style'=>'width:150px;'));
											?>
										<?php endif; ?>
										<?php echo CHtml::fileField("OrderGroupSendWork[$orderGroupId][$i][image]") ?></td>

									<td><?php echo CHtml::textArea("OrderGroupSendWork[$orderGroupId][$i][remark]", isset($sendWork) ? $sendWork->remark : "") ?></td>
								</tr>
							<?php endfor; ?>
						</tbody>
					</table>
				</td>
			</tr>
		<?php endif; ?>
		<?php if($model->child->child->status == 3 && $model->child->child->child->status < 3): ?>
			<tr>
				<td>งวดที่ 3</td>
				<td>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width: 5%;">ลำดับ</th>
								<th>หัวข้อ</th>
								<th>รูป</th>
								<th>เหตุผล</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$orderGroupId = $model->child->child->orderGroupId;
							for($i = 1; $i <= 10; $i++):
								$sendWork = OrderGroupSendWork::model()->find("seq = $i AND orderGroupId = $orderGroupId");
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo CHtml::textField("OrderGroupSendWork[$orderGroupId][$i][title]", isset($sendWork) ? $sendWork->title : "") ?></td>

									<td>
										<?php if(isset($sendWork)): ?>
											<?php
											echo CHtml::image(Yii::app()->baseUrl . $sendWork->image, '', array(
												'style'=>'width:150px;'));
											?>
										<?php endif; ?>
										<?php echo CHtml::fileField("OrderGroupSendWork[$orderGroupId][$i][image]") ?></td>

									<td><?php echo CHtml::textArea("OrderGroupSendWork[$orderGroupId][$i][remark]", isset($sendWork) ? $sendWork->remark : "") ?></td>
								</tr>
							<?php endfor; ?>
						</tbody>
					</table>
				</td>
			</tr>
		<?php endif; ?>
		<?php if(1 == 0): ?>
			<tr>
				<td>งวดที่ 4</td>
				<td>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width: 5%;">ลำดับ</th>
								<th>หัวข้อ</th>
								<th>รูป</th>
								<th>เหตุผล</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$orderGroupId = $model->child->child->child->orderGroupId;
							for($i = 1; $i <= 10; $i++):
								$sendWork = OrderGroupSendWork::model()->find("seq = $i AND orderGroupId = $orderGroupId");
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo CHtml::textField("OrderGroupSendWork[$orderGroupId][$i][title]", isset($sendWork) ? $sendWork->title : "") ?></td>

									<td>
										<?php if(isset($sendWork)): ?>
											<?php
											echo CHtml::image(Yii::app()->baseUrl . $sendWork->image, '', array(
												'style'=>'width:150px;'));
											?>
										<?php endif; ?>
										<?php echo CHtml::fileField("OrderGroupSendWork[$orderGroupId][$i][image]") ?></td>

									<td><?php echo CHtml::textArea("OrderGroupSendWork[$orderGroupId][$i][remark]", isset($sendWork) ? $sendWork->remark : "") ?></td>
								</tr>
							<?php endfor; ?>
						</tbody>
					</table>
				</td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-9">
		<?php
		echo CHtml::submitButton('ส่งงาน', array(
			'class'=>'btn btn-primary'));
		?>
	</div>
</div>

<?php $this->endWidget(); ?>