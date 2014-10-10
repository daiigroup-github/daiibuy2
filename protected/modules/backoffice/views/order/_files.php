<?php
if(isset(Yii::app()->user->userType))
{
	$i = 0;
	if(count($model->orderFiles) > 0)
	{
		if(Yii::app()->user->userType == 4 || Yii::app()->user->userType == 5)
		{
			?>
			<div class="form-group">
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
					foreach($model->orderFiles as $file)
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
			<div class="row">
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
					<div class="form-group">
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
				<div class="form-group">
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