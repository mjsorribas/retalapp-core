<?php
/* @var $this FeaturesController */
/* @var $model PriceFeatures */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'price-features-form',
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
				$.fn.yiiListView.update('price-features-list', {
					// data: { '".get_class($model)."':  }
					
complete: function () {
$(\"#price-features-list ul\").sortable({
	update: function() {
		var that = $(this);
		$(\".loading\").html('<i class=\"fa fa-refresh fa-spin\"></i>');
		setTimeout(function () {
        	var order = that.sortable(\"toArray\");
	        $.post('".$this->createUrl('features/order')."', {order: order}, function(datos){
    			$('.loading').empty();
	        });
		},500);
    }
});
},

				});
				$('#price-features-modal').modal('hide');
				return false;
			}
			return false;
		}",
	),
)); ?>

<div class="row">
	<div class="pln col-lg-8">

<div class="form-group">
	<?php echo $form->labelEx($model,'icon',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.radio.GFontAwesome',array(
				'model'=>$model,
				'attribute'=>'icon',
			),true); ?>
	<?php echo $form->error($model,'icon',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="pln prn col-lg-4">
<div class="form-group">
	<?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'name',
					'allowed' => 100,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
	<?php echo $form->error($model,'name',array('class'=>'help-block')); ?>
</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" class="btn default" data-dismiss="modal"><?php echo Yii::t('app','Cancel')?></button>
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'price-features-submit btn btn-primary btn-large')); ?>
</div>
<?php $this->endWidget(); ?>
