<?php
/* @var $this ThemeController */
/* @var $model HomeTheme */

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
	'id'=>'home-theme-form',
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
    <div class="col-lg-3">

<div class="form-group">
    <?php echo $form->labelEx($model,'logo',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.uploader.GUpload', array(
			    'model' => $model,
			    'attribute' => 'logo',
			    // 'sizeValidate' => array('width'=>'500','height'=>'500'),
			    // 'allowedExtensions' => array('png','jpg','jpeg','pdf','zip'),
			    // 'iconButtom' => 'fa-cloud-upload',
			 	'actionUrl' => $this->createUrl('upload'),
			),true); ?>
    <?php echo $form->error($model,'logo',array('class'=>'help-block')); ?>
</div>
    </div>
    <div class="col-lg-9">
<div class="form-group">
    <?php echo $form->labelEx($model,'color',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.radio.GStatus',array(
				'model'=>$model,
				'attribute'=>'color',
				'listData'=>array(
                    'color-blue'=>'<span class="label label-default">color-blue</span>',
                    'color-green'=>'<span class="label label-default">color-green</span>',
                    'color-orange'=>'<span class="label label-default">color-orange</span>',
                    'color-red'=>'<span class="label label-default">color-red</span>',
                    'color-purple'=>'<span class="label label-default">color-purple</span>',
                    'color-light-blue'=>'<span class="label label-default">color-light-blue</span>',
                    'color-yellow'=>'<span class="label label-default">color-yellow</span>',
                    'color-pink'=>'<span class="label label-default">color-pink</span>',
                    'color-light-green'=>'<span class="label label-default">color-light-green</span>',
				  	'color-black'=>'<span class="label label-default">color-black</span>',
				)
			),true); ?>
    <?php echo $form->error($model,'color',array('class'=>'help-block')); ?>
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