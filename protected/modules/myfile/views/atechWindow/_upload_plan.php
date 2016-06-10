
	<div class="row">
		<div class="col-sm-7">

			 <div class="form-group">
					รูปแปลน : <input name="OrderFile[0]" type="file" class="file" data-show-upload="false">
            </div>
			 <div class="form-group">
					รูปด้าน 1 : <input name="OrderFile[1]" type="file" class="file" data-show-upload="false">
            </div>
			 <div class="form-group">
					รูปด้าน 2 : <input name="OrderFile[2]" type="file" class="file" data-show-upload="false">
            </div>
			 <div class="form-group">
					รูปด้าน 3 : <input name="OrderFile[3]" type="file" class="file" data-show-upload="false">
            </div>
			 <div class="form-group">
					รูปด้าน 4 : <input name="OrderFile[4]" type="file" class="file" data-show-upload="false">
            </div>

			<?php

			?>
		</div>
		<div class="col-sm-5">
			<div class="panel panel-info">
				<div class="panel-heading text-left">
					<h4><b><i class="glyphicon glyphicon-exclamation-sign"></i> หมายเหตุ</b></h4>
				</div>
				<div class="panel-body">
					<small><b>1.หลังจากลูกค้าอัพโหลดแบบ รอ 3 วันทำการ เพื่อทำการประเมินราคา <br>
							2.ขนาดที่ลูกค้าได้รับจากการประเมินราคาใน www.daiibuy.com จะเป็นขนาดมาตรฐานจากโรงงานเท่านั้น โดยจะมีการปรับขนาดหน้าต่าง ให้ใกล้เคียงกับขนาดมารฐาน<br>
							3.หากลูกค้าต้องการสั่งซื้อขนาดอื่นๆ นอกเหนือจากขนาดมารฐาน<br>
						โปรดติดต่อบริษัท ไดอิ กรุ๊ป จำกัด มหาชน โทร. 02-9383464</b></small>
				</div>
			</div>
		</div>
	</div>
	<div class="row wizard-control">

		<?php
			echo CHtml::submitButton('Create', array(
				'class'=>'btn btn-primary'));
			?>
	</div>
