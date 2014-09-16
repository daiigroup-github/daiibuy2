<?php

class ProductController extends MasterFenzerController
{
    public function actionIndex($id)
    {
        $product = array(
            'title' => 'Madrid Sanitary #1',
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

        $this->render('index', array('product' => $product));
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

    public function actionCalculateProductItems()
    {
        if (isset($_POST)) {
            $res = '';

            $this->writeToFile('/tmp/showItems', print_r($_POST, true));

            $items = array();

            for ($i = 0; $i < 6; $i++) {
                $items[$i] = array(
                    'code' => strtoupper(substr(md5(uniqid()), 0, 8)),
                    'name' => 'Fenzer ' . $i,
                    'price' => rand(100, 500),
                    'qty' => rand(1, 100),
                );
            }

            foreach ($items as $item) {
                $res .= '<tr>' .
                    '<td>' . $item['code'] . '</td>' .
                    '<td>' . $item['name'] . '</td>' .
                    '<td>' . number_format($item['price'], 2) . '</td>' .
                    '<td>' .
                    '<input type="number" class="form-control full-width" value="'.$item['qty'].'" />'.
                    /*
                    '<div class="numeric-input full-width">' .
                    '<input type="text" value="' . $item['qty'] . '" name="l"/>' .
                    '<span class="arrow-up"><i class="icons icon-up-dir"></i></span>' .
                    '<span class="arrow-down"><i class="icons icon-down-dir"></i></span>' .
                    '</div>' .
                    */
                    '</td>' .
                    '<td>' . number_format($item['qty']*$item['price'], 2) . '</td>' .
                    '<td><a class="btn btn-danger btn-xs removeProductItem"><i class="fa fa-ban"></i></a></td>' .
                    '</tr>';
            }
            /*
            <tr>
                <td><?php echo $item['code']; ?></td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo number_format($item['price'], 2); ?></td>
                <td>
                    <div class="numeric-input full-width">
                        <input type="text" value="<?php echo $item['qty']; ?>" name="l"/>
                        <span class="arrow-up"><i class="icons icon-up-dir"></i></span>
                        <span class="arrow-down"><i class="icons icon-down-dir"></i></span>
                    </div>
                </td>
                <td><?php echo number_format($item['price'] * $item['qty'], 2); ?></td>
                <td class="text-center">
                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></a>
                </td>
            </tr>
            */

            echo $res;
        }
    }

    public function actionAddProductItem()
    {
        if (isset($_POST)) {
            $item = array(
                'code' => strtoupper(substr(md5(uniqid()), 0, 8)),
                'name' => 'Fenzer ' . rand(10,99),
                'price' => rand(100, 500),
                'qty' => rand(1, 100),
            );

            $res = '<tr>' .
                '<td>' . $item['code'] . '</td>' .
                '<td>' . $item['name'] . '</td>' .
                '<td>' . number_format($item['price'], 2) . '</td>' .
                '<td>' .'<input type="number" />'.
                /*
                '<div class="numeric-input full-width">' .
                '<input type="text" value="' . $item['qty'] . '" name="l"/>' .
                '<span class="arrow-up"><i class="icons icon-up-dir"></i></span>' .
                '<span class="arrow-down"><i class="icons icon-down-dir"></i></span>' .
                '</div>' .
                */
                '</td>' .
                '<td>' . number_format($item['qty']*$item['price'], 2) . '</td>' .
                '<td><a class="btn btn-danger btn-xs" id="removeProductItem"><i class="fa fa-ban"></i></a></td>' .
                '</tr>';

            echo $res;
        }
    }

    public function actionAddToCart()
    {
        $this->writeToFile('/tmp/addToCartFenzer', print_r($_POST, true));
        $res = array();
        $res['result'] = true;

        echo CJSON::encode($res);
    }
}