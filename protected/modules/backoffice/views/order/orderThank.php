<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="form">
	<h3>ขอบคุณที่ใช้บริการ</h3>
	<div class="hero-unit">
		<?php
		if($paymentMethod == 1)
		{
			?>
			<?php
		}
		else
		{
			?>
			<p>ระบบทำการส่งอีเมล์ให้คุณแล้ว กรุณา ตรวจสอบและโอนเงินค่าสินค้า แล้วนำใบเสร็จกลับมายืนยันผ่านทาง Link  อีเมล์ที่ได้รับ ภายใน 3 วัน <br>ขอบพระคุณลูกค้าทุกท่าน และหวังว่าจะได้ให้บริการอีกครั้ง</p>
			<?php
		}
		?>
		<div class="row-fluid text-center">
			<div class="span12">
				<div class="btn-group">
					<?php
					echo CHtml::link("กลับสู่หน้าหลัก", Yii::app()->createUrl(''), array(
						'class'=>'btn btn-warning'));
					?>
					<?php if(sizeof($daiibuy->order) || sizeof($daiibuy->cart)): ?>
						<?php // echo CHtml::link("<i class='icon-shopping-cart icon-white'></i> ดูตะกร้าสินค้า", Yii::app()->createUrl('order/viewCart'), array('class' => 'btn btn-success'));    ?>
						<div class="btn-group">
							<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
								<i class='icon-shopping-cart icon-white'></i> ดูตะกร้าสินค้า
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu" >
								<?php
								foreach($daiibuy->cart as $supplierId=> $items)
								{
									$supplierModel = User::model()->findByPk($supplierId);
									$sumQuantity = 0;
									foreach($items as $productId=> $qty)
									{
										$sumQuantity += $qty;
									}
									?>
									<li><a href="<?php echo Yii::app()->createUrl("order/viewCart/id/" . $supplierId) ?>"><?php echo isset($supplierModel->businessAddress->company) ? "<h4>" . $supplierModel->businessAddress->company . "</h4>" . " จำนวน " . $sumQuantity . " ชิ้น" : "<h4>" . $supplierModel->firstname . " " . $supplierModel->lastname . "</h4>" . " จำนวน " . $sumQuantity . " ชิ้น"; ?></a></li>
									<?php
								}
								?>
							</ul>
						</div>
					<?php endif; ?>
					<?php
					echo CHtml::link("จัดการรายการสั่งซื้อสินค้า", Yii::app()->createUrl("order"), array(
						'class'=>'btn btn-primary'));
					?>
				</div>
			</div>
		</div>

	</div>
</div>
