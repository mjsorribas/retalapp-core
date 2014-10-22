<?php
/* @var $this UsersController */
/* @var $model UsersUsers */
/* @var $form CActiveForm */
?>
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-users-form',
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
	<?php echo $form->labelEx($model,'password',array('class'=>'control-label')); ?>
	<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'password',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'email',
					'allowed' => 128,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
	<?php echo $form->error($model,'email',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'name',
					'allowed' => 255,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
	<?php echo $form->error($model,'name',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'lastname',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'lastname',
					'allowed' => 255,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
	<?php echo $form->error($model,'lastname',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'username',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'username',
					'allowed' => 255,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
	<?php echo $form->error($model,'username',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="col-lg-6">
<div class="form-group">
	<?php echo $form->labelEx($model,'state',array('class'=>'control-label')); ?>
	<?php echo $form->checkBox($model,'state'); ?>
	<?php echo $form->error($model,'state',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'state_email',array('class'=>'control-label')); ?>
	<?php echo $form->checkBox($model,'state_email'); ?>
	<?php echo $form->error($model,'state_email',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'img',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.uploader.GUpload', array(
			    'model' => $model,
			    'attribute' => 'img',
			    // 'sizeValidate' => array('width'=>'500','height'=>'500'),
			    'actionUrl' => $this->createUrl('upload'),
			),true); ?>
	<?php echo $form->error($model,'img',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'registered',array('class'=>'control-label')); ?>
	<?php echo $this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
		        'model' => $model,
		        'attribute' => 'registered',
				'pluginOptions'=>array( 
			        'pick12HourFormat' => false,
		    		'format' => 'YYYY-MM-DD HH:mm:ss',
					'showButtonPanel' => true,
			        'changeYear' => true,
			    ),
				'htmlOptions' => array('class'=>'form-control'),
		    ),true); ?>
	<?php echo $form->error($model,'registered',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'trash',array('class'=>'control-label')); ?>
	<?php echo $form->checkBox($model,'trash'); ?>
	<?php echo $form->error($model,'trash',array('class'=>'help-block')); ?>
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
