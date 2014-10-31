<div class="modal fade" id="condition<?php echo $period; ?>Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<?php //<button type="button" class="close" data-dismiss="modal"><td aria-hidden="true">&times;</td><td class="sr-only">Close</td></button>?>
				<h4 class="modal-title blue" id="myModalLabel">ข้อตกลงและเงื่อนไข</h4>
			</div>
			<div class="modal-body">

				<div class="row sidebar-box" id="confirm_content" style="background-color: white">
					<div class="col-md-12">
						<!--						<div class="sidebar-box-heading">
													<i class="fa fa-tdst"></i>
													<h4>ข้อตกลงและเงื่อนไข <?php // echo $model->title;                                                                                                                                                                                                                ?></h4>
												</div>-->
						<div class="row sidebox-content ">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-11">
										1. เนื่องจากบางบริษัทได้เข้าดำเนินการสำรวจผังตามใบสั่งซื้อของลูกค้าไปแล้วนั้น ทางบริษัทเห็นว่า สามารถเข้าดำเนินการก่อสร้างขั้นตอไปได้<br>
										ผู้สั่งซื้อกรุณาตรวจสอบรายละเอียดตามรายการด้านล่าง
										<table class="table table-bordered table-condensed ">
											<tr>
												<td class="text-center">Layout Appreve </td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
											</tr>
											<tr>
												<td>ผลสำรวจ</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
											</tr>
											<tr>
												<td>ใบรับงานสำรวจ</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-md-11">
										2. ก่อนสังซื้องวดต่อไป ผู้สั่งซื้อต้องอ่านแล้วทำความเข้าใจ รายละเอียดแบบและสัญญาให้ครบถ้วนตามรายการด้านล่างดังนี้
										<table class="table table-bordered table-condensed ">
											<tr>
												<td>แบบผังพื้น</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
											</tr>
											<tr>
												<td>แบบรูปด้าน</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
											</tr>
											<tr>
												<td>แบบรูปตัด</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
											</tr><tr>
												<td>แบบงานระบบไฟฟ้า</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
											</tr><tr>
												<td>แบบงานระบบสุขาภิบาล</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
											</tr><tr>
												<td>สัญญาซื้อขาย</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-md-11">
										3. กรณีผู้สั่งซื้อ อนุมัติตามรายการทั้งหมดแล้ว ถือว่าผู้สั่งซื้อยอมรับเงื่อนไขที่เป็นไปตามรายละเอียดในสัญญา และถือเป็นการทำสัญญาซื้อขายกับบริษัทแล้ว
									</div>
								</div>
								<div class="row">
									<div class="col-md-10">
										ข้าพเจ้าได้อ่านและทำความเข้าใจรายละเอียดตามข้อตกลงและเงื่อนไขข้างต้นดีแล้ว

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<?php
				echo CHtml::ajaxButton('Accept', Yii::app()->createUrl('selectProvince/saveProvince'), array(
					'type'=>'POST',
					'dataType'=>'json',
					'success'=>'js:function(data){
							$("#condition' . $period . 'Modal").modal("hide");
							$("#payForm' . $period . '").submit();
						}'
					), array(
					'class'=>'btn btn-primary'));
				echo CHtml::ajaxButton('Reject', Yii::app()->createUrl('selectProvince/saveProvince'), array(
					'type'=>'POST',
					'dataType'=>'json',
					'success'=>'js:function(data){
							$("#condition' . $period . 'Modal").modal("hide");
						}'
					), array(
					'class'=>'btn btn-danger'));
				?>
			</div>
		</div>
	</div>