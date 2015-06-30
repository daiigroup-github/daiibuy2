<div class="row">
	<div class="col-lg-12">

		<?php $supplierContent = SupplierContentGroup::model()->find("title= 'condition_furniture' AND supplierId= 4"); ?>
		<?php if(isset($supplierContent)): ?>
			<?php echo $supplierContent->description; ?>
		<?php else: ?>
			<h2>เงื่อนไขและข้อตกลง</h2>
			<p>1. หลังจากการสั่งซื้อ เฟอร์นิเจอร์และชำระเงินเรียบร้อยแล้ว บริษัท ฯ จะเข้าดำเนินการติดตั้งหลังจากการก่อสร้างงานงวดที่ 4 แล้วเสร็จ 1 วัน</p>
			<p>2. ระบะเวลาในการติดตั้ง 30 วัน</p>
		<?php endif; ?>
		<br>


	</div>
</div>
<div class="row">
	<div class="col-lg-12 text-center">
		<input type="radio" name="accept" id="acceptAgreement" value="1" />
		<label class="radio-label" for="acceptAgreement"> ฉันได้อ่านขอตกลงและยอมเงื่อนไขแล้ว</label>
	</div>
</div>
<div class="row wizard-control">
	<div class="pull-right">
		<!--<a id="backToStep3" class="btn btn-primary btn-lg" href="<?php // echo Yii::app()->createUrl("/myfile/madrid/backTo3/id/$model->orderGroupId")                                    ?>"><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</a>-->
		<a id="furniture4Back" class="btn btn-primary btn-lg" ><i class="glyphicon glyphicon-chevron-left"></i> กลับ</a>
		<a id="furniture4Next" class="btn btn-success btn-lg" ><i class="glyphicon glyphicon-chevron-right"></i> ยืนยันการสั่งซื้อ</a>
	</div>
</div>