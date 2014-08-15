<!-- Product Tabs -->
<?php
//Prepare Tab
$i = 1;
$tabHeading = '';
$tabContent = '';
foreach ($tabs as $tab) {
    $title = $tab['title'];
    //$tabHeading .= "<a href=\"#tab$i\" class=\"button big\">$title</a> ";
    $tabId = isset($tab['id']) ? $tab['id'] : 'tab'.$i;

    $tabHeading .= CHtml::link($tab['title'] . ' ', '#' . $tabId, array('class' => 'button big')) . ' ';
    $tabContent .= '<div id="' . $tabId . '">' . $tab['detail'] . '</div>';
    $i++;
}
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="tabs">
            <div class="tab-heading">
                <?php /*
					<a href="#tab1" class="button big">Description</a>
					<a href="#tab2" class="button big">Reviews</a>
					<a href="#tab3" class="button big">Comments</a>
                    */
                ?>
                <?php echo $tabHeading; ?>
            </div>

            <div class="page-content tab-content">
                <?php /*
					<div id="tab1">
						Tab1
					</div>
					<div id="tab2">
						Tab2
					</div>
					<div id="tab3">
						Tab3
					</div>
                    */
                ?>
                <?php echo $tabContent; ?>
            </div>
        </div>
    </div>
</div>