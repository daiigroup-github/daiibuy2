<?php

class UserController extends MasterBackofficeController
{
	/**
	 * @return array action filters
	 */
//	public function filters()
//	{
//		return array(
//			'rights', // perform access control for CRUD operations
//		);
//	}
//	public function allowedActions()
//	{
//		return 'DistributorSlideShowByAmphurId,dynamicUserType,checkEmail';
//	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionUpdateProfile()
	{
		$userId = Yii::app()->user->id;
		$model = $this->loadModel($userId);
		$dateNow = new CDbExpression("NOW()");
		if(isset($_POST['User']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$flag = 1;
				$model->attributes = $_POST['User'];
				if($model->save())
				{
					$logo = CUploadedFile::getInstanceByName("uploadLogo");
					if(isset($logo) && !empty($logo))
					{
						$ran = rand(0, 999999);
						$imgType = explode(".", $logo->name);
						$imgType = $imgType[count($imgType) - 1];
						$imageUrl = "images/userFile/" . $userId . "/" . time() . '-' . $ran . "." . $imgType;
						$imagePath = '/../' . $imageUrl;
						if(!file_exists(Yii::app()->getBasePath() . '/../' . "images/userFile/$userId"))
						{
							mkdir(Yii::app()->getBasePath() . '/../' . "images/userFile/$userId", 0777);
						}

						$logo->saveAs(Yii::app()->getBasePath() . $imagePath);
						$model->logo = $imageUrl;
					}
					else
					{
						$model->logo = null;
					}
					$map = CUploadedFile::getInstanceByName("uploadMap");
					if(isset($map) && !empty($map))
					{
						$ran = rand(0, 999999);
						$imgType = explode(".", $map->name);
						$imgType = $imgType[count($imgType) - 1];
						$imageUrl = "images/userFile/" . $userId . "/" . time() . '-' . $ran . "." . $imgType;
						$imagePath = '/../' . $imageUrl;
						if(!file_exists(Yii::app()->getBasePath() . '/../' . "images/userFile/$userId"))
						{
							mkdir(Yii::app()->getBasePath() . '/../' . "images/userFile/$userId", 0777);
						}

						$map->saveAs(Yii::app()->getBasePath() . $imagePath);
						$model->map = $imageUrl;
					}
					else
					{
						$model->map = null;
					}
				}
				else
				{
//					throw new Exception("ไม่สารถ บันทึก user ได้");
					$flag = 0;
				}

				if($flag)
				{
					$model->save();
					$transaction->commit();
					$this->redirect(Yii::app()->homeUrl);
				}
				else
				{
					$transaction->rollback();
				}
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
		}

		$this->render('updateProfile', array(
			'model'=>$model
		));
	}

	public function actionViewProfile($id)
	{
		$this->render('viewProfile', array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$supplierDiscountRangeModel = new SupplierDiscountRange('search');
		$model = new User;
		$dateNow = new CDbExpression('NOW()');
		$addressModel = new Address();
		$shippingAddressModel = new Address();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$userModel = $model->findAll("email =:email", array(
				":email"=>$_POST["User"]["email"]));
			if(count($userModel) == 0)
			{
				$transaction = Yii::app()->db->beginTransaction();
				try
				{
					$flag = 1;
					$model->attributes = $_POST['User'];
					$model->password = $model->hashPassword($model->email, $model->password);
					$model->createDateTime = $dateNow;
					$model->isFirstLogin = 1;
					if($model->type == 3)
					{
						if(!isset($model->minimumOrder) || empty($model->minimumOrder) || $model->minimumOrder <= 0)
						{
							$model->addError("minimumOrder", "กรุณาระบุยอดขั้นต่ำในการขายสินค้า ต่อ Order");
						}
					}
					else
					{
						$model->minimumOrder = 0;
					}
					if($model->type == 2 && Yii::app()->user->userType == 6)
					{
						$model->referenceId = Yii::app()->user->id;
					}
					if($model->save())
					{
						$userId = Yii::app()->db->lastInsertID;

						if(isset($_POST['uploadLogo']))
						{
							$model = $this->loadModel($userId);
							$logo = CUploadedFile::getInstanceByName("uploadLogo");
							if(!empty($logo))
							{
								$ran = rand(0, 999999);
								$imgType = explode(".", $logo->name);
								$imgType = $imgType[count($imgType) - 1];
								$imageUrl = "images/userFile/" . $userId . "/" . time() . '-' . $ran . "." . $imgType;
								$imagePath = '/../' . $imageUrl;
								$Img = $imageUrl;
								//throw new Exception(Yii::app()->getBasePath().'/../'."images/userFile/$userId");
								if(!file_exists(Yii::app()->getBasePath() . '/../' . "images/userFile/$userId"))
								{
									mkdir(Yii::app()->getBasePath() . '/../' . "images/userFile/$userId", 0777);
								}

								$logo->saveAs(Yii::app()->getBasePath() . $imagePath);
								$model->logo = $Img;
							}
							else
							{
								$model->logo = null;
							}
							$model->save();
						}

						if(isset($_POST["UserUserFile"]))
						{
							foreach($_POST["UserUserFile"]["filePath"] as $k=> $v)
							{
								$userUserFileModel = new UserUserFile();
								$userUserFileModel->userId = $userId;
								$userUserFileModel->userFileId = $k;
								$image = CUploadedFile::getInstanceByName("UserUserFile[filePath][$k]");
								if(!empty($image))
								{
									$ran = rand(0, 999999);
									$imgType = explode(".", $image->name);
									$imgType = $imgType[count($imgType) - 1];
									$imageUrl = "images/userFile/" . $userId . "/" . time() . '-' . $ran . "." . $imgType;
									$imagePath = '/../' . $imageUrl;
									$Img = $imageUrl;
									//throw new Exception(Yii::app()->getBasePath().'/../'."images/userFile/$userId");
									if(!file_exists(Yii::app()->getBasePath() . '/../' . "images/userFile/$userId"))
									{
										mkdir(Yii::app()->getBasePath() . '/../' . "images/userFile/$userId", 0777);
									}

									$image->saveAs(Yii::app()->getBasePath() . $imagePath);
									$userUserFileModel->filePath = $Img;
								}
								else
								{
									$userUserFileModel->filePath = null;
								}
								$userUserFileModel->status = 1;
								$userUserFileModel->createDateTime = $dateNow;
								if(!$userUserFileModel->save())
								{
									$flag = 0;
								}
							}
						}

						if(isset($_POST["Address"]))
						{
							if(isset($_POST["Address"]["billing"]))
							{
								$address = new Address();
								$address->attributes = $_POST["Address"]['billing'];
								$address->type = 1;
								$address->userId = $userId;
								if(!$address->save())
								{
									$flag = 0;
									$model->errors;
									$model->addError("errorText", "ไม่สามารถบันทึก ที่อยู่ในการวางบิลได้");
								}
							}

							if(isset($_POST["Address"]["shipping"]) && ($model->type == 1 || $model->type == 2 || $model->type == 3))
							{
								$shipping = new Address();
								$shipping->attributes = $_POST["Address"]["shipping"];
								$shipping->type = 2;
								$shipping->userId = $userId;
								if(!$shipping->save())
								{
									$model->errors;
									$flag = 0;
									$model->addError("errorText", "ไม่สามารถบันทึก ที่อยู่ในการจัดส่งเอกสารได้");
								}
							}
						}
					}
					else
					{
						$flag = 0;
						//var_dump($address);
						//throw new Exception("ไม่สารถ บันทึก user ได้");
					}

					if($flag)
					{
						$transaction->commit();

						$emailObj = new Email();
						$sentMail = new EmailSend();
						$emailObj->Setmail($userId, null, null, null, null, null, $model->password);
						$sentMail->mailNewAccount($emailObj);

						$this->redirect(array(
							'index'));
					}
					else
					{
						$transaction->rollback();
					}
				}
				catch(Exception $e)
				{
					throw new Exception($e->getMessage());
					$model->errors;
					$transaction->rollback();
				}
			}
			else
			{
				$model->addError("email", "มีอีเมล์นี้ในระบบแล้ว");
			}
		}

		$this->render('create', array(
			'model'=>$model,
			'address'=>$addressModel,
			'shippingAddressModel'=>$shippingAddressModel,
			'supplierDiscountRangeModel'=>$supplierDiscountRangeModel,
		));
	}

	public function actionDynamicUserType()
	{
//            $data=  User::model()->findAll('userId=:userId',
//                          array(':userId'=>(int) $_POST['userId']));
//        if(isset($_POST['User']['type']))
//        {
//            $userFiles = UserFile::model()->findAll("Type=:type", array(":type" => (int) $_POST['User']['type']));
//            $userUserFileModel = new UserUserFile();
//            $this->renderPartial("attechFileForm", array("userFiles" => $userFiles, "userUserFileModel" => $userUserFileModel));
//        }
//        else
//        {
		if(isset($_POST['type']))
		{
			$type = $_POST['type'];
		}
		else
		{
			//$type = 1;
		}
		$userFiles = UserFile::model()->findAll("type=:type", array(
			":type"=>(int) $type));
		$userUserFileModel = new UserUserFile();
		$uUserFile = $userUserFileModel->findAll("userId =:userId", array(
			":userId"=>$_POST["userId"]));
		$result = array(
			"userType"=>$type,
			"attechForm"=>$this->renderPartial("attechFileForm", array(
				"userFiles"=>$userFiles,
				"userUserFileModel"=>$userUserFileModel,
				"userUserFileList"=>$uUserFile), true));
		echo json_encode($result);
//		$this->renderPartial("attechFileForm", array(
//			"userFiles" => $userFiles,
//			"userUserFileModel" => $userUserFileModel,
//			"userUserFileList" => $uUserFile));
//        }
	}

	public function actionCheckEmail()
	{
		if(isset($_POST["User"]["email"]) && !empty($_POST["User"]["email"]))
		{
			$user = User::model()->findAll("email=:email", array(
				":email"=>$_POST["User"]["email"]));
			if(count($user) > 0)
			{
				echo "ไม่สามารถใช้ อีเมล์นี้ได้";
			}
			else
			{
				echo "สามารถใช้ อีเมล์นี้ได้";
			}
		}
		else
		{
			echo "กรุณาระบุอีเมล์";
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$isGen = 0;
		$dateNow = new CDbExpression('NOW()');
		$model = $this->loadModel($id);
		if($model->approved == 0)
			$isGen = 2;
		$address = Address::model()->find("userId =:userId AND type = 1", array(
			":userId"=>$id));
		$shippingAddressModel = Address::model()->find("userId =:userId AND type = 2", array(
			":userId"=>$id));
		if(!isset($address))
			$address = new Address();
		if(!isset($shippingAddressModel))
			$shippingAddressModel = new Address();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$supplierDiscountRangeModel = new SupplierDiscountRange('search');
		if(isset($_GET['SupplierDiscountRange']))
			$supplierDiscountRangeModel->attributes = $_GET['SupplierDiscountRange'];

		if(isset($_POST['User']))
		{

			$model->attributes = $_POST['User'];
			if($model->approved == 1 && $isGen == 2)
				$isGen = 1;
			if(!isset($model->password))
			{
				$model->password = $model->hashPassword($model->email, $model->password);
				$isGen = 1;
			}
			if($model->type == 3)
			{
				if(!isset($model->minimumOrder) || empty($model->minimumOrder) || $model->minimumOrder <= 0)
				{
					$model->addError("minimumOrder", "กรุณาระบุยอดขั้นต่ำในการขายสินค้า ต่อ Order");
				}
			}
			else
			{
				$model->minimumOrder = 0;
			}
			if($model->type == 2)
			{
				$model->referenceId;
			}
			if($model->save())
			{

				$logo = CUploadedFile::getInstanceByName("uploadLogo");
				if(isset($logo) && !empty($logo))
				{
					$ran = rand(0, 999999);
					$imgType = explode(".", $logo->name);
					$imgType = $imgType[count($imgType) - 1];
					$imageUrl = "images/userFile/" . $id . "/" . time() . '-' . $ran . "." . $imgType;
					$imagePath = '/../' . $imageUrl;
					if(!file_exists(Yii::app()->getBasePath() . '/../' . "images/userFile/$id"))
					{
						mkdir(Yii::app()->getBasePath() . '/../' . "images/userFile/$id", 0777);
					}

					$logo->saveAs(Yii::app()->getBasePath() . $imagePath);
					$model->logo = $imageUrl;
				}

				$map = CUploadedFile::getInstanceByName("uploadMap");
				if(isset($map) && !empty($map))
				{
					$ran = rand(0, 999999);
					$imgType = explode(".", $map->name);
					$imgType = $imgType[count($imgType) - 1];
					$imageUrl = "images/userFile/" . $id . "/" . time() . '-' . $ran . "." . $imgType;
					$imagePath = '/../' . $imageUrl;
					if(!file_exists(Yii::app()->getBasePath() . '/../' . "images/userFile/$id"))
					{
						mkdir(Yii::app()->getBasePath() . '/../' . "images/userFile/$id", 0777);
					}

					$map->saveAs(Yii::app()->getBasePath() . $imagePath);
					$model->map = $imageUrl;
				}
				$model->save();

				if(isset($_POST["UserUserFile"]))
				{
					foreach($_POST["UserUserFile"]["filePath"] as $k=> $v)
					{
						$userUserFileModel = UserUserFile::model()->find("userId =:userId AND userFileId =:userFileId", array(
							":userId"=>$id,
							":userFileId"=>$k));
						if(count($userUserFileModel) == 0)
						{
							$userUserFileModel = new UserUserFile();
							$userUserFileModel->userId = $id;
							$userUserFileModel->userFileId = $k;
							$userUserFileModel->createDateTime = $dateNow;
						}
						$image = CUploadedFile::getInstanceByName("UserUserFile[filePath][$k]");
						if(!empty($image))
						{
							$ran = rand(0, 999999);
							$imgType = explode(".", $image->name);
							$imgType = $imgType[count($imgType) - 1];
							$imageUrl = "images/userFile/" . $id . "/" . time() . '-' . $ran . "." . $imgType;
							$imagePath = '/../' . $imageUrl;
							$Img = $imageUrl;
							//throw new Exception(Yii::app()->getBasePath().'/../'."images/userFile/$userId");
							if(!file_exists(Yii::app()->getBasePath() . '/../' . "images/userFile/$id"))
							{
								mkdir(Yii::app()->getBasePath() . '/../' . "images/userFile/$id", 0777);
							}

							$image->saveAs(Yii::app()->getBasePath() . $imagePath);
							$userUserFileModel->filePath = $Img;
						}
						else
						{
							if(isset($_POST["oldFilePath"][$k]))
							{
								$userUserFileModel->filePath = $_POST["oldFilePath"][$k];
							}
							else
							{
								$userUserFileModel->filePath = null;
							}
						}
						$userUserFileModel->status = 1;
						$userUserFileModel->updateDateTime = $dateNow;
						if(!$userUserFileModel->save())
						{
							$flag = 0;
						}
					}
				}
				if(isset($_POST["Address"]) && $model->type == 3 || isset($_POST["Address"]) && $model->type == 2)
				{
					$a = $_POST["Address"];
					$address->attributes = $a['business'];
					$address->company = $a['business']['company'];
					if(!$address->save())
					{
						$flag = 0;
					}
					if(isset($a['shipping']
						))
					{
						$shippingAddressModel->attributes = $a['shipping'];
						$shippingAddressModel->company = $a['shipping']['company'];
						if(!$shippingAddressModel->save())
						{
							$flag = 0;
						}
					}
				}
				if($model->type == 2 || $model->type == 3 || $model->type == 6)
				{
					if($isGen == 1)
					{
						$emailObj = new Email();
						$sentMail = new EmailSend();
						$emailObj->Setmail($model->userId, null, null, null, null, null, $model->password);
						$sentMail->mailNewAccount($emailObj);
					}
				}
				$this->redirect(array(
					'index'));
			}
		}

		$this->render('update', array(
			'model'=>$model,
			'address'=>$address,
			'shippingAddressModel'=>$shippingAddressModel,
			'supplierDiscountRangeModel'=>$supplierDiscountRangeModel,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
					'admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model = new User('search');
		$this->checkAdminAccessMenu();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes = $_GET['User'];

		$this->render('index', array(
			'model'=>$model,
		));
	}

	public function actionAddUserCertificateFile($id)
	{
		//$id is UserId
		$userCer = new UserCertificateFile();
		if(isset($_POST["UserCertificateFile"]))
		{
			$userCer->attributes = $_POST["UserCertificateFile"];
			$image = CUploadedFile::getInstanceByName("UserCertificateFile[file]");
			if(!empty($image))
			{
				$ran = rand(0, 999999);
				$imgType = explode(".", $image->name);
				$imgType = $imgType[count($imgType) - 1];
				$imageUrl = "images/userFile/cer" . $id . "/" . time() . '-' . $ran . "." . $imgType;
				$imagePath = '/../' . $imageUrl;
				$Img = $imageUrl;
				if(!file_exists(Yii::app()->getBasePath() . '/../' . "images/userFile/cer$id"))
				{
					mkdir(Yii::app()->getBasePath() . '/../' . "images/userFile/cer$id", 0777);
				}

				$image->saveAs(Yii::app()->getBasePath() . $imagePath);
				$userCer->file = $Img;
			}
			else
			{
				if(isset($_POST["UserCertificateFile"]["oldFile"]))
					$userCer->file = $_POST["UserCertificateFile"]["oldFile"];
				else
				{
					$userCer->file = null;
				}
			}
			$marginType = User::model()->getMarginUserType();
			$userCer->name = $marginType[$userCer->forUserType];
			$userCer->userId = $id;
			$userCer->createDateTime = new CDbExpression('NOW()');
			if($userCer->save())
			{
				$this->redirect(array(
					'update',
					'id'=>$id));
			}
		}
		$this->render('_userCerForm', array(
			'userCer'=>$userCer,
			'userId'=>$id));
	}

	public function actionUpdateUserCertificateFile($id)
	{
		//$id is UserCertificateFileId
		$userCer = UserCertificateFile::model()->findByPk($id);
		if(isset($_POST["UserCertificateFile"]))
		{
			$userCer->attributes = $_POST["UserCertificateFile"];
			$image = CUploadedFile::getInstanceByName("UserCertificateFile[file]");
			if(!empty($image))
			{
				$ran = rand(0, 999999);
				$imgType = explode(".", $image->name);
				$imgType = $imgType[count($imgType) - 1];
				$imageUrl = "images/userFile/cer" . $id . "/" . time() . '-' . $ran . "." . $imgType;
				$imagePath = '/../' . $imageUrl;
				$Img = $imageUrl;
				if(!file_exists(Yii::app()->getBasePath() . '/../' . "images/userFile/cer$id"))
				{
					mkdir(Yii::app()->getBasePath() . '/../' . "images/userFile/cer$id", 0777);
				}

				$image->saveAs(Yii::app()->getBasePath() . $imagePath);
				$userCer->file = $Img;
			}
			else
			{
				$userCer->file = $_POST["UserCertificateFile"]["oldFile"];
			}
			$marginType = User::model()->getMarginUserType();
			$userCer->name = $marginType[$userCer->forUserType];
			$userCer->updateDateTime = new CDbExpression('NOW()');
			if($userCer->save())
			{
				$this->redirect(array(
					'update',
					'id'=>$userCer->userId));
			}
		}
		$this->render('_userCerForm', array(
			'userCer'=>$userCer,
			'userId'=>$userCer->userId));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = User::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionDistributorSlideShowByAmphurId()
	{
		if(isset($_POST['amphurId']))
		{
			$amphurId = $_POST['amphurId'];
		}
		if(isset($amphurId))
		{
			$provinceId = Amphur::model()->findByPk($amphurId)->provinceId;
			$distributorList = User::model()->findAllDistributorByProvinceId($provinceId);
			echo $this->renderPartial('/share/_distributor_slideshow', array(
				'distributorList'=>$distributorList), true, true);
		}
	}

	public function actionCreateSupplierDiscountRange()
	{
		$this->pageHeader = "สร้าง Supplier Percent Discount";
		$model = new SupplierDiscountRange('search');
		if(isset($_GET["supplierId"]))
		{
			$model->supplierId = $_GET["supplierId"];
			$this->breadcrumbs = array(
				'Users'=>Yii::app()->createUrl("admin/user"),
				'Supplier Discount Range'=>array(
					"supplierDiscountRange?supplierId=" . $_GET["supplierId"]),
				'Create'
			);
		}
		else
		{
			$this->breadcrumbs = array(
				'Users'=>Yii::app()->createUrl("admin/user"),
			);
		}

		if(isset($_POST["SupplierDiscountRange"]))
		{

			$model->attributes = $_POST["SupplierDiscountRange"];

			if($model->save())
			{
				$this->redirect("supplierDiscountRange?supplierId=" . $model->supplierId);
			}
		}

		$this->render("_form_sup_reward_range", array(
			'model'=>$model));
	}

	public function actionUpdateSupplierDiscountRange($id)
	{
		$this->pageHeader = "แก้ไข Supplier Percent Discount";
		$this->breadcrumbs = array(
			'Users'=>Yii::app()->createUrl("admin/user"),
			'Supplier Reward Range'=>array(
				"supplierDiscountRange?supplierId=" . $id),
			'Update');
		$model = SupplierDiscountRange::model()->findByPk($id);

		if(isset($_POST["SupplierDiscountRange"]))
		{

			$model->attributes = $_POST["SupplierDiscountRange"];

			if($model->save())
			{
				$this->redirect(array(
					"supplierDiscountRange?supplierId=" . $model->supplierId));
			}
		}

		$this->render("_form_sup_reward_range", array(
			'model'=>$model));
	}

	public function actionDeleteSupplierDiscountRange($id)
	{
		$model = SupplierDiscountRange::model()->findByPk($id);
		$model->delete();
	}

	public function actionSupplierDiscountRange()
	{
		$model = new SupplierDiscountRange('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['SupplierDiscountRange']))
			$model->attributes = $_GET['SupplierDiscountRange'];

		if(isset($_GET["supplierId"]))
		{
			$model->supplierId = $_GET["supplierId"];
		}

		$this->render('_supplier_reward_grid', array(
			'model'=>$model,
		));
	}

}
