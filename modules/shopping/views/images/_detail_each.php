<?php
/* @var $this ImagesController */
/* @var $data ShoppingImages */
?>
<li class="list-group-item cursor-move" id="<?php echo $index."-".$data->id?>">
	<div class="row">	
    <div class="col-lg-7 pls">
<div class="col-lg-4 pln prn">
      <?php echo CHtml::image($data->image_path,'',array('class'=>'img-responsive img-thumbnail','style'=>'width:100%'));?></div>
<div class="col-lg-8">
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), '#'); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('shopping_items_id')); ?>:</b>
	<?php echo CHtml::encode($data->shopping_items_id); ?>
	<br />

	*/ ?>
</div>
    
    </div>
    <div class="col-lg-5">
        <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('images/update', 'id'=>$data->id, 'shopping_items_id'=>$data->shopping_items_id),
                    array('class'=>'btn btn-primary mls pull-right','data-action'=>'crud-images','data-type'=>'update','data-name'=>$data->id)); ?>  
        <?php #echo CHtml::link('<i class="fa fa-eye"></i>', array('images/view', 'id'=>$data->id, 'shopping_items_id'=>$data->shopping_items_id),
                    #array('class'=>'btn btn-default mls pull-right','data-action'=>'crud-images','data-type'=>'view','data-name'=>$data->id)); ?>
        <?php echo CHtml::link('<i class="fa fa-trash-o"></i>', array('images/delete', 'id'=>$data->id),
            		array('class'=>'btn btn-default pull-right','data-action'=>'crud-images', 'data-type'=>'delete','data-name'=>$data->id)); ?>    </div>
    </div>

</li>