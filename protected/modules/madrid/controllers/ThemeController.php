<?php

class ThemeController extends MasterMadridController
{
    public function actionIndex()
    {
        $title = 'Tile Theme';
        $items = $this->showTheme();

        $dataProvider = new CArrayDataProvider($items, array('keyField' => 'id'));
        $dataProvider->pagination->pageSize = 12;
        $template = "<div class='row'>
			<div class='col-lg-6 col-md-6 col-sm-6'>{summary}</div>\n
			<div class='col-lg-6 col-md-6 col-sm-6'>{pager}</div>\n
		</div>
		<div class='row'>
			{items}
		</div>
		<div class='row'>
			<div class='col-lg-6 col-md-6 col-sm-6'>{summary}</div>\n
			<div class='col-lg-6 col-md-6 col-sm-6'>{pager}</div>\n
		</div>";
        $summaryText = '<p>Display {start}-{end} of {count} items (page {page} of {pages})</p>';
        $itemClass = 'col-lg-3 col-md-3 col-sm-4';

        $this->render('index', array(
            'title' => $title,
            'dataProvider' => $dataProvider,
            'itemView' => '//layouts/_product_item',
            'template' => $template,
            'summaryText' => $summaryText,
            'itemClass' => $itemClass
        ));
    }

    public function showTheme()
    {
        $items = [];
        $i = 1;
        foreach ($this->scanDir(Yii::app()->basePath . '/../images/madrid/tile') as $file) {
            if(substr($file, 0, 1) == '.') continue;

            $items[$i] = [
                'id' => $i,
                'image' => Yii::app()->baseUrl . '/images/madrid/tile/' . $file,
                'url' => Yii::app()->createUrl('madrid/product/index/id/' . $i),
                'title' => substr($file, 0, -4),
                'price' => rand(1000, 99999),
                'buttons' => [
                    'favorites'
                ],
                'isQuickView'=>true
            ];

            $i++;
        }

        return $items;
    }

    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'inlineFilterName',
            array(
                'class'=>'path.to.FilterClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }

    public function actions()
    {
        // return external action classes, e.g.:
        return array(
            'action1'=>'path.to.ActionClass',
            'action2'=>array(
                'class'=>'path.to.AnotherActionClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }
    */

    public function actionView($id)
    {
        $this->render('view');
    }
}