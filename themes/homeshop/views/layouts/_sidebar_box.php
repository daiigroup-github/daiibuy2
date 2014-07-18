<?php if(isset($this->sideBarCategories) && $this->sideBarCategories !== []) $this->renderPartial('//layouts/_sidebar_box_category');?>
<?php if(isset($this->sideBarCompare) && $this->sideBarCompare !== []) $this->renderPartial('//layouts/_sidebar_box_compare');?>
<?php if(isset($this->sideBarCarousel) && $this->sideBarCarousel !== []) $this->renderPartial('//layouts/_sidebar_box_carousel');?>
<?php if(isset($this->sideBarBestSellers) && $this->sideBarBestSellers !== []) $this->renderPartial('//layouts/_sidebar_box_bestsellers');?>
<?php if(isset($this->sideBarTag) && $this->sideBarTag !== []) $this->renderPartial('//layouts/_sidebar_box_tag');?>
<?php if(isset($this->sideBarSpecials) && $this->sideBarSpecials !== []) $this->renderPartial('//layouts/_sidebar_box_specials');?>
