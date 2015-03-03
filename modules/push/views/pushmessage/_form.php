<?php
/* @var $this PushmessageController */
/* @var $model PushMessage */
/* @var $form CActiveForm */
?>
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'push-message-form',
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
    <?php echo $form->labelEx($model,'mobile_id_from',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'mobile_id_from',
					'allowed' => 11,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'mobile_id_from',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'mobile_id_to',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'mobile_id_to',
					'allowed' => 11,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'mobile_id_to',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'message',array('class'=>'control-label')); ?>
    <?php echo $form->textArea($model,'message',array('rows'=>5, 'cols'=>50,'class'=>'form-control')); ?>
    <?php echo $form->error($model,'message',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="col-lg-5">
<div class="form-group">
    <?php echo $form->labelEx($model,'img_imagen',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.uploader.GUpload', array(
			    'model' => $model,
			    'attribute' => 'img_imagen',
			    // 'sizeValidate' => array('width'=>'500','height'=>'500'),
			    // 'allowedExtensions' => array('png','jpg','jpeg','pdf','zip'),
			    // 'iconButtom' => 'fa-cloud-upload',
			 	'actionUrl' => $this->createUrl('upload'),
			),true); ?>
    <?php echo $form->error($model,'img_imagen',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'date_created',array('class'=>'control-label')); ?>
    <?php echo $form->textField($model,'date_created',array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'date_created',array('class'=>'help-block')); ?>
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