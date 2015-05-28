<?php
/* @var $this UpdatesController */
/* @var $model ShoppingUpdates */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shopping-updates-form',
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
				$.fn.yiiListView.update('shopping-updates-list', {
					// data: { '".get_class($model)."':  }
					
complete: function () {
$(\"#shopping-updates-list ul\").sortable({
	update: function() {
		var that = $(this);
		$(\".loading\").html('<i class=\"fa fa-refresh fa-spin\"></i>');
		setTimeout(function () {
        	var order = that.sortable(\"toArray\");
	        $.post('".$this->createUrl('updates/order')."', {order: order}, function(datos){
    			$('.loading').empty();
	        });
		},500);
    }
});
},

				});
				$('#shopping-updates-modal').modal('hide');
				return false;
			}
			return false;
		}",
	),
)); ?>

<div class="row">
	<div class="col-lg-12">

<div class="form-group">
	<?php echo $form->labelEx($model,'message',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.wisi.GSummerNote', array(
            	'model'=>$model,
                'attribute'=>'message',
            	'height'=>'250px',
                'htmlOptions' => array(
                    'class' => 'form-control',
                )
			),true); ?>
	<?php echo $form->error($model,'message',array('class'=>'help-block')); ?>
</div>
	</div>
	
</div>

<div class="modal-footer">
	<button type="button" class="btn default" data-dismiss="modal"><?php echo Yii::t('app','Cancel')?></button>
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'shopping-updates-submit btn btn-primary btn-large')); ?>
</div>
<?php $this->endWidget(); ?>
