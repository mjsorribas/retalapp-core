<?php
/* @var $this Purchases_detailController */
/* @var $model CartShoppingDetail */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cart-shopping-detail-form',
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
				$.fn.yiiListView.update('cart-shopping-detail-list', {
					// data: { '".get_class($model)."':  }
					
				});
				$('#cart-shopping-detail-modal').modal('hide');
				return false;
			}
			return false;
		}",
	),
)); ?>

<div class="row">
	<div class="pln col-lg-7">

<div class="form-group">
	<?php echo $form->labelEx($model,'cart_shoping_header_id',array('class'=>'control-label')); ?>
	<?php echo $form->dropDownList($model,'cart_shoping_header_id',array('1'=>'Value 1','2'=>'Value 2','3'=>'Value 3')/* CHtml::listData(NameModelRelated::model()->findAll(array('condition'=>'1=1')),'id','nameValueToShow')*/,array('empty'=>'Select a...','class'=>'form-control')); ?>
	<?php echo $form->error($model,'cart_shoping_header_id',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'product_id',array('class'=>'control-label')); ?>
	<?php echo $form->dropDownList($model,'product_id',array('1'=>'Value 1','2'=>'Value 2','3'=>'Value 3')/* CHtml::listData(NameModelRelated::model()->findAll(array('condition'=>'1=1')),'id','nameValueToShow')*/,array('empty'=>'Select a...','class'=>'form-control')); ?>
	<?php echo $form->error($model,'product_id',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'table_related',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
				'model'=>$model,
				'attribute'=>'table_related',
				'allowed' => 255,
				'htmlOptions' => array('class'=>'form-control'),
			),true); ?>
	<?php echo $form->error($model,'table_related',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'unit_value',array('class'=>'control-label')); ?>
	<?php echo $form->textField($model,'unit_value',array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'unit_value',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="pln prn col-lg-5">
<div class="form-group">
	<?php echo $form->labelEx($model,'currency',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
				'model'=>$model,
				'attribute'=>'currency',
				'allowed' => 3,
				'htmlOptions' => array('class'=>'form-control'),
			),true); ?>
	<?php echo $form->error($model,'currency',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'quantity',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
				'model'=>$model,
				'attribute'=>'quantity',
				'allowed' => 11,
				'htmlOptions' => array('class'=>'form-control'),
			),true); ?>
	<?php echo $form->error($model,'quantity',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'tax_rate',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
				'model'=>$model,
				'attribute'=>'tax_rate',
				'allowed' => 11,
				'htmlOptions' => array('class'=>'form-control'),
			),true); ?>
	<?php echo $form->error($model,'tax_rate',array('class'=>'help-block')); ?>
</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" class="btn default" data-dismiss="modal"><?php echo Yii::t('app','Cancel')?></button>
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'cart-shopping-detail-submit btn btn-primary btn-large')); ?>
</div>
<?php $this->endWidget(); ?>
