<?php

class MasterCheckoutController extends MasterController
{
    public $layout = '//layouts/cl1';
    public function init()
    {
        parent::init();

        Yii::app()->clientScript->registerCSSFile(Yii::app()->baseUrl.'/css/checkout.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/daiibuy.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/checkout.js');

        $this->nav = array(/*
			array(
				'url'=>'#',
				'color'=>'green',
				'caption'=>'Madrid Tile',
				'description'=>'Description'
			),
			array(
				'url'=>'#',
				'color'=>'blue',
				'caption'=>'Madrid Sanitary',
				'description'=>'Description'
			),
			array(
				'url'=>'#',
				'color'=>'red',
				'caption'=>'Tile Theme',
				'description'=>'Description'
			),
			array(
				'url'=>'#',
				'color'=>'orange',
				'caption'=>'Sanitary Set',
				'description'=>'Description'
			),
			array(
				'url'=>'#',
				'caption'=>'About Madrid',
				'description'=>'Company Profile'
			),
			*/
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
}