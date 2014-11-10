<div class="row sidebar-box green">

    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="sidebar-box-heading">
            <i class="icons <?php echo ($order->type == Order::ORDER_TYPE_CART) ? 'fa fa-shopping-cart' : 'fa fa-file-o'; ?>"></i>
            <h4><?php echo ($order->type == Order::ORDER_TYPE_CART) ? 'Cart' : $order->title; ?></h4>
        </div>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'cart'.$order->orderId,
            //'enableClientValidation' => true,
            //'clientOptions' => array('validateOnSubmit' => true,),
            'htmlOptions' => array('class' => '', 'role' => 'form'),
        ));
        ?>
        <div class="sidebar-box-content sidebar-padding-box">
            <div class="category-heading" style="margin-bottom: 1px;padding-top: 15px;">
                    <strong><?php echo ($order->type == Order::ORDER_TYPE_CART) ? 'Cart' : $order->title; ?></strong>

<!--                <div class="category-buttons">
                    <?php
//                    if (($order->type & 1) == 0) {
//                        echo CHtml::ajaxLink('<i class="icons fa fa-refresh"></i>', $this->createUrl('updateCart'), array(
//                            'data'=>'js:$("#cart'.$order->orderId.'").serialize()',
//                            'dataType'=>'json',
//                            'type'=>'POST',
//                            'success'=>'js:function(data){
//                                //update table
//                                $("#order'.$order->orderId.'").html(data.orderTotal);
//
//                                for (var i in data.orderItem) {
//                                    $("#total"+i).html(data.orderItem[i].total);
//                                }
//
//                                $("#summaryTotal").html(data.summary.total);
//                                $("#summaryDiscount").html(data.summary.discount);
//                                $("#summaryGrandTotal").html(data.summary.grandTotal);
//                                $("#summaryDiscountPercent").html(data.summary.discountPercent);
//                            }',
//                        ));
//                    }
                    ?>
                    <a href="category_v1.html"><i class="icons fa fa-edit"></i></a>
                    <a href="category_v2.html"><i class="icons fa fa-times"></i></a>
                </div>-->
            </div>

            <table class="orderinfo-table table-bordered">
                <tr>
                    <th>Code</th>
                    <th>Product name</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>

                <?php $sum = 0; ?>
                <?php foreach ($order->orderItems as $orderItem): ?>
                    <tr>
                        <td id="code<?php echo $orderItem->orderItemsId;?>"><?php echo $orderItem->product->code .' '. $orderItem->productId; ?></td>
                        <td id="name<?php echo $orderItem->orderItemsId;?>"><?php echo $orderItem->product->name; ?></td>
                        <td class="align-right" id="quantity<?php echo $orderItem->productId;?>">
                            <?php if (($order->type & Order::ORDER_TYPE_MYFILE) > 0): /*myfile*/ ?>
                                <?php echo number_format($orderItem->quantity); ?>
                            <?php else: ?>
                                <input type="number" class="form-control" value="<?php echo $orderItem->quantity; ?>" name="quantity[<?php echo $orderItem->orderItemsId;?>]" min="0"/>
                            <?php endif; ?>
                        </td>
                        <td class="align-right" id="price<?php echo $orderItem->orderItemsId;?>"><?php echo number_format($orderItem->price, 2); ?></td>
                        <td class="align-right" id="total<?php echo $orderItem->orderItemsId;?>"><?php echo number_format($orderItem->quantity * $orderItem->price, 2); ?></td>
                    </tr>
                    <?php $sum += $orderItem->quantity * $orderItem->price; ?>
                <?php endforeach; ?>

                <?php //summary?>
                <tr>
                    <td class="align-right" colspan="4"><span class="price big">Sub Total(Baht)</span></td>
                    <td class="align-right"><span class="price big" id="order<?php echo $order->orderId;?>"><?php echo number_format($sum, 2); ?></span></td>
                </tr>

            </table>
        </div>
        <?php echo CHtml::hiddenField('orderId', $order->orderId);?>
        <?php $this->endWidget(); ?>
    </div>

</div>
