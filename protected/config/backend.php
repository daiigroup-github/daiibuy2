<?php

return CMap::mergeArray(require(dirname(__FILE__) . '/main.php'), array('components' => array(),
	'modules' => array(
	// uncomment the following to enable the Gii tool
	'admin', /*
			          'gii'=>array(
			          'class'=>'system.gii.GiiModule',
			          'password'=>'Enter Your Password Here',
			          // If removed, Gii defaults to localhost only. Edit carefully to taste.
			          'ipFilters'=>array('127.0.0.1','::1'),
			          //custom gii generate path
			        
			          //'generatorPaths' => array(
			          //	'application.gii.generators'
			          ),
			          ),
			  */
	),
	'params' => array(
	// this is used in contact page
	),
//'theme' => '',
));
