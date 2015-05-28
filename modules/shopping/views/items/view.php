<?php
/* @var $this ItemsController */
/* @var $model ShoppingItems */

$this->breadcrumbs=array(
	'Productos'=>array('admin'),
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
      <iframe src="https://player.vimeo.com/video/<?=strtr($model->video_promocional,array(
          'https://vimeo.com/'=>'',
          'http://vimeo.com/'=>'',
          'https://www.vimeo.com/'=>'',
          'http://www.vimeo.com/'=>'',
        ))?>" width="100%" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
      
      <br>     
      <br>     
      
      <?php $this->renderPartial('../material/view_embed',array(

          'model'=>$model,
          'materialDataProvider'=>$materialDataProvider,
          'material'=>$material,
      ))?>
      <br>     
      <br>     
      <?php $this->renderPartial('../videos/view_embed',array(

          'model'=>$model,
          'videosDataProvider'=>$videosDataProvider,
          'videos'=>$videos,
      ))?>
      <br>
      <br>

      
<?php $this->renderPartial('../updates/view_embed',array(

    'model'=>$model,
    'updatesDataProvider'=>$updatesDataProvider,
    'updates'=>$updates,
))?>
      
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('imagen')); ?>:</b></div>
          <div class="panel-body">
            <p>      <?php echo CHtml::image($model->image_path,'',array('class'=>'img-responsive img-thumbnail','style'=>'width:100%'));?>    
</p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('name')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->name;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('slug')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->slug;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b></div>
          <div class="panel-body">
            <?php echo Yii::app()->format->toBr($model->description);?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('description_detail')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->description_detail;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('price')); ?>:</b></div>
          <div class="panel-body">
            <span class="text-muted">
              <?php echo Yii::app()->format->money($model->price);?>
            </span>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('free')); ?>:</b></div>
          <div class="panel-body">
            <?php if($model->free):?>
              <a href="#" data-field="free" data-action="enabled" class="btn btn-lg btn-block btn-success">Inactivo</a>
            <?php else:?>
              <a href="#" data-field="free" data-action="enabled" class="btn btn-lg btn-block btn-danger">Activo</a>
            <?php endif;?>

            <?php // if($model->free):?>
            <?php // echo '<span class="label label-success">Free '.Yii::t('app','Enabled').'</span>';?>
            <?php // else:?>
            <?php // echo '<span class="label label-danger">Free '.Yii::t('app','Disabled').'</span>';?>
            <?php // endif;?>
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

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('shopping_categories_id')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->shopping_categories_id;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('temas_relacionados')); ?>:</b></div>
          <div class="panel-body">
            <?php echo Yii::app()->format->toBr($model->temas_relacionados);?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('shopping_facilitador_id')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->shopping_facilitador_id;?></p>
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