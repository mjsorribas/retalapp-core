<?php
/* @var $this UsersController */
/* @var $model UsersUsers */

$this->breadcrumbs=array(
	'Users'=>array('admin'),
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
  <?php echo $this->renderPartial('_role',array('model'=>$model,'role'=>$role)); ?>
  </div>
        
    <div class="col-lg-6">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><b><?=r('app','Details user')?>:</b></div>
          <div class="panel-body">
          <div class="row">
            <div class="col-lg-4">
              <?php echo CHtml::image($model->imageUrl,'',array('class'=>'img-responsive img-thumbnail'));?>    
            </div>
            <div class="col-lg-8">
              <a href="#" data-action="reset" class="btn btn-lg btn-block btn-warning"><?=r('app','Reset password')?></a>
              <?php if($model->state):?>
                <a href="#" data-action="enabled" class="btn btn-lg btn-block btn-success"><?=r('app','Disabled')?></a>
              <?php else:?>
                <a href="#" data-action="enabled" class="btn btn-lg btn-block btn-danger"><?=r('app','Enabled')?></a>
              <?php endif;?>
            </div>
          </div>
  
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('email')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->email;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('name')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->name;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('lastname')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->lastname;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('username')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->username;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('state')); ?>:</b></div>
          <div class="panel-body">
            <?php if($model->state):?>
            <?php echo '<span class="label label-success">'.Yii::t('app','Enabled').'</span>';?>
            <?php else:?>
            <?php echo '<span class="label label-danger">'.Yii::t('app','Disabled').'</span>';?>
            <?php endif;?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('state_email')); ?>:</b></div>
          <div class="panel-body">
            <?php if($model->state_email):?>
            <?php echo '<span class="label label-success">'.Yii::t('app','Enabled').'</span>';?>
            <?php else:?>
            <?php echo '<span class="label label-danger">'.Yii::t('app','Disabled').'</span>';?>
            <?php endif;?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('registered')); ?>:</b></div>
          <div class="panel-body">
              <?php echo Yii::app()->format->formatShort($model->registered);?>
            <span class="text-muted">
              <?php echo Yii::app()->format->formatAgoComment($model->registered);?>
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
    $(document).on('click', '.assign', function(e) {
      e.preventDefault();
      var that=$(this);
      var content=that.html();
      that.html('...');
      that.removeClass('btn-primary btn-info');
      $.ajax({
          url: that.attr('href'),
          type: 'post',
          data: { action: content},
          dataType: 'json',
          success: function(data){
              if(data.result==0) {
                bootbox.alert(data.message);
              } else {
                setTimeout(function(){
                  that.addClass(data.btn);
                  that.html(data.message);
                },200);
              }
          },
      });
    });
    
    $(document).on('click', '[data-action="reset"]', function(e) {
      e.preventDefault();
      var that=$(this);
      that.html('...');
      // that.removeClass('btn-primary btn-info');
      $.ajax({
          url: '<?=$this->createUrl("reset",array("id"=>$model->id))?>',
          type: 'post',
          dataType: 'json',
          success: function(data){
            bootbox.alert(data.message);
          },
      });
    });

    $(document).on('click', '[data-action="enabled"]', function(e) {
      e.preventDefault();
      var that=$(this);
      that.html('...');
      that.removeClass('btn-success btn-danger');
      $.ajax({
          url: '<?=$this->createUrl("enabled",array("id"=>$model->id))?>',
          type: 'post',
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