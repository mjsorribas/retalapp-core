<?php
/* @var $this PushmobilesController */
/* @var $model PushMobiles */
/* @var $form CActiveForm */
?>
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'push-mobiles-form',
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
	<div class="col-lg-7">

<div class="form-group">
	<?php echo $form->labelEx($model,'uuid',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
				'model'=>$model,
				'attribute'=>'uuid',
				'allowed' => 100,
				'htmlOptions' => array('class'=>'form-control'),
			),true); ?>
	<?php echo $form->error($model,'uuid',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="col-lg-5">
<div class="form-group">
	<?php echo $form->labelEx($model,'device_type',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
				'model'=>$model,
				'attribute'=>'device_type',
				'allowed' => 11,
				'htmlOptions' => array('class'=>'form-control'),
			),true); ?>
	<?php echo $form->error($model,'device_type',array('class'=>'help-block')); ?>
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
