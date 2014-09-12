<?php
Yii::import('ext.tinymce.*');

class ProductController extends MasterBackofficeController
{
//	public $layout = '//layouts/admin/column1';

	/**
	 * @return array action filters
	 */
//	public function filters()
//	{
//		return array(
//			'rights', // perform access control for CRUD operations
//		);
//	}

	public function allowedActions()
	{
		return '';
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		if(isset(Yii::app()->user) && Yii::app()->user->id != $model->supplierId && Yii::app()->user->userType != 4)
		{
			$this->redirect(array(
				"index"));
		}
		if(isset($_POST["returnRemark"]))
		{
			$returnRemark = $_POST["returnRemark"];
		}

		if(isset($_POST["rejectRemark"]))
		{
			$rejectRemark = $_POST["rejectRemark"];
		}

		if(isset($_POST["action"]))
		{

			if($_POST["action"] == "approve")
			{
				$model->updateDateTime = new CDbExpression('NOW()');
				$model->status = 2;
				if($model->save())
				{
					//save history
					$productHistory = new ProductHistory();
					$productHistory->userId = $model->supplierId;
					$productHistory->productId = $model->productId;
					$productHistory->description = "Approved";
					$productHistory->createDateTime = new CDbExpression('NOW()');
					$productHistory->save();

					//sent mail
					$emailObj = new Email();
					$sentMail = new EmailSend();
					$emailObj->Setmail(NULL, null, $model->supplierId, null, $model->productId, null);
					$sentMail->mailAddNewProductCompleted($emailObj);
				}
			}
			else if(($_POST["action"] == "return"))
			{
				$model->updateDateTime = new CDbExpression('NOW()');
				$model->status = 3;
				if($model->save())
				{

					//save history
					$productHistory = new ProductHistory();
					$productHistory->userId = $model->supplierId;
					$productHistory->productId = $model->productId;
					$productHistory->description = "Return";
					$productHistory->remark = isset($remark) ? $remark : null;
					$productHistory->createDateTime = new CDbExpression('NOW()');
					$productHistory->save();

					//sent mail
					$emailObj = new Email();
					$sentMail = new EmailSend();
					$emailObj->Setmail(NULL, null, $model->supplierId, null, $model->productId, null, isset($returnRemark) ? $returnRemark : null);
					$sentMail->mailAddNewProductEdit($emailObj);
				}
			}
			else if(($_POST["action"] == "reject"))
			{
				$model->updateDateTime = new CDbExpression('NOW()');
				$model->status = 4;
				if($model->save())
				{

					//save history
					$productHistory = new ProductHistory();
					$productHistory->userId = $model->supplierId;
					$productHistory->productId = $model->productId;
					$productHistory->description = "Reject";
					$productHistory->remark = isset($remark) ? $remark : null;
					$productHistory->createDateTime = new CDbExpression('NOW()');
					$productHistory->save();

					//sent mail
					$emailObj = new Email();
					$sentMail = new EmailSend();
					$emailObj->Setmail(NULL, null, $model->supplierId, null, $model->productId, null, isset($rejectRemark) ? $rejectRemark : null);
					$sentMail->mailAddNewProductRejected($emailObj);
				}
			}
		}

//		if (isset($_POST['Product'])) {
//			if(isset($_POST['Product']['margin']) && !empty($_POST['Product']['margin']))
//                        {
//                            $model->margin = $_POST['Product']['margin'];
//                            $model->updateDateTime = new CDbExpression('NOW()');
//                            $model->status = 1;
//                              $model->save();
//				$emailObj = new Email();
//				$sentMail = new EmailSend();
//				$emailObj->Setmail(NULL, null, $model->supplierId, null, $model->productId, null);
//				$sentMail->mailAddNewProductCompleted($emailObj);
//			} else {
//                            $model->addError("margin", "กรุณาระบุ Margin");
//                        }		}
		$this->render('view', array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Product;
//		$productAttributeModel = new ProductAttribute;
//		$productAttributeValueModel = new ProductAttributeValue;
//		$productPromotion = new ProductPromotion();
//		$productHistory = new ProductHistory();
// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

		if(isset($_POST['Product']))
		{
			$model->attributes = $_POST['Product'];
			$model->createDateTime = new CDbExpression('NOW()');
			$model->supplierId = Yii::app()->user->id;
			$productHistory->userId = $model->supplierId;
//			$uploadFile = CUploadedFile::getInstance($model, 'image');
//			if ($uploadFile) {
//                              $fileName = uniqid() . '_' . $uploadFile->name;
//				$model->image = '/images/product/' . $fileName;
//			}

			$flag = true;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				if($model->save())
				{
					$productId = Yii::app()->db->lastInsertID;
					$productHistory->productId = $productId;
					$uploadFile = CUploadedFile::getInstancesByName('images');
					if($uploadFile && count($uploadFile) > 0)
					{
						$i = 1;
						foreach($uploadFile as $img=> $pic)
						{
							$fileName = uniqid() . '_' . $pic->name;
							$image = Yii::app()->image->load($pic->getTempName());
							$image->resize(800, 600);
							if($image->save(Yii::app()->basePath . '/../images/product/' . $fileName))
							{
								$productImage = new ProductImage();
								$productImage->productId = $productId;
								$productImage->image = '/images/product/' . $fileName;
								$productImage->sortOrder = $i;
								if(!$productImage->save())
								{
									$flag = FALSE;
									break;
								}
								$i++;
							}
							else
							{
								$flag = FALSE;
								break;
							}
						}
					}
					else
					{
						$flag = FALSE;
						$model->addError("image", "กรุณาอัพโหลดรูปสำหรับผลิตภัณฑ์");
					}

					//product attributes


					if(isset($_POST['ProductAttributeValue']))
					{
						foreach($_POST['ProductAttributeValue'] as $productAttributeValue)
						{
							$productAttributeValueModel = new ProductAttributeValue;
							$productAttributeValueModel->attributes = $productAttributeValue;
							$productAttributeValueModel->productId = $productId;

							if(!$productAttributeValueModel->save())
							{
								$flag = false;
								break;
							}
						}
					}
					if(isset($_POST['ProductPromotion']))
					{
						$productPromotion->attributes = $_POST['ProductPromotion'];
						$productPromotion->dateStart = $_POST['ProductPromotion']['dateStart'];
						$productPromotion->dateEnd = $_POST['ProductPromotion']['dateEnd'];
						$productPromotion->productId = $model->productId;

						$flag2 = true;
						if((isset($_POST['ProductPromotion']['dateStart']) && $_POST['ProductPromotion']['dateStart'] != '0000-00-00') || (isset($_POST['ProductPromotion']['dateEnd']) && $_POST['ProductPromotion']['dateEnd'] != '0000-00-00'))
						{
							if($_POST['ProductPromotion']['dateStart'] > $_POST['ProductPromotion']['dateEnd'])
							{
								$productPromotion->addError('dateStart', "dateStart cannot greater than dateEnd.");
								$flag2 = false;
							}
							else
							{
								//if ((isset($_POST['ProductPromotion']['dateStart']) && $_POST['ProductPromotion']['dateStart'] != '0000-00-00') && (!isset($_POST['ProductPromotion']['dateEnd']) && $_POST['ProductPromotion']['dateEnd'] == '0000-00-00')) {
								//$productPromotion->addError('dateEnd', "dateEnd must have value.");
								//$flag2 = false;
								//}
								if((!isset($_POST['ProductPromotion']['dateStart']) || $_POST['ProductPromotion']['dateStart'] == '0000-00-00'))
								{
									$productPromotion->addError('dateStart', "dateStart must have value.");
									$flag2 = false;
								}
								if((int) $_POST['ProductPromotion']['price'] <= 0)
								{
									$productPromotion->addError('price', "Price must greater than 0");
									$flag2 = false;
								}
							}
							if($flag2)
							{
								if(!$productPromotion->save())
								{
									$flag = false;
								}
							}
							else
							{
								$flag = false;
							}
						}
					}
				}
				else
				{
					$flag = false;
				}

				if($flag)
				{
					$productHistory->description = "Create";
					$productHistory->createDateTime = new CDbExpression('NOW()');
					$productHistory->save();


					$transaction->commit();

					//sent mail
					$emailObj = new Email();
					$sentMail = new EmailSend();
					$documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/admin/product/view/id/";
					$emailObj->Setmail(null, null, Yii::app()->user->id, null, $productId, $documentUrl);
					$sentMail->mailAddNewProductToAdmin($emailObj);


//						$emailObj = new Email();
//						$sentMail = new EmailSend();
//						$documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/admin/product/view/id/";
//						$emailObj->Setmail($userId, null , $this->model->supplierId,
//								null, $productId, $documentUrl);
//						$sentMail->mailAddNewProductCompleted($emailObj);

					$this->redirect(array(
						'view',
						'id'=>$model->productId));
				}
				else
				{
					$transaction->rollback();
				}
			}
			catch(Exception $e)
			{
				$transaction->rollback();
				throw new Exception($e->getMessage());
			}
		}

		$this->render('create', array(
			'model'=>$model,
//			'productAttributeModel'=>$productAttributeModel,
//			'productAttributeValueModel'=>$productAttributeValueModel,
//			'productPromotion'=>$productPromotion
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		if(isset(Yii::app()->user) && Yii::app()->user->id != $model->supplierId && Yii::app()->user->userType != 4)
		{
			$this->redirect(array(
				"index"));
		}
		$productAttributeModel = new ProductAttribute;
		$productAttributeValueModel = new ProductAttributeValue;
		//$productPromotion = ProductPromotion::model()->findByPk('productId='.$id);
		$productPromotion = ProductPromotion::model()->find("productId = :productId order by productPromotionId desc", array(
			":productId"=>$id));
		$productPromotion = (isset($model->productPromotion)) ? $model->productPromotion : new ProductPromotion();


// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);
		if(isset($_POST['Product']))
		{
			$model->attributes = $_POST['Product'];
//			$uploadFile = CUploadedFile::getInstance($model, 'image');
//			if ($uploadFile) {
//				$fileName = uniqid() . '_' . $uploadFile->name;
//				$model->image = '/images/product/' . $fileName;
//			}
			if($model->status == 3)
			{
				$model->status = 1;
			}
			$flag = true;
			//$model->status = 1; //change to Wait for approve
			$transaction = Yii::app()->db->beginTransaction();
			try
			{

				if($model->save())
				{

//					if ($uploadFile) {
//						if (!$uploadFile->saveAs(Yii::app()->basePath . '/../images/product/' . $fileName))
//							$flag = false;
//					}
					$productId = $model->productId;

					$uploadFile = CUploadedFile::getInstancesByName('images');
					if($uploadFile && count($uploadFile) > 0)
					{
						$i = 1;
						foreach($uploadFile as $image=> $pic)
						{
							$fileName = uniqid() . '_' . $pic->name;
							$image = Yii::app()->image->load($pic->getTempName());
							$image->resize(800, 600);
							if($image->save(Yii::app()->basePath . '/../images/product/' . $fileName))
							{
//							$fileName = uniqid() . '_' . $pic->name;
//							if($pic->saveAs(Yii::app()->basePath . '/../images/product/' . $fileName))
//							{
								$productImage = new ProductImage();
								$productImage->productId = $productId;
								$productImage->image = '/images/product/' . $fileName;
								$productImage->sortOrder = $i;
								if(!$productImage->save())
								{
									$flag = FALSE;
									break;
								}
								$i++;
							}
							else
							{
								$flag = FALSE;
								break;
							}
						}
					}
					else
					{
						$productImage = ProductImage::model()->findAll("productId = :productId", array(
							":productId"=>$productId));
						if(count($productImage) == 0)
						{
							$flag = FALSE;
							$model->addError("image", "กรุณาอัพโหลดรูปสำหรับผลิตภัณฑ์");
						}
					}

					if(isset($_POST['ProductPromotion']))
					{
						$productPromotion->attributes = $_POST['ProductPromotion'];
						$productPromotion->dateStart = $_POST['ProductPromotion']['dateStart'];
						$productPromotion->dateEnd = $_POST['ProductPromotion']['dateEnd'];
						$productPromotion->productId = $model->productId;

//                        if(isset($productPromotion->dateStart)){ $productPromotion->addError(ggg);  }

						$flag2 = true;
						if((isset($_POST['ProductPromotion']['dateStart']) && $_POST['ProductPromotion']['dateStart'] != '0000-00-00') || (isset($_POST['ProductPromotion']['dateEnd']) && $_POST['ProductPromotion']['dateEnd'] != '0000-00-00'))
						{
							if($_POST['ProductPromotion']['dateStart'] > $_POST['ProductPromotion']['dateEnd'])
							{
								$productPromotion->addError('dateStart', "dateStart cannot greater than dateEnd.");
								$flag2 = false;
							}
							else
							{
//								if ((isset($_POST['ProductPromotion']['dateStart']) && $_POST['ProductPromotion']['dateStart'] != '0000-00-00') && (!isset($_POST['ProductPromotion']['dateEnd']) && $_POST['ProductPromotion']['dateEnd'] == '0000-00-00')) {
//								$productPromotion->addError('dateEnd', "dateEnd must have value.");
//								$flag2 = false;
//								}
								if((!isset($_POST['ProductPromotion']['dateStart']) || $_POST['ProductPromotion']['dateStart'] == '0000-00-00'))
								{
									$productPromotion->addError('dateStart', "dateStart must have value.");
									$flag2 = false;
								}
								if((int) $_POST['ProductPromotion']['price'] <= 0)
								{
									$productPromotion->addError('price', "Price must greater than 0");
									$flag2 = false;
								}
							}
							if($flag2)
							{
								if(!$productPromotion->save())
								{
									$flag = false;
								}
							}
							else
							{
								$flag = false;
							}
						}



//							if(isset($_POST['ProductAttributeValue']))
						if(!ProductAttributeValue::model()->deleteAll('productId=' . $id))
						{

						}
//								{
//
//								$this->writeToFile('/tmp/promotion', print_r(true, true));
//									$flag = false;
//								}
						if(isset($_POST['ProductAttributeValue']))
						{
							foreach($_POST['ProductAttributeValue'] as $productAttributeValue)
							{
								$productAttributeValueModel = new ProductAttributeValue;
								$productAttributeValueModel->attributes = $productAttributeValue;
								$productAttributeValueModel->productId = $id;
								if(!$productAttributeValueModel->save())
								{
									throw new Exception(111);
									$flag = false;
									break;
								}
							}
						}

						if($flag)
						{
							//throw new Exception(333);
							//save history
							$productHistory = new ProductHistory();
							$productHistory->userId = $model->supplierId;
							$productHistory->productId = $model->productId;
							$productHistory->description = "Update";
							$productHistory->createDateTime = new CDbExpression('NOW()');
							$productHistory->save();

							$transaction->commit();

							//sent mail to admin
							$emailObj = new Email();
							$sentMail = new EmailSend();
							$documentUrl = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/admin/product/view/id/";
							$emailObj->Setmail(null, null, Yii::app()->user->id, null, $productId, $documentUrl);
							$sentMail->mailAddNewProductEditedToAdmin($emailObj);

							$this->redirect(array(
								'view',
								'id'=>$model->productId));
						}
						else
							$transaction->rollback();
					}
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
//			if ($flag) {
//				if ($model->save()) {
//					if ($uploadFile)
//						$uploadFile->saveAs(Yii::app()->basePath . '/../images/product/' . $fileName);
//
//					$this->redirect(array(
//						'view',
//						'id' => $model->productId));
//				}
//			}
		}

		$this->render('update', array(
			'model'=>$model,
			'productAttributeModel'=>$productAttributeModel,
			'productAttributeValueModel'=>$productAttributeValueModel,
			'productPromotion'=>$productPromotion
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$model->status = Product::STATUS_DELETE;
		$model->save();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
					'index'));
	}

	public function actionReUse($id)
	{
		$model = $this->loadModel($id);
		$model->status = Product::STATUS_WAITING_APPROVE;
		$model->save();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
					'index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
//                if(Yii::app()->user->id > 0 && isset(Yii::app()->user->id))
//                {
//                    $user = User::model()->findByPk(Yii::app()->user->id);
//                    if($user->type == 1 || $user->type == 2)
//                    {
//                        throw new CHttpException("ไม่สามารถเข้าถึงส่วนนี้ได้");
//                        //$this->redirect(Yii::app()->createUrl("site/index"));
//                    }
//                }
//                else
//                {
//                    throw new CHttpException("ไม่สามารถเข้าถึงส่วนนี้ได้");
//                    //$this->redirect(Yii::app()->createUrl("site/index"));
//                }
		$model = new Product('search');
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes = $_GET['Product'];

		$this->render('index', array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Product the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Product::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	public function actionDeleteProductImage($id)
	{
		$result = array(
			);
		$productImage = ProductImage::model()->findByPk($id);
		if(!$productImage->delete())
		{
			$result["status"] = 0;
			echo CJSON::encode($result);
		}

		$result["status"] = 1;
		echo CJSON::encode($result);
	}

	/**
	 * Performs the AJAX validation.
	 * @param Product $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	//Custom
	public function actionAddAttribute()
	{
		$productAttributeModel = new ProductAttribute;

		if(isset($_POST['ProductAttribute']))
		{
			$productAttributeModel->attributes = $_POST['ProductAttribute'];
			$productAttributeModel->userId = Yii::app()->user->id;
			$flag = $productAttributeModel->save();
			$div = '<option value="' . Yii::app()->db->lastInsertID . '">' . $productAttributeModel->attributeName . '</option>';

			echo CJSON::encode(array(
				'status'=>($flag) ? 'success' : 'failure',
				'div'=>$div,
			));
			exit;
		}
		else
		{
			echo CJSON::encode(array(
				'status'=>'failure',
				'div'=>$this->renderPartial('_addProductAttribute', array(
					'productAttributeModel'=>$productAttributeModel), true),
			));
			exit;
		}
	}

}