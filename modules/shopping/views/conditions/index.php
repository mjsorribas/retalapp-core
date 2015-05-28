<?php
/* @var $this ConditionsController */
/* @var $model ShoppingConditions */

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
	'id'=>'shopping-conditions-form',
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
    <div class="col-lg-12">

<div class="form-group">
    <?php echo $form->labelEx($model,'conditions',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.wisi.GSummerNote', array(
            	'model'=>$model,
                'attribute'=>'conditions',
            	'height'=>'500px',
                'htmlOptions' => array(
                    'class' => 'form-control',
                )
			),true); ?>
    <?php echo $form->error($model,'conditions',array('class'=>'help-block')); ?>
</div>
    </div>
    
</div>
    </div>
<?php $this->endWidget(); ?>
        </div>
    </div>
</section>

</div>