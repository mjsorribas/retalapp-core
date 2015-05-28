<div class="panel panel-default mtl">
    
    <div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('id')); ?></div>
    <div class="panel-body">
        <p id="ShoppingVideos_id_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('link')); ?></div>
    <div class="panel-body">
        <p id="ShoppingVideos_link_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('link_vimeo')); ?></div>
    <div class="panel-body">
        <p id="ShoppingVideos_link_vimeo_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('titulo')); ?></div>
    <div class="panel-body">
        <p id="ShoppingVideos_titulo_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('descripcion')); ?></div>
    <div class="panel-body">
        <p id="ShoppingVideos_descripcion_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('orden_id')); ?></div>
    <div class="panel-body">
        <p id="ShoppingVideos_orden_id_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('shopping_items_id')); ?></div>
    <div class="panel-body">
        <p id="ShoppingVideos_shopping_items_id_label"></p>
    </div>
	</div>


<div class="modal-footer">
    <div class="col-lg-12">
        <button type="button" class="btn btn-default" data-dismiss="modal">
        	<?php echo Yii::t('app','Close')?>        </button>
    </div>
</div>
