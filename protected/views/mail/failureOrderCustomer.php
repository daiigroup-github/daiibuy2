<html>
	<head></head>
	<body>
		<b>บริษัท ไดอิ กรุ๊ป จำกัด มหาชน</b>

		<p>ระบบตอบรับอัตโนมัติ DaiiBuy.com</p>

		<p>เรียน คุณ <b><?php echo $name; ?></b></p>

		<p> <b>การดำเนินการสั่งซื้อสินค้าล้มเหลว</b></p>
		<p>กรุณาตรวจการชำระเงินและเข้าสู่ขั้นตอนการชำระเงินใหม่อีกครั้ง</p>

		<p>เลขที่สั่งซื้อสินค้า(Order No.) : <b><?php echo $invoiceNo; ?></b></p>

		<p><b>กรุณากด</b> <a href="<?php echo $documentUrl + $orderID ?>"><?php echo $documentUrl ?></a> เพื่อตรวจสอบความถูกต้องที่หน้าเว็บไซต์</p>

		<p>ขอขอบคุณที่ใช้บริการระบบสั่งซื้อสินค้าผ่านอินเตอร์เน็ท DaiiBuy.com</p>
		<p>อีเมลฉบับนี้เป็นการแจ้งข้อมูลโดยอัตโนมัติ กรุณาอย่าตอบกลับ</p>
	</body>
</html>