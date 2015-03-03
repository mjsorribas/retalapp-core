<?php
/* @var $this PushmobilesController */
/* @var $model PushMobiles */

$this->breadcrumbs=array(
	'Dispositivos'=>array('admin'),
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
    <div class="col-lg-5">
<div class="thumbnail">



    <div class="caption">
    <h4>
        Dispositivos <?php echo $model->id;?>    </h4>
    </div>
</div>

    </div>
    <div class="col-lg-7">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('uuid')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->uuid;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('device_type')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->device_type;?></p>
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