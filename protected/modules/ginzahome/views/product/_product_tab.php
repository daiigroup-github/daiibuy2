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
                foreach ($tabs as $tab) {
                    $title = $tab['title'];
                    $tabId = isset($tab['id']) ? $tab['id'] : 'tab' . $i;

                    echo CHtml::link($tab['title'], '#' . $tabId, array(
                        'class' => 'button big'));
                    $i++;
                }
                ?>
            </div>

            <div class="page-content tab-content">
                <?php
                $i = 1;
                foreach ($tabs as $tab) {
                    $title = $tab['title'] . $tab['sort'];
                    //$tabHeading .= "<a href=\"#tab$i\" class=\"button big\">$title</a> ";
                    $tabId = isset($tab['id']) ? $tab['id'] : 'tab' . $i;
                    ?>
                    <div id="<?php echo $tabId ?>">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <?php
                                if (strpos($tab['detail'], '{{pay1}}') !== false) {
                                    for ($i = 0; $i < 4; $i++) {
                                        $j = $i + 1;
                                        $tab['detail'] = str_replace("{{pay$j}}", number_format($allPrice[$i], 2), $tab['detail']);
                                    }
                                }
                                if (isset($tab['detail'])) {
                                    echo $tab['detail'];
                                }

                                $detailChilds = ProductSpecGroup::model()->findAll("parentId = " . $tab["id"] . " order by sortOrder");
                                foreach ($detailChilds as $child):
                                    ?>
                                    <div class="row">
                                        <div class="carousel-heading no-margin">
                                            <h4><?php echo $child->title; ?></h4>
                                        </div>
                                    </div>
                                    <?php
                                    $x = 0;
                                    foreach ($child->productSpecs as $item):

                                        if ($x == 0) {
                                            ?>
                                            <div class="row">
                                            <?php } ?>
                                            <div class="col-lg-<?php echo (isset($item->spanWidth) && $item->spanWidth > 0) ? " col-md-" . $item->spanWidth : "4"; ?> col-md-<?php echo (isset($item->spanWidth) && $item->spanWidth > 0) ? " col-md-" . $item->spanWidth : "4"; ?> col-sm-<?php echo (isset($item->spanWidth) && $item->spanWidth > 0) ? " col-md-" . $item->spanWidth : "4"; ?>">
                                                <h3><?php echo $item->title; ?></h3>
                                                <?php if (isset($item->image)): ?>
                                                    <p><?php
                                                        echo CHtml::image(Yii::app()->baseUrl . $item->image, $item->title, array(
                                                            'class' => "cloud-zoom"));
                                                        ?></p>
                                                <?php endif; ?>
                                                <?php if (isset($item->videoEmbeded)): ?>
                                                    <p><?php
                                                        echo $item->videoEmbeded;
                                                        ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <?php if (isset($item->description)): ?>
                                                <div class="col-lg-<?php echo (isset($item->spanWidth) && $item->spanWidth > 0) ? " col-md-" . $item->spanWidth : "4"; ?> col-md-<?php echo (isset($item->spanWidth) && $item->spanWidth > 0) ? " col-md-" . $item->spanWidth : "4"; ?> col-sm-<?php echo (isset($item->spanWidth) && $item->spanWidth > 0) ? " col-md-" . $item->spanWidth : "4"; ?>">
                                                    <?php echo $item->description; ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php
                                            $x++;
//											throw new Exception(print_r($x, true));
                                            if ($x == 2) {
                                                ?>
                                            </div>
                                            <?php
                                            $x = 0;
                                        }


                                    endforeach;
                                    if ($x == 1) {
                                        ?>
                                    </div>
                                    <?php
                                }


                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>