<div id="main-header">

    <div class="row">

        <div id="logo" class="col-lg-4 col-md-4 col-sm-4">
            <a href="home_v1.html"><img src="<?php echo Yii::app()->baseUrl; ?>/images/logo.png" alt="Logo"></a>
        </div>

        <nav id="middle-navigation" class="col-lg-8 col-md-8 col-sm-8">
            <ul class="pull-right">
                <?php
                /*
				<li class="blue">
					<a href="compare_products.html"><i class="icons icon-docs"></i>0 Items</a>
				</li>
                */
                ?>
                <li class="red">
                    <a href="wishlist.html"><i class="icons fa fa-heart"></i>2 Items</a>
                </li>
                <li class="blue"><a href="order_info.html"><i class="icons fa fa-shopping-cart"></i>17 Items</a>
                    <ul id="cart-dropdown" class="box-dropdown parent-arrow">
                        <li>
                            <?php $this->renderPartial('//layouts/_main_header_cart'); ?>
                        </li>
                    </ul>
                </li>
                <li class="green">
                    <a href="#" id="changeProvince">
                        <i class="icons fa fa-location-arrow"></i><span id="province"
                                                                 style="font-size: 8pt;"><?php echo isset($this->province) ? $this->province : ''; ?></span>
                    </a>
                </li>
                <?php
                /*
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
                */
                ?>
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