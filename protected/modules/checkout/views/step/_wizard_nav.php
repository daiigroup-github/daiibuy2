<?php
$step1Class = $step2Class = $step3Class = $step4Class = 'well';

switch($step) {
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
?>
<div class="page-content">
    <div class="row wizard">
        <div class="col-md-3">
            <div class="col-md-10 col-md-push-1 <?php echo $step1Class;?>">Step 1</div>
        </div>
        <div class="col-md-3">
            <div class="col-md-10 col-md-push-1 <?php echo $step2Class;?>">Step 2</div>
        </div>
        <div class="col-md-3">
            <div class="col-md-10 col-md-push-1 <?php echo $step3Class;?>">Step 3</div>
        </div>
        <div class="col-md-3">
            <div class="col-md-10 col-md-push-1 <?php echo $step4Class;?>">Step 4</div>
        </div>
    </div>
</div>