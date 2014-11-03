<?php

class PriceGroupController extends MasterBackofficeController
{

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
//			'rights', // perform access control for CRUD operations
		);
	}

	public function allowedActions()
	{
		return '';
	}

	public $errorMessage;

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
		$model = new PriceGroup;
		$provinceModel = new Province();
		$priceModel = new Price();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PriceGroup']))
		{
			$model->attributes = $_POST['PriceGroup'];
			$model->supplierId = Yii::app()->user->supplierId;
			$flag = true;
			$isHasRate = false;
			$transaction = Yii::app()->db->beginTransaction();

			try
			{
				if($model->save())
				{
					$priceGroupId = Yii::app()->db->lastInsertID;
					foreach($_POST['Price'] as $i=> $price)
					{
						$price['priceGroupId'] = $priceGroupId;
						if(isset($price['status']) && !$price['status'])
							continue;

						$priceModel = new Price();
						$priceModel->attributes = $price;

						if(!$priceModel->save())
						{
							$flag = false;
							$transaction->rollback();
							break;
						}
						$isHasRate = true;
					}

					if($flag && $isHasRate)
					{
						$transaction->commit();
						$this->redirect(array(
							'view',
							'id'=>$model->priceGroupId));
					}
					else
					{
						$model->addError('priceRate', "Price rate must have value at least one province.");
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
		}

		$this->render('create', array(
			'model'=>$model,
			'priceModel'=>$priceModel,
			'provinceModel'=>$provinceModel
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
		//$priceModel = Price::model()->findAll('priceGroupId=' . $id);
		$priceModel = Price::model();
		$provinceModel = new Province();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['PriceGroup']))
		{
			$model->attributes = $_POST['PriceGroup'];
			$flag = true;
			$isHasRate = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				if($model->save())
				{
					//$priceGroupId = Yii::app()->db->lastInsertID;
					foreach($_POST['Price'] as $i=> $price)
					{
						//$price['priceGroupId'] = $id;

						if(($price['priceRate'] != ""))
						{
							$priceModel = Price::model()->findByPk($price['priceId']);
							if(!isset($priceModel))
							{
								$priceModel = new Price();
							}
							$priceModel->attributes = $price;
							if(isset($price['status']) && !$price['status'])
							{
								$priceModel->priceRate = 0;
								$priceModel->status = 0;
							}
							else
							{
								$priceModel->status = 1;
							}
							$priceModel->priceGroupId = $id;

							if(!$priceModel->save())
							{
								$flag = false;
								$transaction->rollback();
								break;
							}
							$isHasRate = true;
						}
					}

					if($flag && $isHasRate)
					{
						$transaction->commit();
						$this->redirect(array(
							'view',
							'id'=>$model->priceGroupId));
					}
					else
					{
						$model->addError('priceRate', "Price rate must have value at least one province.");
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
		}
//		if (isset($_POST['PriceGroup'])) {
//			$model->attributes = $_POST['PriceGroup'];
//			if ($model->save())
//				$this->redirect(array(
//					'view',
//					'id' => $model->priceGroupId));
//		}

		$this->render('update', array(
			'model'=>$model,
			'provinceModel'=>$provinceModel,
			'priceModel'=>$priceModel,
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
	public function actionIndex()
	{
		$model = new PriceGroup('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PriceGroup']))
		{
			$model->attributes = $_GET['PriceGroup'];
		}

		$this->render('index', array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PriceGroup the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = PriceGroup::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PriceGroup $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'price-group-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
