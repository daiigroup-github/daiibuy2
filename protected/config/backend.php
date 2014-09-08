<?php
$params = require dirname(__FILE__) . '/params.php';
return CMap::mergeArray(require(dirname(__FILE__) . '/main.php'), array(
        'components' => array(
            'clientScript' => array(
                'defaultScriptFilePosition' => CClientScript::POS_END,
                'coreScriptPosition' => CClientScript::POS_END,
                'packages' => array(
                    'jquery' => array(
                        'baseUrl' => $params['assets'],
                        'js' => array(
                            'jquery/jquery-2.1.1.min.js',
                            'jquery/jquery-migrate-1.2.1.min.js',
                            'jquery/jquery-ui.min.js',
                            'jquery/jquery.cookie.js',
                        ),
                    ),
                    'bootstrap' => array(
                        'baseUrl' => $params['assets'],
                        'css' => array(
                            'bootstrap/css/bootstrap.min.css',
                            'font-awesome/css/font-awesome.min.css',
                        ),
                        'js' => array(
                            'bootstrap/js/bootstrap.min.js',
                        ),
                        'depends' => array(
                            'jquery'
                        ),
                    ),
                ),
            ),
            /*
            'urlManager' => array(
                'showScriptName' => false,
                'rules' => array(),
            ),
            */
        ),
        'modules' => array(
            // uncomment the following to enable the Gii tool
            'backoffice',
        ),
        'params' => array( // this is used in contact page
        ),
        //'theme' => '',
        // autoloading model and component classes
        'import' => array(
            'application.models._master.*',
        ),
    )
);

