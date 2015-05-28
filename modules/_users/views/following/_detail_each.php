<?php
/* @var $this FollowingController */
/* @var $data UsersFollowing */
?>
<li class="list-group-item" id="">
	<div class="row">
		<div class="col-lg-1">
			<img style="width:100%" src="<?=$data->user->imageUrl?>" alt="" class="img-thumbnail">
		</div>
		<div class="col-lg-10">
			<?=$data->user->name?>
		</div>
	</div>
    <?php #echo CHtml::link('<i class="fa fa-pencil"></i>', array('following/update', 'id'=>$data->id, 'users_users_id'=>$data->users_users_id),
                #array('class'=>'btn btn-primary mls pull-right','data-action'=>'crud-following','data-type'=>'update','data-name'=>$data->id)); ?>  
    <?php #echo CHtml::link('<i class="fa fa-eye"></i>', array('following/view', 'id'=>$data->id, 'users_users_id'=>$data->users_users_id),
                #array('class'=>'btn btn-default mls pull-right','data-action'=>'crud-following','data-type'=>'view','data-name'=>$data->id)); ?>
    <?php #echo CHtml::link('<i class="fa fa-trash-o"></i>', array('following/delete', 'id'=>$data->id),
        		#array('class'=>'btn btn-default pull-right','data-action'=>'crud-following', 'data-type'=>'delete','data-name'=>$data->id)); ?> 
</li>