<?php

class DefaultController extends MasterMadridController {

    public function actionIndex() {

        $supplier = Supplier::model()->find(array(
            'condition' => 'url=:url',
            'params' => array(
                ':url' => $this->module->id,
            ),
        ));

        $categorys = Category::model()->findAll(array(
            'condition' => 'supplierId=:supplierId AND isRoot=1',
            'params' => array(
                ':supplierId' => $supplier->supplierId
            ),
        ));

        $i = 0;
        foreach ($categorys as $category) { // find Cat1
            $categoryToSub = CategoryToSub::model()->find(array(
                'condition' => 'categoryId=:categoryId AND isTheme=0 AND isSet=0',
                'params' => array(
                    ':categoryId' => $category->categoryId,
                ),
            ));


            if (isset($categoryToSub)) {
                $items = array();
                $products[$i] = array(
                    'title' => $category->title,
                    'maxItems' => 4,
                    'moreUrl' => $this->createUrl('category/index/id/' . $category->categoryId),
                );
                $cat2ToProducts = Category2ToProduct::model()->findAll("category1Id = :category1Id AND type = 1 AND status = 1 ", array(
                    ":category1Id" => $category->categoryId,
                ));
                $j = 0;
                foreach ($cat2ToProducts as $cat2ToProduct) {
                    $items[$j]['productId'] = $cat2ToProduct->productId;
                    $items[$j]['name'] = $cat2ToProduct->product->name;
                    $items[$j]['description'] = $cat2ToProduct->product->description;
                    $items[$j]['quantity'] = $cat2ToProduct->product->quantity;
                    $items[$j]['productUnits'] = $cat2ToProduct->product->productUnits;
                    $items[$j]['stockStatusId'] = $cat2ToProduct->product->stockStatusId;
                    $items[$j]['price'] = Product::model()->calProductPrice($cat2ToProduct->product->productId);
                    $items[$j]['promotionPrice'] = Product::model()->calProductPromotionPrice($cat2ToProduct->product->price);
                    $items[$j]['weight'] = $cat2ToProduct->product->weight;
                    $items[$j]['width'] = $cat2ToProduct->product->width;
                    $items[$j]['length'] = $cat2ToProduct->product->length;
                    $items[$j]['images'] = $cat2ToProduct->product->productImages;
                    $items[$j]['url'] = $this->createUrl('product/index/id/' . $cat2ToProduct->product->productId);
                    $j++;
                }
                $products[$i]['items'] = $items;
                $i++;
            }
        }

//        $products = array(
//            array(
//                'title' => 'Sanitary',
//                'maxItems' => 3,
//                'moreUrl' => 'madrid/category/index/id/1',
//                'items' => $sanitaryItems,
//            ),
//            array(
//                'title' => 'Tile',
//                'maxItems' => 3,
//                'moreUrl' => 'madrid/category/index/id/2',
//                'items' => $tileItems,
//            ),
//        );

        $this->render('index', array(
            'products' => $products));
    }

    public function actionCategory($id) {
        $title = ($id == 1) ? 'Sanitary' : 'Tile';
        $this->render('category', array(
            'title' => $title));
    }

}
