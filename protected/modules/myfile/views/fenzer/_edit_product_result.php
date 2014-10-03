<div class="row">
					<div class="col-md-6">
						Height : <?php
						echo CHtml::textField('height', '', array(
							'id'=>'height_input',
							'class'=>'input-lg',
							'disabled'=>true,));
						?>
						เมตร
					</div>
					<div class="col-md-6 pull-left">
						Length : <?php
						echo CHtml::textField('length', '', array(
							'id'=>'length_input',
							'class'=>'input-lg',
						));
						?>
						เมตร
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<table class="table table-hover" style="text-align: center;background-color: #67ae73">
							<thead >
								<tr>
								<th style="text-align: center">Code</th>
								<th style="text-align: center">รายละเอียด</th>
								<th style="text-align: center">หน่วย</th>
								<th style="text-align: center">จำนวน</th>
								<th style="text-align: center">ราคา/หน่วย</th>
								<th style="text-align: center">ราคา(บาท)</th>
								<th style="text-align: center;width:17%">ประเมิณราคา/เมตร(ไม่รวมเข็ม)</th>
								</tr>
							</thead>
							<tbody>
						<?php foreach($productResult as $item): ?>
			<tr class="clickableRow" id="<?php echo $item->productId; ?>" name="<?php echo $item->height; ?>">
				<td><?php echo $item->name; ?></td>
				<td><?php echo $item->height; ?></td>
				<td>3.00</td>
				<td>เรียบ 1 ด้าน</td>
				<td>สีคอนกรีตธรรมชาติ</td>
				<td>1,711.00</td>
				<td>587</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
					</div>
				</div>

