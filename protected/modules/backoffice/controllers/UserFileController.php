<?php

class UserFileController extends MasterBackofficeController
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

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
		$model = new UserFile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserFile']))
		{
			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$model->attributes = $_POST['UserFile'];

				$folderUserFileId = 'folderName';
				$userFileId = CUploadedFile::getInstance($model, 'userFileId');
				if(isset($userFileId) && !empty($userFileId))
				{
					$imgType = explode('.', $userFileId->name);
					$imgType = $imgType[count($imgType) - 1];
					$imageUrl = '/images/' . $folderuserFileId . '/' . time() . '-' . rand(0, 999999) . '.' . $imgType;
					$imagePathuserFileId = '/../' . $imageUrl;
					$model->userFileId = $imageUrl;
				}
				else
				{
					$model->userFileId = null;
				}

				$folderUserFileName = 'folderName';
				$userFileName = CUploadedFile::getInstance($model, 'userFileName');
				if(isset($userFileName) && !empty($userFileName))
				{
					$imgType = explode('.', $userFileName->name);
					$imgType = $imgType[count($imgType) - 1];
					$imageUrl = '/images/' . $folderuserFileName . '/' . time() . '-' . rand(0, 999999) . '.' . $imgType;
					$imagePathuserFileName = '/../' . $imageUrl;
					$model->userFileName = $imageUrl;
				}
				else
				{
					$model->userFileName = null;
				}

				if($model->save())
				{
					if(isset($userFileId) && !empty($userFileId))
					{
						if(!file_exists(Yii::app()->getBasePath() . '/../' . 'images/' . $folderuserFileId))
						{
							mkdir(Yii::app()->getBasePath() . '/../' . 'images/' . $folderuserFileId, 0777);
						}

						if($userFileId->saveAs(Yii::app()->getBasePath() . $imagePathuserFileId))
						{
							if(isset($userFileName) && !empty($userFileName))
							{
								if(!file_exists(Yii::app()->getBasePath() . '/../' . 'images/' . $folderuserFileName))
								{
									mkdir(Yii::app()->getBasePath() . '/../' . 'images/' . $folderuserFileName, 0777);
								}

								if($userFileName->saveAs(Yii::app()->getBasePath() . $imagePathuserFileName))
								{
									$flag = true;
								}
								else
								{
									$flag = false;
								}
							}
						}
					}
				}

				if($flag)
				{
					$transaction->commit();
					$this->redirect(array(
						'view',
						'id'=>$model->userFileId));
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

		if(isset($_POST['UserFile']))
		{
			$olduserFileId = $model->userFileId;
			$olduserFileName = $model->userFileName;
			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$model->attributes = $_POST['UserFile'];

				$folderuserFileId = 'folderName';
				$userFileId = CUploadedFile::getInstance($model, 'userFileId');
				if(isset($userFileId) && !empty($userFileId))
				{
					$imgType = explode('.', $userFileId->name);
					$imgType = $imgType[count($imgType) - 1];
					$imageUrl = '/images/' . $folder{$columnName} . '/' . time() . '-' . rand(0, 999999) . '.' . $imgType;
					$imagePath{$columnName} = '/../' . $imageUrl;
					$model->userFileId = \imageUrl;
				}
				else
				{
					$model->userFileId = $olduserFileId;
				}

				$folderuserFileName = 'folderName';
				$userFileName = CUploadedFile::getInstance($model, 'userFileName');
				if(isset($userFileName) && !empty($userFileName))
				{
					$imgType = explode('.', $userFileName->name);
					$imgType = $imgType[count($imgType) - 1];
					$imageUrl = '/images/' . $folder{$columnName} . '/' . time() . '-' . rand(0, 999999) . '.' . $imgType;
					$imagePath{$columnName} = '/../' . $imageUrl;
					$model->userFileName = \imageUrl;
				}
				else
				{
					$model->userFileName = $olduserFileName;
				}

				if($model->save())
				{
					$flag = true;
					if(isset($userFileId) && !empty($userFileId))
					{
						if(!file_exists(Yii::app()->getBasePath() . '/../' . 'images/' . $folderuserFileId))
						{
							mkdir(Yii::app()->getBasePath() . '/../' . 'images/' . $folderuserFileId, 0777);
						}

						if($userFileId->saveAs(Yii::app()->getBasePath() . $imagePathuserFileId))
						{
							if(isset($olduserFileId) && !empty($olduserFileId))
								unlink(Yii::app()->getBasePath() . '/..' . $olduserFileId);
						}
						else
							$flag = false;
					}
					if(isset($userFileName) && !empty($userFileName))
					{
						if(!file_exists(Yii::app()->getBasePath() . '/../' . 'images/' . $folderuserFileName))
						{
							mkdir(Yii::app()->getBasePath() . '/../' . 'images/' . $folderuserFileName, 0777);
						}

						if($userFileName->saveAs(Yii::app()->getBasePath() . $imagePathuserFileName))
						{
							if(isset($olduserFileName) && !empty($olduserFileName))
								unlink(Yii::app()->getBasePath() . '/..' . $olduserFileName);
						}
						else
							$flag = false;
					}
				}

				if($flag)
				{
					$transaction->commit();
					$this->redirect(array(
						'view',
						'id'=>$model->userFileId));
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
		$dataProvider = new CActiveDataProvider('UserFile');
		$this->render('admin', array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model = new UserFile('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserFile']))
			$model->attributes = $_GET['UserFile'];

		$this->render('index', array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return UserFile the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = UserFile::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param UserFile $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'user-file-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
