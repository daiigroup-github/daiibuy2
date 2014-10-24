<div class="row sidebar-box blue">

	<div class="col-lg-12 col-md-12 col-sm-12">

		<div class="sidebar-box-heading">
			<i class="icons icon-box-2"></i>
			<h4>Summary</h4>
		</div>

		<div class="sidebar-box-content sidebar-padding-box">

			<table class="orderinfo-table table-bordered">

				<tr>
					<td class="align-right"><span class="price big">Total</span></td>
					<td class="align-right" style="width: 169px;"><span class="price big" id="summaryTotal"><?php echo $orderSummary['total'];?></span></td>
				</tr>

				<tr>
					<td class="align-right"><span class="price big">Discount (<span id="summaryDiscountPercent"><?php echo $orderSummary['discountPercent'];?></span>%)</span></td>
					<td class="align-right" style="width: 169px;"><span class="price big" id="summaryDiscount"><?php echo $orderSummary['discount'];?></span></td>
				</tr>

				<tr>
					<td class="align-right"><span class="price big">Grand Total</span></td>
					<td class="align-right" style="width: 169px;"><span class="price big" id="summaryGrandTotal"><?php echo $orderSummary['grandTotal'];?></span></td>
				</tr>

			</table>
		</div>
	</div>

</div>
