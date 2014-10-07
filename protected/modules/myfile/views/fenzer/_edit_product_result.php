<?php

?>
				<div class="row">
					<div class="col-xs-12">
						<table class="table table-hover" style="text-align: center;background-color: #67ae73">
							<thead >
								<tr>
								<th style="text-align: center">Code</th>
								<th style="text-align: center">รายละเอียด</th>
								<th style="text-align: center">หน่วย</th>
								<th style="text-align: center;width:10%">จำนวน</th>
								<th style="text-align: center">ราคา/หน่วย</th>
								<th style="text-align: center">ราคา(บาท)</th>
								<th style="text-align: center;width:17%">ประเมิณราคา/เมตร(ไม่รวมเข็ม)</th>
								</tr>
							</thead>
							<tbody >
						<?php foreach($productResult['items'] as $item): ?>
			<tr class="" id="<?php echo $item->productId; ?>" name="<?php // echo $item->height; ?>">
				<td><?php echo $item->isbn; ?></td>
				<td><?php echo $item->name; ?></td>
				<td><?php echo $item->productUnits; ?></td>
				<td><?php echo CHtml::textField('quantity', $item->quantity,array('id'=>$item->productId,'style'=>'width:100px;text-align:Right;')); ?></td>
				<td><?php echo FenzerController::formatMoney($item->price/$item->quantity,true); ?></td>
				<td><?php echo FenzerController::formatMoney($item->price,true); ?></td>
				<td><?php echo FenzerController::formatMoney(($item->price/$item->quantity)/3,true); ?></td>
			</tr>
		<?php endforeach; ?>

			<tr>
				<td><?php echo CHtml::dropDownList('isbn', 'selectedCode',
					Product::model()->findAllProductArraySupplierIdAndCategoryId(176,$productResult['categoryId']),
					array('id'=>'itemCode',
						'prompt'=>'เลือกรหัส',
						'ajax'=>array(
									'type'=>'POST',
									'url'=>CController::createUrl('fenzer/addNewProductItem'), //url to call.
//									'update'=>'#height_content', //selector to update
									'dataType'=>'html',
									'data'=>array(
										"productId"=>"js:this.key",
										"categoryId"=>$productResult['categoryId']),
									'success'=>'js:function(data){
										$("#height_content").html(data);
									}',
								),
					)); ?></td>
				<td><?php echo ''; ?></td>
				<td><?php echo ''; ?></td>
				<td><?php echo CHtml::textField('quantity', '',array('id'=>'','style'=>'width:100px;text-align:Right;')); ?></td>
				<td><?php echo ''; ?></td>
				<td><?php echo ''; ?></td>
				<td><?php echo ''; ?></td>
			</tr>
	</tbody>
</table>
					</div>
				</div>


<div class="row">

					<?php
//					echo count($productResult['items'])." <br>";
//					foreach($productResult['items'] as $item){
//						echo $item->name ." <br>";
//					}
					?>
				</div>

