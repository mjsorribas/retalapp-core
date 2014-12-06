<div class="panel panel-default mtl">
    
    <div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('id')); ?></div>
    <div class="panel-body">
        <p id="PriceFeatures_id_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('icon')); ?></div>
    <div class="panel-body">
        <p id="PriceFeatures_icon_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('name')); ?></div>
    <div class="panel-body">
        <p id="PriceFeatures_name_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('price_items_id')); ?></div>
    <div class="panel-body">
        <p id="PriceFeatures_price_items_id_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('orden_id')); ?></div>
    <div class="panel-body">
        <p id="PriceFeatures_orden_id_label"></p>
    </div>
	</div>


<div class="modal-footer">
    <div class="col-lg-12">
        <button type="button" class="btn btn-default" data-dismiss="modal">
        	<?php echo Yii::t('app','Close')?>        </button>
    </div>
</div>
