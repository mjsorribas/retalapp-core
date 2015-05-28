<?php
/* @var $this VideosController */
/* @var $model ShoppingVideos */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shopping-videos-form',
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
				$.fn.yiiListView.update('shopping-videos-list', {
					// data: { '".get_class($model)."':  }
					
complete: function () {
$(\"#shopping-videos-list ul\").sortable({
	update: function() {
		var that = $(this);
		$(\".loading\").html('<i class=\"fa fa-refresh fa-spin\"></i>');
		setTimeout(function () {
        	var order = that.sortable(\"toArray\");
	        $.post('".$this->createUrl('videos/order')."', {order: order}, function(datos){
    			$('.loading').empty();
	        });
		},500);
    }
});
},

				});
				$('#shopping-videos-modal').modal('hide');
				return false;
			}
			return false;
		}",
	),
)); ?>

<div class="row">
	<div class="pln col-lg-4">

<div class="form-group">
	<?php echo $form->labelEx($model,'link',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'link',
					'allowed' => 100,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
	<?php echo $form->error($model,'link',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'link_vimeo',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'link_vimeo',
					'allowed' => 100,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
	<?php echo $form->error($model,'link_vimeo',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="pln prn col-lg-8">
<div class="form-group">
	<?php echo $form->labelEx($model,'titulo',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'titulo',
					'allowed' => 100,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
	<?php echo $form->error($model,'titulo',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'descripcion',array('class'=>'control-label')); ?>
	<?php echo $form->textArea($model,'descripcion',array('rows'=>5, 'cols'=>50,'class'=>'form-control')); ?>
	<?php echo $form->error($model,'descripcion',array('class'=>'help-block')); ?>
</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" class="btn default" data-dismiss="modal"><?php echo Yii::t('app','Cancel')?></button>
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'shopping-videos-submit btn btn-primary btn-large')); ?>
</div>
<?php $this->endWidget(); ?>
