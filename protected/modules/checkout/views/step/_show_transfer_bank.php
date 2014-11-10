 
<div class="sidebar-box-heading">
                    <i class="icons icon-box-2"></i>
                    <h4>ธนาคาร</h4>
                </div>
<div class="sidebar-box-content sidebar-padding-box">
                    <table class="orderinfo-table table-bordered">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ธนาคาร</th>
                                <th>สาขา</th>
                                <th>ชื่อบัญชี</th>
                                <th>เลขที่บัญชี</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;
                            foreach($bankModelArray as $item){ ?>
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