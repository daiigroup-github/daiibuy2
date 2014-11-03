<?php
/**
 * @nav
 */
if(isset($this->nav) && $this->nav !== []):
	?>
	<nav id="main-navigation" class="style2">
		<ul>
			<?php foreach($this->nav as $nav): ?>
				<li class="<?php echo isset($nav['color']) ? $nav['color'] : ''; ?> <?php echo isset($nav["class"]) ? $nav["class"] : " " ?>">
					<a href="<?php echo $nav['url']; ?>">
						<span class="nav-caption"><?php echo $nav['caption']; ?></span>
						<?php if(isset($nav['description']) && !empty($nav['description'])): ?>
							<span class="nav-description"><?php echo $nav['description']; ?></span>
						<?php endif; ?>
					</a>

					<?php if(isset($nav['dropdown']) && $nav['dropdown'] !== []): ?>
						<ul class="wide-dropdown normalAniamtion">
							<?php foreach($nav['dropdown'] as $dropdown): ?>
								<li>
									<ul>
										<?php if(isset($dropdown['url'])): ?>
											<li><span class="nav-caption"><a href="<?php echo $dropdown['url']; ?>"><?php echo $dropdown['caption']; ?></a></span></li>
										<?php else: ?>
											<li><span class="nav-caption"><?php echo $dropdown['caption']; ?></span></li>
										<?php endif; ?>

										<?php if(isset($dropdown['dropdown'])): ?>
											<?php foreach($dropdown['dropdown'] as $subDropdown): ?>
												<li><a href="<?php echo $subDropdown['url']; ?>"><i class="icons icon-right-dir"></i> <?php echo $subDropdown['caption']; ?></a></li>
											<?php endforeach; ?>
										<?php endif; ?>
									</ul>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>

			<li class="nav-search">
				<i class="icons icon-search-1"></i>
			</li>

		</ul>

		<?php $this->renderPartial('//layouts/_search_bar'); ?>

	</nav>
<?php endif; ?>