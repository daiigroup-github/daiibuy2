<?php

class CategoryController extends MasterAtechwindowController
{

	public function actionIndex($category1Id)
	{
		$colors = array(
			'ALL',
			'White',
			'Brown',
			'Black',
			'Gray',
		);
		$category1 = Category::model()->findByPk($category1Id);

//        if ($category1->subCategorys !== array()) {
//            $dropdown = array();
//            $j = 0;
//            foreach ($category->subCategorys as $subCategory) {
//                $dropdown[$j] = array(
//                    'url' => $this->createUrl('category/index?id=' . $subCategory->categoryId . "&category1Id=" . $category->categoryId),
//                    'caption' => strtoupper($subCategory->title),
//                );
//                $j++;
//            }
//            $this->nav[$i]['dropdown'] = $dropdown;
//        }
		//Tong Loop For Show Side Category By Cat1
//        $catToSubs = CategoryToSub::model()->findAll("categoryId=" . $_GET["category2Id"] . " GROUP By subCategoryId");
//        $i = 0;
//        $sideBar = array();
//        foreach ($catToSubs as $catToSub) {
//            $sideBar[$i] = array(
//                'url' => $this->createUrl('category/index?id=' . $catToSub->subCategoryId . "&category1Id=" . $catToSub->categoryId),
//                'link' => strtoupper($catToSub->subCategory->title),
//            );
//            $i++;
//        }
//        $this->sideBarCategories = array(
//            'title' => 'Atech Window',
//            'items' => $sideBar);
		//Tong Loop For Show Side Category By Cat1

		if(isset($_GET["category2Id"]))
		{
			$category2Id = $_GET["category2Id"];
			$defaultCategory2 = Category::model()->findByPk($category2Id);
		}
		else
		{
			$defaultCategory2 = $category1->subCategorys[0];
			$category2Id = $defaultCategory2->categoryId;
		}
		$images = [];
		if(count($defaultCategory2->images) > 0):
			foreach($defaultCategory2->images as $image)
			{
				$images[] = Yii::app()->baseUrl . $image->image;
			}
		else:
			$images[] = Yii::app()->baseUrl . $defaultCategory2->image;
		endif;

		//Create By Tong
//        $widthArray = Product::model()->findAtechWidthGroup($id);
//        $heightArray = Product::model()->findAtechHeightGroup($id);

		$this->render('index', array(
			'category1'=>$category1,
			'images'=>$images,
			'category2Id'=>$category2Id,
//            'colors' => $colors,
//            'widthArray' => $widthArray,
//            'heightArray' => $heightArray
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

	public function actionViewOtherProduct($id)
	{
		$this->layout = '//layouts/cl1';
		$cat2ToProduct = Category2ToProduct::model()->findByPk($id);

		$models = Category2ToProduct::model()->findAll("brandId=:brandId AND brandModelId=:brandModelId AND category1Id =:category1Id ", array(
			":brandId"=>$cat2ToProduct->brandId,
			":brandModelId"=>$cat2ToProduct->brandModelId,
			":category1Id"=>$cat2ToProduct->category1Id
		));

		$this->render("_product_list", array(
			'models'=>$models));
	}

}
