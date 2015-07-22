<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
	$this->module->id,
);
?>
<?php $this->renderPartial("_navbar"); ?>
<div class="row">
	<div style="margin-top: 2%">
		<div class="tabs">
			<div class="tab-heading">
				<?php
				echo CHtml::link("Inbox" . ' ', '#' . 1, array(
					'class'=>'button big'));
				?>
				<?php
				echo CHtml::link("History" . ' ', '#' . 2, array(
					'class'=>'button big'));
				?>
			</div>
			<div class="page-content tab-content">
				<div id="1">
					<?php $i = 0; ?>
					<?php foreach($myfileArray as $myfile): ?>
						<div class='col-lg-3 col-md-3 col-sm-12'>
							<div class="blog-item">
								<a class="btn <?php echo ($myfile->status == 1) ? "btn-success" : "btn-primary" ?> col-md-12"  href="<?php echo Yii::app()->createUrl('/index.php/myfile/madrid/view/id/' . $myfile->orderId); ?>">
									<h3><?php echo $myfile->title; ?><?php if($myfile->status == 1): ?><i class="fa fa-comments pull-left"></i><?php endif; ?>
										<?php if(isset($myfile->userSpacialProject[0]) && $myfile->userSpacialProject[0]->status == 1): ?>
											<span class="label label-danger">R</span>
										<?php elseif(isset($myfile->userSpacialProject[0]) && $myfile->userSpacialProject[0]->status == 2): ?>
											<span class="label label-danger">S</span>
										<?php endif; ?>
									</h3>
									<p>วันที่สร้าง :<?php echo $this->dateThai($myfile->createDateTime, 3, TRUE); ?></p>
									<p>วันที่แก้ไข :<?php echo $this->dateThai($myfile->updateDateTime, 2, TRUE) ?></p>
									<p>จังหวัดที่ส่ง : <?php echo Province::model()->findByPk($myfile->provinceId)->provinceName; ?></p>
								</a>
							</div>
						</div>
						<?php $i++; ?>
					<?php endforeach; ?>
				</div>
				<div id="2">
					<?php $i = 0; ?>
					<?php foreach($myfileHistoryArray as $myfile): ?>
						<div class='col-lg-3 col-md-3 col-sm-12'>
							<div class="blog-item">
								<a class="btn <?php echo ($myfile->status == 1) ? "btn-success" : "btn-primary" ?> col-md-12"  href="<?php echo Yii::app()->createUrl('/index.php/myfile/madrid/view/id/' . $myfile->orderId); ?>">
									<h3><?php echo $myfile->title; ?><?php if($myfile->status == 1): ?><i class="fa fa-comments pull-left"></i><?php endif; ?></h3>
									<p>วันที่สร้าง :<?php echo $this->dateThai($myfile->createDateTime, 3, TRUE); ?></p>
									<p>วันที่แก้ไข :<?php echo $this->dateThai($myfile->updateDateTime, 2, TRUE) ?></p>
									<p>จังหวัดที่ส่ง : <?php echo Province::model()->findByPk($myfile->provinceId)->provinceName; ?></p>
								</a>
							</div>
						</div>
						<?php $i++; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>