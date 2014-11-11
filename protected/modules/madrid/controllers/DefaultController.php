<?php

class DefaultController extends MasterMadridController
{

	public function actionIndex()
	{

//        $this->sideBarCategories = array(
//            'title' => 'Madrid Categories',
//            'items' => array(
//                array(
//                    'link' => 'Sanitary',
//                    'url' => 'madrid/category/index/id/1'
//                ),
//                array(
//                    'link' => 'Tile',
//                    'url' => 'madrid/category/index/id/2'
//                ),
//            )
//        );
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
			'condition'=>'url=:url',
			'params'=>array(
				':url'=>$this->module->id,
			),
		));

		$categorys = Category::model()->findAll(array(
			'condition'=>'supplierId=:supplierId AND isRoot=1',
			'params'=>array(
				':supplierId'=>$supplier->supplierId
			),
		));

		$i = 0;
		foreach($categorys as $category)
		{
			$categoryToSub = CategoryToSub::model()->find(array(
				'condition'=>'categoryId=:categoryId AND (isTheme=1 OR isSet=1)',
				'params'=>array(
					':categoryId'=>$category->categoryId,
				),
			));

			if(isset($categoryToSub))
			{
				continue;
			}
			else
			{
				$products[$i] = array(
					'title'=>$category->title,
					'maxItems'=>3,
					'moreUrl'=>$this->createUrl('category/index/id/' . $category->categoryId),
				);
				$items = array();
				foreach($category->subCategorys as $subCategory)
				{
					$cat2ToProducts = Category2ToProduct::model()->findAll("category2Id=:category2Id", array(
						":category2Id"=>$subCategory->categoryId));
					$j = 0;
					foreach($cat2ToProducts as $cat2ToProduct)
					{
						$items[$j]['productId'] = $cat2ToProduct->product->productId;
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
			'products'=>$products));
	}

	public function actionCategory($id)
	{
		$title = ($id == 1) ? 'Sanitary' : 'Tile';
		$this->render('category', array(
			'title'=>$title));
	}

}
