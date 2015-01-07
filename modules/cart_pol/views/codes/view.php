<?php
/* @var $this CodesController */
/* @var $model CartSecretCodes */

$this->breadcrumbs=array(
	'Secrets Codes'=>array('admin'),
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
    </div>
    <div class="col-lg-5">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('secret_code')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->secret_code;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('created_at')); ?>:</b></div>
          <div class="panel-body">
              <?php echo Yii::app()->format->formatShort($model->created_at);?>
            <span class="text-muted">
              <?php echo Yii::app()->format->formatAgoComment($model->created_at);?>
            </span>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('state')); ?>:</b></div>
          <div class="panel-body">
            <?php if($model->state):?>
              <a href="#" data-field="state" data-action="enabled" class="btn btn-lg btn-block btn-success">Inactivo</a>
            <?php else:?>
              <a href="#" data-field="state" data-action="enabled" class="btn btn-lg btn-block btn-danger">Activo</a>
            <?php endif;?>

            <?php // if($model->state):?>
            <?php // echo '<span class="label label-success">State '.Yii::t('app','Enabled').'</span>';?>
            <?php // else:?>
            <?php // echo '<span class="label label-danger">State '.Yii::t('app','Disabled').'</span>';?>
            <?php // endif;?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('cart_upload_id')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->cart_upload_id;?></p>
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