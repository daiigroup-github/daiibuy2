<?php

class MasterMadridController extends MasterController
{
    public function init()
    {
        parent::init();

        $this->nav = array(
            array(
                'url' => 'madrid/category/index/id/2',
                'color' => 'green',
                'caption' => 'Madrid Tile',
                'description' => 'Description'
            ),
            array(
                'url' => 'madrid/category/index/id/1',
                'color' => 'blue',
                'caption' => 'Madrid Sanitary',
                'description' => 'Description'
            ),
            array(
                'url' => 'madrid/theme',
                'color' => 'red',
                'caption' => 'Tile Theme',
                'description' => 'Description'
            ),
            array(
                'url' => 'madrid/set',
                'color' => 'orange',
                'caption' => 'Sanitary Set',
                'description' => 'Description'
            ),
            array(
                'url' => '#',
                'caption' => 'About Madrid',
                'description' => 'Company Profile'
            ),
        );

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