<?php

?>
<div id="result_content" class="content-result">
				<div class="row" >
					<div class="col-xs-12">
						<form id="editTableForm">
						<table id="editTable" class="table table-hover edit-table" style="background-color: #67ae73" name="<?php // echo $productResult['categoryId']; ?>">
							<thead>
<!--								<tr>
									<th><h2>การประเมิณราคา</h2></th>
						<th style="width:80%"><h2>ESTIMATE</h2></th>
								</tr>-->
								<tr>
									<th>ลำดับ</th>
									<th>รายละเอียด</th>
									<th>
										ขนาด(ตามแบบ)
									</th>
									<th>
										ขนาด(มาตรฐาน)
									</th>
									<th class="edit-table-qty" >จำนวน</th>
									<th>
										Code
									</th>
									<th>ราคา</th>
									<th>รวม</th>
								</tr>
							</thead>
							<tbody >

						<?php
						$i = 1;
						if(isset($productResult['items'])){
						foreach($productResult['items'] as $item): ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $item['description']; ?></td>
				<td><?php echo ($item['width']) . " x " . ($item['height']); ?></td>
				<td><?php echo ($item['width']) . " x " . ($item['height']); ?></td>
				<td><?php echo CHtml::textField('productItems['.$item['productId'].'][quantity]', $item['quantity'],array('class'=>'edit-table-qty-input')); ?></td>
				<td><?php echo $item['code']; ?></td>
				<td><?php echo AtechWindowController::formatMoney($item['price']); ?></td>
				<td><?php echo AtechWindowController::formatMoney($item['subTotal'],true); ?></td>
			</tr>
		<?php $i++;
		endforeach;
						}else{
							?>
					</tbody>
					</table>
					</form>
						<div class="text-center">
						ไม่พบสินค้า
						</div>
					<?php	}
?>
	</tbody>
</table>
				</form>
				<div class="row">
				<div class="col-lg-12 text-center">
					<a name="<?php // throw new Exception(print_r($this->action->id,true));
					echo isset($productResult["brandModelId"])? $productResult["brandModelId"] : ""; ?>" id="updateButton" class="btn btn-warning btn-lg <?php echo $this->action->id == 'view'? 'atechUpdate': ($this->action->id == 'create'? 'atechNav':'atechUpdate'); ?>"><i class="glyphicon glyphicon-refresh"></i> อัพเดทราคา</a>
				</div>
			</div>
		</div>
	</div>
</div>