<?php

class ProductController extends MasterMadridController
{
    public function actionIndex($id)
    {
        $images = [];
        /*foreach ($this->scanDir(Yii::app()->basePath . '/../images/madrid/sanitary') as $k => $image) {
            $images[$k] = Yii::app()->baseUrl . '/images/madrid/sanitary/' . $image;
        }*/

        $productModel = Product::model()->findByPk($id);

        foreach ($productModel->productImagesSort as $productImage) {
            $images[] = Yii::app()->baseUrl . $productImage->image;
        }

        $product = array(
            'title' => $productModel->name,
            'code' => 'PBS173',
            'category' => 'Sanitary',
            'stock' => $productModel->quantity,
            'dimension' => array(
                'w' => $productModel->width,
                'h' => $productModel->height,
                'l' => $productModel->length,
            ),
            'weight' => $productModel->weight,
            'price' => $productModel->calProductPrice(),
            'pricePromotion' => $productModel->calProductPromotionPrice(),
            'productId' => $productModel->productId,
            'options' => array(
                array('option1'),
                array('option2'),
            ),
            'images' => $images,
            'attributes' => array(
                'ประเภท' => 'Sanitary',
                'จำนวนคงเหลือ' => '20',
                'กว้าง x ยาว x สูง' => '100.00x100.00x100.00'
            ),
            'description' => 'Control simulated sensors like battery, GPS, and accelerometer with a the user-friendly interface.<br /><br />Powerful command line tools allow you to build complex tests.',
            'tabs' => array(
                array(
                    'title' => 'Description',
                    'detail' => 'Detail Tab1'
                ),
                array(
                    'title' => 'Reviews',
                    'detail' => 'Detail Tab2'
                ),
                array(
                    'title' => 'Comments',
                    'detail' => 'Detail Tab3'
                ),
            ),
        );

        $descriptionTabs = array();
        foreach ($productModel->productSpecGroupsTypeDescription as $desc) {
            $descriptionTabs[]['title'] = $desc->title;
            $descriptionTabs[]['detail'] = $desc->description;
        }

        $this->render('index', array('product' => $product, 'productModel' => $productModel, 'images' => $images, 'descriptionTabs'=>$descriptionTabs));
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

    public function actionAddToCart()
    {
        $this->writeToFile('/tmp/madridProduct', print_r($_POST, true));

        $productId = $_POST['id'];
        $qty = isset($_POST['qty']) ? $_POST['qty'] : 1;

        $supplier = Supplier::model()->find(array(
            'condition'=>'url=:url',
            'params'=>array(':url'=>$this->module->id),
        ));

        $this->cookie = new DaiiBuy();
        $this->cookie->loadCookie();

        $orderModel = Order::model()->findByTokenAndSupplierId($this->cookie->token, $supplier->supplierId);
        $orderItem = OrderItems::model()->saveByOrderIdAndProductId($orderModel->orderId, $productId, $qty);

        $orderModel->totalIncVAT = $orderModel->orderItemsSum;
        $orderModel->save(false);

        return CJSON::encode(array('result'=>OrderItems::model()->saveByOrderIdAndProductId($orderModel->orderId, $productId)));
    }
}