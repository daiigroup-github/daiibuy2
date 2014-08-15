<?php

class ProductController extends MasterFenzerController
{
    public function actionIndex($id)
    {
        $product = array(
            'title' => 'Madrid Sanitary #1',
            'code' => 'PBS173',
            'category' => 'Sanitary',
            'stock' => '20',
            'dimension' => array(
                'w' => 100.00,
                'h' => 100.00,
                'l' => 100.00,
            ),
            'weight' => 80.50,
            'price' => 300,
            'pricePromotion' => 280,
            'productId' => 1,
            'options' => array(
                array('option1'),
                array('option2'),
            ),
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

        $this->render('index', array('product' => $product));
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

    public function actionShowItems()
    {
        if(isset($_POST)){
            $res = array();

            $res = array(
                'kt'=>'Kurtumm',
                'tk'=>'Taklong'
            );

            $this->writeToFile('/tmp/showItems', print_r($_POST, true));

            echo CJSON::encode($_POST);
        }
    }
}