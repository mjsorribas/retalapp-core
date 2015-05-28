<div class="panel panel-default mtl">
    
    <div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('id')); ?></div>
    <div class="panel-body">
        <p id="ShoppingDetail_id_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('name')); ?></div>
    <div class="panel-body">
        <p id="ShoppingDetail_name_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('description')); ?></div>
    <div class="panel-body">
        <p id="ShoppingDetail_description_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('description_detail')); ?></div>
    <div class="panel-body">
        <p id="ShoppingDetail_description_detail_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('price')); ?></div>
    <div class="panel-body">
        <p id="ShoppingDetail_price_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('amount')); ?></div>
    <div class="panel-body">
        <p id="ShoppingDetail_amount_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('state')); ?></div>
    <div class="panel-body">
        <p id="ShoppingDetail_state_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('shopping_header_id')); ?></div>
    <div class="panel-body">
        <p id="ShoppingDetail_shopping_header_id_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('shopping_categories_name')); ?></div>
    <div class="panel-body">
        <p id="ShoppingDetail_shopping_categories_name_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('orden_id')); ?></div>
    <div class="panel-body">
        <p id="ShoppingDetail_orden_id_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('created_at')); ?></div>
    <div class="panel-body">
        <p id="ShoppingDetail_created_at_label"></p>
    </div>
	</div>


<div class="modal-footer">
    <div class="col-lg-12">
        <button type="button" class="btn btn-default" data-dismiss="modal">
        	<?php echo Yii::t('app','Close')?>        </button>
    </div>
</div>
