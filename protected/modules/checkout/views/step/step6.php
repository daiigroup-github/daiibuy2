<div class="row sidebar-box blue">

	<div class="col-lg-12 col-md-12 col-sm-12">

		<div class="sidebar-box-heading">
			<i class="icons icon-box-2"></i>
			<h4>ขอบคุณที่สั่งซื้อสินค้าผ่านระบบสั่งซื้อสินค้าออนไลน์ www.daiibuy.com</h4>
		</div>

		<div>
			<?php
			$this->renderPartial('_show_transfer_bank', array('bankArray' => $bankArray)); ?>
		</div>

		<div class="sidebar-box-content sidebar-padding-box">
			<div class="row">
				<div class="col-md-12 text-center">
					<h2>ขอบคุณที่ใช้บริการ</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<?php
								echo CHtml::link('<i class="icon-folder-close icon-white"></i> การจัดการสั่งซื้อสินค้า', Yii::app()->createUrl("order"), array(
									'class'=>'btn btn-info',));
								?>
								<?php
								echo CHtml::link('<i class="icon-home icon-white"></i> กลับสู่หน้าหลัก', Yii::app()->homeUrl, array(
									'class'=>'btn btn-primary',));
								?>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>

</div>

