<?php
/* @var $this CitiesController */
/* @var $model UsersLocationCities */

$this->breadcrumbs=array(
	'Cities'=>array('admin'),
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
    <div class="col-lg-7">
    </div>
    <div class="col-lg-5">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('name')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->name;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('code')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->code;?></p>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('users_location_states_id')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->users_location_states_id;?></p>
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