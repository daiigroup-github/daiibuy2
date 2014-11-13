

<div class="sidebar-box-content sidebar-padding-box">
                    <table class="orderinfo-table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center">ลำดับ</th>
                                <th style="text-align: center">ธนาคาร</th>
                                <th style="text-align: center">สาขา</th>
                                <th style="text-align: center">ชื่อบัญชี</th>
                                <th style="text-align: center">เลขที่บัญชี</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;
                            foreach($bankArray as $item){ ?>
                         <tr>
                            <td class="align-center"><?php echo $i; ?></td>
                            <td class="align-center"><?php echo BankName::model()->getBankNameByBankNameId($item->bankNameId); ?></td>
                            <td class="align-center"><?php echo $item->branch; ?></td>
                            <td class="align-center"><?php echo $item->accName; ?></td>
                            <td class="align-center"><?php echo $item->accNo; ?></td>
                        </tr>
                        <?php
                        $i++;
  }
                        ?>
                        </tbody>
                    </table>
  </div>