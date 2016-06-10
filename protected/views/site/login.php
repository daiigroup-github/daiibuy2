<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array(
//		'class'=>'form-signin',
//		'role'=>'form'
    ),
        ));
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12" >


        <div class="sidebar-box-heading">
            <i class="icons icon-lock"></i>
            <h4>เข้าสู่ระบบ</h4>
        </div>

        <div class="sidebar-box-content sidebar-padding-box">
            <div class="row">
                <div class="col-md-6" style="border-right: 2px black solid">
                    <div class="row sidebar-box blue">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <div class="sidebar-box-heading">
                                <i class="icons icon-box-2"></i>
                                <h4>ขั้นตอนการใช้บริการ</h4>
                            </div>

                            <div class="sidebar-box-content sidebar-padding-box">
                                <div class="">
                                    <p>1. กรอก email ที่ลงทะเบียน</p>
                                    <p>2. กรอก password ที่ระบุไว้เบื้องต้น</p>
                                    <p>3. กดปุ่ม Singin เพื่อเข้าสู่ระบบ</p>
                                </div>
                                <hr>
                                <!--								<div style="font-size: small" class="alert alert-danger">
                                                                                                        <p>**หมายเหตุ</p>

                                                                                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="row">
                        <div class="col-md-12 text-danger">
                            <?php echo isset($message) ? $message : ""; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            echo $form->emailField($model, 'username', array(
                                'class' => 'form-control',
                                'placeholder' => 'Email'));
                            ?>
                            <?php echo $form->error($model, 'username'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <?php
                            echo $form->passwordField($model, 'password', array(
                                'class' => 'form-control',
                                'placeholder' => 'Password'));
                            ?>
                            <?php echo $form->error($model, 'password'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="checkbox">
                                <?php
                                echo $form->checkbox($model, 'rememberMe', array(
                                    'class' => ''));
                                ?> Remember me
                            </label>
                        </div>
                        <div class="col-md-6 text-right">
                            <label class="checkbox">
                                <a href="forgotPassword">Forgot password</a>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
