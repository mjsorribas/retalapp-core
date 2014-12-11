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
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('img')); ?>:</b></div>
          <div class="panel-body">
            <?php echo CHtml::image($model->imageUrl,'',array('class'=>'img-responsive img-thumbnail'));?>    
  
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
            <?php echo '<span class="label label-success">State '.Yii::t('app','Enabled').'</span>';?>
            <?php else:?>
            <?php echo '<span class="label label-danger">State '.Yii::t('app','Disabled').'</span>';?>
            <?php endif;?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('state_email')); ?>:</b></div>
          <div class="panel-body">
            <?php if($model->state_email):?>
            <?php echo '<span class="label label-success">State Email '.Yii::t('app','Enabled').'</span>';?>
            <?php else:?>
            <?php echo '<span class="label label-danger">State Email '.Yii::t('app','Disabled').'</span>';?>
            <?php endif;?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('registered')); ?>:</b></div>
          <div class="panel-body">
              <?php echo Yii::app()->format->formatShort($model->registered);?>
            <span class="text-muted">
              <?php echo Yii::app()->format->formatAgoComment($model->registered);?>
            </span>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('trash')); ?>:</b></div>
          <div class="panel-body">
            <?php if($model->trash):?>
            <?php echo '<span class="label label-success">Trash '.Yii::t('app','Enabled').'</span>';?>
            <?php else:?>
            <?php echo '<span class="label label-danger">Trash '.Yii::t('app','Disabled').'</span>';?>
            <?php endif;?>
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

<?php Yii::app()->clientScript->registerScript("assignRoles","
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
            if(data.result==0)
                alert(data.message);
            else {
          setTimeout(function(){
                  that.addClass(data.btn);
                  that.html(data.message);
        },200);
            }
        },
    });
});
");?>
