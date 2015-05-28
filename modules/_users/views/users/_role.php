<table class="table">
<?php foreach(Yii::app()->authManager->getAuthItems() as $data):?>
<?php if($data->name==="root") continue;;?>
<?php $enabled=Yii::app()->authManager->checkAccess($data->name,$model->id)?>
	<tr><td>
		<h4 style="margin: 0;"><?php echo $data->name?>
			<?php if(Yii::app()->user->checkAccess("admin") or Yii::app()->user->checkAccess("root")):?>
				<?php echo CHtml::link($enabled?"Quitar":"Asignar",array("users/assign","id"=>$model->id,"item"=>$data->name),
					array("class"=>$enabled?"assign btn default pull-right btn-primary":"assign btn btn-info pull-right"));?>
				<?php endif;?>
		</h4>
		<em style="font-size: 13px;line-height: 15px;"><?php echo $data->description?></em>
	</tr></td>
<?php endforeach;?>
</table>