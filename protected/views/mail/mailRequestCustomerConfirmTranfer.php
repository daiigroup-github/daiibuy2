<html>
	<head></head>
	<body>
		<b>บริษัท ไดอิ กรุ๊ป จำกัด มหาชน</b>

		<p>ระบบตอบรับอัตโนมัติ DaiiBuy.com</p>

		<p>เรียน คุณ <b><?php echo $name; ?></b></p>

		<p> <b>คุณได้ทำการสั่งซื้อสินค้า!!</b></p>
		<p>กรุณาตรวจสอบเลขที่สั่งซื้อด้านล่าง</p>

		<p>เลขที่สั่งซื้อสินค้า(Order No.) : <b><?php echo $invoiceNo; ?></b></p>
		<p>ใบสั่งซื้อสินค้านี้มีอายุการใช้งาน 3 วัน กรุณาโอนเงินก่อนเวลาดังกล่าว </p>

		<p><b>กรุณากด</b> <a href="<?php echo $documentUrl; ?>"> >>View<< </a> เพื่อตรวจสอบความถูกต้อง และจำนวนเงินที่ต้องโอนเพื่อสำระค่าสินค้าที่หน้าเว็บไซต์</p>

		<?php if(isset($bankList)): ?>
			<p>ลูกค้า สามารถโอนเงินมาทางบัญชีของ บริษัท จากรายการด้านล่างดังนี้</p>
			<table style="width: 80%;" border="1" >
				<thead>
				<th>ธนาคาร</th>
				<th>เลขที่บัญชี</th>
				<th>ชื่อบัญชี</th>
				<th>ประเภทบัญชี</th>
				<th>สาขา</th>
			</thead>
			<tbody>
				<?php
				foreach($bankList as $bank):
					$bankNameModel = BankName::model()->find("bankNameId = " . $bank->bankNameId);
					?>
					<tr>
						<td><?php echo $bankNameModel->title ?></td>
						<td><?php echo $bank->accNo ?></td>
						<td><?php echo $bank->accName ?></td>
						<td><?php echo $bank->accType ?></td>
						<td><?php echo $bank->branch ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
	<p><strong>หลังจากโอนเงินเรียบร้อยแล้วกรุณา นำใบเสร็จ กลับมายืนยันที่ <a href="<?php echo $documentUrl; ?>"> >>ยืนยันชำระเงิน<< </a></strong></p>


	<p>ขอขอบคุณที่ใช้บริการระบบสั่งซื้อสินค้าผ่านอินเตอร์เน็ท DaiiBuy.com</p>
	<p>อีเมลฉบับนี้เป็นการแจ้งข้อมูลโดยอัตโนมัติ กรุณาอย่าตอบกลับ</p>
</body>
</html>
