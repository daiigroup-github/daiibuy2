<?php

class DefaultController extends MasterAtechwindowController
{

	public $layout = '//layouts/cl1';

	public function actionIndex($id = null)
	{
		$title = 'Fenzer';

		//pager
		$items = $this->showCategory();

		$dataProvider = new CArrayDataProvider($items, array(
			'keyField'=>'id'));
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

		$supplierModel = Supplier::model()->find(array(
			'condition'=>'url=:url',
			'params'=>array(
				':url'=>$this->module->id)));
		if(!isset($id))
		{
			$categorys = Category::model()->findAll(array(
				'condition'=>'supplierId=:supplierId AND isRoot=0 AND status=1',
				'params'=>array(
					':supplierId'=>$supplierModel->supplierId)));
		}
		else
		{
			$category = Category::model()->findByPk($id);
			$categorys = $category->subCategorys;
		}

		/*
		  $this->render('index', array(
		  'title' => $title,
		  'dataProvider' => $dataProvider,
		  'itemView' => '//layouts/_product_item2',
		  'template' => $template,
		  'items' => $items,
		  ));
		 */

		$this->render('index', array(
			'supplierModel'=>$supplierModel,
			'categorys'=>$categorys,
			'category1Id'=>isset($category) ? $category->categoryId : NULL));
	}

}
