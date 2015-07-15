<?php

class ProductController extends MasterMadridController {

    public function actionIndex($id) {
        $images = [];
        /* foreach ($this->scanDir(Yii::app()->basePath . '/../images/madrid/sanitary') as $k => $image) {
          $images[$k] = Yii::app()->baseUrl . '/images/madrid/sanitary/' . $image;
          } */

        $productModel = Product::model()->findByPk($id);
        foreach ($productModel->productImagesSort as $productImage) {
            $images[] = Yii::app()->baseUrl . $productImage->image;
        }

        $descriptionTabs = array();
        foreach ($productModel->productSpecGroupsTypeDetails as $desc) {
            $descriptionTabs[]['title'] = $desc->title;
            $descriptionTabs[]['detail'] = $desc->description;
        }

        $this->render('index', array(
            'productModel' => $productModel,
            'images' => $images,
            'descriptionTabs' => $descriptionTabs));
    }

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

    public function actionAddToCart() {
        $productId = $_POST['productId'];

        $qty = isset($_POST['qty']) ? $_POST['qty'] : 1;
//		throw new Exception(print_r($_POST['productId'], true));
        $supplier = Supplier::model()->find(array(
            'condition' => 'url=:url',
            'params' => array(
                ':url' => $this->module->id),
        ));

        $this->cookie = new DaiiBuy();
        $this->cookie->loadCookie();
//        throw new Exception(print_r($qty, true));
        $orderModel = Order::model()->findByTokenAndSupplierId($this->cookie->token, $supplier->supplierId);
        $orderItem = OrderItems::model()->saveByOrderIdAndProductId($orderModel->orderId, $productId, $qty);

        $orderModel->totalIncVAT = $orderModel->orderItemsSum;
        $orderModel->save(false);

        echo CJSON::encode(array(
            'result' => $orderItem));
    }

    public function actionAddFavourite() {
        $oldFav = UserFavourite::model()->findAll('userId = ' . $_POST["userId"] . ' and category2Id = ' . $_POST["category2Id"]);
        if (count($oldFav) == 0) {
            $model = new UserFavourite();
            $model->userId = $_POST["userId"];
            $model->category2Id = $_POST["category2Id"];
            $model->createDateTime = new CDbExpression("NOW()");
            $model->updateDateTime = new CDbExpression("NOW()");
            if ($model->save()) {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            echo 3;
        }
    }

}
