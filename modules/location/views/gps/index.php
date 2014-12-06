<?php
/* @var $this GpsController */
/* @var $model LocationGps */

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
	'id'=>'location-gps-form',
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
    <div class="col-lg-6">

<div class="form-group">
    <?php echo $form->labelEx($model,'map_address',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.map.GMap', array(
			    'model' => $model,
			    'attribute' => 'map_address',
			),true); ?>
    <?php echo $form->error($model,'map_address',array('class'=>'help-block')); ?>
</div>
    </div>
    <div class="col-lg-6">
     <?php $this->widget('ext.widgets.gmap.GShowLocation',array(
        'lat'=>$model->map_address_lat,
        'lng'=>$model->map_address_lng,
        'width'=>'100%',
        'height'=>'500',
        'zoom'=>'8',
    ));?>
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