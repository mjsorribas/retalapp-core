<?php
/* @var $this PushconfigController */
/* @var $model PushConfig */

$this->breadcrumbs=array(
	Yii::t('app','Update'),
);
?>

<div class="col-lg-12">
<?php foreach(Yii::app()->user->getFlashes() as $type => $message):?>
  <div class="alert alert-<?php echo $type?>">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $message?>
  </div>
<?php endforeach;?>

<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'push-config-form',
	'htmlOptions'=>array("class"=>"","role"=>"form"),
	'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true),
)); ?>
	<div class="col-lg-12">
	<?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-danger')); ?>

    <div class="form-group">
        <div class="pull-right">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'btn btn-primary btn-large')); ?>
        </div>
    </div>

<div class="row">
    <div class="col-lg-6">

<div class="form-group">
    <?php echo $form->labelEx($model,'android_api_key',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
				'model'=>$model,
				'attribute'=>'android_api_key',
				'allowed' => 1000,
				'htmlOptions' => array('class'=>'form-control'),
			),true); ?>
    <?php echo $form->error($model,'android_api_key',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'android_host',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
				'model'=>$model,
				'attribute'=>'android_host',
				'allowed' => 250,
				'htmlOptions' => array('class'=>'form-control'),
			),true); ?>
    <?php echo $form->error($model,'android_host',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'ios_pwd',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
				'model'=>$model,
				'attribute'=>'ios_pwd',
				'allowed' => 500,
				'htmlOptions' => array('class'=>'form-control'),
			),true); ?>
    <?php echo $form->error($model,'ios_pwd',array('class'=>'help-block')); ?>
</div>
    </div>
    <div class="col-lg-6">
    <div class="form-group">
    <?php echo $form->labelEx($model,'ios_cert',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.uploader.GUpload', array(
                'model' => $model,
                'attribute' => 'ios_cert',
                // Put this same array extensions allowed in your upload action
                'allowedExtensions' => array('pem'),
                'actionUrl' => $this->createUrl('upload'),
            ),true); ?>
    <?php echo $form->error($model,'ios_cert',array('class'=>'help-block')); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model,'ios_host',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
				'model'=>$model,
				'attribute'=>'ios_host',
				'allowed' => 500,
				'htmlOptions' => array('class'=>'form-control'),
			),true); ?>
    <?php echo $form->error($model,'ios_host',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'activo',array('class'=>'control-label')); ?>
    <?php echo $form->checkBox($model,'activo'); ?>
    <?php echo $form->error($model,'activo',array('class'=>'help-block')); ?>
</div>
    </div>
</div>
    <div class="form-group">
        <div class="pull-right">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'btn btn-primary btn-large')); ?>
        </div>
    </div>
    </div>
<?php $this->endWidget(); ?>
        </div>
    </div>
</section>

</div>