<?php

class DefaultController extends MasterMadridController
{
    public function actionIndex()
    {
        echo $this->module->id;
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

        $i = 0;
        $sanitaryItems = array();
        foreach (Product::model()->findAll(array('limit' => 7)) as $s) {
            $sanitaryItems[$i]['productId'] = $s->productId;
            $sanitaryItems[$i]['name'] = $s->name;
            $sanitaryItems[$i]['quantity'] = $s->quantity;
            $sanitaryItems[$i]['productUnits'] = $s->productUnits;
            $sanitaryItems[$i]['stockStatusId'] = $s->stockStatusId;
            $sanitaryItems[$i]['price'] = Product::model()->calProductPrice($s->productId);
            $sanitaryItems[$i]['promotionPrice'] = Product::model()->calProductPromotionPrice($s->price);
            $sanitaryItems[$i]['weight'] = $s->weight;
            $sanitaryItems[$i]['width'] = $s->width;
            $sanitaryItems[$i]['length'] = $s->length;
            $sanitaryItems[$i]['images'] = array();
            $sanitaryItems[$i]['url'] = $this->createUrl('product/index/id/'.$s->productId);

            $i++;
        }

        $j = 0;
        $tileItems = array();
        foreach (Product::model()->findAll(array('limit' => 7)) as $t) {
            $tileItems[$j]['productId'] = $t->productId;
            $tileItems[$j]['name'] = $t->name;
            $tileItems[$j]['quantity'] = $t->quantity;
            $tileItems[$j]['productUnits'] = $t->productUnits;
            $tileItems[$j]['stockStatusId'] = $t->stockStatusId;
            $tileItems[$j]['price'] = Product::model()->calProductPrice($t->productId);
            $tileItems[$j]['promotionPrice'] = Product::model()->calProductPromotionPrice($t->price);
            $tileItems[$j]['weight'] = $t->weight;
            $tileItems[$j]['width'] = $t->width;
            $tileItems[$j]['length'] = $t->length;
            $tileItems[$j]['images'] = array();
            $tileItems[$j]['url'] = $this->createUrl('product/index/id/'.$t->productId);


            $j++;
        }

        $products = array(
            array(
                'title' => 'Sanitary',
                'maxItems' => 3,
                'moreUrl' => 'madrid/category/index/id/1',
                'items' => $sanitaryItems,
            ),
            array(
                'title' => 'Tile',
                'maxItems' => 3,
                'moreUrl' => 'madrid/category/index/id/2',
                'items' => $tileItems,
            ),
        );

        $this->render('index', array('products' => $products));
    }

    public function actionCategory($id)
    {
        $title = ($id == 1) ? 'Sanitary' : 'Tile';
        $this->render('category', array('title' => $title));
    }
}