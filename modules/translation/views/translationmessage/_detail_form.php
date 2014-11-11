<?php
/* @var $this TranslationmessageController */
/* @var $model TranslationMessage */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'translation-message-form',
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
				$.fn.yiiListView.update('translation-message-list', {
					// data: { '".get_class($model)."':  }
					
				});
				$('#translation-message-modal').modal('hide');
				return false;
			}
			return false;
		}",
	),
)); ?>

<div class="row">
	<div class="pln prn col-lg-12">
		<div class="form-group">
		    <?php echo $form->labelEx($model,'language',array('class'=>'control-label')); ?>
		    <?php echo $form->dropDownList($model,'language',$this->module->languages,array('class'=>'form-control'))?>
		    <?php echo $form->error($model,'language',array('class'=>'help-block')); ?>
		</div>
		<div class="form-group">
			<?php echo $form->labelEx($model,'translation',array('class'=>'control-label')); ?>
			<?php echo $form->textArea($model,'translation',array('rows'=>5, 'cols'=>50,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'translation',array('class'=>'help-block')); ?>
		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" class="btn default" data-dismiss="modal"><?php echo Yii::t('app','Cancel')?></button>
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'translation-message-submit btn btn-primary btn-large')); ?>
</div>
<?php $this->endWidget(); ?>
