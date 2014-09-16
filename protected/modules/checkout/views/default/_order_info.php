<div class="row sidebar-box green">

    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="sidebar-box-heading">
            <i class="icons icon-box-2"></i>
            <h4><?php echo $cart['title']; ?></h4>
        </div>

        <?php foreach ($cart['items'] as $cartItem): ?>
            <form>
            <div class="sidebar-box-content sidebar-padding-box">
                <div class="category-heading" style="margin-bottom: 1px;padding-top: 15px;">
                    <strong><?php echo $cartItem['title']; ?></strong>

                    <div class="category-buttons">
                        <?php
                        if(($cart['type']&1) == 0) {
                            echo '<a href="category_v1.html"><i class="icons fa fa-refresh"></i></a>';
                        }
                        ?>
                        <a href="category_v1.html"><i class="icons fa fa-edit"></i></a>
                        <a href="category_v2.html"><i class="icons fa fa-times"></i></a>
                    </div>
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
                    <?php foreach ($cartItem['items'] as $item): ?>
                        <tr>
                            <td><?php echo $item['code']; ?></td>
                            <td><?php echo $item['name']; ?></td>
                            <?php if (($cart['type'] & 1) > 0): /*myfile*/ ?>
                                <td class="align-right"><?php echo number_format($item['qty'], 2); ?></td>
                            <?php else: ?>
                                <td class="align-right">
                                    <input type="number" class="form-control" value="<?php echo $item['qty'];?>" min="0" />
                                    <?php
                                    /*
                                    <div class="numeric-input full-width">
                                        <input type="text" value="<?php echo $item['qty'];?>" name="l" class="form-control"/>
                                        <span class="arrow-up"><i class="icons icon-up-dir"></i></span>
                                        <span class="arrow-down"><i class="icons icon-down-dir"></i></span>
                                    </div>
                                    */
                                    ?>
                                </td>
                            <?php endif; ?>
                            <td class="align-right"><?php echo number_format($item['unitPrice'], 2); ?></td>
                            <td class="align-right"><?php echo number_format($item['qty'] * $item['unitPrice'], 2); ?></td>
                        </tr>
                        <?php $sum += $item['qty'] * $item['unitPrice']; ?>
                    <?php endforeach; ?>

                    <?php //summary?>
                    <tr>
                        <td class="align-right" colspan="4"><span class="price big">Sub Total</span></td>
                        <td class="align-right"><span class="price big"><?php echo number_format($sum, 2); ?></span>
                        </td>
                    </tr>

                </table>
            </div>
            </form>
        <?php endforeach; ?>
    </div>

</div>
