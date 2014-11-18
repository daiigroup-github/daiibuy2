<?php
//throw new Exception(print_r($productResult,true));
?>
<div class="content-result">
	<div class="carousel-heading no-margin">
								<h4>Confirm Order My file</h4>
							</div>
	<div class="row" id="order" name="<?php echo $productResult['orderId']; ?>">
					<div class="col-xs-12">

						<form id="editTableForm">
							<table id="editTable" style="background-color: #DDD" class="table orderinfo-table table-hover edit-table" name="<?php echo $productResult['categoryId']; ?>">
							<thead>
								<tr>
								<th>Code</th>
								<th style="width: 40%;">รายละเอียด</th>
								<th>หน่วย</th>
								<th class="edit-table-qty" >จำนวน</th>
								<th>ราคา/หน่วย</th>
								<th>ราคา(บาท)</th>
								<th class="edit-table-price">ประเมิณราคา/เมตร(ไม่รวมเข็ม)</th>
								</tr>
							</thead>
							<tbody >
						<?php foreach($productResult['items'] as $item): ?>
			<tr>
				<td><?php echo $item->code; ?></td>
				<td><?php echo $item->name; ?></td>
				<td><?php echo $item->productUnits; ?></td>
				<td name="<?php echo 'productItems['.$item->productId.'][quantity]'; ?>"><?php echo $item->quantity; ?></td>
				<td><?php echo FenzerController::formatMoney($item->price/intval($item->quantity),true); ?></td>
				<td><?php echo FenzerController::formatMoney($item->price,true); ?></td>
				<td><?php echo FenzerController::formatMoney(($item->price/$item->quantity)/3,true); ?></td>
			</tr>
		<?php endforeach; ?>

<!--			<tr>
				<td><?php // echo CHtml::dropDownList('productId', 'selectedCode',
//					CHtml::listData(Product::model()->findAll('supplierId ='. 176 .' AND Status = 1'), 'productId', 'code'),
//					array('id'=>'itemCode',
//						'prompt'=>'เลือกรหัส',
//						'ajax'=>array(
//									'type'=>'POST',
//									'url'=>CController::createUrl('fenzer/addNewProductItem'), //url to call.
////									'update'=>'#height_content', //selector to update
//									'dataType'=>'html',
//									'data'=>array(
//										"productId"=>"js:this.value",
//										"categoryId"=>$productResult['categoryId']),
//										"length"=>0,
//									'success'=>'js:function(data){
//										alert("Yo");
//										$("#result_content").html(data);
//									}',
//								),
//					)); ?></td>
				<td><?php // echo ''; ?></td>
				<td><?php // echo ''; ?></td>
				<td><?php // echo CHtml::textField('quantity', '',array('id'=>'qty','style'=>'width:100px;text-align:Right;')); ?></td>
				<td><?php // echo ''; ?></td>
				<td><?php // echo ''; ?></td>
				<td><?php // echo ''; ?></td>
			</tr>-->
	</tbody>
<!--	<tr>
					<td class="align-right"><span class="price big">Total</span></td>
					<td class="align-right" style="width: 169px;"><span class="price big" id="summaryTotal"><?php // echo $productResult['totalPrice'];?></span></td>
				</tr>-->
</table>
							</form>
					</div>
				</div>


<!--<div class="row">
	<div class="col-sm-1">
		เพิ่มสินค้า
	</div>
	<div class="col-sm-3">
	<form id="addItem" action="#">

	<?php // echo CHtml::dropDownList('productId', 'selectedCode',
//					CHtml::listData(Product::model()->findAll('supplierId ='. 176 .' AND Status = 1'), 'productId', 'code'),
//					array('class'=>'form-control',
//						'id'=>'itemCode',
//						'prompt'=>'เลือกรหัสสินค้า',
//						'style'=>'text-align: center;',
//					)); ?>

					<?php
//					echo count($productResult['items'])." <br>";
//					foreach($productResult['items'] as $item){
//						echo $item->name ." <br>";
//					}
					?>

		</form>
	</div>
	<div class="col-sm-3">
		<button id="addItemButton" class="btn btn-block btn-info">เพิ่มสินค้า</button>
		<?php // echo CHtml::button('เพิ่มสินค้า',
//			array('class'=>'btn btn-info',
//				'ajax'=>array(
//				'type'=>'POST',
//				'url'=>CController::createUrl('fenzer/addNewProductItem'),
//				'dataType'=>'html',
//				'data'=>'js:$("#addItem").serialize()',
//				'success'=>'js:function(data){
//					$("#editTable").append(data);
//				}',
//				),
//			)); ?>
	</div>

	</div>-->
</div>