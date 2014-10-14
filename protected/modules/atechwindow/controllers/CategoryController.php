<?php

class CategoryController extends MasterAtechwindowController
{
    public function actionIndex($id)
    {
        $colors = array(
            'ALL',
            'White',
            'Brown',
            'Black',
            'Gray',
        );

        $category2 = Category::model()->findByPk($id);

        $images = [];
        foreach ($category2->images as $image) {
            $images[] = Yii::app()->baseUrl . $image->image;
        }

        $this->render('index', array(
            'category2'=>$category2,
            'images' => $images,
            'colors'=> $colors
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