
<form method="POST">
    <div class="div-white col-lg-8 text-center">
        <?php
        if (isset($messege)) {
            echo "<font color='red'>" . $messege . "</font>";
        }
        ?>
        <table class="table-condensed  col-lg-12">
            <tr><td colspan="3" align="center"><b><h1>Forgot Password</h1></b></td</tr>
            <tr><td> <input type="text" class="form-control" width="200px;" placeholder=" E - mail" name="email"></td></tr>
            <tr><td align="left"><button class="btn btn-lg btn-primary btn-block" type="submit">รับรหัสผ่านใหม่</button></td></tr>
        </table>
    </div>
</form>