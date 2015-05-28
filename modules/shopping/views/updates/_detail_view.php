<div class="panel panel-default mtl">
    
    <div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('id')); ?></div>
    <div class="panel-body">
        <p id="ShoppingUpdates_id_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('message')); ?></div>
    <div class="panel-body">
        <p id="ShoppingUpdates_message_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('orden_id')); ?></div>
    <div class="panel-body">
        <p id="ShoppingUpdates_orden_id_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('shopping_items_id')); ?></div>
    <div class="panel-body">
        <p id="ShoppingUpdates_shopping_items_id_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('created_at')); ?></div>
    <div class="panel-body">
        <p id="ShoppingUpdates_created_at_label"></p>
    </div>
	</div>


<div class="modal-footer">
    <div class="col-lg-12">
        <button type="button" class="btn btn-default" data-dismiss="modal">
        	<?php echo Yii::t('app','Close')?>        </button>
    </div>
</div>
