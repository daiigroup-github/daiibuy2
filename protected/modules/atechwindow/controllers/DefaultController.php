<?php

class DefaultController extends MasterAtechwindowController {

//    public $layout = '//layouts/cl1';

    public function actionIndex($brandId=null, $categoryId=null) {
        $colors = array(
            'ALL',
            'White',
            'Brown',
            'Black',
            'Gray',
        );

        //Tong Loop For Show Side Category By Cat1
        $supplier = Supplier::model()->find(array(
            'condition' => 'url=:url',
            'params' => array(
                ':url' => $this->module->id,
            ),
        ));

        if(!isset($brandId)) {
            $brands = Brand::model()->findAll(array(
                'condition' => 'supplierId=:supplierId',
                'params' => array(
                    ':supplierId' => $supplier->supplierId,
                ),
                'order' => 'title ASC',
//            'group by' => 'category2Id',
            ));
            $brandId = $brands[0]->brandId;
        }

        $category2ToProducts = Category2ToProduct::model()->findAll('brandId = ' . $brandId . ' AND status = 1 group by category1Id');

        $categoryId = isset($categoryId) ? $categoryId : $category2ToProducts[0]->category->categoryId;

        /*
        if (isset($category2ToProducts[0]))
            $defaultCategory2 = Category::model()->findByPk($category2ToProducts[0]->category2Id);

        $images = [];
        if (isset($defaultCategory2->images)):
            if (count($defaultCategory2->images) > 0):
                foreach ($defaultCategory2->images as $image) {
                    $images[] = Yii::app()->baseUrl . $image->image;
                }
            else:
                $images[] = Yii::app()->baseUrl . $defaultCategory2->image;
            endif;
        endif;
        */

        $buttons = [];
        $k = 0;
        foreach ($category2ToProducts as $category2ToProduct) {
            if($categoryId == $category2ToProduct->category->categoryId){
                $active = 'active';
                $c2tp = $category2ToProduct;
            } else {
                $active = '';
            }

            $buttons[$k] = CHtml::link($category2ToProduct->category->title,
                $this->createUrl('default/index/brandId/'.$brandId.'/categoryId/'.$category2ToProduct->category->categoryId),
                array('class'=>'button small '.$active));
            $k++;
        }


        $this->render('index', array(
            'category2ToProducts' => $category2ToProducts,
            'category2ToProduct' => $c2tp,
//            'images' => $images,
//            'category2Id' => isset($defaultCategory2->categoryId) ? $defaultCategory2->categoryId : null,
            'colors' => $colors,
            'buttons'=>$buttons,
            'brandId'=>$brandId
        ));

    }

}
