<div class="row sidebar-box green">

    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="sidebar-box-heading">
            <i class="icons <?php echo (($order->type == Order::ORDER_TYPE_CART) ? 'fa fa-shopping-cart' : 'fa fa-file-o'); ?>"></i>
            <h4><?php echo $i . ". " . (($order->type == Order::ORDER_TYPE_CART) ? 'ตระกร้า' : "My File " . $order->title); ?></h4>
        </div>
		<?php
		$form = $this->beginWidget('CActiveForm', array(
			'id'=>'cart' . $order->orderId,
			//'enableClientValidation' => true,
			//'clientOptions' => array('validateOnSubmit' => true,),
			'htmlOptions'=>array(
				'class'=>'',
				'role'=>'form'),
		));
		?>
        <div class="sidebar-box-content sidebar-padding-box">
            <div class="category-heading" style="margin-bottom: 1px;padding-top: 15px;">
				<strong><?php echo ($order->type == Order::ORDER_TYPE_CART) ? 'ตระกร้า' : "Myfile " . $order->title; ?></strong>

                <div class="category-buttons">
					<?php
					if(($order->type & 1) == 0)
					{
						$supplier = Supplier::model()->findByPk($supplierId);
						$minValue = (isset($supplier) && $supplier->minimumOrder > 0) ? $supplier->minimumOrder : Configuration::model()->find('name = "minValueToBuy"')->value;
						echo CHtml::ajaxLink('<i class="icons fa fa-refresh"></i>', $this->createUrl('updateCart'), array(
							'data'=>'js:$("#cart' . $order->orderId . '").serialize()',
							'dataType'=>'json',
							'type'=>'POST',
							'success'=>'js:function(data){
                                //update table
                                $("#order' . $order->orderId . '").html(data.orderTotal);

                                for (var i in data.orderItem) {
                                    $("#total"+i).html(data.orderItem[i].total);
                                }
                                $("#summaryTotal").html(data.summary.total);
                                $("#summaryDiscount").html(data.summary.discount);
                                $("#summaryGrandTotal").html(data.summary.grandTotal);
                                $("#summaryDiscountPercent").html(data.summary.discountPercent);
								if(parseInt(data.summary.total.replace(",", "")) < ' . $minValue . '){
									$("#checkoutBtn").addClass("hidden");
								}else{
									$("#checkoutBtn").removeClass("hidden");
								}
                            }',
						));
					}
					?>
					<?php if($order->type == Order::ORDER_TYPE_MYFILE_TO_CART): ?><a href="<?php echo Yii::app()->createUrl("/myfile/" . $order->supplier->url . "/view/id/" . $order->orderId) ?>"><i class="icons fa fa-edit"></i></a><?php endif; ?>
                    <a href="<?php echo Yii::app()->createUrl("/checkout/cart/deleteCart/id/" . $order->orderId) ?>"><i class = "icons fa fa-times"></i></a>
				</div>
			</div>

			<table class = "orderinfo-table table-bordered">
				<tr>
					<th style="text-align:center">รหัสสินค้า</th>
					<th style="text-align:center">ชื่อสินค้า</th>
					<th style="text-align:center">จำนวน</th>
					<th style="text-align:center">ราคาต่อหน่วย</th>
					<th style="text-align:center">รวม</th>
				</tr>

				<?php $sum = 0;
				?>
				<?php
				foreach($order->orderItems as $orderItem):
					$price = ($orderItem->product->calProductPromotionPrice() != 0) ? $orderItem->product->calProductPromotionPrice() : $orderItem->product->calProductPrice();
					?>
					<tr>
						<td id="code<?php echo $orderItem->orderItemsId; ?>"><?php echo $orderItem->product->code; ?></td>
						<td id="name<?php echo $orderItem->orderItemsId; ?>"><?php echo $orderItem->title; ?></td>
						<td class="align-right" id="quantity<?php echo $orderItem->productId; ?>">
							<?php if(($order->type & Order::ORDER_TYPE_MYFILE) > 0): /* myfile */ ?>
								<?php echo number_format($orderItem->quantity); ?>
							<?php else: ?>
								<input type="number" class="form-control" value="<?php echo $orderItem->quantity; ?>" name="quantity[<?php echo $orderItem->orderItemsId; ?>]" min="0"/>
							<?php endif; ?>
						</td>
						<td class="align-right" id="price<?php echo $orderItem->orderItemsId; ?>"><?php echo number_format($price, 2); ?></td>
						<td class="align-right" id="total<?php echo $orderItem->orderItemsId; ?>"><?php echo number_format($orderItem->quantity * $price, 2); ?></td>
					</tr>
					<?php $sum += $orderItem->quantity * $price; ?>
				<?php endforeach; ?>

				<?php //summary    ?>
				<tr>
					<td class="align-right" colspan="4"><span class="price big">ยอดรวม</span></td>
					<td class="align-right"><span class="price big" id="order<?php echo $order->orderId; ?>"><?php echo number_format($sum, 2); ?></span></td>
				</tr>

			</table>
		</div>
		<?php echo CHtml::hiddenField('orderId', $order->orderId); ?>
		<?php $this->endWidget(); ?>
	</div>

</div>
