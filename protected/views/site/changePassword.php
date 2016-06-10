<form method="POST">
    <div class="div-white col-lg-8 text-center">
        <?php
        if (isset($messege)) {
            echo "<font color='red'>" . $messege . "</font>";
        }
        ?>
        <table class="table-condensed  col-lg-12">
            <tr><td colspan="3" align="center"><b><h1>Change Password</h1></b></td</tr>
            <tr><td> <input type="password" class="form-control"  placeholder=" Old Password" name="password" required></td></tr>
            <tr><td> <input type="password" class="form-control"  placeholder=" New Password" name="newPassword" required></td></tr>
            <tr><td> <input type="password" class="form-control"  placeholder=" Confirm New Password" name="confirmNewPassword" required></td></tr>
            <tr><td align="left"><button class="btn btn-lg btn-primary btn-block" type="submit">ยืนยันรหัสผ่าน</button></td></tr>
        </table>
    </div>
</form>
