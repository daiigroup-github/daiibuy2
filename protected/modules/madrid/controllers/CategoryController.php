<?php

class CategoryController extends MasterMadridController {

    public function actionIndex($id, $id2 = null) {
        $category = Category::model()->findByPk($id);

        //theme
        $hasTheme = CategoryToSub::model()->find(array(
            'condition' => 'categoryId=:categoryId AND isTheme=1 AND status=1',
            'params' => array(
                ':categoryId' => $id
            ),
        ));
//        throw new Exception(print_r($hasTheme, true));
        if (isset($hasTheme) && isset($id2)) {
            $this->showTheme($id, $id2);
        }

        $hasSet = CategoryToSub::model()->find(array(
            'condition' => 'categoryId=:categoryId AND isSet=1 AND status=1',
            'params' => array(
                ':categoryId' => $id
            ),
        ));
        if (isset($hasSet)) {
            $this->showSet($category);
        }


//        if (!isset($hasTheme)) {
        if (isset($id2)) {
            $subCategorysId = $id2;
            $category2ToProducts = Category2ToProduct::model()->findAll('category1Id=' . $id . ' AND status=1 and type = 1 AND category2Id IN (' . $subCategorysId . ')');
        } else {
            $subCategorys = $category->categoryToSubs;
            $category2ToProducts = Category2ToProduct::model()->findAll('category1Id=' . $id . ' AND status=1 AND type = 1');
        }
//        }
//		$category2ToProducts = Category2ToProduct::model()->findAll(array(
//			'condition'=>'category1Id=:category1Id AND category2Id IN (:category2Id)',
//			'params'=>array(
//				':category1Id'=>$id,
//				':category2Id'=>$subCategorysId,
//			),
//		));

        $criteria = new CDbCriteria();
        $criteria->addInCondition('productId', CHtml::listData($category2ToProducts, 'productId', 'productId'));

        $dataProvider = new CActiveDataProvider('Product', array(
            'criteria' => $criteria));
        $dataProvider->pagination->pageSize = 300;
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

        $this->sideBarCategories = $this->sideBarCategories($id);

        $this->render('index', array(
            'title' => $category->title,
            'dataProvider' => $dataProvider,
            'itemView' => '_product_item',
            'template' => $template,
            'summaryText' => $summaryText,
            'category2Id' => $id2
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

    public function actionAddFavouriteProduct() {
        $existing = UserFavourite::model()->find("userId = " . $_POST["userId"] . " AND productId = " . $_POST["productId"]);

//        throw new Exception(print_r($_POST["userId"] . ', ' . $_POST["productId"], true));
        if (isset($existing)) {
            echo 3;
        } else {
            $model = new UserFavourite();
            $model->userId = $_POST["userId"];
            $model->productId = $_POST["productId"];
            $model->createDateTime = new CDbExpression("NOW()");
            $model->updateDateTime = new CDbExpression("NOW()");
            if ($model->save()) {
                echo 1;
            } else {
                echo 2;
            }
        }
    }

}
