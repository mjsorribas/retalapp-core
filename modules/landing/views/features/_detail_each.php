<?php
/* @var $this FeaturesController */
/* @var $data LandingFeatures */
?>
<li class="list-group-item cursor-move" id="<?php echo $index."-".$data->id?>">
	<div class="row">	
    <div class="col-lg-7 pls">
<div class="col-lg-4 pln prn">
<i class="fa <?=$data->icon?>"></i> 
</div>
<div class="col-lg-8">
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), '#'); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('icon')); ?>:</b>
	<?php echo CHtml::encode($data->icon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('landing_pages_id')); ?>:</b>
	<?php echo CHtml::encode($data->landing_pages_id); ?>
	<br />

	*/ ?>
</div>
    
    </div>
    <div class="col-lg-5">
        <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('features/update', 'id'=>$data->id, 'landing_pages_id'=>$data->landing_pages_id),
                    array('class'=>'btn btn-primary mls pull-right','data-action'=>'crud-features','data-type'=>'update','data-name'=>$data->id)); ?>  
        <?php #echo CHtml::link('<i class="fa fa-eye"></i>', array('features/view', 'id'=>$data->id, 'landing_pages_id'=>$data->landing_pages_id),
                    #array('class'=>'btn btn-default mls pull-right','data-action'=>'crud-features','data-type'=>'view','data-name'=>$data->id)); ?>
        <?php echo CHtml::link('<i class="fa fa-trash-o"></i>', array('features/delete', 'id'=>$data->id),
            		array('class'=>'btn btn-default pull-right','data-action'=>'crud-features', 'data-type'=>'delete','data-name'=>$data->id)); ?>    </div>
    </div>

</li>