<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
	'Users'=>array(
		'index'),
	$model->userId,
);

$this->menu = array(
	array(
		'label'=>'List User',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create User',
		'url'=>array(
			'create')),
	array(
		'label'=>'Update User',
		'url'=>array(
			'update',
			'id'=>$model->userId)),
	array(
		'label'=>'Delete User',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->userId),
			'confirm'=>'Are you sure you want to delete this item?')),
	array(
		'label'=>'Manage User',
		'url'=>array(
			'admin')),
);
?>

<h1>View User #<?php echo $model->userId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'userId',
		'firstname',
		'lastname',
		'email',
		'telephone',
		'fax',
		'password',
		'cart',
		'wishlist',
		'newsletter',
		'ip',
		'status',
		'approved',
		'token',
		'type',
		'createDateTime',
	),
));
?>
