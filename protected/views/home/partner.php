<h2><?php echo ($partnerType == 1) ? "ORG" : "WOW"; ?></h2>

<div class="row">
	<div class="col-lg-7" style="border-right: 1px black solid">
		<?php if(isset($promotions)): ?>
			<?php
			$flag = true;
			foreach($promotions as $promotion):
				?>
				<div class="row">
					<div class="col-lg-6">
						<?php if($flag): ?>
							<img src="<?php echo Yii::app()->baseUrl . $promotion->image; ?>" class="col-lg-12" />
						<?php else: ?>
							<h3 style="font-weight: bold;text-decoration: underline"><?php echo $promotion->title; ?></h3>
							<?php echo $promotion->description; ?>
						<?php endif; ?>
					</div>
					<div class="col-lg-6">
						<?php if($flag): ?>
							<h3 style="font-weight: bold;text-decoration: underline"><?php echo $promotion->title; ?></h3>
							<?php echo $promotion->description; ?>
						<?php else: ?>
							<img src="<?php echo Yii::app()->baseUrl . $promotion->image; ?>" class="col-lg-12" />
						<?php endif; ?>
					</div>
				</div>
				<?php
				$flag = FALSE;
			endforeach;
			?>
		<?php endif; ?>
	</div>

	<div class="col-lg-5">
		<?php if(isset($error) && $error == 1): ?>
			<div class="row">
				<div class="col-lg-12 alert alert-danger" >
					ไม่สามารถเปลี่ยน WOW ได้ เนื่องจาก คุณยังไม่เคยซื้อสินค้ากับ WOW ปัจจุบัน หรือ อายุการเป็น WOW ไม่ครบ 3 เดือน
				</div>
			</div>
		<?php endif; ?>
		<div class="row  sidebar-box green">
			<div class="col-lg-12" >
				<?php
				$form = $this->beginWidget('CActiveForm', array(
					'id'=>'login-form',
					'action'=>Yii::app()->createUrl('site/login'),
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
					'htmlOptions'=>array(
//		'class'=>'form-signin',
//		'role'=>'form'
					),
				));
				?>
				<?php if(Yii::app()->user->isGuest): ?>
					<div class="sidebar-box-heading">
						<i class="icons icon-lock"></i>
						<h4>เข้าสู่ระบบ</h4>
					</div>

					<div class="sidebar-box-content sidebar-padding-box">
						<div class="row">
							<div class="col-md-12">

								<div class="row">
									<div class="col-md-12">
										<?php
										echo $form->emailField($login, 'username', array(
											'class'=>'form-control',
											'placeholder'=>'Email'));
										if(isset($_GET["code"]) && !empty($_GET["code"]))
										{
											echo CHtml::hiddenField("partnerCode", $_GET["code"]);
										}
										?>
										<?php echo $form->error($login, 'username'); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">

										<?php
										echo $form->passwordField($login, 'password', array(
											'class'=>'form-control',
											'placeholder'=>'Password'));
										?>
										<?php echo $form->error($login, 'password'); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label class="checkbox">
											<?php
											echo $form->checkbox($login, 'rememberMe', array(
												'class'=>''));
											?> Remember me
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
				<?php else: ?>
					<div class="sidebar-box-heading">
						<i class="icons icon-lock"></i>
						<h4>ท่านเป็นสมาชิกในระบบแล้ว</h4>
					</div>
					<div class="sidebar-box-content sidebar-padding-box">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<strong>ขอต้อนรับ คุณ : <?php echo Yii::app()->user->name; ?></strong>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<?php
										echo CHtml::link("<i class='fa fa-shopping-cart'></i> สั่งซื้อสินค้า", Yii::app()->createUrl("/home"), array(
											'class'=>'btn btn-success  btn-block',
											'style'=>'margin-top:20px'))
										?>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										ต้องการออกจากระบบ กด Logout ด้านบน
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<?php $this->endWidget(); ?>
			</div>
		</div>
		<?php if(Yii::app()->user->isGuest): ?>
			<div class="row sidebar-box blue">
				<div class="col-lg-12">
					<?php
					$form = $this->beginWidget('CActiveForm', array(
						'id'=>'register-form',
						'enableAjaxValidation'=>false,
						'htmlOptions'=>array(
							'enctype'=>'multipart/form-data',
							'class'=>'form-horizontal'),
					));
					?>
					<div class="sidebar-box-heading" style="margin-top: 30px">
						<i class="fa fa-file"></i>
						<h4>ลงทะเบียน</h4>
					</div>

					<div class="sidebar-box-content sidebar-padding-box">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<?php echo $form->errorSummary($user); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php
										echo $form->textField($user, 'firstname', array(
											'class'=>'form-control',
											'placeholder'=>'Firstname'));
										?>
										<?php echo $form->error($user, 'firstname'); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php
										echo $form->textField($user, 'lastname', array(
											'class'=>'form-control',
											'placeholder'=>'Lastname'));
										?>
										<?php echo $form->error($user, 'lastname'); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php
										echo $form->emailField($user, 'email', array(
											'class'=>'form-control',
											'placeholder'=>'Email'));
										?>
										<?php echo $form->error($user, 'email'); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">

										<?php
										echo $form->passwordField($user, 'password', array(
											'class'=>'form-control',
											'placeholder'=>'Password'));
										?>
										<?php echo $form->error($user, 'password'); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<button class="btn btn-lg btn-warning btn-block" type="submit">Sign in</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php $this->endWidget(); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>

