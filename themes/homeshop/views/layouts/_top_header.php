<div id="top-header">

	<div class="row">

		<nav id="top-navigation" class="col-lg-7 col-md-7 col-sm-7">
			<ul class="pull-left">
				<?php if(isset(Yii::app()->user->id)): ?>
					<!--					<li><a href="create_an_account.html">My Account</a></li>
										<li><a href="orders_list.html">List Order</a></li>
										<li><a href="order_info.html">Checkout</a></li>-->
				<?php endif; ?>
				<?php
				$contentMenu = Content::model()->find("type = 3 AND parentId = 0");
				foreach($contentMenu->childs as $content):
					?>
					<li><a href="<?php echo Yii::app()->createUrl("/content/view/id/" . $content->contentId) ?>"><?php echo $content->title; ?></a></li>
					<!--<li><a href="contact.html">Contact</a></li>-->
				<?php endforeach; ?>
			</ul>
		</nav>

		<nav class="col-lg-5 col-md-5 col-sm-5">
			<ul class="pull-right">
				<?php if(!isset(Yii::app()->user->id)): ?>
					<li class="purple"><a href="<?php echo Yii::app()->createUrl("site/login") ?>"><i class="icons icon-user-3"></i> Login</a></li>
			<!--					<li class="purple"><a href="#"><i class="icons icon-user-3"></i> Login</a>
									<ul id="login-dropdown" class="box-dropdown">
										<li>
											<div class="box-wrapper">
												<h4>LOGIN</h4>
												<form id="login-form" >
													<div class="iconic-input">
														<input name="LoginForm[username]" type="text" class="form-control" placeholder="Username">
														<i class="icons icon-user-3"></i>
													</div>
													<div class="iconic-input">
														<input name="LoginForm[password]" type="password" class="form-control" placeholder="Password">
														<i class="icons icon-lock"></i>
													</div>
													<input type="checkbox" id="loginremember">
													<label for="loginremember">Remember me</label>
													<br>
													<br>

													<div class="pull-left">
														<input type="submit" class="orange" value="Login">
					<?php
//											echo CHtml::ajaxLink("Login", Yii::app()->createUrl("/site/login"), array(
//												'type'=>"POST",
//												'data'=>'{username:"xxxx",password:"yyyy"}',
//												'success'=>'function(data){
//												alert(data)
//											}'
//												), array(
//												"class"=>"button orange"))
					?>
													</div>
												</form>
												<div class="pull-right">
													<a href="#">Forgot your password?</a>
													<br>
													<a href="#">Forgot your username?</a>
													<br>
												</div>
												<br class="clearfix">
											</div>
											<div class="footer">
												<h4 class="pull-left">NEW CUSTOMER?</h4>
												<a class="button pull-right" href="create_an_account.html">Create an account</a>
											</div>
										</li>
									</ul>
								</li>-->
								<!--<li><a href="#"><i class="icons icon-lock"></i> Create an Account</a></li>-->
				<?php else: ?>
					<li><a href="<?php echo Yii::app()->createUrl("site/logout") ?>"><i class="icons icon-user"></i> <?php echo Yii::app()->user->name . "(Logout)"; ?></a></li>
					<?php if(Yii::app()->user->userType == 4 || Yii::app()->user->userType == 3): ?>
						<li><a href="<?php echo Yii::app()->createUrl("backend.php/backoffice/default") ?>"><i class="icons icon-lock"></i> Backoffice</a></li>
						<?php endif; ?>
					<?php endif; ?>

			</ul>
		</nav>

	</div>

</div>