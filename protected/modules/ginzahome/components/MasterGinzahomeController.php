<?php

class MasterGinzahomeController extends MasterController
{
    public function init()
    {
        parent::init();

        Yii::app()->clientScript->registerCSSFile(Yii::app()->baseUrl.'/css/ginzahome.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/daiibuy.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/ginzahome.js');

        $this->nav = array(
            array(
                'url' => 'madrid/category/index/id/2',
                'color' => 'green',
                'caption' => 'บ้านชั้นเดียว',
                'description' => 'Description'
            ),
            array(
                'url' => 'madrid/category/index/id/1',
                'color' => 'blue',
                'caption' => 'บ้านสองชั้น',
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

    public function showCategory()
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
        $items = [];
        $i = 1;
        foreach ($this->scanDir(Yii::app()->basePath . '/../images/ginzahome') as $file) {
            $items[$i] = [
                'id' => $i,
                'image' => Yii::app()->baseUrl . '/images/ginzahome/' . $file,
                'url' => Yii::app()->createUrl('ginzahome/category/index/id/' . $i),
                'title' => substr($file, 0, -4),
                'price' => 'Concept Description',
                'description'=>'bla bla bla ...',
                'isQuickView'=>false
            ];

            $i++;
        }

        return $items;
    }
}