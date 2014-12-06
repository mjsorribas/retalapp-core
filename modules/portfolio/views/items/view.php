<?php
/* @var $this ItemsController */
/* @var $model PortfolioItems */

$this->breadcrumbs=array(
	'Portfolio Items'=>array('admin'),
	$model->title,
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
  <?php echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/'.$model->preview,'',array('class'=>'img-responsive img-thumbnail','style'=>'width:100%'));?>    </div>
    <div class="col-lg-5">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('title')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->title;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('date')); ?>:</b></div>
          <div class="panel-body">
              <?php echo Yii::app()->format->formatShort($model->date);?>
            <span class="text-muted">
              <?php echo Yii::app()->format->formatAgoComment($model->date);?>
            </span>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('image')); ?>:</b></div>
          <div class="panel-body text-center">
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/'.$model->image,'',array('class'=>'img-responsive img-thumbnail'));?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('video')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->video;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('audio')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->audio;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('prominent')); ?>:</b></div>
          <div class="panel-body">
            <?php if($model->prominent):?>
            <?php echo '<span class="label label-success">Prominent '.Yii::t('app','Enabled').'</span>';?>
            <?php else:?>
            <?php echo '<span class="label label-danger">Prominent '.Yii::t('app','Disabled').'</span>';?>
            <?php endif;?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('created_at')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->created_at;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('portfolio_categories_id')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->portfolio_categories_id;?></p>
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