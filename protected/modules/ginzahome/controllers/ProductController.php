<?php

class ProductController extends MasterGinzahomeController
{
    /**
     * @param $id = categoryId
     * @param $id2 = subCategoryId
     * @throws CException
     */
    public function actionIndex($id,$id2)
    {
        $images = [];
        foreach ($this->scanDir(Yii::app()->basePath . '/../images/ginzahome') as $k => $image) {
            $images[$k] = Yii::app()->baseUrl . '/images/ginzahome/' . $image;
        }

        $description = '
            <p>Grid systems are used for creating page layouts through a series of rows and columns that house your content. Here\'s how the Bootstrap grid system works:</p>
            <ul>
    <li>Rows must be placed within a <code>.container</code> (fixed-width) or <code>.container-fluid</code> (full-width) for proper alignment and padding.</li>
    <li>Use rows to create horizontal groups of columns.</li>
    <li>Content should be placed within columns, and only columns may be immediate children of rows.</li>
    <li>Predefined grid classes like <code>.row</code> and <code>.col-xs-4</code> are available for quickly making grid layouts. Less mixins can also be used for more semantic layouts.</li>
  </ul>
        ';

        $imageRow = array(
            array(
                'title'=>'Image Row 1',
                'maxItems'=>5,
                'images'=>array(
                    '/images/ginzahome/1floor.jpg',
                    '/images/ginzahome/1floor.jpg',
                    '/images/ginzahome/1floor.jpg',
                    '/images/ginzahome/1floor.jpg',
                    '/images/ginzahome/1floor.jpg',
                    '/images/ginzahome/1floor.jpg',
                    '/images/ginzahome/1floor.jpg',
                    '/images/ginzahome/1floor.jpg',
                    '/images/ginzahome/1floor.jpg',
                    '/images/ginzahome/1floor.jpg',
                    '/images/ginzahome/1floor.jpg',
                    '/images/ginzahome/1floor.jpg',
                ),
            ),
            array(
                'title'=>'Image Row 2',
                'images'=>array(
                    '/images/ginzahome/2floor.jpg',
                    '/images/ginzahome/2floor.jpg',
                    '/images/ginzahome/2floor.jpg',
                    '/images/ginzahome/2floor.jpg',
                    '/images/ginzahome/2floor.jpg',
                ),
            ),
            array(
                'title'=>'Image Row 3',
                'maxItems'=>3,
                'images'=>array(
                    '/images/ginzahome/1floor.jpg',
                    '/images/ginzahome/2floor.jpg',
                    '/images/ginzahome/1floor.jpg',
                    '/images/ginzahome/2floor.jpg',
                    '/images/ginzahome/1floor.jpg',
                ),
            ),
        );

        $product = array(
            'title' => 'Ginza 188C',
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
            'images' => $images,
            'description' => $description,
            'tabs' => array(
                array(
                    'title' => 'รายละเอียด',
                    'detail' => $this->renderPartial('_tab_product_detail', array(), true)
                ),
                array(
                    'title' => 'Function',
                    'detail' => $this->renderPartial('_image_row', array('imageRow'=>$imageRow), true)
                ),
                array(
                    'title' => 'Design',
                    'detail' => $this->renderPartial('_image_gallery', array(), true).$this->renderPartial('_vdo', array(), true)
                ),
                array(
                    'title' => 'บ้านตัวอย่าง',
                    'detail' => $this->renderPartial('_reference', array(), true)
                ),
                array(
                    'title' => 'วิธีการชำระเงิน',
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
}