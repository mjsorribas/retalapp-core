<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
$module=Yii::app()->getModule('gii');
$arratClean=Yii::app()->getModule('gii')->arrayClean;
$optionsLayouts=array(
        //array('4','8'),
        //array('8','4'),
        // array('3','9'),
        // array('9','3'),
        array('6','6'),
        // array('12','12'),
        array('7','5'),
        array('5','7'),
    );
shuffle($optionsLayouts);
$showImage=false;
$showMap=false;
$showDownload=false;
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->labelName;
echo "\$this->breadcrumbs=array(
	'$label'=>array('admin'),
	\$model->{$nameColumn},
);\n";?>
?>
<div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
    <div class="form-group">
        <div class="text-right">
		<?php echo "<?php echo CHtml::link(Yii::t('app','Back'),array('admin'),array('class'=>'btn btn-large btn-default'))?>";?>
        </div>
    </div>
<div class="row">
    <div class="col-lg-<?php echo $optionsLayouts[0][0]?>">
<?php foreach($this->tableSchema->columns as $column):?><?php 
$tangaColumn=$module->getParamsField($column);
$columnLat=explode('_', $column->name);
    if(isset($columnLat[0]) and isset($columnLat[2]) and $columnLat[0]=='map' and ($columnLat[2]=='lat' or $columnLat[2]=='lng'))
        continue;
?><?php if($tangaColumn['type']==='img'):?>
<?php $showImage=true; ?>
  <?php echo "<?php echo CHtml::image(\$model->".$column->name."_path,'',array('class'=>'img-responsive img-thumbnail','style'=>'width:100%'));?>"; ?>
<?php break;?>
<?php endif;?>
<?php $columnLat=explode('_', $column->name);
    if(isset($columnLat[0]) and $columnLat[0]=='map'):?>
    <?php $showMap=true; ?>
    <?php echo "<?php \$this->widget('ext.widgets.gmap.GShowLocation',array(
        'lat'=>\$model->{$column->name}_lat,
        'lng'=>\$model->{$column->name}_lng,
        'width'=>'100%',
        'height'=>'300',
        'zoom'=>'13',
    ));?>"; ?>
<?php break;?>
<?php endif;?><?php if($tangaColumn['type']==='file'):?>
   <?php $showDownload=true; ?>
  <?php echo "<?php echo CHtml::link('<i style=\"font-size:10em\" class=\"fa fa-download\"></i>',\$model->".$column->name."_path,array('class'=>'mhl mvl'));?>"; ?>
<?php break;?>
<?php endif;?>
<?php endforeach;?>
    </div>
    <div class="col-lg-<?php echo $optionsLayouts[0][1]?>">
        <div class="panel panel-default">
          <!-- Default panel contents -->
<?php foreach($this->tableSchema->columns as $column):?>
<?php 
    $tangaColumn=$module->getParamsField($column);
    
    $columnLat=explode('_', $column->name);
    
    if($tangaColumn['type']==='file' and $showDownload)
    {
        $showDownload=false;
        continue;
    }
    if($tangaColumn['type']==='img' and $showImage)
    {
        $showImage=false;
        continue;
    }
    if(isset($columnLat[0]) and $columnLat[0]=='map' and $showMap)
    {
        $showMap=false;
        continue;
    }
    if($column->name=='orden_id')
        continue;
    if($column->name=='id')
        continue;
    if(isset($columnLat[0]) and isset($columnLat[2]) and $columnLat[0]=='map' and ($columnLat[2]=='lat' or $columnLat[2]=='lng'))
        continue;
?>
<?php if($tangaColumn['type']==='img'):?>
          <div class="panel-heading"><?php echo "<b><?php echo CHtml::encode(\$model->getAttributeLabel('{$column->name}')); ?>:</b>"; ?></div>
          <div class="panel-body text-center">
            <?php echo "<?php echo CHtml::image(\$model->".$column->name."_path,'',array('class'=>'img-responsive img-thumbnail'));?>\n"; ?>
          </div>
<?php elseif($tangaColumn['type']==='code'):?>
          <div class="panel-heading"><?php echo "<b><?php echo CHtml::encode(\$model->getAttributeLabel('{$column->name}')); ?>:</b>"; ?></div>
          <div class="panel-body">
            <span class="text-muted">
              <?php echo "<?php echo \$this->widget('yiiwheels.widgets.ace.WhAceEditor', array(
                          'model'=>\$model,
                            'attribute'=>'".$column->name."',
                            'htmlOptions' => array(
                                'class' => 'form-control',
                                'style'=> 'width:100%;height:150px',
                            )
                  ),true);?>\n"; ?>
            </span>
          </div>
<?php elseif($tangaColumn['type']==='money'):?>
          <div class="panel-heading"><?php echo "<b><?php echo CHtml::encode(\$model->getAttributeLabel('{$column->name}')); ?>:</b>"; ?></div>
          <div class="panel-body">
            <span class="text-muted">
              <?php echo "<?php echo Yii::app()->format->money(\$model->".$column->name.");?>\n"; ?>
            </span>
          </div>
<?php elseif($tangaColumn['type']==='text'):?>
          <div class="panel-heading"><?php echo "<b><?php echo CHtml::encode(\$model->getAttributeLabel('{$column->name}')); ?>:</b>"; ?></div>
          <div class="panel-body">
            <?php echo "<?php echo Yii::app()->format->toBr(\$model->".$column->name.");?>\n"; ?>
          </div>
<?php  elseif(isset($columnLat[0]) and $columnLat[0]=='map'): ?>
          <div class="panel-heading"><?php echo "<b><?php echo CHtml::encode(\$model->getAttributeLabel('{$column->name}')); ?>:</b>"; ?></div>
          <div class="panel-body ptn pln prn pbn">
            <?php echo "<?php \$this->widget('ext.widgets.gmap.GShowLocation',array(
            'lat'=>\$model->{$column->name}_lat,
            'lng'=>\$model->{$column->name}_lng,
            'width'=>'100%',
            'height'=>'300',
            'zoom'=>'13',
        ));?>\n"; ?>
          </div>
<?php elseif($tangaColumn['type']==='video'): ?>
          <div class="panel-heading"><?php echo "<b><?php echo CHtml::encode(\$model->getAttributeLabel('{$column->name}')); ?>:</b>"; ?></div>
          <div class="panel-body ptn pln prn pbn">
            <?php echo "<?php \$this->widget('ext.widgets.youtube.Yiitube', array('size'=>'small','v' => \$model->".$column->name."));?>"?>
          </div>
<?php elseif($tangaColumn['type']==='file'):?>
          <div class="panel-heading"><?php echo "<b><?php echo CHtml::encode(\$model->getAttributeLabel('{$column->name}')); ?>:</b>"; ?></div>
          <div class="panel-body">
            <?php echo "<?php echo CHtml::link('<i class=\"fa fa-download\"></i>',\$model->".$column->name."_path,array('font-size:100%'));?>\n"; ?>
          </div>
<?php elseif($tangaColumn['type']==='boolean'):?>
          <div class="panel-heading"><?php echo "<b><?php echo CHtml::encode(\$model->getAttributeLabel('{$column->name}')); ?>:</b>"; ?></div>
          <div class="panel-body">
            <?php echo "<?php if(\$model->{$column->name}):?>\n"; ?>
              <a href="#" data-field="<?=$column->name?>" data-action="enabled" class="btn btn-lg btn-block btn-success"><?=r('app','Disabled')?></a>
            <?php echo "<?php else:?>\n"; ?>
              <a href="#" data-field="<?=$column->name?>" data-action="enabled" class="btn btn-lg btn-block btn-danger"><?=r('app','Enabled')?></a>
            <?php echo "<?php endif;?>\n"; ?>

            <?php echo "<?php // if(\$model->{$column->name}):?>\n"; ?>
            <?php echo "<?php // echo '<span class=\"label label-success\">".ucwords(strtr($column->name,$arratClean))." '.Yii::t('app','Enabled').'</span>';?>\n"; ?>
            <?php echo "<?php // else:?>\n"; ?>
            <?php echo "<?php // echo '<span class=\"label label-danger\">".ucwords(strtr($column->name,$arratClean))." '.Yii::t('app','Disabled').'</span>';?>\n"; ?>
            <?php echo "<?php // endif;?>\n"; ?>
          </div>
<?php elseif($tangaColumn['type']==='date' or $tangaColumn['type']==='datetime'):?>
          <div class="panel-heading"><?php echo "<b><?php echo CHtml::encode(\$model->getAttributeLabel('{$column->name}')); ?>:</b>"; ?></div>
          <div class="panel-body">
              <?php echo "<?php echo Yii::app()->format->formatShort(\$model->".$column->name.");?>\n"; ?>
            <span class="text-muted">
              <?php echo "<?php echo Yii::app()->format->formatAgoComment(\$model->".$column->name.");?>\n"; ?>
            </span>
          </div>
<?php else:?>
          <div class="panel-heading"><?php echo "<b><?php echo CHtml::encode(\$model->getAttributeLabel('{$column->name}')); ?>:</b>"; ?></div>
          <div class="panel-body">
            <p><?php echo "<?php echo \$model->{$column->name};?>"; ?></p>
          </div>
<?php endif;?>

<?php endforeach;?>

        </div>
    </div>
</div>

<?php if(count($this->tableSchema->columns)>2):?>
    <div class="form-group">
        <div class="text-right">
        <?php echo "<?php echo CHtml::link(Yii::t('app','Back'),array('admin'),array('class'=>'btn btn-large btn-default'))?>";?>
        </div>
    </div>
<?php endif;?>
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
          url: '<?php echo "<?=\$this->createUrl(\"enabled\",array(\"id\"=>\$model->id))?>"?>',
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