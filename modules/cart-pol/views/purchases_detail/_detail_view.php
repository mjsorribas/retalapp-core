<div class="panel panel-default mtl">
    
    <div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('id')); ?></div>
    <div class="panel-body">
        <p id="CartShoppingDetail_id_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('cart_shoping_header_id')); ?></div>
    <div class="panel-body">
        <p id="CartShoppingDetail_cart_shoping_header_id_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('product_id')); ?></div>
    <div class="panel-body">
        <p id="CartShoppingDetail_product_id_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('table_related')); ?></div>
    <div class="panel-body">
        <p id="CartShoppingDetail_table_related_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('unit_value')); ?></div>
    <div class="panel-body">
        <p id="CartShoppingDetail_unit_value_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('currency')); ?></div>
    <div class="panel-body">
        <p id="CartShoppingDetail_currency_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('quantity')); ?></div>
    <div class="panel-body">
        <p id="CartShoppingDetail_quantity_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('tax_rate')); ?></div>
    <div class="panel-body">
        <p id="CartShoppingDetail_tax_rate_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('created_at')); ?></div>
    <div class="panel-body">
        <p id="CartShoppingDetail_created_at_label"></p>
    </div>
	</div>


<div class="modal-footer">
    <div class="col-lg-12">
        <button type="button" class="btn btn-default" data-dismiss="modal">
        	<?php echo Yii::t('app','Close')?>        </button>
    </div>
</div>
