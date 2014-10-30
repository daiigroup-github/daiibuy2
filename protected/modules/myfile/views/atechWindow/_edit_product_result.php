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
						foreach($productResult['items'] as $item): ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $item['description']; ?></td>
				<td><?php echo ($item['width']*1000) . " x " . ($item['height']*1000); ?></td>
				<td><?php echo ($item['width']*1000) . " x " . ($item['height']*1000); ?></td>
				<td><?php echo CHtml::textField('productItems['.$item['productId'].'][quantity]', $item['quantity'],array('class'=>'edit-table-qty-input')); ?></td>
				<td><?php echo $item['code']; ?></td>
				<td><?php echo AtechWindowController::formatMoney($item['price']); ?></td>
				<td><?php echo AtechWindowController::formatMoney($item['subTotal'],true); ?></td>
			</tr>
		<?php $i++;
		endforeach; ?>
	</tbody>
</table>
							</form>
					</div>
				</div>
</div>