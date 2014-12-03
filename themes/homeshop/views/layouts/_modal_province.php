<!-- Modal -->
<div class="modal fade" id="selectProvinceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
	<div class="modal-dialog">
		<?php
		$form = $this->beginWidget('CActiveForm', array(
			'id'=>'selectProvinceForm',
			//'enableClientValidation' => true,
			//'clientOptions' => array('validateOnSubmit' => true,),
			'htmlOptions'=>array(
				'class'=>'',
				'role'=>'form'
			),
		));
		?>
		<div class="modal-content">
			<div class="modal-header">
				<?php //<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>?>
				<h4 class="modal-title" id="myModalLabel">Select Province</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-info">
					กรุณาเลือกจังหวัด(ราคาอาจมีการเปลี่ยนแปลงตามสถานที่ส่งสินค้าตามจังหวัดที่ท่านเลือก).
				</div>

				<?php
				echo CHtml::dropDownList('provinceId', $this->cookie['provinceId'], CHtml::listData(Province::model()->findAll(), 'provinceId', 'provinceName'), array(
					'class'=>'form-control',
					'id'=>'selectProvince'
				));

				echo CHtml::textField('flag', $this->action->id=='step', array('style'=>'display:none'));
				?>
			</div>
			<div class="modal-footer">
				<?php //<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>?>
				<?php //<button type="button" class="btn btn-primary">Save changes</button>?>
				<?php
				echo CHtml::ajaxButton('Select Province', Yii::app()->createUrl('selectProvince/saveProvince'), array(
					'type'=>'POST',
					'dataType'=>'json',
					'data'=>'js:$("#selectProvinceForm").serialize()',
					'success'=>'js:function(data){
							//alert(data.provinceId);
							$("#selectProvinceModal").modal("hide");
							$("#selectProvinceModal").on("hidden.bs.modal", function (e) {
								window.location.assign(2);
							});
						}'
					), array(
					'class'=>'btn btn-primary'));
				?>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>

<?php
if(isset($this->module))
{
	$isShow = isset($this->cookie['provinceId']) && !empty($this->cookie['provinceId']) ? 'false' : 'true';
	Yii::app()->clientScript->registerScript('selectProvinceModal', "

	/*
	$('#selectProvinceModal').on('show.bs.modal', function(e){
		$.ajax({
			url: '" . Yii::app()->createUrl('site/province') . "',
			dataType : 'html',
			success : function(data){
				$('.modal-body').html(data);
			}
		});
	});
	*/
	$('#selectProvinceModal').modal({
		backdrop: 'static',
		keyboard: false,
		show : $isShow
	});
");
}
?>
<?php Yii::app()->clientScript->registerScript('selectProvince', "
	$('#selectProvince').select2();
", CClientScript::POS_READY); ?>