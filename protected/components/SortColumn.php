<?php
Yii::import('zii.widgets.grid.CGridColumn');

class SortColumn extends CGridColumn
{

	public $sortable = false;
	public $url;
	public $header = "Sort";

	public function init()
	{
		if(!isset($this->url))
		{
			$this->url = isset(Yii::app()->controller->module->id) ? Yii::app()->controller->module->id . "/" . Yii::app()->controller->id . "/sortItem" : Yii::app()->controller->id . "/sortItem";
		}
		parent::init();
	}

	protected function renderHeaderCellContent()
	{
		echo trim($this->header) !== '' ? $this->header : $this->grid->blankDisplay;
	}

	protected function renderDataCellContent($row, $data)
	{
//		$pagination = $this->grid->dataProvider->getPagination();
//		$index = $pagination->pageSize * $pagination->currentPage + $row + 1;
		$sortOrder = isset($data->sortOrder) ? $data->sortOrder : 0;
		$this->htmlOptions = array(
			'width'=>'17px',);
		$btn = "";
		$btn .= CHtml::ajaxLink("<i class='fa fa-caret-square-o-up text-success'></i>", Yii::app()->createUrl($this->url . "?id=" . $data->primaryKey . "&action=up"), array(
				'type'=>'get',
				'dataType'=>'JSON',
				'success'=>"function(data){
					if(data.status == true)
					{
						$.fn.yiiGridView.update('" . $this->grid->id . "');
					}
					else
					{
						alert(data.error);
					}
				} "
				), array(
				"id"=>"up" . $data->primaryKey,
//				'onclick'=>'return confirm("Do you want to change sortOrder this Item!!")'
		));
		$btn .=CHtml::textField("sortOrder", $sortOrder, array(
				'style'=>'width:20px',
				"onChange"=>"sortItem(this, '" . Yii::app()->createUrl($this->url . "?id=" . $data->primaryKey . "&action=custom") . "', '" . $this->grid->id . "')",
				"id"=>"txt" . $data->primaryKey));
		$btn .= CHtml::ajaxLink("<i class = 'fa fa-caret-square-o-down text-danger'></i>", Yii::app()->createUrl($this->url . "?id=" . $data->primaryKey . "&action=down"), array(
				'type'=>'get',
				'dataType'=>'JSON',
				'success'=>"function(
			data){
			if(
			data.status == true)
			{
			$.fn.yiiGridView.update(
			'" . $this->grid->id . "');
			}
			else
			{
			alert(
			data.error);
			}
			} "
				), array(
				"id"=>"down" . $data->primaryKey,
//				'onclick'=>'return confirm("Do you want to change sortOrder this Item!!")'
		));
		echo $btn;
	}

}
?>
<script>
	function sortItem(txt, url, grid)
	{
		if (confirm("Do you want to change sortOrder this Item!!"))
		{
			jQuery.ajax({
				type: "GET",
				datatype: "AJAX",
				url: url,
				data: 'orderIndex=' + txt.value,
				success: function (data) {
					$.fn.yiiGridView.update(grid);
				}
			});
		}
	}
</script>
