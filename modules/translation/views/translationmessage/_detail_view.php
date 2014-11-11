<div class="panel panel-default mtl">
    
    <div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('id')); ?></div>
    <div class="panel-body">
        <p id="TranslationMessage_id_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('language')); ?></div>
    <div class="panel-body">
        <p id="TranslationMessage_language_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('translation')); ?></div>
    <div class="panel-body">
        <p id="TranslationMessage_translation_label"></p>
    </div>
	<div class="panel-heading"><?php echo CHtml::encode($model->getAttributeLabel('id_key')); ?></div>
    <div class="panel-body">
        <p id="TranslationMessage_id_key_label"></p>
    </div>
	</div>


<div class="modal-footer">
    <div class="col-lg-12">
        <button type="button" class="btn btn-default" data-dismiss="modal">
        	<?php echo Yii::t('app','Close')?>        </button>
    </div>
</div>
