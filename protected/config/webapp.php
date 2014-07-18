<?php
$params = require dirname(__FILE__) . '/params.php';
return CMap::mergeArray(
	require(dirname(__FILE__) . '/main.php'), array(
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
							//'bootstrap/css/font-awesome.min.css',
						),
						'js' => array(
							'bootstrap/js/bootstrap.min.js',),
						'depends' => array(
							'jquery'
						),
					),
					'homeshop' => array(
						'baseUrl' => $params['assets'],
						'css' => array(
							'css/perfect-scrollbar.css',
							'css/style.css',
							'css/flexslider.css',
							'css/fontello.css',
							'css/animation.css',
							'css/owl.carousel.css',
							'css/owl.theme.css',
							'css/chosen.css',
						    'css/custom.css',
						    'css/jquery.fancybox.css',
						    'select2/select2.css',
						    'select2/select2-bootstrap.css'
						),
						'js' => array(
							'js/modernizr.min.js',
							'js/jquery.raty.min.js',
							'js/perfect-scrollbar.min.js',
							'js/zoomsl-3.0.min.js',
							'js/jquery.fancybox.pack.js',
							'js/jquery.themepunch.plugins.min.js',
							'js/jquery.themepunch.revolution.min.js',
							'js/flexslider.min.js',
							'js/jquery.iosslider.min.js',
							'js/jquery.nouislider.min.js',
							'js/owl.carousel.min.js',
							'js/zoomsl-3.0.min.js',
							'js/chosen.jquery.min.js',
							'js/main-script.js',
						    'select2/select2.js',
							'jquery/jquery.cookie.js'
						),
						'depends' => array('bootstrap'),
					),
				),
			),
			'urlManager' => array(
				'showScriptName' => false,
				'rules' => array(),
			),
		),
		'modules' => array( // uncomment the following to enable the Gii tool
			'checkout',
			'fenzer',
			'madrid'
		),
		'params' => array( // this is used in contact page
		),
		'theme'=>'homeshop',
	    'defaultController'=>'home'
	)
);