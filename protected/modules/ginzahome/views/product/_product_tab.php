<!-- Product Tabs -->
<?php
//Prepare Tab

$tabHeading = '';
$tabContent = '';
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="tabs">
			<div class="tab-heading">
				<?php
				$i = 1;
				foreach($tabs as $tab)
				{
					$title = $tab['title'];
					$tabId = isset($tab['id']) ? $tab['id'] : 'tab' . $i;

					echo CHtml::link($tab['title'] . ' ', '#' . $tabId, array(
						'class'=>'button big'));
					$i++;
				}
				?>
			</div>

            <div class="page-content tab-content">
				<?php
				$i = 1;
				foreach($tabs as $tab)
				{
					$title = $tab['title'];
					//$tabHeading .= "<a href=\"#tab$i\" class=\"button big\">$title</a> ";
					$tabId = isset($tab['id']) ? $tab['id'] : 'tab' . $i;
					?>
					<div id="<?php echo $tabId ?>">
						<?php echo $tab['detail']; ?>

						<?php
						$detailChilds = ProductSpecGroup::model()->findAll("parentId = " . $tab["id"]);
						foreach($detailChilds as $child):
							?>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">

									<div class="carousel-heading no-margin">
										<h4><?php echo $child->title; ?></h4>
									</div>

									<div class="page-content">
										<?php foreach($child->productSpecs as $item): ?>
											<?php if(isset($item->image)): ?>
												<p><?php
													echo CHtml::image(Yii::app()->baseUrl . $item->image, $item->title, array(
														'class'=>isset($item->spanWidth) ? "col-md=" . $item->spanWidth : ""));
													?></p>
											<?php endif; ?>
											<?php echo $item->description . "<br>"; ?>
										<?php endforeach; ?>
									</div>

								</div>

							</div>
							<?php
						endforeach;
						$i++;
						?>
					</div>
					<?php
				}
				?>
            </div>
        </div>
    </div>
</div>