<?php

class FurnitureController extends MasterBackofficeController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			/*
			  array('allow',  // allow all users to perform 'index' and 'view' actions
			  'actions'=>array('index','view'),
			  'users'=>array('*'),
			  ),
			  array('allow', // allow authenticated user to perform 'create' and 'update' actions
			  'actions'=>array('create','update'),
			  'users'=>array('@'),
			  ),
			  array('allow', // allow admin user to perform 'admin' and 'delete' actions
			  'actions'=>array('admin','delete'),
			  'users'=>array('admin'),
			  ),
			  array('deny',  // deny all users
			  'users'=>array('*'),
			  ),
			 */
		);

		/*
		  $result = array();
		  return CMap::mergeArray(parent::rules(), $result);
		 */
	}

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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Furniture;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

		if(isset($_POST['Furniture']))
		{
			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$model->attributes = $_POST['Furniture'];

				$folderimage = 'folderName';
				$image = CUploadedFile::getInstance($model, 'image');
				if(isset($image) && !empty($image))
				{
					$imgType = explode('.', $image->name);
					$imgType = $imgType[count($imgType) - 1];
					$imageUrl = '/images/' . $folderimage . '/' . time() . '-' . rand(0, 999999) . '.' . $imgType;
					$imagePathimage = '/../' . $imageUrl;
					$model->image = $imageUrl;
				}
				else
				{
					$model->image = null;
				}

				$model->createDateTime = new CDbExpression("NOW()");
				$model->updateDateTime = new CDbExpression("NOW()");
				if($model->save())
				{
					if(isset($image) && !empty($image))
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
						$flag = true;
				}

//				$emailController = new EmailSend();
//				$url = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/"; // Edit Your Url for send in content email
//				$action = "";
//				$no = 1;
//				$name = "Your Name";
//				$email = "admin@yourDomain.com";
//				$title = "Your Title";
//				$description = "Your Description";
//				$remark = "Your Remark";
//				$creator = "System Creator";
//				if($emailController->mailsend($email, $name, $no, $title, $description, $url, $action, $remark, $creator))
//				{
//					$flag = false;
//				}
				if($flag)
				{
					$transaction->commit();
					$this->redirect(array(
						'view',
						'id'=>$model->furnitureId));
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

		$this->render('create', array(
			'model'=>$model,
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

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

		if(isset($_POST['Furniture']))
		{
			$oldimage = $model->image;
			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$model->attributes = $_POST['Furniture'];
				$model->updateDateTime = new CDbExpression("NOW()");
				$folderimage = 'folderName';
				$image = CUploadedFile::getInstance($model, 'image');
				if(isset($image) && !empty($image))
				{
					$imgType = explode('.', $image->name);
					$imgType = $imgType[count($imgType) - 1];
					$imageUrl = '/images/' . $folderimage . '/' . time() . '-' . rand(0, 999999) . '.' . $imgType;
					$imagePathimage = '/../' . $imageUrl;
					$model->image = $imageUrl;
				}
				else
				{
					$model->image = $oldimage;
				}

				if($model->save())
				{
					$flag = true;
					if(isset($image) && !empty($image))
					{
						if(!file_exists(Yii::app()->getBasePath() . '/../' . 'images/' . $folderimage))
						{
							mkdir(Yii::app()->getBasePath() . '/../' . 'images/' . $folderimage, 0777);
						}

						if($image->saveAs(Yii::app()->getBasePath() . $imagePathimage))
						{
							if(isset($oldimage) && !empty($oldimage))
								unlink(Yii::app()->getBasePath() . '/..' . $oldimage);
						}
						else
							$flag = false;
					}
				}
//				$emailController = new EmailSend();
//				$url = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/"; // Edit Your Url for send in content email
//				$action = "";
//				$no = 1;
//				$name = "Your Name";
//				$email = "admin@yourDomain.com";
//				$title = "Your Title";
//				$description = "Your Description";
//				$remark = "Your Remark";
//				$creator = "System Creator";
//				if($emailController->mailsend($email, $name, $no, $title, $description, $url, $action, $remark, $creator))
//				{
//					$flag = false;
//				}
				if($flag)
				{
					$transaction->commit();
					$this->redirect(array(
						'view',
						'id'=>$model->furnitureId));
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

		$this->render('update', array(
			'model'=>$model,
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
	 * Lists all models.
	 */
	public function actionAdmin()
	{
		$dataProvider = new CActiveDataProvider('Furniture');
		$this->render('admin', array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model = new Furniture('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Furniture']))
			$model->attributes = $_GET['Furniture'];

		$this->render('index', array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Furniture the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Furniture::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Furniture $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'furniture-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
