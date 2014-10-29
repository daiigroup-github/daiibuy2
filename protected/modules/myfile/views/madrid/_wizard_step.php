<div class="row form-group hidden">
	<div class="col-xs-12">
		<ul class="nav nav-pills nav-justified thumbnail setup-panel">
			<li class="<?php echo $this->action->id == 'create' ? 'active' : ''; ?>"><a href="#step-1">
					<h4 class="list-group-item-heading">Step 1</h4>
					<p class="list-group-item-text">First step description</p>
				</a></li>
			<li><a href="#step-2">
					<h4 class="list-group-item-heading">Step 2</h4>
					<p class="list-group-item-text">Second step description</p>
				</a></li>
			<li class="<?php echo ($this->action->id == 'view' && $model->status == 0) ? 'active' : ''; ?>"><a href="#step-2-1">
					<h4 class="list-group-item-heading">Step 2-1</h4>
					<p class="list-group-item-text">Third step description</p>
				</a></li>
			<li><a href="#step-2-2">
					<h4 class="list-group-item-heading">Step 2-2</h4>
					<p class="list-group-item-text">ใส่ปริมาณเอง</p>
				</a></li>
			<li class="<?php echo ($this->action->id == 'view' && $model->status == 1) ? 'active' : ''; ?>"><a href="#step-3">
					<h4 class="list-group-item-heading">Step _</h4>
					<p class="list-group-item-text">เปรียบเทียบประเมินราคา</p>
				</a></li>

			<li><a href="#step-4">
					<h4 class="list-group-item-heading">Step 4</h4>
					<p class="list-group-item-text">Third step description</p>
				</a></li>
			<li><a href="#step-5">
					<h4 class="list-group-item-heading">Step 5</h4>
					<p class="list-group-item-text">Third step description</p>
				</a></li>
		</ul>
	</div>
</div>