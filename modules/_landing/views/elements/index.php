<?php
/* @var $this ElementsController */
/* @var $model LandingElements */

$this->breadcrumbs=array(
	'Landing Elements'=>array('admin'),
	'Lista de Landing Elements',
);
 ?><div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">

<div class="col-lg-4">

<div class="panel-group" id="accordion-assign1" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <?php foreach($this->module->getModulesList() as $i => $module):?>
    <?php $types=$this->module->getTypesList($module);?>
    <?php if($types===array()) continue;?>

<div class="panel-heading" role="tab" id="heading<?=$module?>">
	<h4 class="panel-title">
		<a data-toggle="collapse" data-parent="#accordion" href="#<?=$module?>" aria-expanded="true" aria-controls="<?=$module?>">
			<?=$module?>
		</a>
	</h4>
</div>
<div id="<?=$module?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$module?>">
	<div class="panel-body">
		<ul class="list-group sortable-container connectedSortable">
			<?php foreach($types as $type):?>
				<li class="list-group-item" id="<?=$module." ".$type?>" style="cursor:move"><?=CHtml::image($this->module->getImgBlock($module,$type),'',array('class'=>'img-responsive','title'=>$type))?></li>
			<?php endforeach;?>
		</ul>
	</div>
</div>

	<?php endforeach;?>
  </div>
</div>


</div>

<div class="col-lg-8">
	<div class="panel panel-default" id="accordion-assign2">
		<?php foreach(LandingElementsPositions::model()->findAll() as $position):?>
		<div class="panel-heading"><?=$position->name?></div>
		<ul id="position-<?=$position->id?>" class="list-group sortable-container connectedSortable">

			<?php foreach($position->elements as $elemen):?>
			<li class="list-group-item" id="<?=$elemen->module." ".$elemen->type?>" style="cursor:move"><?=CHtml::image($this->module->getImgBlock($elemen->module,$elemen->type),'',array('class'=>'img-responsive','title'=>$elemen->type))?><a data-action="delete" href="<?=$this->createUrl("delete",array("id"=>$elemen->id))?>" class="pull-right"><i class="fa fa-trash"></i> Remove</a></li>
			<?php endforeach;?>
		</ul>
		<?php endforeach;?>
	</div>
</div>



		</div>
    </div>
</section>
</div>
<script>
$(function() {
	/**
	 * This event delete or publish an Item
	 * according to selected Item
	*/
	$(document).on('click','[data-action=delete]',function(e){
	    e.preventDefault();
	    var that = $(this);
	    var href = $(this).attr('href');
	    bootbox.confirm("¿Está seguro que desea <strong>Quitar</strong> el bloque seleccionado?", function(result) {
	        if(result) {
	            $.ajax({
	                url: href,
	                success:function (data) {
	    							that.parent().empty();
	                }
	            });
	        }
	    });
	});

	 	$( "#accordion-assign1 .sortable-container, #accordion-assign2 .sortable-container" ).sortable({
      connectWith: ".connectedSortable",
			update: function() {
				var that = $(this);

				if(that.parent().attr('id')=='accordion-assign2') {
					$('.loading').html('<i class="fa fa-refresh fa-spin"></i>');
					var position = that.attr('id').replace('position-','');

					setTimeout(function () {
							var order = that.sortable("toArray");
							$.post('<?php echo $this->createUrl("assignBlock") ?>', {
								position: position,
								blocks: that.sortable("toArray"),
							}, function(datos){
								$('.loading').empty();
							});
					},500);
				}
			}
    }).disableSelection();


});
</script>
