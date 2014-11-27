<div class="row sidebar-box blue">

	<div class="col-lg-12 col-md-12 col-sm-12">

		<div class="sidebar-box-heading">
			<i class="icons icon-box-2"></i>
			<h4>Summary</h4>
		</div>

		<div class="sidebar-box-content sidebar-padding-box">

			<table class="orderinfo-table table-bordered">

				<tr>
					<td class="align-right"><span class="price big">รวม</span></td>
					<td class="align-right" style="width: 169px;"><span class="price big" id="summaryTotal"><?php echo $orderSummary['total']; ?></span></td>
				</tr>

				<tr>
					<td class="align-right"><span class="price big">ส่วนลด (<span id="summaryDiscountPercent"><?php echo $orderSummary['discountPercent']; ?></span>%)</span></td>
					<td class="align-right" style="width: 169px;"><span class="price big" id="summaryDiscount"><?php echo $orderSummary['discount']; ?></span></td>
				<tr>
					<td class="align-right"><span class="price big">รวมหลังหักส่วนลด</span></span></td>
					<td class="align-right" style="width: 169px;"><span class="price big" id="summaryDiscount"><?php echo $orderSummary['totalPostSupplierRangeDiscount']; ?></span></td>
				</tr>
				</tr>

				<?php if(isset(Yii::app()->user->id) && Yii::app()->user->userType == 2): ?>
					<tr>
						<td class="align-right"><span class="price big">ส่วนลดตัวแทนจำหน่าย (<span id="summaryDiscountPercent"><?php echo $orderSummary['distributorDiscountPercent']; ?></span>%)</span></td>
						<td class="align-right" style="width: 169px;"><span class="price big" id="summaryDiscount"><?php echo $orderSummary['distributorDiscount']; ?></span></td>
					</tr>
					<tr>
						<td class="align-right"><span class="price big">รวมหลังหักส่วนลดตัวแทนจำหน่าย</span></span></td>
						<td class="align-right" style="width: 169px;"><span class="price big" id="summaryDiscount"><?php echo $orderSummary['totalPostDistributorDiscount']; ?></span></td>
					</tr>
				<?php endif; ?>

				<?php if(isset($orderSummary["extraDiscount"])): ?>
					<tr>
						<td class="align-right"><span class="price big">ส่วนลดพิเศษ </span></td>
						<td class="align-right" style="width: 169px;"><span class="price big" id="summaryDiscount"><?php echo $orderSummary["extraDiscount"]; ?></span></td>
					</tr>
				<?php endif; ?>

				<tr>
					<td class="align-right"><span class="price big">รวมทั้งสิ้น</span></td>
					<td class="align-right" style="width: 169px;"><span class="price big" id="summaryGrandTotal"><?php echo $orderSummary['grandTotal']; ?></span></td>
				</tr>

			</table>
		</div>
	</div>

</div>
