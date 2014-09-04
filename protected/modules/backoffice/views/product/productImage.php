<?php
//receive ProductModel;


$baseUrl = Yii::app()->baseUrl;

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery-1.7.2.min.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/fancyBox.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.js?v=2.0.6');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.js?v=1.0.2');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-media.js?v=1.0.0');
$cs->registerCssFile($baseUrl . '/js/fancyBox/fancyBox.css');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.css?v=2.0.6');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');
?>
<script>
	function changeImage(image)
	{
		var mainImage = document.getElementById("main-image");
		var mainLink = document.getElementById("main-link");
		mainImage.src = image.src;
		mainLink.href = image.src;
		//alert(image.src);
	}
</script>
<?php
$i = 1;
foreach($model->productImage as $proImage)
{
	if($i == 1)
	{
		//$imgClass = "fancyFrame img-polaroid";
		$imgClass = "img-polaroid";
		$imgStyle = "";
		$imgClick = "";
		$imgId = "main-image";
		$imgUrl = Yii::app()->request->baseUrl . $proImage->image;
		$imgLinkStart = "<a id='main-link' class='fancyFrame' Title=$imgId href=$imgUrl>";
		$imgLinkEnd = "</a>";
//            $imgLinkStart = "";
//            $imgLinkEnd = "";
	}
	else
	{
		$imgClass = "img-rounded span4";
		$imgStyle = "width:65px";
		$imgClick = "changeImage(this)";
		$imgId = "image" . $proImage->productImageId;
		$imgUrl = Yii::app()->request->baseUrl . $proImage->image;
		$imgLinkStart = "";
		$imgLinkEnd = "";
	}
	?>
	<?php echo $imgLinkStart; ?><img id="<?php echo $imgId; ?>" src="<?php echo Yii::app()->request->baseUrl . $proImage->image; ?>" <?php echo " " . !empty($imgClass) ? "class=" . $imgClass : ""; ?> style="<?php echo $imgStyle; ?>"  <?php echo " " . !empty($imgClick) ? "onclick='" . $imgClick . "'" : ""; ?> /></a><?php echo $imgLinkEnd; ?>
	<?php
	if($i == 1)
	{
		echo "<hr>";
		$imgClass = "img-rounded span4";
		$imgStyle = "width:65px";
		$imgClick = "changeImage(this)";
		$imgId = "image" . $proImage->productImageId;
		$imgUrl = Yii::app()->request->baseUrl . $proImage->image;
		$imgLinkStart = "";
		$imgLinkEnd = "";
		?>
		<?php echo $imgLinkStart; ?><img id="<?php echo $imgId; ?>" src="<?php echo Yii::app()->request->baseUrl . $proImage->image; ?>" <?php echo " " . !empty($imgClass) ? "class=" . $imgClass : ""; ?> style="<?php echo $imgStyle; ?>"  <?php echo " " . !empty($imgClick) ? "onclick='" . $imgClick . "'" : ""; ?> /></a><?php echo $imgLinkEnd; ?>
		<?php
	}
	$i++;
}
?>
<?php // $this->endWidget();?>
