<?php
$params = require dirname(__FILE__) . '/protected/config/params.php';

// change the following paths if necessary
$yii = dirname(__FILE__) . $params['framework'];
$config = dirname(__FILE__) . '/protected/config/backend.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
Yii::createWebApplication($config)->run();
