<?php

class CategoryController extends MasterAtechwindowController
{
    public function actionIndex($id)
    {
        $images = [];
        foreach ($this->scanDir(Yii::app()->basePath . '/../images/atechwindow') as $k => $image) {
            $images[$k] = Yii::app()->baseUrl . '/images/atechwindow/' . $image;
        }

        $colors = array(
            'ALL',
            'White',
            'Brown',
            'Black',
            'Gray',
        );

        $sizes = array(
            '2000 x 1000',
            '2100 x 1200',
            '2200 x 1400',
            '2300 x 1600',
            '2400 x 1800',
            '2500 x 2000',
        );

        $product = array(
            'title' => 'Ateh Window #' . $id,
            'code' => 'PBS173',
            'category' => 'Sanitary',
            'stock' => '20',
            'dimension' => array(
                'w' => 100.00,
                'h' => 100.00,
                'l' => 100.00,
            ),
            'weight' => 80.50,
            'productId' => 1,
            'options' => array(
                array(
                    'title' => 'Size',
                    'items' => $sizes,
                ),
                array(
                    'title' => 'Color',
                    'items' => $colors,
                ),
            ),
            'images' => $images,
            'description' => 'Control simulated sensors like battery, GPS, and accelerometer with a the user-friendly interface.<br /><br />Powerful command line tools allow you to build complex tests.',
            'tabs' => array(
                array(
                    'title' => 'Items',
                    'detail' => 'No items',
                    'id' => 'items'
                ),
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

        $this->render('index', array(
            'product' => $product,
        ));
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
}