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

        $criteria = new CDbCriteria();
        $criteria->with = 'category';
        $criteria->condition = 't.brandId=:brandId AND t.status=1 AND category.status=1';
        $criteria->params = array(':brandId'=>$brandId);
        $criteria->group = 't.category1Id';
        $category2ToProducts = Category2ToProduct::model()->findAll($criteria);

        $categoryId = isset($categoryId) ? $categoryId : $category2ToProducts[0]->category->categoryId;

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
            'colors' => $colors,
            'buttons'=>$buttons,
            'brandId'=>$brandId
        ));

    }

}
