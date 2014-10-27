<?php

class CategoryToSubController extends MasterBackofficeController
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
		$cat = new Category();
		$model = new CategoryToSub;
		if($_GET["categoryId"])
		{
			$model->categoryId = $_GET["categoryId"];
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$cat->attributes = $_POST["Category"];
				$cat->isRoot = 0;
				if(!Yii::app()->user->isGuest)
				{
					$sup = UserToSupplier::model()->find("userId =" . Yii::app()->user->id);
					$cat->supplierId = $sup->supplierId;
				}
				$catModel = Category::model()->findByPk($model->categoryId);
				$cat->createDateTime = new CDbExpression("NOW()");
				$cat->updateDateTime = new CDbExpression("NOW()");
				$folderimage = 'subCategory';
				$image = CUploadedFile::getInstance($cat, 'image');
				if(isset($image) && !empty($image))
				{
					$imgType = explode('.', $image->name);
					$imgType = $imgType[count($imgType) - 1];
					$imageUrl = '/images/' . $folderimage . '/' . time() . '-' . rand(0, 999999) . '.' . $imgType;
					$imagePathimage = '/../' . $imageUrl;
					$cat->image = $imageUrl;
				}
				else
				{
					$cat->image = null;
				}
				if($cat->save())
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
					{
						$flag = true;
					}

					$subCatId = Yii::app()->db->lastInsertID;
					$model->attributes = $_POST['CategoryToSub'];
					$model->subCategoryId = $subCatId;
					$model->createDateTime = new CDbExpression("NOW()");
					$model->updateDateTime = new CDbExpression("NOW()");
					if($model->save())
					{
						$flag = true;
					}
				}

				if($flag)
				{
					$transaction->commit();
					$this->redirect(array(
						'index',
						'categoryId'=>$_GET["categoryId"]));
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
			'cat'=>$cat
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
		$cat = $model->subCategory;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$oldImage = $cat->image;
				$cat->attributes = $_POST["Category"];
				$catModel = Category::model()->findByPk($model->categoryId);
				$cat->updateDateTime = new CDbExpression("NOW()");

				$folderimage = 'subCategory';
				$image = CUploadedFile::getInstance($cat, 'image');
				if(isset($image) && !empty($image))
				{
					$imgType = explode('.', $image->name);
					$imgType = $imgType[count($imgType) - 1];
					$imageUrl = '/images/' . $folderimage . '/' . time() . '-' . rand(0, 999999) . '.' . $imgType;
					$imagePathimage = '/../' . $imageUrl;
					$cat->image = $imageUrl;
				}
				else
				{
					$cat->image = $oldImage;
				}
				if($cat->save())
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
					{
						$flag = true;
					}
					$model->attributes = $_POST['CategoryToSub'];
					$model->updateDateTime = new CDbExpression("NOW()");

					if($model->save())
					{
						$flag = true;
					}
				}

				if($flag)
				{
					$transaction->commit();
					$this->redirect(array(
						'index',
						'categoryId'=>$model->categoryId));
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
			'cat'=>$cat
		));
	}

	public function actionUpdateDescription($id)
	{
		$model = $this->loadModel($id);
		if(isset($_POST["CategoryToSub"]))
		{
			$model->attributes = $_POST["CategoryToSub"];
			if($model->save())
			{
				$this->redirect(array(
					'index',
					'categoryId'=>$model->categoryId));
			}
		}
		$this->render('update_description', array(
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
		$dataProvider = new CActiveDataProvider('CategoryToSub');
		$this->render('admin', array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model = new CategoryToSub('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['CategoryToSub']))
			$model->attributes = $_GET['CategoryToSub'];
		if(isset($_GET["categoryId"]))
		{
			$model->categoryId = $_GET["categoryId"];
		}

		$this->render('index', array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CategoryToSub the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = CategoryToSub::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CategoryToSub $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'category-to-sub-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionSaveCategorytoSub($categoryId = null, $subCategoryId = null, $isTheme = false, $isSet = false)
	{
//		throw new Exception(print_r($_REQUEST, true));
		$result = array();
		$model = new CategoryToSub();
		$model->createDateTime = new CDbExpression("NOW()");
		$model->updateDateTime = new CDbExpression("NOW()");
		if(!isset($_POST['categoryId']))
		{
			$model->categoryId = $categoryId;
			$model->subCategoryId = $subCategoryId;
			$model->isTheme = FALSE;
			$model->isSet = false;
			return $model->save();
		}
		else
		{
			$model->categoryId = $_POST["categoryId"];
			$model->subCategoryId = $_POST["subCategoryId"];
			$result["status"] = $model->save();
			echo CJSON::encode($result);
		}
	}

}
