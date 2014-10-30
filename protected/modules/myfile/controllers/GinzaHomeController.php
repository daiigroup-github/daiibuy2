<?php

class GinzaHomeController extends MasterMyFileController
{

	public function actionIndex()
	{
		$this->layout = '//layouts/cl1';

		$myfileArray = Order::model()->findAllMyFileBySupplierId(isset(Yii::app()->user->id) ? Yii::app()->user->id : 0, 4, null);
		$this->render('index', array(
			'myfileArray'=>$myfileArray));
	}

	public function actionCreate()
	{
		$this->layout = '//layouts/cl1';
		$model = new Order;
		$model->isTheme = 1;
		$orderDetailModel = new OrderDetail;
		$orderDetailModel->orderDetailTemplateId = OrderDetail::model()->getOrderDetailTemplateIdBySupplierId(3);
		$orderDetailTemplateField = OrderDetailTemplateField::model()->findAll('orderDetailTemplateId = ' . $orderDetailModel->orderDetailTemplateId . ' AND status = 1');
		// uncomment the following code to enable ajax-based validation
		/*
		  if(isset($_POST['ajax']) && $_POST['ajax']==='order-create-form')
		  {
		  echo CActiveForm::validate($model);
		  Yii::app()->end();
		  }
		 */
//		throw new Exception(print_r($_FILES['OrderFile'],true));
		if(isset($_FILES['OrderFile']) && $_POST["Order"]["createMyfileType"] == 2)
		{
//			$planFile = $_FILES['OrderFile'];
			try
			{
				if(isset($_POST['Order']))
				{
					$flag = false;
					$transaction = Yii::app()->db->beginTransaction();
					$model->attributes = $_POST['Order'];
					$model->type = 1;
					$model->status = 0;
					$model->supplierId = 3;
					$model->isTheme = 1;
					$model->userId = Yii::app()->user->id;
					$model->createDateTime = new CDbExpression("NOW()");

					if($model->save())
					{
						$flag = TRUE;
						$orderId = Yii::app()->db->lastInsertID;
						$this->saveOrderDetail($orderId, $orderDetailModel->orderDetailTemplateId);
						$folderimage = "orderFile";

						for($i = 0; $i <= sizeof($_FILES["OrderFile"]); $i++)
						{
							$image = CUploadedFile::getInstanceByName("OrderFile[$i]");

							if(isset($image) && !empty($image))
							{
								$orderFileModel = new OrderFile();
								$imgType = explode('.', $image->name);
								$imgType = $imgType[count($imgType) - 1];
								$imageUrl = '/images/' . $folderimage . '/' . time() . '-' . rand(0, 999999) . '.' . $imgType;
								$imagePathimage = '/../' . $imageUrl;
								$orderFileModel->senderId = Yii::app()->user->id;
								$orderFileModel->filePath = $imageUrl;
								$orderFileModel->orderId = $orderId;
								$orderFileModel->fileName = $image->name;
								$orderFileModel->createDateTime = new CDbExpression("NOW()");
								$orderFileModel->userType = 1;
								$orderFileModel->status = 1;
								if($orderFileModel->save())
								{
									if(!file_exists(Yii::app()->getBasePath() . '/../' . 'images/' . $folderimage))
									{
										mkdir(Yii::app()->getBasePath() . '/../' . 'images/' . $folderimage, 0777);
									}
									if($image->saveAs(Yii::app()->getBasePath() . $imagePathimage))
									{
										$flag = true;
									}
									else
									{
										$flag = false;
									}
								}
								else
								{
									$flag = FALSE;
									break;
								}
							}
						}

						if($flag)
						{
							foreach($_POST["OrderDetailValue"] as $k=> $v)
							{
								$orderFieldValue = new OrderDetailValue();
								$orderFieldValue->orderDetailTemplateFieldId = $k;
								$orderFieldValue->value = $v["value"];
								$orderFieldValue->orderDetailId = $this->orderDetailId;
								$orderFieldValue->createDateTime = new CDbExpression("NOW()");
								$orderFieldValue->updateDateTime = new CDbExpression("NOW()");
								if(!$orderFieldValue->save())
								{
									$flag = FALSE;
									break;
								}
							}
						}
					}

					if($flag)
					{
						$transaction->commit();
						$this->redirect(array(
							'view',
							'id'=>$model->orderId));
					}
					else
					{
						$transaction->rollback();
					}
				}
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
		}
		else
		{
			if(isset($_POST["Order"]))
			{
				$transaction = Yii::app()->db->beginTransaction();
				$flag = true;
				$model->attributes = $_POST['Order'];
				$model->type = 1;
				$model->status = 1;
				$model->supplierId = 3;
				if($_POST["Order"]["createMyfileType"] == 3)
				{
					$model->isTheme = 0;
				}
				else
				{
					$model->isTheme = 1;
				}
				$model->userId = Yii::app()->user->id;
				$model->createDateTime = new CDbExpression("NOW()");
				if($model->save(false))
				{
					$orderId = Yii::app()->db->lastInsertID;
					foreach($_POST["OrderItems"] as $k=> $v)
					{
						if(!empty($v["productId"]))
						{
							$orderItems = new OrderItems();
							$orderItems->orderId = $orderId;
							$orderItems->attributes = $_POST["OrderItems"][$k];
							$orderItems->createDateTime = new CDbExpression("NOW()");
							if(isset($_POST["OrderItems"][$k]["price"]))
							{
								$price = $_POST["OrderItems"][$k]["price"];
							}
							else
							{
								$price = Product::model()->findByPk($_POST["OrderItems"][$k]["productId"])->price;
								$orderItems->price = $price;
							}
							$orderItems->total = $price * $_POST["OrderItems"][$k]["quantity"];

							if(!$orderItems->save(false))
							{
								$flag = FALSE;
								break;
							}
						}
					}
				}
				else
				{
					$flag = FALSE;
				}
				if($flag)
				{
					$transaction->commit();
					$this->redirect(array(
						'view',
						'id'=>$model->orderId));
				}
			}
			$this->render('create', array(
				'model'=>$model,
//				'orderDetailModel'=>$orderDetailModel,
				'orderDetailTemplateField'=>$orderDetailTemplateField,
			));
		}
	}

	public function actionView($id)
	{
		$this->layout = '//layouts/cl1';
		$model = $this->loadModel($id);
		$orderDetailModel = new OrderDetail;
		$orderDetailModel->orderDetailTemplateId = OrderDetail::model()->getOrderDetailTemplateIdBySupplierId(3);
		$orderDetailTemplateField = OrderDetailTemplateField::model()->findAll('orderDetailTemplateId = ' . $orderDetailModel->orderDetailTemplateId . ' AND status = 1');
		if(isset($_POST["OrderItems"]))
		{
			foreach($_POST["OrderItems"] as $k=> $v)
			{
				$orderItems = OrderItems::model()->findByPk($k);
				$orderItems->quantity = $v["quantity"];
				$orderItems->total = $orderItems->quantity * $orderItems->price;
				if($orderItems->save(FALSE))
				{
					$model->status = 2;
					$model->save(false);
				}
			}
		}
		$this->render('view', array(
			'model'=>$model,
			'orderDetailTemplateField'=>$orderDetailTemplateField,
		));
	}

	public function loadModel($id)
	{
		$model = Order::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

}
