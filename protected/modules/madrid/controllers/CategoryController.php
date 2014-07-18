<?php

class CategoryController extends MasterMadridController
{
	public function actionIndex($id)
	{
		$title = ($id == 1) ? 'Sanitary' : 'Tile';

		//pager
		$items = $this->showSanitary();

		$dataProvider = new CArrayDataProvider($items, array('keyField' => 'id'));
		$dataProvider->pagination->pageSize = 9;
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

		$this->render('index', array('title' => $title,
		                             'dataProvider' => $dataProvider,
		                             'itemView'=>'//layouts/_product_item',
		                             'template'=>$template,
		                             'summaryText'=>$summaryText,
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