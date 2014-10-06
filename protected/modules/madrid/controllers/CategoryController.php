<?php

class CategoryController extends MasterMadridController
{
    public function actionIndex($id)
    {
        $title = ($id == 1) ? 'Sanitary' : 'Tile';

        $items = $this->showSanitary($id);

        //$dataProvider = new CArrayDataProvider($items, array('keyField' => 'id'));
        $dataProvider = Product::model()->search();
        $dataProvider->pagination->pageSize = 9;
        $template = "<div class='row'>
			<div class='col-lg-4 col-md-4 col-sm-4'>{summary}</div>\n
			<div class='col-lg-8 col-md-8 col-sm-8'>{pager}</div>\n
		</div>
		<div class='row'>
			{items}
		</div>
		<div class='row'>
			<div class='col-lg-4 col-md-4 col-sm-4'>{summary}</div>\n
			<div class='col-lg-8 col-md-8 col-sm-8'>{pager}</div>\n
		</div>";
        $summaryText = '<p>Display {start}-{end} of {count} items (page {page} of {pages})</p>';

        $this->render('index', array(
            'title' => $title,
            'dataProvider' => $dataProvider,
            'itemView' => '_product_item',
            'template' => $template,
            'summaryText' => $summaryText,
        ));
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
}