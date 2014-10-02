<?php

class ContentController extends MasterBackofficeController
{

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			);
	}

	public function allowedActions()
	{
		return 'contentview';
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionContentView($id)
	{
		$this->layout = '//layouts/daiibuy/column1';
		$this->render('view', array(
			'model'=>$this->loadModel($id),
		));
	}

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
	public function actionCreate($id = null)
	{
		$model = new Content;
		if(isset($id))
		{
			$parent = Content::model()->findByPk($id);
			$model->parent = $parent;
			$model->parentId = $id;
			$model->type = $parent->type;
		}
		else
		{
			$parent = null;
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Content']))
		{
			$model->attributes = $_POST['Content'];
			$contentFolder = "content";
			$tempImage = CUploadedFile::getInstance($model, 'image');
			if(isset($tempImage))
			{
				$fileName = uniqid() . '_' . $tempImage->name;
				$model->image = '/images/' . $contentFolder . '/' . $fileName;
				$image = Yii::app()->image->load($tempImage->getTempName());
				//$image->resize(1170, 300)->rotate(0)->quality(75)->sharpen(20);
				switch($model->type)
				{
					case 0:
						$image->resize(1170, 300);
						break;
					case 1:
						$image->resize(250, 250);
						break;
					default:
						// Do nothing if not case in upper
						break;
				}
			}
			else
			{
				$model->image = null;
			}
			$model->createDateTime = new CDbExpression("NOW()");
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				if($model->save())
				{
					if(isset($model->image))
					{
						if(!file_exists(Yii::app()->getBasePath() . '/../' . "images/$contentFolder"))
						{
							mkdir(Yii::app()->getBasePath() . '/../' . "images/$contentFolder", 0777);
						}
						if(!$image->save(Yii::app()->basePath . '/../images/' . $contentFolder . '/' . $fileName)) // or $image->save('images/small.jpg');
						//if ($uploadFile->saveAs(Yii::app()->basePath . '/../images/bank/' . $fileName))
						{
							$transaction->rollback();
						}
					}
					$transaction->commit();
					if($model->parentId == 0)
					{
						$this->redirect(array(
							'index'));
					}
					else
					{
						$this->redirect(array(
							'update',
							'id'=>$model->parentId));
					}
				}
				else
				{
					$transaction->rollback();
				}
			}
			catch(Exception $ex)
			{
				$transaction->rollback();
				throw new Exception($e->getMessage());
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

		if(isset($_POST['Content']))
		{
			$model->attributes = $_POST['Content'];
			$contentFolder = "content";
			$tempImage = CUploadedFile::getInstance($model, 'image');
			if(isset($tempImage))
			{
				$fileName = uniqid() . '_' . $tempImage->name;
				$model->image = '/images/' . $contentFolder . '/' . $fileName;
				$image = Yii::app()->image->load($tempImage->getTempName());
				//$image->resize(1170, 300)->rotate(0)->quality(75)->sharpen(20);
				switch($model->type)
				{
					case 0:
						$image->resize(1170, 300);
						break;
					case 1:
						$image->resize(250, 250);
						break;
					default:
						// Do nothing if not case in upper
						break;
				}
			}
			else
			{
				$model->image = $_POST['Content']['oldImage'];
			}


			$model->updateDateTime = new CDbExpression("NOW()");
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				if($model->save())
				{
					if(isset($image))
					{
						if(!file_exists(Yii::app()->getBasePath() . '/../' . "images/$contentFolder"))
						{
							mkdir(Yii::app()->getBasePath() . '/../' . "images/$contentFolder", 0777);
						}
						if(!$image->save(Yii::app()->basePath . '/../images/' . $contentFolder . '/' . $fileName)) // or $image->save('images/small.jpg');
						{
							$transaction->rollback();
						}
					}

					$transaction->commit();
					if($model->parentId == 0)
					{
						$this->redirect(array(
							'index'));
					}
					else
					{
						$this->redirect(array(
							'update',
							'id'=>$model->parentId));
					}
				}
				else
				{
					$transaction->rollback();
				}
			}
			catch(Exception $ex)
			{
				$transaction->rollback();
				throw new Exception($e->getMessage());
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
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model = new Content('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Content']))
			$model->attributes = $_GET['Content'];

		$this->render('index', array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Content the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Content::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Content $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'content-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
