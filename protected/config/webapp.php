<?php
$params = require dirname(__FILE__) . '/params.php';
return CMap::mergeArray(
		require(dirname(__FILE__) . '/main.php'), array(
		'components'=>array(
			'clientScript'=>array(
				'defaultScriptFilePosition'=>CClientScript::POS_END,
				'coreScriptPosition'=>CClientScript::POS_END,
				'packages'=>array(
					'jquery'=>array(
						'baseUrl'=>$params['assets'],
						'js'=>array(
							'jquery/jquery-2.1.1.min.js',
							'jquery/jquery-migrate-1.2.1.min.js',
							'jquery/jquery-ui.min.js',
							'jquery/jquery.cookie.js',
						),
					),
					'bootstrap'=>array(
						'baseUrl'=>$params['assets'],
						'css'=>array(
							'bootstrap/css/bootstrap.min.css',
//							'bootstrap/css/bootstrap-theme.min.css'
						//'bootstrap/css/font-awesome.min.css',
						),
						'js'=>array(
							'bootstrap/js/bootstrap.min.js',
//							'bootstrap/js/jquery.bootstrap.wizard.min.js',
						),
						'depends'=>array(
							'jquery'
						),
					),
					'homeshop'=>array(
						'baseUrl'=>$params['assets'],
						'css'=>array(
//							'css/jquery.fileupload.css',
//							'css/jquery.fileupload-ui.css',
//							'css/jquery.fileupload-noscript.css',
//							'css/jquery.fileupload-ui-noscript.css',
							'css/fileinput.css',
							'css/perfect-scrollbar.css',
							'css/myFileStyle.css',
							'css/style.css',
							'css/flexslider.css',
							'css/fontello.css',
							'css/animation.css',
							'css/owl.carousel.css',
							'css/owl.theme.css',
							'css/chosen.css',
							'css/jquery.fancybox.css',
							'select2/select2.css',
							'select2/select2-bootstrap.css',
							'font-awesome/css/font-awesome.min.css',
							'css/custom.css',


						),
						'js'=>array(
							'js/fileinput.js',
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
							'jquery/jquery.cookie.js',

//							'js/vendor/jquery.ui.widget.js',
//							'js/jquery.iframe-transport.js',
//							'js/jquery.fileupload.js',
//							'js/jquery.fileupload-process.js',
//							'js/jquery.fileupload-image.js',
//							'js/jquery.fileupload-validate.js',
//							'js/main.js',
//							'js/jquery.blueimp-gallery.min.js',
//							'js/canvas-to-blob.min.js',
//							'js/load-image.all.min.js',
//							'js/tmpl.min.js',

//							'js/html5shiv.min.js',
//							'js/respond.min.js',
						),
						'depends'=>array(
							'bootstrap'),
					),
				),
			),
			'image'=>array(
				'class'=>'application.extensions.image.CImageComponent',
				// GD or ImageMagick
				'driver'=>'GD',
				// ImageMagick setup path
				'params'=>array(
					'directory'=>'/opt/local/bin'),
			),
			'urlManager'=>array(
				'showScriptName'=>false,
				'rules'=>array(
                    '<controller:\w+>/<action:\w+>/<c:\d+>/<c2:d+>'=>'<controller>/<action>',
                ),
			),
		),
		'modules'=>array(
			// uncomment the following to enable the Gii tool
			'checkout',
			'fenzer',
			'madrid',
			'atechwindow',
			'ginzahome',
			'ginzatown',
			'myfile',
			'backoffice'
		),
		'params'=>array(
		// this is used in contact page
		),
		'theme'=>'homeshop',
		'defaultController'=>'home',
		// autoloading model and component classes
		'import'=>array(
			'application.models._master.*',
		),
		)
);
