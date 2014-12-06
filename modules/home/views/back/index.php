<?php
/* @var $this BackController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
	    <div class="table-inbox-wrap">
			<h4><?=$data?></h4>
			<h4>This is the CMS view <?php echo $this->uniqueId . '/' . $this->action->id; ?></h4>
			I am here <code><?=__FILE__?></code>
		</div>
    </div>
</section>
</div>