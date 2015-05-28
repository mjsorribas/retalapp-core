<?php
/* @var $this ImagesController */
/* @var $model ShoppingImages */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shopping-images-form',
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
				$.fn.yiiListView.update('shopping-images-list', {
					// data: { '".get_class($model)."':  }
					
complete: function () {
$(\"#shopping-images-list ul\").sortable({
	update: function() {
		var that = $(this);
		$(\".loading\").html('<i class=\"fa fa-refresh fa-spin\"></i>');
		setTimeout(function () {
        	var order = that.sortable(\"toArray\");
	        $.post('".$this->createUrl('images/order')."', {order: order}, function(datos){
    			$('.loading').empty();
	        });
		},500);
    }
});
},

				});
				$('#shopping-images-modal').modal('hide');
				return false;
			}
			return false;
		}",
	),
)); ?>

<div class="row">
	<div class="pln col-lg-6">

<div class="form-group">
	<?php echo $form->labelEx($model,'image',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.uploader.GUpload', array(
			    'model' => $model,
			    'attribute' => 'image',
			    // 'sizeValidate' => array('width'=>'500','height'=>'500'),
			    // 'allowedExtensions' => array('png','jpg','jpeg','pdf','zip'),
			    // 'iconButtom' => 'fa-cloud-upload',
			 	'actionUrl' => $this->createUrl('upload'),
			),true); ?>
	<?php echo $form->error($model,'image',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="pln prn col-lg-6">
	</div>
</div>

<div class="modal-footer">
	<button type="button" class="btn default" data-dismiss="modal"><?php echo Yii::t('app','Cancel')?></button>
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'shopping-images-submit btn btn-primary btn-large')); ?>
</div>
<?php $this->endWidget(); ?>
