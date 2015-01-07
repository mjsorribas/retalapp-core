<?php
/* @var $this Codes_upload_modalController */
/* @var $model CartSecretCodes */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cart-secret-codes-form',
	'htmlOptions'=>array('class'=>'','role'=>'form'),
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnChange'=>false,
		'validateOnSubmit'=>true,		
		'beforeValidate'=>"js:function(form){
	    	var newSessing = form.data('settings');
            newSessing.validationUrl = $(form).attr('action');
            form.data('settings', newSessing);
            return true;
		}",
		'afterValidate'=>"js:function(form,data,hasError){ 
			if(!hasError) {
				form.each (function(){
				  this.reset();
				});
				$.fn.yiiListView.update('cart-secret-codes-list', {
					// data: { '".get_class($model)."':  }
					
				});
				$('#cart-secret-codes-modal').modal('hide');
				return false;
			}
			return false;
		}",
	),
)); ?>

<div class="row">
	<div class="pln col-lg-4">

<div class="form-group">
	<?php echo $form->labelEx($model,'secret_code',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'secret_code',
					'allowed' => 100,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
	<?php echo $form->error($model,'secret_code',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="pln prn col-lg-8">
<div class="form-group">
	<?php echo $form->labelEx($model,'state',array('class'=>'control-label')); ?>
	<?php echo $form->checkBox($model,'state'); ?>
	<?php echo $form->error($model,'state',array('class'=>'help-block')); ?>
</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" class="btn default" data-dismiss="modal"><?php echo Yii::t('app','Cancel')?></button>
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'cart-secret-codes-submit btn btn-primary btn-large')); ?>
</div>
<?php $this->endWidget(); ?>
