<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered table-hover">
											<thead>
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
											<tbody>
												<?php
												$i = 1;
												foreach($productResult['items'] as $item): ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $item['description']; ?></td>
				<td><?php echo ($item['width']*1000) . " x " . ($item['height']*1000); ?></td>
				<td><?php echo ($item['width']*1000) . " x " . ($item['height']*1000); ?></td>
				<td><?php echo $item['quantity']; ?></td>
				<td><?php echo $item['code']; ?></td>
				<td><?php echo AtechWindowController::formatMoney($item['price']); ?></td>
				<td><?php echo AtechWindowController::formatMoney($item['subTotal'],true); ?></td>
			</tr>
													<?php
													$i++;
												endforeach;
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>