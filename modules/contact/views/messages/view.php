<?php
/* @var $this MessagesController */
/* @var $model ContactMessages */

$this->breadcrumbs=array(
	'Messages'=>array('admin'),
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
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('name')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->name;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('phone')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->phone;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('email')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->email;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('message')); ?>:</b></div>
          <div class="panel-body">
            <?php echo Yii::app()->format->toBr($model->message);?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('read')); ?>:</b></div>
          <div class="panel-body">
            <?php if($model->read):?>
            <?php echo '<span class="label label-success">Read '.Yii::t('app','Enabled').'</span>';?>
            <?php else:?>
            <?php echo '<span class="label label-danger">Read '.Yii::t('app','Disabled').'</span>';?>
            <?php endif;?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('created_at')); ?>:</b></div>
          <div class="panel-body">
              <?php echo Yii::app()->format->formatShort($model->created_at);?>
            <span class="text-muted">
              <?php echo Yii::app()->format->formatAgoComment($model->created_at);?>
            </span>
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