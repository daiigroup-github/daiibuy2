<?php

class DefaultController extends MasterAtechwindowController {

//    public $layout = '//layouts/cl1';

    public function actionIndex() {
        $colors = array(
            'ALL',
            'White',
            'Brown',
            'Black',
            'Gray',
        );
//        $category1 = Category::model()->findByPk($category1Id);
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
        $supplier = Supplier::model()->find(array(
            'condition' => 'url=:url',
            'params' => array(
                ':url' => $this->module->id,
            ),
        ));
        $brands = Brand::model()->findAll(array(
            'condition' => 'supplierId=:supplierId',
            'params' => array(
                ':supplierId' => $supplier->supplierId,
            ),
            'order' => 'title ASC',
//            'group by' => 'category2Id',
        ));
//        throw new Exception(print_r($brands, true));
        if (isset($_GET["brandId"]))
            $brandId = $_GET["brandId"];
        if (!isset($brandId))
            $brandId = $brands[0]->brandId;




        $category2ToProducts = Category2ToProduct::model()->findAll('brandId = ' . $brandId . ' AND status = 1');
//        throw new Exception(print_r($category2ToProducts[0]->category2Id, true));
        if (isset($category2ToProducts[0]))
            $defaultCategory2 = Category::model()->findByPk($category2ToProducts[0]->category2Id);
//        throw new Exception(print_r(count($category2ToProducts), true));
//        if (isset($_GET[""])) {
//            $category2Id = $_GET["category2Id"];
//            $defaultCategory2 = Category::model()->findByPk($category2Id);
//        } else {
//            $defaultCategory2 = $category1->subCategorys[0];
//            $category2Id = $defaultCategory2->categoryId;
//        }
        $images = [];
        if (isset($defaultCategory2->images)):
            if (count($defaultCategory2->images) > 0):
                foreach ($defaultCategory2->images as $image) {
                    $images[] = Yii::app()->baseUrl . $image->image;
                }
            else:
                $images[] = Yii::app()->baseUrl . $defaultCategory2->image;
            endif;
        endif;

//        throw new Exception(print_r($brandId, true));
        //Create By Tong
//        $widthArray = Product::model()->findAtechWidthGroup($id);
//        $heightArray = Product::model()->findAtechHeightGroup($id);

        $this->render('index', array(
            'category2ToProducts' => $category2ToProducts,
            'images' => $images,
            'category2Id' => isset($defaultCategory2->categoryId) ? $defaultCategory2->categoryId : null,
            'colors' => $colors,
//            'colors' => $colors,
//            'widthArray' => $widthArray,
//            'heightArray' => $heightArray
        ));
//		$title = 'Fenzer';
//
//		//pager
//		$items = $this->showCategory();
//
//		$dataProvider = new CArrayDataProvider($items, array(
//			'keyField'=>'id'));
//		$template = "<div class='row'>
//			<div class='col-lg-6 col-md-6 col-sm-6'>{summary}</div>\n
//			<div class='col-lg-6 col-md-6 col-sm-6'>{pager}</div>\n
//		</div>
//		<div class='row'>
//			{items}
//		</div>
//		<div class='row'>
//			<div class='col-lg-6 col-md-6 col-sm-6'>{summary}</div>\n
//			<div class='col-lg-6 col-md-6 col-sm-6'>{pager}</div>\n
//		</div>";
//
//		$data = array();
//
//		$supplierModel = Supplier::model()->find(array(
//			'condition'=>'url=:url',
//			'params'=>array(
//				':url'=>$this->module->id)));
//		if(!isset($id))
//		{
//			$categorys = Category::model()->findAll(array(
//				'condition'=>'supplierId=:supplierId AND isRoot=0 AND status=1',
//				'params'=>array(
//					':supplierId'=>$supplierModel->supplierId)));
//		}
//		else
//		{
//			$category = Category::model()->findByPk($id);
//			$categorys = $category->subCategorys;
//		}
//
//		/*
//		  $this->render('index', array(
//		  'title' => $title,
//		  'dataProvider' => $dataProvider,
//		  'itemView' => '//layouts/_product_item2',
//		  'template' => $template,
//		  'items' => $items,
//		  ));
//		 */
//
//		$this->render('index', array(
//			'supplierModel'=>$supplierModel,
//			'categorys'=>$categorys,
//			'category1Id'=>isset($category) ? $category->categoryId : NULL));
    }

}
