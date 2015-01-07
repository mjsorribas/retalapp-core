<?php
/* @var $this Codes_uploadController */
/* @var $model CartUpload */
/* @var $form CActiveForm */
?>
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cart-upload-form',
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
    <?php echo $form->labelEx($model,'file',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.uploader.GUpload', array(
			    'model' => $model,
			    'attribute' => 'file',
			    // Put this same array extensions allowed in your upload action
		        'iconButtom' => 'fa-cloud-upload',
		        'allowedExtensions' => array('csv'),
			    'actionUrl' => $this->createUrl('upload'),
			),true); ?>
    <?php echo $form->error($model,'file',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="col-lg-6">
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