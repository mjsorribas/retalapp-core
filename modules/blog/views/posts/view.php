<?php
/* @var $this PostsController */
/* @var $model BlogPosts */

$this->breadcrumbs=array(
	'Posts'=>array('admin'),
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
  <?php echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/'.$model->image,'',array('class'=>'img-responsive img-thumbnail','style'=>'width:100%'));?>    </div>
    <div class="col-lg-5">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('author_id')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->author->name;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('title')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->title;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('text')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->text;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('youtube')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->youtube;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('vimeo')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->vimeo;?></p>
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