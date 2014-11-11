<?php
/* @var $this TranslationmessageController */
/* @var $data TranslationMessage */
?>
<li class="list-group-item" id="">
	<div class="row">	
    <div class="col-lg-7 pls">

<div class="col-lg-12">
    
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('translation')); ?>:</b>
	<?php echo CHtml::encode($data->translation); ?>
	<br />

</div>
    
    </div>
    <div class="col-lg-5">
        <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('translationmessage/update', 'id'=>$data->id_key, 'id_id'=>$data->id),
                    array('class'=>'btn btn-primary mls pull-right','data-action'=>'crud-translationmessage','data-type'=>'update','data-name'=>$data->id_key)); ?>  
        <?php echo CHtml::link('<i class="fa fa-trash-o"></i>', array('translationmessage/delete', 'id'=>$data->id_key),
            		array('class'=>'btn btn-default pull-right','data-action'=>'crud-translationmessage', 'data-type'=>'delete','data-name'=>$data->id_key)); ?>    </div>
    </div>

</li>