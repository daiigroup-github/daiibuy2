<?php

class SiteController extends MasterController
{

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		$this->layout = '//layouts/column1';
		if($error = Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model = new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes = $_POST['ContactForm'];
			if($model->validate())
			{
				$name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
				$subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
				$headers = "From: $name <{$model->email}>\r\n" .
					"Reply-To: {$model->email}\r\n" .
					"MIME-Version: 1.0\r\n" .
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
				Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact', array(
			'model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout = '//layouts/home';
		$model = new LoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				if(isset($_POST["partnerCode"]) && !empty($_POST["partnerCode"]))
				{
					$user = User::model()->find("email = '" . $model->username . "'");
//					throw new Exception(print_r($_POST, true));
					$partnerType = UserPartner::model()->findPartnerTypeByCode($_POST["partnerCode"]);
					if($user->validatePassword($model->password))
					{
						if(!isset($user->partnerCode) || empty($user->partnerCode))
						{
							$user->partnerCode = $_POST["partnerCode"];
							$user->partnerType = $partnerType;
							$user->partnerDateTime = new CDbExpression("NOW()");
						}
						else
						{
							if($user->partnerCode != $_POST["partnerCode"])
							{
								if($partnerType == 2)
								{
									$partnerOrder = OrderGroup::model()->count("partnerCode = '" . $_POST["partnerCode"] . "'");
									if($partnerOrder > 0)
									{
										// ถามว่าจะเปลี่ยนหรือเป่า
										$this->redirect(array(
											"home/partnerChangeConfirm",
											'id'=>$user->userId,
											'code'=>$_POST["partnerCode"]));
									}
									else
									{

										$date1 = new DateTime();
										$date2 = new DateTime($user->partnerDateTime);
										$diff = $date1->diff($date2);
										$months = $diff->y * 12 + $diff->m + $diff->d / 30;
										$monthDiff = round($months);
										if($monthDiff > 3)
										{
											//เกิน 3 เดือน ถึงเปลี่ยนได้ถามก่อน
											$this->redirect(array(
												"home/partnerChangeConfirm",
												'id'=>$user->userId,
												'code'=>$_POST["partnerCode"]));
										}
										else
										{
											//Alert หน่อยว่า เปลี่ยน WOW ไม่ได้
											$this->redirect(array(
												'home/partner',
												'code'=>$_POST["partnerCode"],
												'error'=>1));
										}
									}
								}
								else if($partnerType == 1)
								{
									$user->partnerCode = $_POST["partnerCode"];
								}
							}
						}
						$user->save(FALSE);

						UserPartner::model()->updateAll(array(
							'status' => 0), "userId = $user->userId");
						$up = new UserPartner();
						$up->userId = Yii::app()->db->lastInsertID;
						$up->partnerCode = $_POST["partnerCode"];
						$up->partnerType = $partnerType;
//				$up->partnerId = "org Or wow Id";
						$up->createDateTime = new CDbExpression("NOW()");
						$up->updateDateTime = new CDbExpression("NOW()");
					}
				}
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		// display the login form
		$this->render('login', array(
			'model'=>$model,
			'message'=>isset($_GET["message"]) ? $_GET["message"] : NULL));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionSelectProvince()
	{
		$this->writeToFile('/tmp/province', print_r($_POST, true));
		echo CJSON::encode($_POST);
	}

}
