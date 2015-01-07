<?php
/* @var $this CodesController */
/* @var $model CartSecretCodes */
/* @var $form CActiveForm */
?>
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cart-secret-codes-form',
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
	<div class="col-lg-6">

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
<div class="form-group">
    <?php echo $form->labelEx($model,'state',array('class'=>'control-label')); ?>
    <?php echo $form->checkBox($model,'state'); ?>
    <?php echo $form->error($model,'state',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="col-lg-6">
<div class="form-group">
    <?php echo $form->labelEx($model,'cart_upload_id',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'cart_upload_id',
					'allowed' => 11,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'cart_upload_id',array('class'=>'help-block')); ?>
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