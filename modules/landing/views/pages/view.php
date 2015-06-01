<?php
/* @var $this PagesController */
/* @var $model LandingPages */

$this->breadcrumbs=array(
	'Pages'=>array('admin'),
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
    <div class="col-lg-5">
  <?php echo CHtml::image($model->image_path,'',array('class'=>'img-responsive img-thumbnail','style'=>'width:100%'));?>    

<div style="margin-top:20px"> 
<?php $this->renderPartial('../features/view_embed',array(
  'model'=>$model,
  'featuresDataProvider'=>$featuresDataProvider,
  'features'=>$features,
))?>

</div>
  </div>
    <div class="col-lg-7">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('name')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->name;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('slug')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->slug;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('video')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->video;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('call')); ?>:</b></div>
          <div class="panel-body">
            <?php echo Yii::app()->format->toBr($model->call);?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('call_text')); ?>:</b></div>
          <div class="panel-body">
            <?php echo Yii::app()->format->toBr($model->call_text);?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('code')); ?>:</b></div>
          <div class="panel-body">
            <span class="text-muted">
              <?php echo $this->widget('yiiwheels.widgets.ace.WhAceEditor', array(
                          'model'=>$model,
                            'attribute'=>'code',
                            'htmlOptions' => array(
                                'class' => 'form-control',
                                'style'=> 'width:100%;height:150px',
                            )
                  ),true);?>
            </span>
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
<script>
  $(function(){

    $(document).on('click', '[data-action="enabled"]', function(e) {
      e.preventDefault();
      var that=$(this);
      var field = that.attr('data-field');
      that.html('...');
      that.removeClass('btn-success btn-danger');
      $.ajax({
          url: '<?=$this->createUrl("enabled",array("id"=>$model->id))?>',
          type: 'post',
          data: { 'field': field },
          dataType: 'json',
          success: function(data){
              
              if(data.result) {
                setTimeout(function(){
                  that.addClass(data.btn);
                  that.html(data.html);
                },200);
              } else {
                bootbox.alert(data.message);
              }
          },
      });
    });
  })
</script>