daiibuy2
========

daiibuy.com version 2

Connect ORG & WOW

'org'=>array(
		'connectionString'=>"mysql:host=$host;dbname=daiibuy2_org_dev",
		'emulatePrepare'=>true,
		'username'=>"$user",
		'password'=>"$pwd",
		'charset'=>'utf8',
		'class'=>'CDbConnection',
	),
	'wow'=>array(
		'connectionString'=>"mysql:host=$host;dbname=daiiwow_dev",
		'emulatePrepare'=>true,
		'username'=>"$user",
		'password'=>"$pwd",
		'charset'=>'utf8',
		'class'=>'CDbConnection',
	),