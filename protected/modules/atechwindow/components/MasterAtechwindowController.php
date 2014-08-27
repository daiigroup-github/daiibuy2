<?php

class MasterAtechwindowController extends MasterController
{
    public function init()
    {
        parent::init();

        Yii::app()->clientScript->registerCSSFile(Yii::app()->theme->baseUrl.'/assets/css/atechwindow.css');

        $this->nav = array(
            array(
                'url' => '#',
                'color' => 'green',
                'caption' => 'Window',
                'description' => 'Description'
            ),
            array(
                'url' => '#',
                'color' => 'blue',
                'caption' => 'Door',
                'description' => 'Description'
            ),
            array(
                'url' => '#',
                'caption' => 'ABOUT ATECH WINDOW',
                'description' => 'Company Profile'
            ),
        );

        $this->sideBarCategories = array(
            'title' => 'Atech Window',
            'items' => array(
                array(
                    'link' => 'ประตูบานเปิดคู่',
                    'url' => '#'
                ),
                array(
                    'link' => 'ประตูบานเปิดเดี่ยว',
                    'url' => '#'
                ),
                array(
                    'link' => 'หน้าต่างบานเปิดคู่',
                    'url' => '#'
                ),
                array(
                    'link' => 'บานช่องแสง',
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
        foreach ($this->scanDir(Yii::app()->basePath . '/../images/atechwindow') as $file) {
            $items[$i] = [
                'id' => $i,
                'image' => Yii::app()->baseUrl . '/images/atechwindow/' . $file,
                'url' => Yii::app()->createUrl('atechwindow/category/index/id/' . $i),
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