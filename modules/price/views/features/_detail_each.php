<?php
/* @var $this FeaturesController */
/* @var $data PriceFeatures */
?>
<li class="list-group-item cursor-move" id="<?php echo $index."-".$data->id?>">
	<div class="row">	
    <div class="col-lg-7 pls">

<div class="col-lg-12">
	<i style="font-size:25px" class="fa <?=$data->icon?>"></i>
    
	<?php echo CHtml::encode($data->name); ?>


	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_items_id')); ?>:</b>
	<?php echo CHtml::encode($data->price_items_id); ?>
	<br />

	*/ ?>
</div>
    
    </div>
    <div class="col-lg-5">
        <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('features/update', 'id'=>$data->id, 'price_items_id'=>$data->price_items_id),
                    array('class'=>'btn btn-primary mls pull-right','data-action'=>'crud-features','data-type'=>'update','data-name'=>$data->id)); ?>  
        <?php echo CHtml::link('<i class="fa fa-trash-o"></i>', array('features/delete', 'id'=>$data->id),
            		array('class'=>'btn btn-default pull-right','data-action'=>'crud-features', 'data-type'=>'delete','data-name'=>$data->id)); ?>    </div>
    </div>

</li>