<html>
	<head></head>
	<body>
		<b>บริษัท ไดอิ กรุ๊ป จำกัด มหาชน</b>

		<p>ระบบตอบรับอัตโนมัติ DaiiBuy.com</p>

		<p>เรียน คุณ <b><?php echo $name; ?></b></p>

		<p> <b>คุณได้สมัครใช้บริการระบบสั่งซื้อสินค้าผ่านอินเตอร์เน็ท DaiiBuy.com</b></p>
		<p>โปรดตรวจสอบความถูกต้องและทำการยืนยันข้อมูลตามด้านล่าง</p>

		<p>ชื่อผู้ใช้งาน : <b><?php echo $userName; ?></b></p>
		<p>password : <b><?php echo $password ?></b></p>

		<p><b>กรุณากด</b> <a href="<?php echo "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/site/login"; ?>"><?php echo $documentUrl ?></a> เพื่อเข้าสู่ระบบ</p>

		<p>ขอขอบคุณที่ใช้บริการระบบสั่งซื้อสินค้าผ่านอินเตอร์เน็ท DaiiBuy.com</p>
		<p>อีเมลฉบับนี้เป็นการแจ้งข้อมูลโดยอัตโนมัติ กรุณาอย่าตอบกลับ</p>
	</body>
</html>
