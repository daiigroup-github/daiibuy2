<html>
    <head></head>
    <body>
        <b>บริษัทไดอิ กรุ๊ป จำกัด มหาชน</b>

        <p>ระบบตอบรับอัตโนมัติ DaiiBuy.com</p>

        <p>เรียน คุณ <b><?php echo $name; ?></b></p>

        <p> <b>ระบบได้ทำการ Reset Password ใหม่ให้คุณแล้ว</b></p>
        <p>Password ใหม่ของคุณคือ : <b><?php echo $password; ?></b></p>

        <?php
        //throw new Exception($name);
        ?>
        <p><b>กรุณากด</b> <a href="<?php echo $documentUrl ?>"> เข้าสู่ระบบ </a>  เพื่อเข้าสู่ระบบ และ เปลี่ยนระหัสผ่านใหม่</p>

        <p>ขอขอบคุณที่ใช้บริการระบบสั่งซื้อสินค้าผ่านอินเตอร์เน็ท DaiiBuy.com</p>
        <p>อีเมลฉบับนี้เป็นการแจ้งข้อมูลโดยอัตโนมัติ กรุณาอย่าตอบกลับ</p>
    </body>
</html>
