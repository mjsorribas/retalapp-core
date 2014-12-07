<?php
/* @var $this StatesController */
/* @var $model CartStates */

$this->breadcrumbs=array(
	'Cart States'=>array('admin'),
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
    <div class="col-lg-4">
<div class="thumbnail">




    <div class="caption">
    <h4>
        Cart States <?php echo $model->id;?>    </h4>
    </div>
</div>

    </div>
    <div class="col-lg-8">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->description;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('icon_class')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->icon_class;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('class_status')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->class_status;?></p>
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