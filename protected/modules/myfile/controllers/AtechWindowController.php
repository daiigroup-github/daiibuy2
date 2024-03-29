<?php

class AtechWindowController extends MasterMyFileController {

    public function init() {
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/vendor/jquery.ui.widget.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/jquery.iframe-transport.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/jquery.fileupload.js');
//		Yii::app()->clientScript->registerScrisptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/jquery.fileupload-process.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/jquery.fileupload-image.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/jquery.fileupload-audio.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/jquery.fileupload-video.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/jquery.fileupload-validate.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/main.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/jquery.blueimp-gallery.min.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/canvas-to-blob.min.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/load-image.all.min.js');
//		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/tmpl.min.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/daiibuy.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/fileinput.js');
        Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/themes/homeshop/assets/css/fileinput.css');
//		Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/themes/homeshop/assets/css/vetical_navbar.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/themes/homeshop/assets/js/wizard.create.myfile.js');
        parent::init();
    }

    public function actionIndex() {
        $this->layout = '//layouts/cl1';

        $myfileArray = Order::model()->findAllMyFileBySupplierId(isset(Yii::app()->user->id) ? Yii::app()->user->id : 0, 2, null);
        $myfileHistoryArray = Order::model()->findAllMyFileHistoryBySupplierId(Yii::app()->user->id, 2, null);
        $this->render('index', array(
            'myfileArray' => $myfileArray,
            'myfileHistoryArray' => $myfileHistoryArray));
    }

    public function actionCreate() {
        $this->layout = '//layouts/cl1';

        $model = new Order;
        $orderDetailModel = new OrderDetail;
        $orderDetailModel->orderDetailTemplateId = OrderDetail::model()->getOrderDetailTemplateIdBySupplierId(2);
        $orderDetailTemplateField = OrderDetailTemplateField::model()->findAll('orderDetailTemplateId = ' . $orderDetailModel->orderDetailTemplateId . ' AND status = 1');
        $modelArray = BrandModel::model()->findAll('supplierId = 2 AND status = 1');
        // uncomment the following code to enable ajax-based validation
        /*
          if(isset($_POST['ajax']) && $_POST['ajax']==='order-create-form')
          {
          echo CActiveForm::validate($model);
          Yii::app()->end();
          }
         */
//		throw new Exception(print_r($_FILES['OrderFile'],true));
        if (isset($_FILES['OrderFile'])) {
//			$planFile = $_FILES['OrderFile'];
            try {
                if (isset($_POST['Order'])) {
                    $flag = false;
                    $transaction = Yii::app()->db->beginTransaction();
                    $model->attributes = $_POST['Order'];
                    $model->type = 1;
                    $model->status = 0;
                    $model->supplierId = 2;
                    $model->userId = Yii::app()->user->id;
                    $model->createDateTime = new CDbExpression("NOW()");

                    if ($model->save()) {
                        $folderimage = "orderFile";
                        $orderId = Yii::app()->db->lastInsertID;
                        $this->saveOrderDetail($orderId, $orderDetailModel->orderDetailTemplateId);
                        for ($i = 0; $i <= sizeof($_FILES["OrderFile"]); $i++) {
                            $image = CUploadedFile::getInstanceByName("OrderFile[$i]");
                            if (isset($image) && !empty($image)) {
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
                                $orderFileModel->userType = Yii::app()->user->userType;
                                $orderFileModel->status = 1;
                                if ($orderFileModel->save()) {
                                    if (!file_exists(Yii::app()->getBasePath() . '/../' . 'images/' . $folderimage)) {
                                        mkdir(Yii::app()->getBasePath() . '/../' . 'images/' . $folderimage, 0777);
                                    }
                                    if ($image->saveAs(Yii::app()->getBasePath() . $imagePathimage)) {
                                        $flag = true;
                                    } else {
                                        $flag = false;
                                    }
                                } else {
                                    $flag = FALSE;
                                    break;
                                }
                            }
                        }

                        if ($flag) {
//                            throw new Exception(print_r($_POST["OrderDetailValue"], true));
                            foreach ($_POST["OrderDetailValue"] as $k => $v) {
                                if ($v["value"] <> "") {
                                    $orderFieldValue = new OrderDetailValue();
                                    $orderFieldValue->orderDetailTemplateFieldId = $k;
                                    $orderFieldValue->value = $v["value"];
                                    $orderFieldValue->orderDetailId = $this->orderDetailId;
                                    $orderFieldValue->createDateTime = new CDbExpression("NOW()");
                                    $orderFieldValue->updateDateTime = new CDbExpression("NOW()");
                                    if (!$orderFieldValue->save()) {

                                        $flag = FALSE;
                                        break;
                                    }
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        $this->redirect(array(
                            'view',
                            'id' => $model->orderId));
                    } else {
                        $transaction->rollback();
                    }
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
                $transaction->rollback();
            }
        } else {
            $this->render('create', array(
                'model' => $model,
                'modelArray' => $modelArray,
//				'orderDetailModel'=>$orderDetailModel,
//				'orderDetailTemplateFieldArray'=>$orderDetailTemplateField,
            ));
        }
    }

    public function actionView($id) {
        $modelArray = BrandModel::model()->findAll('supplierId = 2 AND status = 1');
        $model = $this->loadModel($id);
        $res = array();
        if (count($model->orderItems) > 0) {
            $total = 0.00;
            foreach ($model->orderItems as $item) {
                $productModel = Product::model()->findByPk($item->productId);
                $productPromotion = ProductPromotion::model()->find("productId=:productId AND ('" . date("Y-m-d") . "' BETWEEN dateStart AND dateEnd)", array(
                    ":productId" => $productModel->productId));
                $res["items"][$productModel->productId]['productId'] = $productModel->productId;
                $res["items"][$productModel->productId]['code'] = $productModel->code;
                $res["items"][$productModel->productId]['width'] = $productModel->width;
                $res["items"][$productModel->productId]['height'] = $productModel->height;
//			$res["items"][$productModel->productId]['category'] = $productModel->categoryId;
//			$res["items"][$productModel->productId]['type'] = $item['type'];
                $res["items"][$productModel->productId]['description'] = $productModel->name;
                $res["items"][$productModel->productId]['quantity'] = $item->quantity;
                if (isset($productPromotion)) {
                    //promotion price
                    $res["items"][$productModel->productId]['price'] = Product::model()->calProductPromotionTotalPrice($productModel->productId, 1, $model->provinceId);
                } else {
                    //normal price
                    $res["items"][$productModel->productId]['price'] = Product::model()->calProductTotalPrice($productModel->productId, 1, $model->provinceId);
                }
                $subTotal = $res["items"][$productModel->productId]['price'] * $res["items"][$productModel->productId]['quantity'];
                $res["items"][$productModel->productId]['subTotal'] = $subTotal;

                $total = $subTotal + $total;
            }
            $res["total"] = $total;
            $cate2ToProduct = Category2ToProduct::model()->find('productId = ' . $productModel->productId);
            $modelToCategory = ModelToCategory1::model()->find('categoryId = ' . $cate2ToProduct->category1Id);
            $res["brandModelId"] = $modelToCategory->brandModelId;
//            throw new Exception(print_r($res["brandModelId"], true));
        }

        $this->layout = '//layouts/cl1';
        $this->render('view', array(
            'model' => $model,
            'productResult' => $res,
            'modelArray' => $modelArray,
        ));
    }

    public function loadModel($id) {
        $model = Order::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionSaveMyFileAtech() {
        $isNew = true;
        if (isset($_POST['provinceId'])) {
            $provinceId = $_POST['provinceId'];
        }
        if (isset($_POST['title'])) {
            $title = $_POST['title'];
        }
        if (isset($_POST['orderId']) && !($_POST['orderId'] == "") && !($_POST['orderId'] == NULL))
		{
			$orderId = $_POST['orderId'];
            $isNew = FALSE;
		}

        if (isset($_POST['brandModelId'])) {
            $brandModelId = $_POST['brandModelId'];
        }

        if (isset($_POST['productItems'])) {
            $productItems = $_POST['productItems'];
            $productArray = array();
            $a = 0;
            foreach ($productItems as $z) {
                foreach ($z as $productId => $item) {
                    $productModel = Product::model()->findByPk($productId);
                    $productArray[$a] = $productModel;
                    $productArray[$a]['quantity'] = isset($item["quantity"]) ? $item["quantity"] : 1;
				}
                $a++;
            }
//			foreach($productItems as $productId=> $item)
//			{
//				$productModel = Product::model()->findByPk($productId);
//				$productArray[$productModel->productId] = $productModel;
//				$productArray[$productModel->productId]['quantity'] = $item["quantity"];
//			}
        }
//	throw new Exception(print_r($productArray, true));

		$res = Product::model()->calculatePriceFromEstimateAtech($brandModelId, $provinceId, $productArray, isset($orderId) ? $orderId : null );
		//disable foreign key
        $transaction = Yii::app()->db->beginTransaction();
        $sqlForeignKeyDisable = 'SET foreign_key_checks = 0;';
        $command = Yii::app()->db->createCommand($sqlForeignKeyDisable);
        $command->execute();
        try {
        if ($isNew == FALSE)
			{
				$model = Order::model()->findByPk($orderId);
			} else {
            $model = new Order();
            $model->title = $title;
            $model->provinceId = $provinceId;
            $model->type = 1;
            $model->totalIncVAT = $res["total"];
            $model->supplierId = 2;
            $model->userId = Yii::app()->user->id;
            $model->createDateTime = new CDbExpression("NOW()");
        }
        $model->status = 2;
        $model->updateDateTime = new CDbExpression("NOW()");
        if ($model->save()) {
            if ($isNew) {
                $newOrderId = Yii::app()->db->lastInsertID;
                $res['orderId'] = $newOrderId;
            }

            $i = 0;
            foreach ($res['items'] as $productId => $item) {

                if ($isNew) {
//throw new Exception(print_r($res,true));
                    $orderItemModel = new OrderItems();
                    $orderItemModel->orderId = $newOrderId;
                    $orderItemModel->productId = $productId;
                    $orderItemModel->title = substr($res['items'][$i]['name'], 0, 44);
                    $orderItemModel->createDateTime = new CDbExpression("NOW()");
                } else {
                    $orderItemModels = OrderItems::model()->findAll('orderId = ' . $orderId);
                    $orderItemModel = $orderItemModels[$i];
                    $orderItemModel->productId = $productId;
                }
//                throw new Exception(print_r($orderItemModel, true));
                $orderItemModel->title = substr($res['items'][$i]['name'], 0, 44);
                $orderItemModel->price = $res['items'][$i]['price'];
                $orderItemModel->quantity = $res['items'][$i]['quantity'];
                $orderItemModel->total = $res['items'][$i]['price'] * $res['items'][$i]['quantity'];
                $orderItemModel->updateDateTime = new CDbExpression("NOW()");

                if (!($orderItemModel->save())) {
                    throw new Exception(print_r($orderItemModel->errors, True));
                }
                $i++;
            }
        } else {
                throw new Exception(print_r($model->errors, true));
        }
        } catch (Exception $exc) {
            $transaction->rollback();
            echo $exc->getTraceAsString();
        }
        
        $transaction->commit();
        echo $this->renderPartial('/atechWindow/_confirm_product', array(
            'productResult' => $res,
                ), TRUE, TRUE);
    }

//
//	public function actionSaveTitleAndProvinceId(){
//		$model = new Order();
//		if(isset($_POST['title']) && !empty($_POST['title'])){
//			$model->title = $_POST['title'];
//		}
//		if(isset($_POST['provinceId']) && !empty($_POST['provinceId'])){
//			$model->provinceId = $_POST['provinceId'];
//		}
//		echo $this->renderPartial('/atechWindow/_upload_plan', array(
//				'model'=>$model,
//				),TRUE, TRUE);
//	}
    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */


    public function actionAddNewProductItem() {

        if (isset($_POST['rows']) && !empty($_POST['rows'])) {
            $rowCount = $_POST['rows'] - 1;
            $index = $rowCount - 1;
//			throw new Exception(print_r($rowCount+1,true));
        }
        echo '<tr>'
        . '<td>' . $rowCount . '</td>'
        . '<td class="cat">' . CHtml::dropDownList('Criteria[' . $index . '][category]', "category", Category::model()->findAllParentCategoryArray(2), array(
            'class' => 'form-control',
            'prompt' => 'เลือกประเภท',
            'onchange' => 'findType(this)')) . '</td>'
        . '<td class="type">' . CHtml::dropDownList('Criteria[' . $index . '][type]', "type", array(
                ), array(
            'prompt' => 'เลือกรูปแบบ',
            'class' => 'form-control',
            'onchange' => 'findSize(this);',
            'id' => 'type',
        )) . '</td>'
        . '<td class="size">' . CHtml::dropDownList('Criteria[' . $index . '][size]', "size", array(
                ), array(
            'prompt' => 'เลือกขนาด',
            'class' => 'form-control',
            'id' => '"size"',
        )) . '</td>'
        . '<td>' . CHtml::textField('Criteria[' . $index . '][quantity]', 1, array(
            'class' => 'edit-table-qty-input number')) . '</td>'
        . '<td><button id="deleteRow" class="deleteRow btn btn-danger">remove</button></td>'
        . '</tr>';
    }

    public function actionCalculatePriceMyFile() {
        $orderModel = new Order();
        $orderDetailTemplate = OrderDetailTemplate::model()->findOrderDetailTemplateBySupplierId(2);
//        throw new Exception(print_r($_POST['Criteria'], true));
        if (isset($_POST['Criteria'])) {
            $criteria = $_POST['Criteria'];
        }
        if (isset($_POST['provinceId'])) {
            $provinceId = $_POST['provinceId'];
        }
        if (isset($_POST['title'])) {
            $title = $_POST['title'];
        }
//		if(isset($_POST['size']))
//		{
//			$value = $_POST['size'];
//			$size = explode(" x ", $value);
//			$width = $size[0];
//			$height = $size[1];
//		}

        $brandModelArray = BrandModel::model()->findAllBrandModelArrayBySupplierId(2);
        $firstBrand = reset($brandModelArray);
//		throw new Exception(print_r($brandModelArray, true));

		$itemSetArray = Product::model()->calculatePriceFromCriteriaAtech($criteria, $firstBrand->brandModelId, $provinceId);

        echo $this->renderPartial('/atechWindow/_edit_product_result', array(
            'productResult' => $itemSetArray,
                ), TRUE, TRUE);
    }

    public function actionUpdatePriceMyFile() {
//        throw new Exception(print_r($_POST, true));
		if (isset($_POST['orderId'])) {
            $orderId = $_POST['orderId'];
        }
        if (isset($_POST['Criteria'])) {
            $criteria = $_POST['Criteria'];
        }
        if (isset($_POST['provinceId'])) {
            $provinceId = $_POST['provinceId'];
        }
        if (isset($_POST['title'])) {
            $title = $_POST['title'];
        }
        if (isset($_POST['brandModelId'])) {
            $brandModelId = $_POST['brandModelId'];
        }

//        throw new Exception(print_r($_POST['productItems'], true));
//		if (isset($_POST['productItems']) && isset($_POST['Criteria'])) {
//            $productItems = $_POST['productItems'];
//            $i = 0;
//            foreach ($productItems as $item) {
//                foreach ($item as $p)
//				{
//					if ($criteria[$i]["quantity"] > $p["quantity"])
//						$criteria[$i]["quantity"] = $p["quantity"];
//				}
//                $i++;
//            }
//        } else
		if (isset($_POST['productItems']))
		{
			$productItems = $_POST['productItems'];
            $productArray = array();
            $a = 0;
            foreach ($productItems as $z) {
                foreach ($z as $productId => $item) {
                    $productModel = Product::model()->findByPk($productId);
                    $productArray[$a] = $productModel;
                    $productArray[$a]['quantity'] = $item["quantity"];
                }
                $a++;
            }
        }
//		throw new Exception(print_r($productArray, true));
//		if(isset($_POST['size']))
//		{
//			$value = $_POST['size'];
//			$size = explode(" x ", $value);
//			$width = $size[0];
//			$height = $size[1];
//		}
        if (isset($criteria) && isset($brandModelId) && isset($provinceId))
		{
//			throw new Exception(print_r($_POST['productItems'], true));
			if (isset($_POST['productItems']))
			{
				$productItems = $_POST['productItems'];
				$i = 1;
				foreach ($_POST['productItems'] as $item)
				{
					foreach ($item as $itemId => $qty)
					{
//						throw new Exception(print_r($productItems[1][$itemId]["quantity"], true));
						$criteria[$i - 1]["quantity"] = $productItems[$i][$itemId]["quantity"];
					}
					$i++;
				}
//				throw new Exception(print_r($criteria, true));
			}
			$itemSetArray = Product::model()->calculatePriceFromCriteriaAtech($criteria, $brandModelId, $provinceId);
        } else {
//            throw new Exception(print_r($productArray, true));
			if (isset($orderId))
			{
				$itemSetArray = Product::model()->calculatePriceFromEstimateAtech($brandModelId, $provinceId, $productArray, $orderId);
			}
			else
			{
				$itemSetArray = Product::model()->calculatePriceFromEstimateAtech($brandModelId, $provinceId, $productArray);
			}
		}
//		throw new Exception(print_r($itemSetArray,true));
        echo $this->renderPartial('/atechWindow/_edit_product_result', array(
            'productResult' => $itemSetArray,
                ), TRUE, TRUE);
    }

    public function actionFinish($id) {
//		$model = Order::model()->findByPk($id);
//		$model->status = 1;
//		$model->save();
        $this->redirect(array(
            'index'));
    }

    public function actionAddtoCartNow($id) {
        $model = Order::model()->findByPk($id);
        $model->type = 3;
        $model->save();
        $this->redirect(array(
            'index'));
    }

    public function actionAddToCart() {
        if (isset($_POST['orderId']) && !empty($_POST['orderId'])) {
            $orderId = $_POST['orderId'];
//			throw new Exception(print_r($orderId,true));
            $model = Order::model()->findByPk($orderId);
            $model->type = 3;
            if ($model->save()) {
                echo 'success';
            }
        }
        echo 'fail';
    }

    public function actionFindAllCat2ByCat1Id() {
        $data = CategoryToSub::model()->findAll('categoryId=:categoryId', array(
            ':categoryId' => (int) $_POST['cat1Id']));
//		$result = array(
//			);
        echo CHtml::tag('option', array(
            'value' => ''), CHtml::encode("-- เลือกรูปแบบ --"), true);
        foreach ($data as $item) {
//			$result[$item->brandModelId] = $item->title;
            echo CHtml::tag('option', array(
                'value' => $item->subCategoryId), CHtml::encode(isset($item->subCategory) ? $item->subCategory->title : ""), true);
        }
//		echo CJSON::encode($result);
    }

    public function actionFindAllSizeByCate2Id() {

        $brands = Brand::model()->findAll('supplierId = 2 and status = 1');
        $firstBrandId = $brands[0]->brandId;
        $data = Category2ToProduct::model()->findAll('category1Id=:category2Id and brandId=:brandId', array(
            ':category2Id' => (int) $_POST['cat2'],
            ':brandId' => $firstBrandId));
//		$result = array(
//			);
        echo CHtml::tag('option', array(
            'value' => ''), CHtml::encode("-- เลือกขนาด --"), true);

        foreach ($data as $item) {
//			throw new Exception(print_r($item->product->width. ' x '. $item->product->height,true));
//			$result[$item->brandModelId] = $item->title;
            echo CHtml::tag('option', array(
                'value' => $item->product->width . " x " . $item->product->height), CHtml::encode(isset($item->product) ? $item->product->width . " x " . $item->product->height : ""), true);
        }
    }

}
