<div class="panel panel-default mtl">
    
    <div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('id')); ?></div>
    <div class="panel-body">
        <p id="CartSecretCodes_id_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('secret_code')); ?></div>
    <div class="panel-body">
        <p id="CartSecretCodes_secret_code_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('created_at')); ?></div>
    <div class="panel-body">
        <p id="CartSecretCodes_created_at_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('state')); ?></div>
    <div class="panel-body">
        <p id="CartSecretCodes_state_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('cart_upload_id')); ?></div>
    <div class="panel-body">
        <p id="CartSecretCodes_cart_upload_id_label"></p>
    </div>
	</div>


<div class="modal-footer">
    <div class="col-lg-12">
        <button type="button" class="btn btn-default" data-dismiss="modal">
        	<?php echo Yii::t('app','Close')?>        </button>
    </div>
</div>
