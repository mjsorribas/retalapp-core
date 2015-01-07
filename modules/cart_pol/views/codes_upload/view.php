<?php
/* @var $this Codes_uploadController */
/* @var $model CartUpload */

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
    <div class="col-lg-6">
     <?php echo CHtml::link('<i style="font-size:10em" class="fa fa-download"></i>',$model->file_path,array('class'=>'mhl mvl'));?>    
   
  
  <div class="mtl">
  <?php $this->renderPartial('../codes_upload_modal/view_embed',array(

      'model'=>$model,
      'codes_upload_modalDataProvider'=>$codes_upload_modalDataProvider,
      'codes_upload_modal'=>$codes_upload_modal,
  ))?>
  </div>

   </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('created_at')); ?>:</b></div>
          <div class="panel-body">
              <?php echo Yii::app()->format->formatShort($model->created_at);?>
            <span class="text-muted">
              <?php echo Yii::app()->format->formatAgoComment($model->created_at);?>
            </span>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('users_users_id')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->user->name;?> <?php echo $model->user->lastname;?></p>
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