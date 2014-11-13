<?php
$this->renderPartial('_step_header', array(
	'step'=>$step));
?>

<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="carousel-heading no-margin">
            <h4>Order Information</h4>

            <div class="carousel-arrows">
                <a href="#"><i class="icons icon-reply"></i></a>
            </div>
        </div>

        <table class="orderinfo-table">

            <tbody>
<!--            <tr>
                <th>Order number</th>
                <td>21512512</td>
            </tr>

            <tr>
                <th>Order date</th>
                <td>2013-07-12</td>
            </tr>

            <tr>
                <th>Order status</th>
                <td>Confirmed by shopper</td>
            </tr>

            <tr>
                <th>Last updated</th>
                <td>2013-07-12</td>
            </tr>

            <tr>
                <th>Shipment</th>
                <td>--</td>
            </tr>

            <tr>
                <th>Comment</th>
                <td>Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer
                    adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus
                    eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna.
                </td>
            </tr>-->

<!--            <tr>
                <th>Payment</th>
                <td>PayPal</td>
            </tr>-->

                <tr>
                    <th>Supplier Name</th>
                    <td><?php echo $supplierName; ?></td>
                </tr>

				<tr>
					<th>ราคาขายที่จังหวัด</th>
					<?php $province = Province::model()->findByPk($this->cookie->provinceId); ?>
					<td><span class="price"><?php echo $province->provinceName; ?> </span></td>
				</tr>
				<tr>
					<th>Total(Baht)</th>
					<td><span class="price"><?php echo $orderSummary['grandTotal']; ?> </span></td>
				</tr>

            </tbody>
        </table>

    </div>

</div>

<div class="row">

    <div class="col-lg-6 col-md-6 col-sm-6">

        <div class="carousel-heading no-margin">
            <h4>Bill to</h4>
        </div>

        <table class="orderinfo-table">

            <tbody>
				<tr>
					<th>Email</th>
					<td><?php echo $userModel->email; ?></td>
				</tr>

				<tr>
					<th>Company name</th>
					<td><?php echo isset($billingAddress->company) ? $billingAddress->company : "-"; ?></td>
				</tr>

				<tr>
					<th>Title</th>
					<td>Mr./Miss.</td>
				</tr>

				<tr>
					<th>First name</th>
					<td><?php echo $billingAddress->firstname; ?></td>
				</tr>

				<tr>
					<th>Last name</th>
					<td><?php
						echo $billingAddress->lastname;
						;
						?></td>
				</tr>

				<tr>
					<th>Address</th>
					<td><?php echo $billingAddress->address_1; ?></td>
				</tr>

				<tr>
					<th>District</th>
					<td><?php echo District::model()->getDistrictNameById($billingAddress->districtId); ?></td>
				</tr>

				<tr>
					<th>Amphur</th>
					<td><?php echo Amphur::model()->getAmphurNameById($billingAddress->amphurId); ?></td>
				</tr>

				<tr>
					<th>Province</th>
					<td><?php echo Province::model()->getProvinceNameById($billingAddress->provinceId); ?></td>
				</tr>

				<tr>
					<th>ZIP / Postal code</th>
					<td><?php echo $billingAddress->postcode; ?></td>
				</tr>

				<tr>
					<th>Phone</th>
					<td><?php echo $userModel->telephone; ?></td>
				</tr>

            </tbody>
        </table>

    </div>

    <div class="col-lg-6 col-md-6 col-sm-6">

        <div class="carousel-heading no-margin">
            <h4>Ship to</h4>
        </div>

        <table class="orderinfo-table">

            <tbody>
				<tr>
					<th>Company name</th>
					<td><?php echo isset($shippingAddress->company) ? $shippingAddress->company : "-"; ?></td>
				</tr>

				<tr>
					<th>First name</th>
					<td><?php echo $shippingAddress->firstname; ?></td>
				</tr>

				<tr>
					<th>Last name</th>
					<td><?php echo $shippingAddress->lastname; ?></td>
				</tr>

				<tr>
					<th>Address</th>
					<td><?php echo $shippingAddress->address_1; ?></td>
				</tr>

				<tr>
					<th>District</th>
					<td><?php echo District::model()->getDistrictNameById($shippingAddress->districtId); ?></td>
				</tr>

				<tr>
					<th>Amphur</th>
					<td><?php echo Amphur::model()->getAmphurNameById($shippingAddress->amphurId); ?></td>
				</tr>

				<tr>
					<th>Province</th>
					<td><?php echo Province::model()->getProvinceNameById($shippingAddress->provinceId); ?></td>
				</tr>

				<tr>
					<th>ZIP / Postal code</th>
					<td><?php echo $shippingAddress->postcode; ?></td>
				</tr>

				<tr>
					<th>Phone</th>
					<td><?php echo $userModel->telephone; ?></td>
				</tr>

            </tbody>
        </table>

    </div>
</div>

<div class="row">
    <div class="col-md-12 register-account">
        <div class="carousel-heading">
            <h4>Order Summary</h4>
        </div>

		<!--        <div class="row sidebar-box green">

					<div class="col-lg-12 col-md-12 col-sm-12">

						<div class="sidebar-box-heading">
							<i class="icons icon-box-2"></i>
							<h4>Other</h4>
						</div>

						<div class="sidebar-box-content sidebar-padding-box">
							<div class="category-heading" style="margin-bottom: 1px;padding-top: 15px;">
								<strong>Tile</strong>

								<div class="category-buttons">
									<a href="category_v1.html"><i class="icons fa fa-refresh"></i></a> <a
										href="category_v1.html"><i class="icons fa fa-edit"></i></a>
									<a href="category_v2.html"><i class="icons fa fa-times"></i></a>
								</div>
							</div>

							<table class="orderinfo-table table-bordered">

								<tbody>
								<tr>
									<th>Code</th>
									<th>Product name</th>
									<th>Qty</th>
									<th>Unit Price</th>
									<th>Total</th>
								</tr>

								<tr>
									<td>754714</td>
									<td>f70df8ca72</td>
									<td class="align-right">
										33
									</td>
									<td class="align-right">7,024.00</td>
									<td class="align-right">231,792.00</td>
								</tr>
								<tr>
									<td>120560</td>
									<td>4f71ba488c</td>
									<td class="align-right">
										98
									</td>
									<td class="align-right">6,631.00</td>
									<td class="align-right">649,838.00</td>
								</tr>
								<tr>
									<td>191364</td>
									<td>bdb935b678</td>
									<td class="align-right">
										65
									</td>
									<td class="align-right">5,194.00</td>
									<td class="align-right">337,610.00</td>
								</tr>
								<tr>
									<td>300320</td>
									<td>46d89c010b</td>
									<td class="align-right">
										92
									</td>
									<td class="align-right">4,761.00</td>
									<td class="align-right">438,012.00</td>
								</tr>

								<tr>
									<td class="align-right" colspan="4"><span class="price big">Sub Total</span></td>
									<td class="align-right"><span class="price big">1,657,252.00</span>
									</td>
								</tr>

								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="row sidebar-box green">

					<div class="col-lg-12 col-md-12 col-sm-12">

						<div class="sidebar-box-heading">
							<i class="icons icon-box-2"></i>
							<h4>WC1</h4>
						</div>

						<form>
							<div class="sidebar-box-content sidebar-padding-box">
								<div class="category-heading" style="margin-bottom: 1px;padding-top: 15px;">
									<strong>Tile</strong>

									<div class="category-buttons">
										<a href="category_v1.html"><i class="icons fa fa-edit"></i></a>
										<a href="category_v2.html"><i class="icons fa fa-times"></i></a>
									</div>
								</div>

								<table class="orderinfo-table table-bordered">

									<tbody><tr>
										<th>Code</th>
										<th>Product name</th>
										<th>Qty</th>
										<th>Unit Price</th>
										<th>Total</th>
									</tr>

									<tr>
										<td>322573</td>
										<td>89915e6eb2</td>
										<td class="align-right">4.00</td>
										<td class="align-right">7,592.00</td>
										<td class="align-right">30,368.00</td>
									</tr>
									<tr>
										<td>337482</td>
										<td>6e10b5c794</td>
										<td class="align-right">39.00</td>
										<td class="align-right">7,020.00</td>
										<td class="align-right">273,780.00</td>
									</tr>
									<tr>
										<td>862675</td>
										<td>766c00c1bd</td>
										<td class="align-right">23.00</td>
										<td class="align-right">9,870.00</td>
										<td class="align-right">227,010.00</td>
									</tr>
									<tr>
										<td>578676</td>
										<td>dae0505c17</td>
										<td class="align-right">4.00</td>
										<td class="align-right">5,634.00</td>
										<td class="align-right">22,536.00</td>
									</tr>

									<tr>
										<td class="align-right" colspan="4"><span class="price big">Sub Total</span></td>
										<td class="align-right"><span class="price big">553,694.00</span>
										</td>
									</tr>

									</tbody></table>
							</div>
						</form>
						<form>
							<div class="sidebar-box-content sidebar-padding-box">
								<div class="category-heading" style="margin-bottom: 1px;padding-top: 15px;">
									<strong>Sanitary</strong>

									<div class="category-buttons">
										<a href="category_v1.html"><i class="icons fa fa-edit"></i></a>
										<a href="category_v2.html"><i class="icons fa fa-times"></i></a>
									</div>
								</div>

								<table class="orderinfo-table table-bordered">

									<tbody><tr>
										<th>Code</th>
										<th>Product name</th>
										<th>Qty</th>
										<th>Unit Price</th>
										<th>Total</th>
									</tr>

									<tr>
										<td>305122</td>
										<td>8cf1f83bf4</td>
										<td class="align-right">7.00</td>
										<td class="align-right">2,588.00</td>
										<td class="align-right">18,116.00</td>
									</tr>
									<tr>
										<td>249079</td>
										<td>f24337b797</td>
										<td class="align-right">44.00</td>
										<td class="align-right">4,960.00</td>
										<td class="align-right">218,240.00</td>
									</tr>
									<tr>
										<td>308786</td>
										<td>c173d7dfb4</td>
										<td class="align-right">72.00</td>
										<td class="align-right">3,380.00</td>
										<td class="align-right">243,360.00</td>
									</tr>
									<tr>
										<td>349870</td>
										<td>641dbf4f3f</td>
										<td class="align-right">75.00</td>
										<td class="align-right">1,852.00</td>
										<td class="align-right">138,900.00</td>
									</tr>

									<tr>
										<td class="align-right" colspan="4"><span class="price big">Sub Total</span></td>
										<td class="align-right"><span class="price big">618,616.00</span>
										</td>
									</tr>

									</tbody></table>
							</div>
						</form>
					</div>

				</div>-->

		<?php
		foreach($orders as $order)
		{
			$this->renderPartial('_order_info', array(
				'order'=>$order));
		}
		?>
		<?php
		$this->renderPartial('_order_info_summary', array(
			'orderSummary'=>$orderSummary));
		?>
    </div>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
			<?php
			echo CHtml::link('&lt; Back', 'javascript:window.history.back();', array(
				'class'=>'button orange',
				'name'=>'Register'));
			?>
			<?php
			echo CHtml::link('Next &gt;', $this->createUrl(4), array(
				'class'=>'button green pull-right'));
			?>
			<?php //echo CHtml::submitButton('Check out', array('class'=>'big green pull-right', 'name'=>'checkout'));   ?>
        </div>
    </div>
</div>