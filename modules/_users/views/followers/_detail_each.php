<?php
/* @var $this FollowersController */
/* @var $data UsersFollowers */
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
	<?php #echo CHtml::link('<i class="fa fa-pencil"></i>', array('followers/update', 'id'=>$data->id, 'users_users_id'=>$data->users_users_id),
                #array('class'=>'btn btn-primary mls pull-right','data-action'=>'crud-followers','data-type'=>'update','data-name'=>$data->id)); ?>  
    <?php #echo CHtml::link('<i class="fa fa-eye"></i>', array('followers/view', 'id'=>$data->id, 'users_users_id'=>$data->users_users_id),
                #array('class'=>'btn btn-default mls pull-right','data-action'=>'crud-followers','data-type'=>'view','data-name'=>$data->id)); ?>
    <?php #echo CHtml::link('<i class="fa fa-trash-o"></i>', array('followers/delete', 'id'=>$data->id),
        		#array('class'=>'btn btn-default pull-right','data-action'=>'crud-followers', 'data-type'=>'delete','data-name'=>$data->id)); ?>
</li>