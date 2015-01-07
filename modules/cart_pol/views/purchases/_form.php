<?php
/* @var $this PurchasesController */
/* @var $model CartShoppingHeader */
/* @var $form CActiveForm */
?>
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cart-shopping-header-form',
	'htmlOptions'=>array("class"=>"","role"=>"form"),
	'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true),
)); ?>
	<?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-danger')); ?>
	<div class="col-lg-12">
    <div class="form-group">
        <div class="text-right">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'btn btn-primary btn-large')); ?>
		<?php echo CHtml::link(Yii::t('app','Back'),array('admin'),array('class'=>'btn btn-large btn-default'))?>        </div>
    </div>
<div class="row">
	<div class="col-lg-9">

<div class="form-group">
	<?php echo $form->labelEx($model,'ref_venta',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
				'model'=>$model,
				'attribute'=>'ref_venta',
				'allowed' => 50,
				'htmlOptions' => array('class'=>'form-control'),
			),true); ?>
	<?php echo $form->error($model,'ref_venta',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'users_id',array('class'=>'control-label')); ?>
	<?php echo $form->dropDownList($model,'users_id',array('1'=>'Value 1','2'=>'Value 2','3'=>'Value 3')/* CHtml::listData(NameModelRelated::model()->findAll(array('condition'=>'1=1')),'id','nameValueToShow')*/,array('empty'=>'Select a...','class'=>'form-control')); ?>
	<?php echo $form->error($model,'users_id',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'total',array('class'=>'control-label')); ?>
	<?php echo $form->textField($model,'total',array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'total',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="col-lg-3">
<div class="form-group">
	<?php echo $form->labelEx($model,'shipping_cost',array('class'=>'control-label')); ?>
	<?php echo $form->textField($model,'shipping_cost',array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'shipping_cost',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'cart_states_id',array('class'=>'control-label')); ?>
	<?php echo $form->dropDownList($model,'cart_states_id',array('1'=>'Value 1','2'=>'Value 2','3'=>'Value 3')/* CHtml::listData(NameModelRelated::model()->findAll(array('condition'=>'1=1')),'id','nameValueToShow')*/,array('empty'=>'Select a...','class'=>'form-control')); ?>
	<?php echo $form->error($model,'cart_states_id',array('class'=>'help-block')); ?>
</div>
	</div>
</div>

    <div class="form-group">
        <div class="text-right">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'btn btn-primary btn-large')); ?>
		<?php echo CHtml::link(Yii::t('app','Back'),array('admin'),array('class'=>'btn btn-large btn-default'))?>        </div>
    </div>

	</div>
<?php $this->endWidget(); ?>
        </div>
    </div>
</section>
