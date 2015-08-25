<?php

class MadridController extends MasterMyFileController
{

	public function init()
	{
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/fileinput.js');
		Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/themes/homeshop/assets/css/fileinput.css');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/wizard.create.myfile.js');
		parent::init();
	}

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
		$this->layout = '//layouts/cl1';
		$model = $this->loadModel($id);
		$orderDetailModel = OrderDetail::model()->find('orderId = ' . $id);
		$orderDetailId = $orderDetailModel->orderDetailId;
		$orderDetailModel->orderDetailTemplateId = OrderDetail::model()->getOrderDetailTemplateIdBySupplierId(3);
		$orderDetailTemplateField = OrderDetailTemplateField::model()->findAll('orderDetailTemplateId = ' . $orderDetailModel->orderDetailTemplateId . ' AND status = 1');
		$orderDetailValueCat2 = OrderDetailValue::model()->find('orderDetailId = ' . $orderDetailId . ' AND orderDetailTemplateFieldId = 9');
//        throw new Exception(print_r($orderDetailTemplateFieldCat2, true));
		$category2Id = isset($orderDetailValueCat2->value) ? $orderDetailValueCat2->value : null;
		$themes = UserFavourite::model()->findAllThemeAndSetByUserIdAndCate2Id(Yii::app()->user->id, TRUE, $category2Id);
		$sets = UserFavourite::model()->findAllThemeAndSetByUserIdAndCate2Id(Yii::app()->user->id, FALSE);
//        throw new Exception(print_r($_POST["OrderItems"], true));
//        throw new Exception(print_r($themes, true));
		if(isset($category2Id))
		{
			$resultTheme = "";
			$resultTheme .= "<ul>";
			foreach($themes as $theme):
				$url = '"' . Yii::app()->baseUrl . '"';
				$resultTheme .= "<li><a href='#'  onclick='loadThemeItem(" . $theme->category2Id . "," . $url . "," . (isset($model->orderId) ? $model->orderId : 0) . ")' > " . $theme->category2->title . "</li></a>";
			endforeach;
			$resultTheme .= "</ul>";
			$resultSets = "";
			$resultSets .= "<ul>";
			foreach($sets as $set):
				$resultSets .= "<li><a href='#' onclick='loadSetItem(" . $set->category2Id . ", " . $url . ")'>" . $set->category2->title . "</li></a>";
			endforeach;
			$resultSets .= "</ul>";
			$results = array();
			$results["themes"] = $resultTheme;
			$results["sets"] = $resultSets;
			$results["status"] = 1;
//            throw new Exception(print_r($results, true));
		}else
		{
			$results["status"] = 0;
		}

		if(isset($_POST["OrderItems"]))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				foreach($_POST["OrderItems"] as $k=> $v)
				{
//                throw new Exception(print_r($_POST["OrderItems"], true));
					if(empty($v["productId"]))
					{
						$orderItems = OrderItems::model()->findByPk($k);
						$orderItems->delete();
					}
					else if(!empty($v["quantity"]))
					{
						$orderItems = OrderItems::model()->findByPk($k);
						$productModel = Product::model()->findByPk($v["productId"]);
						if(isset($orderItems))
						{
							$orderItems->title = $productModel->name;
							$orderItems->quantity = intval($v["quantity"]);
							$orderItems->price = $v["price"];
							$orderItems->productId = $v["productId"];
							$orderItems->total = $orderItems->quantity * $orderItems->price;
							if($orderItems->save(FALSE))
							{
								$model->status = 2;
								$model->save(false);
							}
						}
					}
				}
			}
			catch(Exception $exc)
			{
				$transaction->rollback();
				echo $exc->getTraceAsString();
			}
			$transaction->commit();
		}
		$categoryToSub = CategoryToSub::model()->findAll(array(
			'condition'=>' isType=1',
		));
		$subCategorysId = implode(',', CHtml::listData($categoryToSub, 'categoryId', 'categoryId'));
		$categorys = Category::model()->findAll("categoryId IN (" . $subCategorysId . ")");
		$items = $this->showType($categorys);
//        throw new Exception(print_r($results, true));
		$this->render('view', array(
			'model'=>$model,
			'orderDetailTemplateField'=>$orderDetailTemplateField,
			'categoryItems'=>$items,
			'results'=>$results,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
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
		if(isset($_FILES['OrderFile']) && $_POST["Order"]["createMyfileType"] == 2)
		{
//			$planFile = $_FILES['OrderFile'];
//            throw new Exception(print_r($_FILES['OrderFile'], true));
			try
			{
				if(isset($_POST['Order']))
				{
//                    throw new Exception(print_r($_POST["Order"], true));
					$flag = false;
					$transaction = Yii::app()->db->beginTransaction();
					$model->attributes = $_POST['Order'];
					$model->type = 1;
					$model->status = 0;
					$model->supplierId = 3;
					$model->isTheme = $_POST["Order"]["isTheme"];
					$model->userId = Yii::app()->user->id;
					$model->createDateTime = new CDbExpression("NOW()");
//                    throw new Exception(print_r($model, true));
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
//                            throw new Exception(print_r($_POST["OrderDetailValue"], true));
							foreach($_POST["OrderDetailValue"] as $k=> $v)
							{
								if($v["value"] <> "")
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
					}
					else
					{
//                        throw new Exception(print_r($model, true));
						$flag = FALSE;
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
				if($_POST["Order"]["isTheme"] == 3)
				{
					$model->isTheme = 0;
				}
				else
				{
					$model->isTheme = 1;
				}
//                throw new Exception(print_r($model, true));
				$model->userId = Yii::app()->user->id;
				$model->createDateTime = new CDbExpression("NOW()");
//                throw new Exception(print_r($model, true));
				if($model->save(false))
				{
					$orderId = Yii::app()->db->lastInsertID;
					$orderDetailModel->orderId = $orderId;
					if($orderDetailModel->save())
					{
						$orderDetailModel->orderDetailId = Yii::app()->db->lastInsertID;
						$flag = true;
					}
					else
					{
						$flag = false;
					}
//                    throw new Exception(print_r($_POST["OrderItems"], true));
					foreach($_POST["OrderItems"] as $k=> $v)
					{
						if(!empty($v["productId"]))
						{
							$product = Product::model()->findByPk($v["productId"]);
							$orderItems = new OrderItems();
							$orderItems->orderId = $orderId;
							$orderItems->title = $product->name;
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
//                throw new Exception(print_r($flag, true));
				if($flag)
				{
					foreach($_POST["OrderDetailValue"] as $k=> $v)
					{
						if(isset($v["value"]))
						{
							$orderFieldValue = new OrderDetailValue();
							$orderFieldValue->orderDetailTemplateFieldId = $k;
							$orderFieldValue->value = $v["value"];
							$orderFieldValue->orderDetailId = $orderDetailModel->orderDetailId;
							$orderFieldValue->createDateTime = new CDbExpression("NOW()");
							$orderFieldValue->updateDateTime = new CDbExpression("NOW()");
//                            throw new Exception(print_r($orderFieldValue, true));
							if($orderFieldValue->save())
							{
								$flag = TRUE;
							}
							else
							{
								$flag = FALSE;
								break;
							}
						}
						else
						{
							$flag = TRUE;
						}
					}
//                    throw new Exception(print_r($v["value"], true));
					$flag = TRUE;
					if($flag)
					{
						$transaction->commit();
//                        throw new Exception(print_r($model->orderItems, true));
						$this->redirect(array(
							'view',
							'id'=>$model->orderId));
					}
					else
					{

					}
				}
			}
		}
		$categoryToSub = CategoryToSub::model()->findAll(array(
			'condition'=>' isType=1',
		));
		$subCategorysId = implode(',', CHtml::listData($categoryToSub, 'categoryId', 'categoryId'));
		$categorys = Category::model()->findAll("categoryId IN (" . $subCategorysId . ")");
		$items = $this->showType($categorys);
		$this->render('create', array(
			'model'=>$model,
//				'orderDetailModel'=>$orderDetailModel,
			'orderDetailTemplateField'=>$orderDetailTemplateField,
			'categoryItems'=>$items,
		));
	}

	public function showType($categorys)
	{
		$items = [];
		$i = 1;
		/*
		  foreach ($this->scanDir(Yii::app()->basePath . '/../images/madrid/tile') as $file) {
		  if(substr($file, 0, 1) == '.') continue;
		  $items[$i] = [
		  'id' => $i,
		  'image' => Yii::app()->baseUrl . '/images/madrid/tile/' . $file,
		  'url' => Yii::app()->createUrl('madrid/product/index/id/' . $i),
		  'title' => substr($file, 0, -4),
		  'price' => rand(1000, 99999),
		  'buttons' => [
		  'favorites'
		  ],
		  'isQuickView'=>true
		  ];
		  $i++;
		  }
		 */
		foreach($categorys as $category)
		{
			$image = '';
			if(isset($category->categoryImages))
			{
				foreach($category->categoryImages as $categoryImage)
				{
					$image = $categoryImage->image;
					break;
				}
			}
			$items[$i] = array(
				'id'=>$category->categoryId,
				'image'=>Yii::app()->baseUrl . $category->image,
				'url'=>Yii::app()->createUrl('madrid/theme/index/id/' . $category->categoryId),
				'category2Id'=>$category->categoryId,
				'title'=>$category->title,
				//'price' => rand(1000, 99999),
//				'buttons'=>[
//					'favorites'
//				],
				'isQuickView'=>true
			);
			$i++;
		}
		return $items;
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
		if(isset($_POST['Order']))
		{
			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$model->attributes = $_POST['Order'];
				if($model->save())
				{
					$flag = true;
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
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$this->layout = '//layouts/cl1';
		$myfileArray = Order::model()->findAllMyFileBySupplierId(isset(Yii::app()->user->id) ? Yii::app()->user->id : 0, 3, $this->cookie->token);
		$myfileHistoryArray = Order::model()->findAllMyFileHistoryBySupplierId(isset(Yii::app()->user->id) ? Yii::app()->user->id : 0, 3, $this->cookie->token);
		$this->render('index', array(
			'myfileArray'=>$myfileArray,
			'myfileHistoryArray'=>$myfileHistoryArray));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Order the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Order::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Order $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionLoadThemeItem()
	{
		$result = array();
		if(isset($_POST["orderId"]) && $_POST["orderId"] > 0)
		{
			$model = $this->loadModel($_POST["orderId"]);
		}
		if(!isset($model))
		{
			$model = new Order();
		}
		$model->isTheme = 1;
		$result['view'] = $this->renderPartial("_theme", array(
			'model'=>$model), true);
		if(isset($_POST["category2Id"]))
		{
			$cat2ToProduct = Category2ToProduct::model()->findAll("category2Id = " . $_POST["category2Id"]);
//            throw new Exception(print_r($cat2ToProduct, true));
			if(count($cat2ToProduct) > 0)
			{
				$result["status"] = TRUE;
				foreach($cat2ToProduct as $item)
				{
					$result[strtolower($item->groupName)]["productId"] = $item->productId;
//                    throw new Exception(print_r($result, true));
					$result[strtolower($item->groupName)]["code"] = $item->product->code;
					$result[strtolower($item->groupName)]["name"] = $item->product->name;
					$result[strtolower($item->groupName)]["width"] = $item->product->width;
					$result[strtolower($item->groupName)]["height"] = $item->product->height;
					$result[strtolower($item->groupName)]["productArea"] = isset($item->product->area) ? $item->product->area : ($item->product->width * $item->product->width) / 1000;
					$result[strtolower($item->groupName)]["price"] = $item->product->price;
					$result[strtolower($item->groupName)]["productUnits"] = $item->product->productUnits;
				}
//                throw new Exception(print_r($result, true));
			}
			else
			{
				$result["status"] = FALSE;
				$result["errorMessage"] = "Cant' find Product Array";
			}
		}
		else
		{
			$result["status"] = FALSE;
			$result["errorMessage"] = "Cant' find POST Parameter";
		}
//        throw new Exception(print_r(count($cat2ToProduct), true));
//        throw new Exception(print_r($result, true));
		echo CJSON::encode($result);
	}

	public function actionRenderThemeView()
	{
		if(isset($_POST["orderId"]) && $_POST["orderId"] > 0)
		{
			$model = $this->loadModel($_POST["orderId"]);
		}
		if(!isset($model))
		{
			$model = new Order();
		}
		$model->isTheme = 1;
		$this->renderPartial("_theme", array(
			'model'=>$model));
	}

	public function actionLoadSetItem()
	{
		$cat2ToProduct = new Category2ToProduct();
		$result = array();
		if(isset($_POST["category2Id"]))
		{
			$cat2ToProduct = Category2ToProduct::model()->findAll("category2Id = " . $_POST["category2Id"]);
		}
		$this->renderPartial("_sanitary_set", array(
			'model'=>$cat2ToProduct), FALSE, TRUE);
	}

	public function actionPrepareProductsFav()
	{
		$products = UserFavourite::model()->findAll("userId = " . Yii::app()->user->id . " AND productId is not null ");
		$resultTheme = "";
		$resultTheme .= "<ul>";
		$url = Yii::app()->baseUrl;
//        throw new Exception(print_r($products, true));
		foreach($products as $theme):
			if(isset($theme->product->name) && isset($theme->productId))
			{
				$url = '"' . Yii::app()->baseUrl . '"';
				$resultTheme .= "<li><a href='#'  onclick='loadProductsFavItem(" . $theme->productId . "," . $url . "," . 0 . "," . $_POST['provinceId'] . ")' > " . $theme->product->name . "</li></a>";
			}
		endforeach;
		$resultTheme .= "</ul>";
		$results = array();
		$results["products"] = $resultTheme;
		$results["status"] = TRUE;
//        throw new Exception(print_r($results, true));
		echo CJSON::encode($results);
	}

	public function actionBackTo3($id)
	{
		$model = Order::model()->findByPk($id);
		$model->status = 1;
		$model->save();
		$this->redirect(array(
			'view',
			'id'=>$id));
	}

	public function actionFinish($id)
	{
//		$model = Order::model()->findByPk($id);
//		$model->status = 3;
//		$model->save();
		$this->redirect(array(
			'index'));
	}

	public function actionAddtoCart($id)
	{
		$model = Order::model()->findByPk($id);
		$model->type = 3;
		$model->save();
		$this->redirect(array(
			'index'));
	}

	public function actionFindProductByPk()
	{
		$model = Product::model()->findByPk($_POST["productId"]);
		echo CJSON::encode($model->attributes);
	}

	public function actionPrepareThemeAndSet()
	{
//        throw new Exception(print_r($_POST["category2Id"], true));
		$category2Id = $_POST["category2Id"];
		$themes = UserFavourite::model()->findAllThemeAndSetByUserIdAndCate2Id(Yii::app()->user->id, TRUE, $category2Id);
		$sets = UserFavourite::model()->findAllThemeAndSetByUserIdAndCate2Id(Yii::app()->user->id, FALSE);
//        $products = UserFavourite::model()->findAll("userId =" . Yii::app()->user->id . " AND productId =" . $_POST["productId"]);
//        throw new Exception(print_r($themes, true));
		$resultTheme = "";
		$resultTheme .= "<ul>";
		foreach($themes as $theme):
			$url = '"' . Yii::app()->baseUrl . '"';
			$resultTheme .= "<li><a href='#'  onclick='loadThemeItem(" . $theme->category2Id . "," . $url . "," . 0 . ")' > " . $theme->category2->title . "</li></a>";
		endforeach;
		$resultTheme .= "</ul>";
		$resultSets = "";
		$resultSets .= "<ul>";
		foreach($sets as $set):
			$resultSets .= "<li><a href='#' onclick='loadSetItem(" . $set->category2Id . ", " . $url . ")'>" . $set->category2->title . "</li></a>";
		endforeach;
		$resultSets .= "</ul>";
		$results = array();
		$results["themes"] = $resultTheme;
		$results["sets"] = $resultSets;
		$results["status"] = TRUE;
//        throw new Exception(print_r($results, true));
		echo CJSON::encode($results);
	}

	public function actionLoadProductFavItem()
	{
		$result = array();
		if(isset($_POST["orderId"]) && $_POST["orderId"] > 0)
		{
			$model = $this->loadModel($_POST["orderId"]);
		}
		if(!isset($model))
		{
			$model = new Order();
		}
		$model->isTheme = 0;
//        $result['view'] =
		if(isset($_POST["productId"]))
		{
			$product = Product::model()->findByPk($_POST["productId"]);
//            throw new Exception(print_r($product, true));
			$this->renderPartial("_product_fav", array(
				'model'=>$model,
				'product'=>$product,
				'provinceId'=>$_POST["provinceId"]), FALSE, TRUE);
		}
//
//        if (isset($product)) {
//            $result["status"] = TRUE;
//            $result["productId"] = $product->productId;
//            $result["code"] = $product->code;
//            $result["image"] = isset($product->productImagesSort[0]) ? Yii::app()->baseUrl . $product->productImagesSort[0]->image : "";
//            $result["name"] = $product->name;
//            $result["description"] = $product->description;
//            $result["width"] = $product->width;
//            $result["height"] = $product->height;
//            $result["productArea"] = isset($product->area) ? $product->area : "";
//            $result["price"] = $product->price;
//            $result["noPerBox"] = isset($product->noPerBox) ? $product->noPerBox : 12;
//            $result["productUnits"] = $product->productUnits;
//        } else {
//            $result["status"] = FALSE;
//            $result["errorMessage"] = "Cant' find Product Array";
//        }
//        } else {
//            $result["status"] = FALSE;
//            $result["errorMessage"] = "Cant' find POST Parameter";
//        }
//        echo CJSON::encode($result);
	}

	public function actionFindTileByProductId()
	{
		$productId = $_POST["productId"];
		$category1Id = $_POST["category1Id"];
		$productModel = Product::model()->findByPk($productId);
		$category2ToProduct = Category2ToProduct::model()->find('productId = ' . $productId . ' and category1Id = ' . $category1Id);
//        throw new Exception(print_r($productModel, true));
		$result[$productModel->productId]["productId"] = $productModel->productId;
		$result[$productModel->productId]["productCode"] = $productModel->code;
		$result[$productModel->productId]["name"] = $productModel->name;
		$result[$productModel->productId]["productUnits"] = $productModel->productUnits;
		$result[$productModel->productId]["productArea"] = $productModel->area;
//        throw new Exception(print_r($productModel->calProductPromotionPrice(null, null), true));
		$result[$productModel->productId]["price"] = $productModel->calProductPromotionPrice(null, null);
		$result[$productModel->productId]["productUnits"] = $productModel->productUnits;
		$result[$productModel->productId]["productImage"] = CHtml::image(Yii::app()->baseUrl . $productModel->productImages[0]->image);
//        throw new Exception(print_r(count($cat2ToProduct), true));
//        throw new Exception(print_r($result, true));
		echo CJSON::encode($result);
	}

}
