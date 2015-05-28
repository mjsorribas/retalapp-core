<?php
/* @var $this DetailController */
/* @var $model ShoppingDetail */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shopping-detail-form',
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
				$.fn.yiiListView.update('shopping-detail-list', {
					// data: { '".get_class($model)."':  }
					
complete: function () {
$(\"#shopping-detail-list ul\").sortable({
	update: function() {
		var that = $(this);
		$(\".loading\").html('<i class=\"fa fa-refresh fa-spin\"></i>');
		setTimeout(function () {
        	var order = that.sortable(\"toArray\");
	        $.post('".$this->createUrl('detail/order')."', {order: order}, function(datos){
    			$('.loading').empty();
	        });
		},500);
    }
});
},

				});
				$('#shopping-detail-modal').modal('hide');
				return false;
			}
			return false;
		}",
	),
)); ?>

<div class="row">
	<div class="pln col-lg-8">

<div class="form-group">
	<?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'name',
					'allowed' => 60,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
	<?php echo $form->error($model,'name',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'description',array('class'=>'control-label')); ?>
	<?php echo $form->textArea($model,'description',array('rows'=>5, 'cols'=>50,'class'=>'form-control')); ?>
	<?php echo $form->error($model,'description',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'description_detail',array('class'=>'control-label')); ?>
	<?php echo $form->textArea($model,'description_detail',array('rows'=>5, 'cols'=>50,'class'=>'form-control')); ?>
	<?php echo $form->error($model,'description_detail',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'price',array('class'=>'control-label')); ?>
	<?php echo "";
			$model->price=Yii::app()->format->money($model->price);
			echo $this->widget('yiiwheels.widgets.maskmoney.WhMaskMoney', array(
            	'model'=>$model,
                'attribute'=>'price',
                'htmlOptions' => array(
                    'class' => 'form-control'
                )
			),true); ?>
	<?php echo $form->error($model,'price',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="pln prn col-lg-4">
<div class="form-group">
	<?php echo $form->labelEx($model,'amount',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'amount',
					'allowed' => 11,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
	<?php echo $form->error($model,'amount',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'state',array('class'=>'control-label')); ?>
	<?php echo $form->checkBox($model,'state'); ?>
	<?php echo $form->error($model,'state',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'shopping_categories_name',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'shopping_categories_name',
					'allowed' => 255,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
	<?php echo $form->error($model,'shopping_categories_name',array('class'=>'help-block')); ?>
</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" class="btn default" data-dismiss="modal"><?php echo Yii::t('app','Cancel')?></button>
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'shopping-detail-submit btn btn-primary btn-large')); ?>
</div>
<?php $this->endWidget(); ?>
