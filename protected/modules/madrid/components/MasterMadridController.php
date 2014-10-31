<?php

class MasterMadridController extends MasterController
{
    public function init()
    {
        parent::init();

        Yii::app()->clientScript->registerCSSFile(Yii::app()->baseUrl.'/css/madrid.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/daiibuy.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/madrid.js');

        $supplier = Supplier::model()->find(array(
            'condition'=>'url=:url',
            'params'=>array(
                ':url'=>$this->module->id,
            ),
        ));

        $categorys = Category::model()->findAll(array(
            'condition'=>'supplierId=:supplierId AND isRoot=1',
            'params' => array(
                ':supplierId'=>$supplier->supplierId
            ),
        ));

        $nav = array();
        $i=0;
        foreach ($categorys as $category) {
            $categoryToSub = CategoryToSub::model()->find(array(
                'condition'=>'categoryId=:categoryId AND (isTheme=1 OR isSet=1)',
                'params'=>array(
                    ':categoryId'=>$category->categoryId,
                ),
            ));

            if(isset($categoryToSub)) {
                if($categoryToSub->isTheme == 1) {
                    $nav['theme'] = array(
                        'url' => $this->createUrl('theme'),
                        'color' => 'orange',
                        'caption' => $category->title,
//                        'description' => 'Description'
                    );
                }

                if($categoryToSub->isSet == 1) {
                    $nav['set'] = array(
                        'url' => $this->createUrl('set'),
                        'color' => 'red',
                        'caption' => $category->title,
//                        'description' => 'Description'
                    );
                }
            }
            else {
                $this->nav[$i] = array(
                    'url' => $this->createUrl('category/index/id/'.$category->categoryId),
                    'color' => $this->navColor[$i],
                    'caption' => $category->title,
                    'description' => 'Description'
                );

                $i++;
            }
        }

        $this->nav[$i+1] = $nav['theme'];
        $this->nav[$i+1] = $nav['set'];


        $this->sideBarCategories = array(
            'title' => 'Madrid Categories',
            'items' => array(
                array(
                    'link' => 'Madrid 1',
                    'url' => '#'
                ),
                array(
                    'link' => 'Madrid 2',
                    'url' => '#'
                ),
                array(
                    'link' => 'Madrid 3',
                    'url' => '#'
                ),
                array(
                    'link' => 'Madrid 4',
                    'url' => '#'
                ),
                array(
                    'link' => 'Madrid 5',
                    'url' => '#'
                ),
                array(
                    'link' => 'Madrid 6',
                    'url' => '#'
                ),
                array(
                    'link' => 'Madrid 7',
                    'url' => '#',
                    'items' => array(

                        array(
                            'link' => 'Madrid sub 1',
                            'url' => '#'
                        ),
                        array(
                            'link' => 'Madrid sub 2',
                            'url' => '#'
                        ),
                        array(
                            'link' => 'Madrid sub 3',
                            'url' => '#'
                        ),
                        array(
                            'link' => 'Madrid sub 4',
                            'url' => '#'
                        ),
                        array(
                            'link' => 'Madrid sub 5',
                            'url' => '#'
                        ),
                        array(
                            'link' => 'Madrid sub 6',
                            'url' => '#'
                        ),
                        array(
                            'link' => 'Madrid sub 7',
                            'url' => '#'
                        ),
                        array(
                            'link' => 'Madrid sub 8',
                            'url' => '#'
                        ),
                    ),
                ),
            )
        );
    }

    //temp function
    public function scanDir($dir)
    {
        $files = scandir($dir);
        array_shift($files);
        array_shift($files);
        return $files;
    }

    public function showSanitary($type = 1)
    {
        /*
        $item = [
            'id'=>'',
            'image'=>'',
            'url'=>'',
            'title'=>'',
            'price'=>'',
            'pricePromotion'=>'',
            'buttons'=>[
                'cart',
                'favorites',
                'compare',
            ],
        ];
        */

        $productType = ($type == 1) ? 'sanitary' : 'tile';

        $items = [];
        $i = 1;
        foreach ($this->scanDir(Yii::app()->basePath . '/../images/madrid/'.$productType) as $file) {
            if(substr($file, 0, 1) == '.') continue;

            $items[$i] = [
                'id' => $i,
                'image' => Yii::app()->baseUrl . '/images/madrid/'.$productType.'/' . $file,
                'url' => Yii::app()->createUrl('madrid/product/index/id/' . $i),
                'title' => substr($file, 0, -4),
                'price' => rand(1000, 99999),
                'buttons' => [
                    'cart',
                    //'favorites'
                ],
                'isQuickView'=>true,
            ];

            $i++;
        }

        return $items;
    }
}