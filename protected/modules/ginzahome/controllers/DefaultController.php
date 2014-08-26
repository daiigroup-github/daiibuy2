<?php

class DefaultController extends MasterGinzahomeController
{
    public function actionIndex()
    {
        $title = 'Ginza Home';

        //pager
        $items = $this->showCategory();

        $dataProvider = new CArrayDataProvider($items, array('keyField' => 'id'));
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

        $data = array();

        $this->render('index', array(
            'title' => $title,
            'dataProvider' => $dataProvider,
            'itemView' => '//layouts/_product_item2',
            'template' => $template,
            'items' => $items,
        ));
    }
}