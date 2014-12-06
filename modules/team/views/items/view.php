<?php
/* @var $this ItemsController */
/* @var $model TeamItems */

$this->breadcrumbs=array(
	'Team'=>array('admin'),
	$model->name,
);
?>
<div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
    <div class="form-group">
        <div class="text-right">
		<?php echo CHtml::link(Yii::t('app','Back'),array('admin'),array('class'=>'btn btn-large btn-default'))?>        </div>
    </div>
<div class="row">
    <div class="col-lg-7">
  <?php echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/'.$model->image,'',array('class'=>'img-responsive img-thumbnail','style'=>'width:100%'));?>    </div>
    <div class="col-lg-5">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('name')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->name;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('position')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->position;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b></div>
          <div class="panel-body">
            <?php echo Yii::app()->format->toBr($model->description);?>
          </div>


        </div>
    </div>
</div>

    <div class="form-group">
        <div class="text-right">
        <?php echo CHtml::link(Yii::t('app','Back'),array('admin'),array('class'=>'btn btn-large btn-default'))?>        </div>
    </div>
        </div>
    </div>
</section>
</div>