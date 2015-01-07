<?php
/* @var $this Codes_upload_modalController */
/* @var $data CartSecretCodes */
?>
<li class="list-group-item" id="">
	<div class="row">	
    <div class="col-lg-7 pls">


    

	<b><?php echo CHtml::encode($data->getAttributeLabel('secret_code')); ?>:</b>
	<?php echo CHtml::encode($data->secret_code); ?>
	<br>

<?php if($data->state):?>
<?php echo '<span class="label label-success">'.Yii::t('app','Enabled').'</span>';?>
<?php else:?>
<?php echo '<span class="label label-danger">'.Yii::t('app','Disabled').'</span>';?>
<?php endif;?>

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cart_upload_id')); ?>:</b>
	<?php echo CHtml::encode($data->cart_upload_id); ?>
	<br />

	*/ ?>

    
    </div>
    <div class="col-lg-5">
        <?php #echo CHtml::link('<i class="fa fa-pencil"></i>', array('codes_upload_modal/update', 'id'=>$data->id, 'cart_upload_id'=>$data->cart_upload_id),
                    #array('class'=>'btn btn-primary mls pull-right','data-action'=>'crud-codes_upload_modal','data-type'=>'update','data-name'=>$data->id)); ?>  
        <?php #echo CHtml::link('<i class="fa fa-eye"></i>', array('codes_upload_modal/view', 'id'=>$data->id, 'cart_upload_id'=>$data->cart_upload_id),
                    #array('class'=>'btn btn-default mls pull-right','data-action'=>'crud-codes_upload_modal','data-type'=>'view','data-name'=>$data->id)); ?>
        <?php echo CHtml::link('<i class="fa fa-trash-o"></i>', array('codes_upload_modal/delete', 'id'=>$data->id),
            		array('class'=>'btn btn-default pull-right','data-action'=>'crud-codes_upload_modal', 'data-type'=>'delete','data-name'=>$data->id)); ?>    </div>
    </div>

</li>