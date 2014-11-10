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
$c = 0;
$sideBarContent = array();
$supplier = Supplier::model()->find("url='" . $this->module->id . "'");
$supContentGroup = SupplierContentGroup::model()->findAll("supplierId=" . $supplier->supplierId . " ORDER BY sortOrder ASC");
foreach($supContentGroup as $group):
//	$contents = $this->sideBarContents;
//	$sideBar[$i] = array(
//		'url'=>$this->createUrl('category/index?id=' . $catToSub->subCategoryId . "&category1Id=" . $catToSub->categoryId),
//		'link'=>strtoupper($catToSub->subCategory->title),
//	);
//	$this->sideBarCategories = array(
//		'title'=>'Atech Window',
//		'items'=>$sideBar);
	?>
	<div class="row sidebar-box <?php echo $this->navColor[$c % 4]; ?>">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="sidebar-box-heading">
				<i class="icons icon-folder-open-empty"></i>
				<h4><?php echo $group->title; ?></h4>
			</div>
			<div class="sidebar-box-content">
				<ul>
					<?php foreach($group->supplierContents as $item): ?>
						<li>
							<?php echo CHtml::link($item->title . '<i class="icons icon-right-dir"></i>', $this->createUrl('content/view?id=' . $item->supplierContentId)); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<?php
	$c++;
endforeach;
?>
<!-- /Categories -->