<?php
/* @var $this SliderController */
/* @var $model HomeSlider */

$this->breadcrumbs=array(
	'Slider'=>array('admin'),
	$model->id,
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
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('image_front')); ?>:</b></div>
          <div class="panel-body text-center">
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/'.$model->image_front,'',array('class'=>'img-responsive img-thumbnail'));?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('text1')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->text1;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('text2')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->text2;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('text3')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->text3;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('text4')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->text4;?></p>
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