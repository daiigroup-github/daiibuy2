<?php

class SetController extends MasterMadridController
{
	public function actionIndex()
	{
		$title = 'Sanitary Set';
		$items = $this->showSanitary();

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

		$this->render('index', array('title' => $title,
		                             'dataProvider' => $dataProvider,
		                             'itemView' => '//layouts/_product_item',
		                             'template' => $template,
		                             'summaryText' => $summaryText,
		                             'itemClass' => $itemClass
		));
	}

	public function actionDetail()
	{
		$images = [];
		foreach ($this->scanDir(Yii::app()->basePath . '/../images/madrid/sanitary') as $k => $image) {
			$images[$k] = Yii::app()->baseUrl . '/images/madrid/sanitary/' . $image;
		}
		$product = array(
			'title' => 'Madrid Sanitary #',
			'code' => 'PBS173',
			'category' => 'Sanitary',
			'stock' => '20',
			'dimension' => array(
				'w' => 100.00,
				'h' => 100.00,
				'l' => 100.00,
			),
			'weight' => 80.50,
			'price' => 300,
			'pricePromotion' => 280,
			'productId' => 1,
			'options' => array(
				array('option1'),
				array('option2'),
			),
			'images' => $images,
			'tabs' => array(
				array(
					'title' => 'Description',
					'detail' => 'Detail Tab1'
				),
				array(
					'title' => 'Reviews',
					'detail' => 'Detail Tab2'
				),
				array(
					'title' => 'Comments',
					'detail' => 'Detail Tab3'
				),
			),
		);

		$this->render('detail', array('product' => $product));
	}

	public function showSanitary()
	{
		$items = [];
		$i = 1;
		foreach ($this->scanDir(Yii::app()->basePath . '/../images/madrid/sanitary') as $file) {
			$items[$i] = [
				'id' => $i,
				'image' => Yii::app()->baseUrl . '/images/madrid/sanitary/' . $file,
				'url' => Yii::app()->createUrl('madrid/product/index/id/' . $i),
				'title' => substr($file, 0, -4),
				'price' => rand(1000, 99999),
				'buttons' => [
					'favorites'
				]
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
}