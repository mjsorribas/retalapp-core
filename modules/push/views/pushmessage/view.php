<?php
/* @var $this PushmessageController */
/* @var $model PushMessage */

$this->breadcrumbs=array(
	'Messajes'=>array('admin'),
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
  <?php echo CHtml::image($model->img_imagen_path,'',array('class'=>'img-responsive img-thumbnail','style'=>'width:100%'));?>    </div>
    <div class="col-lg-5">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('mobile_id_from')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->mobile_id_from;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('mobile_id_to')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->mobile_id_to;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('message')); ?>:</b></div>
          <div class="panel-body">
            <?php echo Yii::app()->format->toBr($model->message);?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('date_created')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->date_created;?></p>
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