<div id="main-header">

	<div class="row">

		<div id="logo" class="col-lg-4 col-md-4 col-sm-4">
			<a href="home_v1.html"><img src="<?php echo Yii::app()->baseUrl;?>/images/logo.png" alt="Logo"></a>
		</div>

		<nav id="middle-navigation" class="col-lg-8 col-md-8 col-sm-8">
			<ul class="pull-right">
				<li class="blue">
					<a href="compare_products.html"><i class="icons icon-docs"></i>0 Items</a>
				</li>
				<li class="red">
					<a href="wishlist.html"><i class="icons icon-heart-empty"></i>2 Items</a>
				</li>
				<li class="orange"><a href="order_info.html"><i class="icons icon-basket-2"></i>17 Items</a>
					<ul id="cart-dropdown" class="box-dropdown parent-arrow">
						<li>
							<div class="box-wrapper parent-border">
								<p>Recently added item(s)</p>

								<table class="cart-table">
									<tr>
										<td><img src="img/products/sample1.jpg" alt="product"></td>
										<td>
											<h6>Lorem ipsum dolor</h6>

											<p>Product code PSBJ3</p>
										</td>
										<td>
											<span class="quantity"><span class="light">1 x</span> $79.00</span>
											<a href="#" class="parent-color">Remove</a>
										</td>
									</tr>
									<tr>
										<td><img src="img/products/sample1.jpg" alt="product"></td>
										<td>
											<h6>Lorem ipsum dolor</h6>

											<p>Product code PSBJ3</p>
										</td>
										<td>
											<span class="quantity"><span class="light">1 x</span> $79.00</span>
											<a href="#" class="parent-color">Remove</a>
										</td>
									</tr>
									<tr>
										<td><img src="img/products/sample1.jpg" alt="product"></td>
										<td>
											<h6>Lorem ipsum dolor</h6>

											<p>Product code PSBJ3</p>
										</td>
										<td>
											<span class="quantity"><span class="light">1 x</span> $79.00</span>
											<a href="#" class="parent-color">Remove</a>
										</td>
									</tr>
								</table>

								<br class="clearfix">
							</div>

							<div class="footer">
								<table class="checkout-table pull-right">
									<tr>
										<td class="align-right">Tax:</td>
										<td>$0.00</td>
									</tr>
									<tr>
										<td class="align-right">Discount:</td>
										<td>$37.00</td>
									</tr>
									<tr>
										<td class="align-right"><strong>Total:</strong></td>
										<td><strong class="parent-color">$999.00</strong></td>
									</tr>
								</table>
							</div>

							<div class="box-wrapper no-border">
								<a class="button pull-right parent-background" href="#">Checkout</a>
								<a class="button pull-right" href="order_info.html">View Cart</a>
							</div>
						</li>
					</ul>
				</li>
				<li class="green">
					<a href="#" id="changeProvince">
						<i class="icons icon-location"></i><span id="province" style="font-size: 8pt;"><?php echo isset($this->province) ? $this->province : '';?></span>
					</a>
				</li>
				<li><a href="#"><i class="icons icon-dollar"></i>US Dollar</a>
					<ul class="box-dropdown parent-arrow">
						<li>
							<div class="box-wrapper no-padding parent-border">
								<table class="currency-table">
									<tr>
										<td><a href="#">$ US Dollar</a></td>
									</tr>
									<tr>
										<td><a href="#">€ Euro</a></td>
									</tr>
									<tr>
										<td><a href="#">£ Pound</a></td>
									</tr>
								</table>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</nav>

	</div>

</div>

<?php Yii::app()->clientScript->registerScript('changeProvince', "
	$('#changeProvince').live('click', function(){
		$('#selectProvinceModal').modal({
			backdrop: 'static',
			keyboard: false,
			show : true
		});
	});
");?>