<?php
$params = require dirname(__FILE__) . '/params.php';

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name'=>'Daiibuy 2 สินค้าเกี่ยวกับบ้านที่ถูกที่สุด ',
	// preloading 'log' component
	'preload'=>array(
		'log'),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.models._master.*',
		'application.components.*',
		'application.helpers.*',
		'application.extensions.php_barcode128.*',
		'application.extensions.yii-mail.*',
		'application.extensions.select2.*',
	),
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>false, //'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>false, //array('127.0.0.1','::1'),
		),
	),
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		  'db' => array(
		  'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
		  ),
		 */
		// uncomment the following to use a MySQL database
		'db'=>$params['db'],
//		'dbDaiibuy1'=>$params['dbDaiibuy1'],
		'mail'=>array(
			'class'=>'application.extensions.yii-mail.YiiMail',
			'transportType'=>'smtp', // change to 'php' when running in real domain.
//'viewPath' => 'application.views.mail',
			'logging'=>true,
			'dryRun'=>false,
			'transportOptions'=>array(
				'host'=>'smtp.gmail.com', //if not work, try smtp.googlemail.com
				'username'=>'kamon.p@daiigroup.com',
				'password'=>'84888488ab',
				'port'=>'465',
				'encryption'=>'ssl',
			),),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			// uncomment the following to show log messages on web pages
			/*
			  array(
			  'class'=>'CWebLogRoute',
			  ),
			 */
			),
		),
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'sendEmail'=>false,
		'ePaymentServerType'=>2
	),
);
