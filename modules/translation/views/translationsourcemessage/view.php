<?php
/* @var $this TranslationsourcemessageController */
/* @var $model TranslationSourceMessage */

$this->breadcrumbs=array(
	'Translate Labels'=>array('admin'),
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
    <?php $this->renderPartial('../translationmessage/view_embed',array(

    'model'=>$model,
    'translationmessageDataProvider'=>$translationmessageDataProvider,
    'translationmessage'=>$translationmessage,
))?>
    </div>
    <div class="col-lg-7">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('category')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->category;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('message')); ?>:</b></div>
          <div class="panel-body">
            <?php echo Yii::app()->format->toBr($model->message);?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('use')); ?>:</b></div>
          <div class="panel-body">

          <code>echo r('<?php echo Yii::app()->format->toBr($model->category);?>','<?php echo Yii::app()->format->toBr($model->message);?>')</code>
            
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