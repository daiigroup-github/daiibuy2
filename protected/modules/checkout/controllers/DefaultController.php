<?php

class DefaultController extends MasterCheckoutController
{
    public function actionIndex()
    {
        $carts = array(
            array(
                'title' => 'Other',
                'type' => 2,
                'items' => array(
                    array(
                        'title' => 'Tile',
                        'items' => array(
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'title' => 'WC1',
                'type' => 3,
                'items' => array(
                    array(
                        'title' => 'Tile',
                        'items' => array(
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                        ),
                    ),
                    array(
                        'title' => 'Sanitary',
                        'items' => array(
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'title' => 'WC2',
                'type' => 3,
                'items' => array(
                    array(
                        'title' => 'Tile',
                        'items' => array(
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                        ),
                    ),
                    array(
                        'title' => 'Sanitary',
                        'items' => array(
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                            array(
                                'id' => rand(0, 99999),
                                'code' => rand(100000, 999999),
                                'name' => substr(md5(uniqid()), 0, 10),
                                'qty' => rand(1, 99),
                                'unitPrice' => rand(100, 9999),
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->render('index', array('carts' => $carts));
    }
}