<?php

class DefaultController extends MasterMadridController
{
    public function actionIndex()
    {
        $this->sideBarCategories = array(
            'title' => 'Madrid Categories',
            'items' => array(
                array(
                    'link' => 'Sanitary',
                    'url' => 'madrid/category/index/id/1'
                ),
                array(
                    'link' => 'Tile',
                    'url' => 'madrid/category/index/id/2'
                ),
            )
        );

//        $i = 0;
//        $sanitaryItems = array();
//        foreach (Product::model()->findAll(array('limit' => 7)) as $s) {
//            //if($s->productImages == array()) continue;
//
//            $sanitaryItems[$i]['productId'] = $s->productId;
//            $sanitaryItems[$i]['name'] = $s->name;
//            $sanitaryItems[$i]['quantity'] = $s->quantity;
//            $sanitaryItems[$i]['productUnits'] = $s->productUnits;
//            $sanitaryItems[$i]['stockStatusId'] = $s->stockStatusId;
//            $sanitaryItems[$i]['price'] = Product::model()->calProductPrice($s->productId);
//            $sanitaryItems[$i]['promotionPrice'] = Product::model()->calProductPromotionPrice($s->price);
//            $sanitaryItems[$i]['weight'] = $s->weight;
//            $sanitaryItems[$i]['width'] = $s->width;
//            $sanitaryItems[$i]['length'] = $s->length;
//            $sanitaryItems[$i]['images'] = $s->productImages;
//            $sanitaryItems[$i]['url'] = $this->createUrl('product/index/id/' . $s->productId);
//
//            $i++;
//        }
//
//        $j = 0;
//        $tileItems = array();
//        foreach (Product::model()->findAll(array('limit' => 7)) as $t) {
//            //if($t->productImages == array()) continue;
//
//            $tileItems[$j]['productId'] = $t->productId;
//            $tileItems[$j]['name'] = $t->name;
//            $tileItems[$j]['quantity'] = $t->quantity;
//            $tileItems[$j]['productUnits'] = $t->productUnits;
//            $tileItems[$j]['stockStatusId'] = $t->stockStatusId;
//            $tileItems[$j]['price'] = Product::model()->calProductPrice($t->productId);
//            $tileItems[$j]['promotionPrice'] = Product::model()->calProductPromotionPrice($t->price);
//            $tileItems[$j]['weight'] = $t->weight;
//            $tileItems[$j]['width'] = $t->width;
//            $tileItems[$j]['length'] = $t->length;
//            $tileItems[$j]['images'] = $t->productImages;
//            $tileItems[$j]['url'] = $this->createUrl('product/index/id/' . $t->productId);
//
//
//            $j++;
//        }

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
        foreach ($categorys as $category) {
            $categoryToSub = CategoryToSub::model()->find(array(
                'condition' => 'categoryId=:categoryId AND (isTheme=1 OR isSet=1)',
                'params' => array(
                    ':categoryId' => $category->categoryId,
                ),
            ));

            if (isset($categoryToSub)) {
               continue;
            } else {
                $products[$i] = array(
                    'title'=>$category->title,
                    'maxItems'=>3,
                    'moreUrl'=>$this->createUrl('category/index/id/'.$category->categoryId),
                );
                $items = array();
                foreach($category->subCategorys as $subCategory) {
                    foreach ($subCategory->products as $product) {
                        $items[$i]['productId'] = $product->productId;
                        $items[$i]['name'] = $product->name;
                        $items[$i]['quantity'] = $product->quantity;
                        $items[$i]['productUnits'] = $product->productUnits;
                        $items[$i]['stockStatusId'] = $product->stockStatusId;
                        $items[$i]['price'] = Product::model()->calProductPrice($product->productId);
                        $items[$i]['promotionPrice'] = Product::model()->calProductPromotionPrice($product->price);
                        $items[$i]['weight'] = $product->weight;
                        $items[$i]['width'] = $product->width;
                        $items[$i]['length'] = $product->length;
                        $items[$i]['images'] = $product->productImages;
                        $items[$i]['url'] = $this->createUrl('product/index/id/' . $product->productId);
                    }
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

        $this->render('index', array('products' => $products));
    }

    public function actionCategory($id)
    {
        $title = ($id == 1) ? 'Sanitary' : 'Tile';
        $this->render('category', array('title' => $title));
    }
}