<?php

class MasterFenzerController extends MasterController
{
    public function init()
    {
        parent::init();

        Yii::app()->clientScript->registerCSSFile(Yii::app()->baseUrl.'/css/fenzer.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/daiibuy.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/fenzer.js');

        $this->nav = array(
            array(
                'url' => '#',
                'color' => 'green',
                'caption' => 'M-WALL',
                'description' => 'Description'
            ),
            array(
                'url' => '#',
                'color' => 'blue',
                'caption' => 'DOUBLE-S',
                'description' => 'Description'
            ),
            array(
                'url' => '#',
                'color' => 'red',
                'caption' => 'SANDY',
                'description' => 'Description'
            ),
            array(
                'url' => '#',
                'color' => 'orange',
                'caption' => 'BRICKS',
                'description' => 'Description'
            ),
            array(
                'url' => '#',
                'caption' => 'ABOUT FENZER',
                'description' => 'Company Profile'
            ),
        );

        $this->sideBarCategories = array(
            'title' => 'Fenzer Categories',
            'items' => array(
                array(
                    'link' => 'M-Wall',
                    'url' => '#'
                ),
                array(
                    'link' => 'Double S',
                    'url' => '#'
                ),
                array(
                    'link' => 'Sandy',
                    'url' => '#'
                ),
                array(
                    'link' => 'Brick',
                    'url' => '#'
                ),
                /*
                array(
                    'link'=>'Madrid 7',
                    'url'=>'#',
                    'items'=>array(

                        array(
                            'link'=>'Madrid sub 1',
                            'url'=>'#'
                        ),
                        array(
                            'link'=>'Madrid sub 2',
                            'url'=>'#'
                        ),
                        array(
                            'link'=>'Madrid sub 3',
                            'url'=>'#'
                        ),
                        array(
                            'link'=>'Madrid sub 4',
                            'url'=>'#'
                        ),
                        array(
                            'link'=>'Madrid sub 5',
                            'url'=>'#'
                        ),
                        array(
                            'link'=>'Madrid sub 6',
                            'url'=>'#'
                        ),
                        array(
                            'link'=>'Madrid sub 7',
                            'url'=>'#'
                        ),
                        array(
                            'link'=>'Madrid sub 8',
                            'url'=>'#'
                        ),
                    ),
                ),
                */
            )
        );

        $this->cat1 = array(
            array('title' => 'M-Wall'),
            array('title' => 'Double S'),
            array('title' => 'Sandy'),
            array('title' => 'Bricks')
        );

        $this->cat2 = array(
            '1.50',
            '1.75',
            '2.00',
            '2.25',
            '2.50',
            '2.75',
            '3.00'
        );
    }

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
        foreach ($this->scanDir(Yii::app()->basePath . '/../images/fenzer') as $file) {
            $items[$i] = [
                'id' => $i,
                'image' => Yii::app()->baseUrl . '/images/fenzer/' . $file,
                'url' => Yii::app()->createUrl('fenzer/category/index/id/' . $i),
                'title' => substr($file, 0, -4),
                'price' => 'ราคาต่อเมตร '.number_format(rand(1000, 2999), 2).' บาท',
                'description'=>'bla bla bla ...',
                'isQuickView'=>false
            ];

            $i++;
        }

        return $items;
    }
}