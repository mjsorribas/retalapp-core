<?php
/* @var $this PriceController */
/* @var $model PriceItems */

$this->breadcrumbs=array(
	'Prices'=>array('admin'),
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
    <div class="col-lg-6">
    <?php $this->renderPartial('../features/view_embed',array(

    'model'=>$model,
    'featuresDataProvider'=>$featuresDataProvider,
    'features'=>$features,
))?>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('name')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->name;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('subtitle')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->subtitle;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('price')); ?>:</b></div>
          <div class="panel-body">
            <span class="text-muted">
              <?php echo Yii::app()->format->money($model->price);?>
            </span>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('pay_per')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->pay_per;?></p>
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