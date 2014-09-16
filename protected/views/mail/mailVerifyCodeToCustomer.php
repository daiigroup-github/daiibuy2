<html>
	<?php
	?>
	<head></head>
	<body>
		<b>บริษัท ไดอิ กรุ๊ป จำกัด มหาชน</b>

		<p>ระบบตอบรับอัตโนมัติ DaiiBuy.com</p>

		<p>เรียน คุณ <b><?php echo $name; ?></b></p>

		<p> <b>ขณะนี้สินค้าถูกส่งถึงตัวแทนกระจายสินค้าแล้ว</b></p>
		<p>กรุณาตรวจสอบข้อมูลด้านล่าง และติดต่อรับสินค้าได้ทันที</p>

		<p>เลขที่สั่งซื้อสินค้า(Order No.) : <b><?php echo $invoiceNo; ?></b></p>
		<p>รหัสยืนยันการรับสินค้า (Verify Code) : <b> <?php echo $verifyCode ?> </b> (กรุณานำรหัสไปยืนยันรับสินค้ากับตัวแทนกระจายสินค้า)</p>
		<p>ชื่อตัวแทนกระจายสินค้า : <?php echo $dealerName; ?></p>
		<p>ที่อยู่ตัวแทนผู้กระจายสินค้า : <?php echo $dealerAddress . $dealerAddress2 . $amphur . $province . $postcode; ?></p>
		<p>Email : <?php echo $email ?></p>
		<p>เบอร์โทรศัทพ์ : <?php echo $dealerPhone; ?></p>


		<p><b>กรุณากด</b> <a href="<?php echo $documentUrl . $orderID; ?>"> >>View<< </a> เพื่อตรวจสอบสถานะความคืบหน้าทางหน้าเว็บไซต์</p>

		<p>อีเมลฉบับนี้เป็นการแจ้งข้อมูลโดยอัตโนมัติ กรุณาอย่าตอบกลับ</p>
	</body>
</html>
