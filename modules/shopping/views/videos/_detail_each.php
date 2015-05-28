<?php
/* @var $this VideosController */
/* @var $data ShoppingVideos */
?>
<li class="list-group-item cursor-move" id="<?php echo $index."-".$data->id?>">
	<div class="row">	
    <div class="col-lg-7 pls">
<div class="col-lg-4 pln prn">
<?php if(!empty($data->link_vimeo)):?>
<?php #echo CHtml::encode($data->link_vimeo); ?>
<?php 
/*
$video=strtr($data->link_vimeo,array(
	'http://vimeo.com/'=>'',
	'https://vimeo.com/'=>'',
	'http://www.vimeo.com/'=>'',
	'https://www.vimeo.com/'=>'',
));
$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/{$video}.php")); ?>
<img src="<?=$hash[0]['thumbnail_small']?>">
<?php 
*/
?>
<div class="icon-link-admin">
	<i class="fa fa-video-camera"></i>
</div>
<?php elseif(!empty($data->link)):?>
	<div class="icon-link-admin">
		<i class="fa fa-download"></i>
	</div>
<?php /* */ ?>
<?php endif;?>
</div>
<div class="col-lg-8">
    
	<?php echo CHtml::encode($data->titulo); ?>
	<br />
	<?php /*

	<b><?php echo CHtml::encode($data->getAttributeLabel('shopping_items_id')); ?>:</b>
	<?php echo CHtml::encode($data->shopping_items_id); ?>
	<br />

	*/ ?>
</div>
    
    </div>
    <div class="col-lg-5">
        <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('videos/update', 'id'=>$data->id, 'shopping_items_id'=>$data->shopping_items_id),
                    array('class'=>'btn btn-primary mls pull-right','data-action'=>'crud-videos','data-type'=>'update','data-name'=>$data->id)); ?>  
        <?php #echo CHtml::link('<i class="fa fa-eye"></i>', array('videos/view', 'id'=>$data->id, 'shopping_items_id'=>$data->shopping_items_id),
                    #array('class'=>'btn btn-default mls pull-right','data-action'=>'crud-videos','data-type'=>'view','data-name'=>$data->id)); ?>
        <?php echo CHtml::link('<i class="fa fa-trash-o"></i>', array('videos/delete', 'id'=>$data->id),
            		array('class'=>'btn btn-default pull-right','data-action'=>'crud-videos', 'data-type'=>'delete','data-name'=>$data->id)); ?>    </div>
    </div>

</li>