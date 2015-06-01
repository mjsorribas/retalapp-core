<?php
/* @var $this ElementsController */
/* @var $model LandingElements */
/* @var $form CActiveForm */
?>
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'landing-elements-form',
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
    <?php echo $form->labelEx($model,'landing_elements_positions_id',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.radio.GStatus', array(
                'model'=>$model,
                'attribute'=>'landing_elements_positions_id',
                'htmlOptions'=>array('class'=>'form-control'),
                'listData'=>LandingElementsPositions::listData(),
            ),true)?>
    <?php echo $form->error($model,'landing_elements_positions_id',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'module',array('class'=>'control-label')); ?>
	<?php #echo $form->textField($model,'module',array('class'=>'form-control')); ?>
	<?php echo $form->dropDownList($model,'module',$this->module->getModulesList(),array('empty'=>Yii::t('app','Select one ...'),'class'=>'form-control')); ?>
	<?php echo $form->error($model,'module',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="col-lg-6">
<div class="form-group">
	<?php echo $form->labelEx($model,'type',array('class'=>'control-label')); ?>
	<?php #echo $form->textField($model,'type',array('class'=>'form-control')); ?>
	<?php echo $form->dropDownList($model,'type',$this->module->getTypesList($model->module),array('empty'=>Yii::t('app','Select one ...'),'class'=>'form-control')); ?>
	<?php echo $form->error($model,'type',array('class'=>'help-block')); ?>
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
