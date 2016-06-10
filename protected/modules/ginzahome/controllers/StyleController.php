<?php

class StyleController extends MasterGinzahomeController {

    public function actionIndex($id) {
        /**
         * Ginza style CategoryToSub::isTheme=1
         */
        $supplierModel = Supplier::model()->find(array(
            'condition' => 'url=:url',
            'params' => array(
                ':url' => $this->module->id)));

        //find all styles
        $categoryIds = CategoryToSub::model()->findAll(array(
            'condition' => 'brandModelId=' . $id . ' AND isTheme=1',
            'order' => 'sortOrder',
            'select' => 'distinct categoryId'
        ));
        $catText = "";
        $i = 1;
        foreach ($categoryIds as $cat) {
            $catText = $catText . $cat->categoryId;
            $sortOrder = ModelToCategory1::model()->findAll('brandModelId=' . $id);
            foreach ($sortOrder as $sort) {
                if ($sort->categoryId == $cat->categoryId) {
                    //throw new Exception($cat->categoryId);
                    $Item = Category::model()->find('categoryId=' . $cat->categoryId);
                    $Item->sortOrder = $sort->sortOrder;
                    $Item->save(false);
                }
                //$cat->sortOrder = $sort->sortOrder;
                // $cat->save(false);
            }
            if ($i < count($categoryIds))
                $catText .= ", ";
            $i++;
        }

        $styles = Category::model()->findAll('categoryId in (' . $catText . ' ) order by sortOrder ASC');
        $this->render('index', array(
            'supplierModel' => $supplierModel,
            'styles' => $styles,
            'brandModelId' => $id
        ));
    }

    public function actionChangeStyle() {
        $result = [];
        if (isset($_POST['categoryId']) && isset($_POST['filter'])) {
            $categoryId = $_POST['categoryId'];
            $filter = $_POST['filter'];
            //throw new \yii\base\Exception($productId);
            $catToSubModels = CategoryToSub::model()->findAll(array(
                'condition' => 'categoryId=:categoryId AND brandModelId=:brandModelId order by sortOrder',
                'params' => array(
                    ':categoryId' => $style->categoryId,
                    ':brandModelId' => $brandModelId,
                ),
            ));
            $result['status'] = 1;
            $result['priceTable'] = $this->render('//layouts/_modal_product_price_table', ['category' => $categories]);
        } else {
            $result['status'] = 2;
            $result['error'] = "Can't Render Price Table";
        }

        echo json_encode($result);
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
    public function actionTest() {
        $this->render("/test/test");
    }

    public function actionChangeType() {
        $result = [];
        if (isset($_POST['type']) && isset($_POST['categoryId'])) {
            $type = $_POST['type'];
            $categoryId = $_POST['categoryId'];
            $result['status'] = 1;

            $result['priceTable'] = $type;
        } else {
            $result['status'] = 2;
            $result['error'] = "Can't Render Price Table";
        }
        //throw new Exception('312312312');
        // return;
        echo json_encode($result);
    }

}
