<?php
/* @var $this StatesController */
/* @var $model CartStates */
/* @var $form CActiveForm */
?>
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cart-states-form',
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
	<?php echo $form->labelEx($model,'description',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
				'model'=>$model,
				'attribute'=>'description',
				'allowed' => 100,
				'htmlOptions' => array('class'=>'form-control'),
			),true); ?>
	<?php echo $form->error($model,'description',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'icon_class',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.radio.GFontAwesome',array(
				'model'=>$model,
				'attribute'=>'icon_class',
			),true); ?>
	<?php echo $form->error($model,'icon_class',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="col-lg-6">
<div class="form-group">
	<?php echo $form->labelEx($model,'class_status',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.radio.GStatus',array(
				'model'=>$model,
				'attribute'=>'class_status',
				'listData'=>array(
				  	'default'=>'<span class="label label-default">Default</span>',
					'primary'=>'<span class="label label-primary">Primary</span>',
					'success'=>'<span class="label label-success">Success</span>',
					'info'=>'<span class="label label-info">Info</span>',
					'warning'=>'<span class="label label-warning">Warning</span>',
					'danger'=>'<span class="label label-danger">Danger</span>'
				)
			),true); ?>
	<?php echo $form->error($model,'class_status',array('class'=>'help-block')); ?>
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
