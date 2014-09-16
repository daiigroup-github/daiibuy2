<?php

class ProductController extends MasterAtechwindowController
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

    public function actionSearchProductItems()
    {
        if (isset($_POST)) {
            $res = '';

            $colors = array(
                'ALL',
                'White',
                'Brown',
                'Black',
                'Gray',
            );

            $sizes = array(
                '2000 x 1000',
                '2100 x 1200',
                '2200 x 1400',
                '2300 x 1600',
                '2400 x 1800',
                '2500 x 2000',
            );

            $items = array();

            for ($i = 0; $i < rand(3, 9); $i++) {
                $items[$i] = array(
                    'model' => 'Model ' . $i,
                    'code' => strtoupper(substr(md5(uniqid()), 0, 8)),
                    'name' => 'Atech Window ' . $i,
                    'size' => $sizes[rand(0, 5)],
                    'color' => $colors[rand(0, 4)],
                    'price' => rand(100, 500),
                    'qty' => 1,

                );
            }

            foreach ($items as $item) {
                $res .= '<tr>' .
                    '<td>' . $item['model'] . '</td>' .
                    '<td>' . $item['code'] . '</td>' .
                    '<td>' . $item['name'] . '</td>' .
                    '<td>' . $item['size'] . '</td>' .
                    '<td>' . $item['color'] . '</td>' .
                    '<td>' . number_format($item['qty']*$item['price'], 2) . '</td>' .
                    '<td>' .
                    '<div class="numeric-input full-width">' .
                    '<input type="text" value="' . $item['qty'] . '" name="l"/>' .
                    '<span class="arrow-up"><i class="icons icon-up-dir"></i></span>' .
                    '<span class="arrow-down"><i class="icons icon-down-dir"></i></span>' .
                    '</div>' .
                    '</td>' .
                    '<td><a class="btn btn-info btn-xs addToCart" data-productid="'.$item['code'].'"><i class="fa fa-shopping-cart"></i></a></td>' .
                    '</tr>';
            }

            /**
             * <?php foreach ($items as $item): ?>
            <tr>
            <td><?php echo $item['model']; ?></td>
            <td><?php echo $item['code']; ?></td>
            <td><?php echo $item['name']; ?></td>
            <td><?php echo $item['size']; ?></td>
            <td><?php echo $item['color']; ?></td>
            <td><?php echo number_format($item['price'] * $item['qty'], 2); ?></td>
            <td>
            <div class="numeric-input full-width">
            <input type="text" value="<?php echo $item['qty']; ?>" name="l"/>
            <span class="arrow-up"><i class="icons icon-up-dir"></i></span>
            <span class="arrow-down"><i class="icons icon-down-dir"></i></span>
            </div>
            </td>
            <td class="text-center">
            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-shopping-cart"></i></a>
            </td>
            </tr>
            <?php endforeach; ?>
             */

            echo $res;
        }
    }
}
