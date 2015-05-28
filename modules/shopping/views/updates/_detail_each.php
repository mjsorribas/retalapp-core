<?php
/* @var $this UpdatesController */
/* @var $data ShoppingUpdates */
?>
<li class="list-group-item cursor-move" id="<?php echo $index."-".$data->id?>">
	<div class="row">	
    
    <div class="col-lg-12">
    	<em><?=$data->created_at?></em> <br>
    	<?=$data->message?>
        <?php #echo CHtml::link('<i class="fa fa-pencil"></i>', array('updates/update', 'id'=>$data->id, 'shopping_items_id'=>$data->shopping_items_id),
                    #array('class'=>'btn btn-primary mls pull-right','data-action'=>'crud-updates','data-type'=>'update','data-name'=>$data->id)); ?>  
        <?php #echo CHtml::link('<i class="fa fa-eye"></i>', array('updates/view', 'id'=>$data->id, 'shopping_items_id'=>$data->shopping_items_id),
                    #array('class'=>'btn btn-default mls pull-right','data-action'=>'crud-updates','data-type'=>'view','data-name'=>$data->id)); ?>
        <?php #echo CHtml::link('<i class="fa fa-trash-o"></i>', array('updates/delete', 'id'=>$data->id),
            		#array('class'=>'btn btn-default pull-right','data-action'=>'crud-updates', 'data-type'=>'delete','data-name'=>$data->id)); ?>    </div>
    </div>

</li>