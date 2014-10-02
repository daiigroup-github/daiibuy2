<?php
/*
$step1Class = $step2Class = $step3Class = $step4Class = 'well well-sm';

switch ($step) {
    case 1:
        $step1Class = 'alert alert-warning';
        break;
    case 2:
        $step1Class = 'alert alert-success';
        $step2Class = 'alert alert-warning';
        break;
    case 3:
        $step1Class = $step2Class = 'alert alert-success';
        $step3Class = 'alert alert-warning';
        break;
    case 4:
        $step1Class = $step2Class = $step3Class = 'alert alert-success';
        $step4Class = 'alert alert-warning';
        break;
}
*/
?>
<?php
/*

<div class="page-content">
    <div class="row wizard">
        <div class="col-md-2 col-md-offset-1">
            <div class="col-md-10 col-md-push-1 <?php echo $step1Class;?>">Login/Register</div>
        </div>
        <div class="col-md-2">
            <div class="col-md-10 col-md-push-1 <?php echo $step2Class;?>">Billing/Shipping</div>
        </div>
        <div class="col-md-2">
            <div class="col-md-10 col-md-push-1 <?php echo $step3Class;?>">Summary</div>
        </div>
        <div class="col-md-2">
            <div class="col-md-10 col-md-push-1 <?php echo $step4Class;?>">Confirm</div>
        </div>
        <div class="col-md-2">
            <div class="col-md-10 col-md-push-1 <?php echo $step4Class;?>">Success</div>
        </div>
    </div>
</div>

*/
?>

<?php
$step1Class = $step2Class = $step3Class = $step4Class = $step5Class = 'disabled';
$line1Class = $line2Class = $line3Class = $line4Class = $line5Class = '';

switch($step) {
    case 1:
        $step1Class = 'active';
        break;
    case 2:
        $step1Class = 'success';
        $step2Class = 'active';
        $line1Class = 'passed';
        break;
    case 3:
        $step1Class = $step2Class = 'success';
        $step3Class = 'active';
        $line1Class = $line2Class = 'passed';
        break;
    case 4:
        $step1Class = $step2Class = $step3Class = 'success';
        $step4Class = 'active';
        $line1Class = $line2Class = $line3Class = 'passed';
        break;
    case 5:
        $step1Class = $step2Class = $step3Class = $step4Class = 'success';
        $step5Class = 'active';
        $line1Class = $line2Class = $line3Class = $line4Class = 'passed';
        break;
}
?>
<div class="page-content">
    <ul class="nav nav-pills nav-justified nav-wizard">
        <li class="<?php echo $step1Class;?>"><a href="#">1. Login / Register</a></li>
        <li class="line <?php echo $line1Class;?>"><span></span></li>
        <li class="<?php echo $step2Class;?>"><a href="#">2. Billing / Shipping</a></li>
        <li class="line <?php echo $line2Class;?>"><span></span></li>
        <li class="<?php echo $step3Class;?>"><a href="#">3. Summary</a></li>
        <li class="line <?php echo $line3Class;?>"><span></span></li>
        <li class="<?php echo $step4Class;?>"><a href="#">4. Confirm Payment</a></li>
        <li class="line <?php echo $line4Class;?>"><span></span></li>
        <li class="<?php echo $step5Class;?>"><a href="#">5. Thank you</a></li>
    </ul>
</div>