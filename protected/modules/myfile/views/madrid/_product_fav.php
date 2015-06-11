<h3>ตารางประเมินราคา <?php echo $model->title; ?></h3>
<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="text-center">
					<th rowspan="2" style="text-align:center">ลำดับ</th>
					<th rowspan="2" style="text-align:center">รายละเอียดสินค้า</th>
					<?php // if($this->action->id == "view" || $model->status == 1): ?>

<!--						<th style="width: 10%;text-align: center">พื้นที่จาก การประเมิณ</th>
						<th>หน่วย</th>-->
					<?php // endif; ?>
					<th rowspan="2" style="text-align:center">รหัส</th>
					<th rowspan="2" style="text-align:center">หน่วย</th>
					<th rowspan="2" style="text-align:center">จำนวน/หน่วย</th>
					<th colspan="2" style="text-align:center">ขนาดพื้นที่</th>
					<?php if($this->action->id == "view" || $model->status == 1): ?>
						<th rowspan="2" style="width: 10%;text-align: center">ปริมาณจาก การประเมิณพื้นที่</th>
						<th rowspan="2" style="text-align:center">ปริมาณแก้ไข</th>
					<?php else: ?>
						<th rowspan="2" style="text-align:center">ระบุจำนวน</th>
					<?php endif; ?>
					<th rowspan="2" style="text-align:center">ราคารวม</th>
				</tr>
				<tr>
					<th rowspan="2"  style="text-align:center">หน่วย</th>
					<th rowspan="2"  style="text-align:center">พื้นที่</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1;
				if(1 == 2):
					?>
					<tr id="orderItem">
						<td><?php echo $i; ?></td>
						<td style="text-align:center"></td>
						<td style="text-align: center"><?php echo $item->area; ?><?php echo CHtml::hiddenField("supplierArea" . strtolower($item->groupName), $item->area); ?></td>
						<td>ตร.เมตร</td>
						<td id="productCode<?php echo strtolower($item->groupName) ?>" class="text-info" id="productCode"><?php echo isset($item->product) ? $item->product->code : ""; ?></td>
						<td id="productName<?php echo strtolower($item->groupName) ?>"><?php echo isset($item->product) ? $item->product->name : ""; ?></td>
						<td id="productUnits<?php echo strtolower($item->groupName) ?>"><?php echo isset($item->product) ? $item->product->productUnits : ""; ?></td>
						<?php
						echo CHtml::hiddenField("OrderItems[" . $item->orderItemsId . "][price]", isset($item->product) ? $item->product->price : "", array(
							'id'=>"priceHidden" . strtolower($item->groupName)));
						?>
						<?php
						echo CHtml::hiddenField("OrderItems[" . $item->orderItemsId . "][productId]", isset($item->product) ? $item->product->productId : "", array(
							'id'=>"productId" . strtolower($item->groupName)));
						?>
						<?php
						$productArea = isset($item->product) ? ($item->product->width * $item->product->height) / 10000 : 0;
						$estimateQuantity = $productArea * $item->area;
						?>

						<td  style="text-align: center" id="productArea<?php echo strtolower($item->groupName) ?>">
							<?php echo $productArea; ?>
						</td>
						<td style="text-align: center" id="estimateAreaQuantity<?php echo strtolower($item->groupName) ?>"><?php echo $estimateQuantity ?></td>
						<td id="quantity<?php echo strtolower($item->groupName) ?>"><?php
							echo CHtml::numberField("OrderItems[" . $item->orderItemsId . "][quantity]", $item->quantity, array(
								'min'=>0,
								//													'class'=>'hide',
								'id'=>'quantityText_' . strtolower($item->groupName)));
							?></td>
						<td id="price<?php echo strtolower($item->groupName) ?>"><?php echo isset($item->product) ? number_format($item->quantity * $item->product->price) : 0 ?></td>
					</tr>
				<?php endif; ?>
				<?php if(1 == 2): ?>
					<tr>
						<td><?php
							echo (isset($item->product->productImagesSort) && count($item->product->productImagesSort)) ? CHtml::image(Yii::app()->baseUrl . $item->product->productImagesSort[0]->image, "", array(
									'style'=>'width:200px')) : "";
							?></td>
						<td><?php echo $item->product->code; ?></td>
						<td><?php echo $item->product->name; ?></td>
						<td style="color:red"><?php echo number_format($item->product->price, 2); ?>
							<?php // echo CHtml::hiddenField("Order[createMyfileType]", 3)   ?>
							<?php echo CHtml::hiddenField("OrderItems[$item->orderItemsId][productId]", $item->productId) ?>
							<?php
							echo CHtml::hiddenField("OrderItems[$item->orderItemsId][price]", $item->product->price, array(
								'id'=>'priceHidden_' . $i))
							?>
						</td>
						<td style="width: 20%">
							<div class="row"><div class="col-md-12"><?php
									echo CHtml::numberField("OrderItems[$item->orderItemsId][quantity]", $item->quantity, array(
										"id"=>"quantityText_" . $i))
									?></div></div>
						</td>
						<?php if($this->action->id == "view"): ?>
							<td id="total<?php echo $i; ?>"><?php echo number_format($item->product->price * $item->quantity, 0) ?></td>
						<?php endif; ?>
					</tr>
				<?php endif; ?>
				<?php
				if(1 == 1)
				{
					echo CHtml::hiddenField("Order[createMyfileType]", 1);
					?>
					<tr id="orderItem">
						<td><?php echo $i; ?></td>
						<td id="productName"></td>
						<?php if($this->action->id == "view" || $model->status == 1): ?>
							<td style="text-align: center"><?php // echo $item->area;                                                                                                                                                 ?><?php // echo CHtml::hiddenField("supplierArea" . strtolower($k), $item->area);                                                                                                                                                 ?></td>
							<td>ตร.เมตร</td>
						<?php endif; ?>

						<td id="productCode" class="text-info" id="productCode"><?php // echo $item->product->code;                                                                                                                                                    ?></td>
						<td id="productUnits"><?php // echo $item->product->name;                                                                                                                                                 ?></td>
						<td ><?php // echo $item->product->productUnits;                                                                                                                                               ?></td>
						<?php
						echo CHtml::hiddenField("OrderItems[price]", "", array(
							'id'=>"priceHidden"));
						?>
						<?php
						echo CHtml::hiddenField("OrderItems[productId]", "", array(
							'id'=>"productId"));
						echo CHtml::hiddenField("OrderItems[groupName]", "", array(
							'id'=>"groupName"));
						?>
						<?php
//												$productArea = ($item->product->width * $item->product->height) / 10000;
//												$estimateQuantity = $productArea * $item->area;
						?>

						<td  style="text-align: center" id="productArea">
							<?php // echo $productArea;            ?>
						</td>
						<?php if($this->action->id == "view" || $model->status == 1): ?>
							<td style="text-align: center" id="estimateAreaQuantity"><?php // echo $estimateQuantity                                                                                                                                           ?></td>
						<?php endif; ?>
						<td></td>
						<td id="quantity"><?php
							echo CHtml::numberField("OrderItems[quantity]", "", array(
								'min'=>0,
								//													'class'=>'hide',
								'id'=>'quantityText'));
							?></td>
						<td id="price"><?php // echo number_format($item->quantity * $item->product->price)                                                                                                                                              ?></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>

		<div class="row">
			<div class="col-md-4">
				<img src="" id="image" class="col-md-12" />
			</div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12" ><h3 id="name"></h3></div>
				</div>
				<div class="row">
					<div class="col-md-12" id="code"></div>
				</div>
				<div class="row">
					<div class="col-md-12" id="description"></div>
				</div>
				<div class="row">
					<div class="col-md-12" id="pprice"></div>
				</div>
			</div>
		</div>
	</div>
</div>