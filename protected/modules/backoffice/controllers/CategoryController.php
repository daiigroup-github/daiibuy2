<?php

class CategoryController extends MasterBackofficeController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
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
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Category;
        $brandToCat = new ModelToCategory1();

        if (isset($_GET["brandModelId"])) {
            $brandToCat->brandModelId = $_GET["brandModelId"];
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Category'])) {
            $flag = false;
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $model->attributes = $_POST['Category'];
                if (!Yii::app()->user->isGuest) {
                    $sup = UserToSupplier::model()->find("userId =" . Yii::app()->user->id);
                    if (isset($sup)) {
                        $model->supplierId = $sup->supplierId;
                        if ($sup->supplierId == 4) {
                            $model->isRoot = 1;
                        }
                    }
                }
                $model->createDateTime = new CDbExpression("NOW()");
                $model->updateDateTime = new CDbExpression("NOW()");
                $folderimage = 'category';
                $image = CUploadedFile::getInstance($model, 'image');
                if (isset($image) && !empty($image)) {
                    $imgType = explode('.', $image->name);
                    $imgType = $imgType[count($imgType) - 1];
                    $imageUrl = '/images/' . $folderimage . '/' . time() . '-' . rand(0, 999999) . '.' . $imgType;
                    $imagePathimage = '/../' . $imageUrl;
                    $model->image = $imageUrl;
                } else {
                    $model->image = null;
                }

                if ($model->save()) {
                    $categoryId = Yii::app()->db->lastInsertID;
                    if (isset($image) && !empty($image)) {
                        if (!file_exists(Yii::app()->getBasePath() . '/../' . 'images/' . $folderimage)) {
                            mkdir(Yii::app()->getBasePath() . '/../' . 'images/' . $folderimage, 0777);
                        }

                        if ($image->saveAs(Yii::app()->getBasePath() . $imagePathimage)) {
                            $flag = true;
                        } else {
                            $flag = false;
                        }
                    } else {
                        $flag = true;
                    }

                    if ($flag) {
                        if (!$this->actionSaveModelToCategory1($_GET["brandModelId"], $categoryId)) {
                            $flag = FALSE;
                        }
                    }
                }

                if ($flag) {
                    $transaction->commit();
                    $this->redirect(array(
                        'index?brandModelId=' . $_GET["brandModelId"]));
                } else {
                    $transaction->rollback();
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
                $transaction->rollback();
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Category'])) {
            $oldimage = $model->image;
            $flag = false;
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $model->attributes = $_POST['Category'];
                $model->updateDateTime = new CDbExpression("NOW()");
                $folderimage = 'category';
                $image = CUploadedFile::getInstance($model, 'image');
                if (isset($image) && !empty($image)) {
                    $imgType = explode('.', $image->name);
                    $imgType = $imgType[count($imgType) - 1];
                    $imageUrl = '/images/' . $folderimage . '/' . time() . '-' . rand(0, 999999) . '.' . $imgType;
                    $imagePathimage = '/../' . $imageUrl;
                    $model->image = $imageUrl;
                } else {
                    $model->image = $oldimage;
                }

                if ($model->save()) {
                    $flag = true;
                    if (isset($image) && !empty($image)) {
                        if (!file_exists(Yii::app()->getBasePath() . '/../' . 'images/' . $folderimage)) {
                            mkdir(Yii::app()->getBasePath() . '/../' . 'images/' . $folderimage, 0777);
                        }

                        if ($image->saveAs(Yii::app()->getBasePath() . $imagePathimage)) {
                            if (isset($oldimage) && !empty($oldimage))
                                @unlink(Yii::app()->getBasePath() . '/..' . $oldimage);
                        } else
                            $flag = false;
                    }
                }

                if ($flag) {
                    $transaction->commit();
                    $this->redirect(array(
                        'index?brandModelId=' . $model->modelToCategory1s[0]->brandModelId));
                } else {
                    $transaction->rollback();
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
                $transaction->rollback();
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
//		Yii::app()->db->createCommand("SET FOREIGN_KEY_CHECKS = 0;")->query();
        $model = ModelToCategory1::model()->findByPk($id);
        $model->delete();
//		Yii::app()->db->createCommand("SET FOREIGN_KEY_CHECKS = 1;")->query();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
                        'admin'));
    }

    /**
     * Lists all models.
     */
    public function actionAdmin() {
        $dataProvider = new CActiveDataProvider('Category');
        $this->render('admin', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Category('search');
        $model->unsetAttributes();  // clear any default values
        $brandToCat = new ModelToCategory1('search');
        if (isset($_GET["brandModelId"])) {
            $brandToCat->brandModelId = $_GET["brandModelId"];
        }
        if (isset($_GET['Category'])) {
            $model->attributes = $_GET['Category'];
            $brandToCat->attributes = $_GET['Category'];
        }

        $this->render('index', array(
            'brandToCat' => $brandToCat,
            'model' => $model
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Category the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Category::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Category $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'category-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSaveModelToCategory1($brandModelId = null, $categoryId = null) {
//		throw new Exception(print_r($_REQUEST, true));
        $result = array();
        $model = new ModelToCategory1();
        $model->createDateTime = new CDbExpression("NOW()");
        $model->updateDateTime = new CDbExpression("NOW()");
        if (!isset($_POST['categoryId'])) {
            $model->brandModelId = $brandModelId;
            $model->categoryId = $categoryId;
            return $model->save();
        } else {
            $model->brandModelId = $_POST["brandModelId"];
            $model->categoryId = $_POST["categoryId"];
            $result["status"] = $model->save();
            echo CJSON::encode($result);
        }
    }

    public function actionReplaceStakeByCategoryId() {
        $result = array();
        $categoryId = $_POST["categoryId"];
        $provinces = Province::model()->findAll();
        if (isset($categoryId)) {
            $result["status"] = TRUE;
            $result["stakeReplace"] = $this->renderPartial("_stake_table", array(
                'categoryId' => $categoryId,
                'provinces' => $provinces), true);
        } else {
            $result["status"] = FALSE;
        }

        echo CJSON::encode($result);
    }

    public function actionStake() {
        $flag = true;
        $model = new CategoryStakeProvince();
        $provinces = Province::model()->findAll();
        $text = "";
        if (isset($_GET["categoryId"])) {
            $model->categoryId = $_GET["categoryId"];
        }

        if (isset($_POST["CategoryStakeProvince"])) {
            foreach ($_POST["CategoryStakeProvince"] as $provinceId => $data) {
                if (isset($data["stake"]) && !empty($data["stake"])):
                    $stake = CategoryStakeProvince::model()->find("categoryId = " . $_GET["categoryId"] . " AND provinceId = $provinceId");
                    if (isset($stake)) {
                        $model = $stake;
                    } else {
                        $model = new CategoryStakeProvince();
                    }
                    $cateName = Category::model()->find('categoryId=' . $_GET['id']);
                    $subCate = Category::model()->find('categoryId=' . $_GET['categoryId']);
                    $text = $cateName->title . " - " . $subCate->title;
                    //throw new Exception($text);
                    $model->categoryId = $_GET["categoryId"];
                    $model->provinceId = $provinceId;
                    $model->stake = $data["stake"];
                    $subCate->fullName = $text;
                    $subCate->save(false);
                    $model->createDateTime = new CDbExpression("NOW()");
                    $model->updateDateTime = new CDbExpression("NOW()");

                    if (!$model->save()) {
                        $flag = FALSE;
                    }
                endif;
            }
            if ($flag) {
                if (isset($_POST["saveAndBack"])) {
                    $this->redirect(array(
                        '/backoffice/categoryToSub',
                        'categoryId' => $_GET["categoryId"],
                        'brandModelId' => $_GET["brandModelId"],
                        'isTheme' => 1));
                }
            }
        }

        $this->render("_stake", array(
            'model' => $model,
            'provinces' => $provinces,
            'categoryId' => isset($_GET["categoryId"]) ? $_GET["categoryId"] : NULL)
        );
    }

}
