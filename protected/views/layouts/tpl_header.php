<?php
/*
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="navbar-inner">
		<div class="container">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="#"><?php echo Yii::app()->name; ?></a>

			<div class="navbar-collapse collapse">
				<?php
				$this->widget('zii.widgets.CMenu', array(
					//'encodeLabel' => false,
					'items' => array(
						array('label' => 'Home',
						      'url' => array('/site/index')),
						array('label' => 'About',
						      'url' => array('/site/page',
						                     'view' => 'about')),
						array('label' => 'Contact',
						      'url' => array('/site/contact')),
						array('label' => 'Login',
						      'url' => array('/site/login'),
						      'visible' => Yii::app()->user->isGuest),
						array('label' => 'Logout (' . Yii::app()->user->name . ')',
						      'url' => array(
							      '/site/logout'),
						      'visible' => !Yii::app()->user->isGuest)
						/*
						  array('label'=>'Menu', 'url'=>array('/url'), 'active'=>$this->id=='controllerId',
						  'items' => array(
						  array(
						  'label' => 'Sub 1',
						  'url' => array('/brand/view', 'id'=>1)),
						  array(
						  'label' => 'Sub 2',
						  'url' => array('/brand/view', 'id'=>2)),
						  ),
						  'itemOptions' => array('class' => 'dropdown'),
						  'submenuOptions' => array('class' => 'dropdown-menu'),
						  ),

					),
					'htmlOptions' => array('class' => 'nav navbar-nav'),
				));
				?>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>
</div>
*/
?>

<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Project name</a>
		</div>
		<div class="navbar-collapse collapse">
			<?php
			$this->widget('zii.widgets.CMenu', $this->nav);
			?>
		</div>
		<!--/.nav-collapse -->
	</div>
</div>