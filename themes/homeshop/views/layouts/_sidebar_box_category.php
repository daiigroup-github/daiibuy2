<?php
/**
 * @params
 * $sideBarCategory = array(
 *  'title'=>string,
 *  'items'=>array(
		array(
 *          'url'=>string,
 *          'link'=>string,
 *          'items'=>array(
 *              array('url'=>string, 'link'=>string),
 *          )
 *      ),
 *  ),
 * )
 */
$categories = $this->sideBarCategories;
?>
<!-- Categories -->
<div class="row sidebar-box purple">

	<div class="col-lg-12 col-md-12 col-sm-12">

		<div class="sidebar-box-heading">
			<i class="icons icon-folder-open-empty"></i>
			<h4><?php echo $categories['title'];?></h4>
		</div>

		<div class="sidebar-box-content">
			<ul>
				<?php foreach($categories['items'] as $item):?>
				<li>
					<?php echo CHtml::link($item['link'].'<i class="icons icon-right-dir"></i>', $item['url']);?>

					<?php if(isset($item['items'])):?>
					<ul class="sidebar-dropdown">
						<li>
							<ul>
								<?php $i=0;$j=4;?>
								<?php foreach($item['items'] as $subItem):?>
								<li><?php echo CHtml::link($subItem['link'], $subItem['url']);?></li>

						<?php if($i==$j):?>
							<?php $j+=5;?>
							</ul>
						</li>
						<li>
							<ul>
						<?php endif;?>

								<?php $i++;?>
								<?php endforeach;?>
							</ul>
						</li>
					</ul>
					<?php endif;?>
				</li>
				<?php endforeach;?>

				<?php
				/*
				<li><a href="#">Cameras &amp; Photography <i class="icons icon-right-dir"></i></a></li>
				<li><a href="#">Computers &amp; Tablets <i class="icons icon-right-dir"></i></a></li>
				<li><a href="#">Cell Phones &amp; Accessories <i class="icons icon-right-dir"></i></a>
					<ul class="sidebar-dropdown">
						<li>
							<ul>
								<li><a href="#">Cell phones &amp; Smartphone</a></li>
								<li><a href="#">Cell Phone Accessories</a></li>
								<li><a href="#">Headsets</a></li>
								<li><a href="#">Cases, Covers & Skins</a></li>
								<li><a href="#">Screen Protectors</a></li>
							</ul>
						</li>
						<li>
							<ul>
								<li><a href="#">Chargers & Cradles</a></li>
								<li><a href="#">Batteries</a></li>
								<li><a href="#">Cables & Adapters</a></li>
								<li><a href="#">All About Smartphones</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li><a href="#">TV, Audio &amp; Surveillance <i class="icons icon-right-dir"></i></a></li>
				<li><a href="#">Video Games &amp; Consoles <i class="icons icon-right-dir"></i></a></li>
				<li><a href="#">Car Audio, Video &amp; GPS <i class="icons icon-right-dir"></i></a></li>
				<li><a href="#">Best Sellers <i class="icons icon-right-dir"></i></a></li>
				<li><a href="#">Shop by Brands <i class="icons icon-right-dir"></i></a></li>
				<li><a class="purple" href="#">All Categories</a></li>
				*/
				?>
			</ul>
		</div>

	</div>

</div>
<!-- /Categories -->