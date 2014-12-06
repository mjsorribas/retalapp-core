<?php
/* @var $this IntroController */
/* @var $model HomeIntro */

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
	'id'=>'home-intro-form',
	'htmlOptions'=>array("class"=>"","role"=>"form"),
	'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true),
)); ?>
	<div class="col-lg-12">
	<?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-danger')); ?>

    <div class="form-group">
        <div class="text-right">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'btn btn-primary btn-large')); ?>
        </div>
    </div>

<div class="row">
    <div class="col-lg-7">

<div class="form-group">
    <?php echo $form->labelEx($model,'title',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'title',
					'allowed' => 255,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'title',array('class'=>'help-block')); ?>
</div>
    </div>
    <div class="col-lg-5">
<div class="form-group">
    <?php echo $form->labelEx($model,'text',array('class'=>'control-label')); ?>
    <?php echo $form->textArea($model,'text',array('rows'=>5, 'cols'=>50,'class'=>'form-control')); ?>
    <?php echo $form->error($model,'text',array('class'=>'help-block')); ?>
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