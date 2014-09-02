<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
	'Users',
);

$this->menu = array(
	array(
		'label'=>'Create User',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");


$this->pageHeader = 'การจัดการ User';
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<?php
		if(isset(yii::app()->user->id))
		//if(User::model()->findByPk(Yii::app()->user->id)->type == 6)
		//{
		//        echo CHtml::link('<i class="icon-plus-sign icon-white"></i> เพิ่ม Distributor', array(
		//                'user/create'), array(
		//                'class'=>'btn btn-primary'));
		//}
		//else
			if(1 == 1)
			//if(User::model()->findByPk(Yii::app()->user->id)->type != 6)
			{
				echo CHtml::link('<i class="icon-plus-sign icon-white"></i> เพิ่ม User', array(
					'create'), array(
					'class'=>'btn btn-primary'));
			}
		?>
	</div>
</div>


<?php
$this->renderPartial('_search', array(
	'model'=>$model,
));
?>

<?php
if(isset(Yii::app()->user->id))
{
	if(1 == 1)
	//if(User::model()->findByPk(Yii::app()->user->id)->type == 6)
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'user-grid',
			'itemsCssClass'=>'table table-striped table-bordered table-condensed',
			'dataProvider'=>$model->search(),
			//'filter'=>$model,
			'columns'=>array(
				//'email',
				array(
					'name'=>'email',
					'type'=>'raw',
					'value'=>'isset($data->minimumOrder)?"$data->email => ขั้นต่ำ : $data->minimumOrder":"$data->email" ',
				),
				'firstname',
				'lastname',
				array(
					'name'=>'บริษัท',
					'type'=>'raw',
					'value'=>'$data->showUserCompany($data->userId)',
				),
				'telephone',
				'createDateTime',
				//'fax',
				array(
					'name'=>'type',
					'type'=>'raw',
					'htmlOptions'=>array(
						'style'=>'text-align:center;width:10%'),
					'value'=>'$data->showUserType($data->type)',
				),
			),
		));
	else
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'user-grid',
			'itemsCssClass'=>'table table-striped table-bordered table-condensed',
			'dataProvider'=>$model->search(),
			//'filter'=>$model,
			'columns'=>array(
				//'email',
				array(
					'name'=>'email',
					'type'=>'raw',
					'value'=>'isset($data->minimumOrder)?"$data->email => ขั้นต่ำ : $data->minimumOrder":"$data->email" ',
				),
				'firstname',
				'lastname',
				array(
					'name'=>'บริษัท',
					'type'=>'raw',
					'value'=>'$data->showUserCompany($data->userId)',
				),
				'telephone',
				'createDateTime',
				//'fax',
				array(
					'name'=>'type',
					'type'=>'raw',
					'htmlOptions'=>array(
						'style'=>'text-align:center;width:10%'),
					'value'=>'$data->showUserType($data->type)',
				),
				array(
					'class'=>'CButtonColumn',
					'template'=>'{view} {update} {delete} {reward}',
					'buttons'=>array(
						'reward'=>array(
							'label'=>'Reward',
							'url'=>'Yii::app()->createUrl("admin/user/supplierDiscountRange?supplierId=".$data->primaryKey)',
							'visible'=>'($data->type == 3)'
						)
					),
				),
			),
		));
}else
{
	$this->redirect(Yii::app()->baseUrl);
}
?>
