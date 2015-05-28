<?php
/* @var $this MaterialController */
/* @var $data ShoppingMaterial */
?>
<li class="list-group-item cursor-move" id="<?php echo $index."-".$data->id?>">
	<div class="row">	
    <div class="col-lg-7 pls">
		<?php echo CHtml::encode($data->nombre); ?>
	</div>
    <div class="col-lg-5">
        <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('material/update', 'id'=>$data->id, 'shopping_items_id'=>$data->shopping_items_id),
                    array('class'=>'btn btn-primary mls pull-right','data-action'=>'crud-material','data-type'=>'update','data-name'=>$data->id)); ?>  
        <?php #echo CHtml::link('<i class="fa fa-eye"></i>', array('material/view', 'id'=>$data->id, 'shopping_items_id'=>$data->shopping_items_id),
                    #array('class'=>'btn btn-default mls pull-right','data-action'=>'crud-material','data-type'=>'view','data-name'=>$data->id)); ?>
        <?php echo CHtml::link('<i class="fa fa-trash-o"></i>', array('material/delete', 'id'=>$data->id),
            		array('class'=>'btn btn-default pull-right','data-action'=>'crud-material', 'data-type'=>'delete','data-name'=>$data->id)); ?>    </div>
    </div>

</li>