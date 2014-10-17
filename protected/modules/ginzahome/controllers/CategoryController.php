<?php

class CategoryController extends MasterGinzahomeController
{
    public $layout = '//layouts/cl1';
    public function actionIndex($id)
    {
        $images = [];
        foreach ($this->scanDir(Yii::app()->basePath . '/../images/ginzahome') as $k => $image) {
            $images[$k] = Yii::app()->baseUrl . '/images/ginzahome/' . $image;
        }
        $product = array(
            'title' => 'Ginza Home :: บ้าน 2 ชั้น',
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
                array('option1'),
                array('option2'),
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

        $category = Category::model()->findByPk($id);
        echo $category->title;

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
}