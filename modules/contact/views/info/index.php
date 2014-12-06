<?php
/* @var $this InfoController */
/* @var $model ContactInfo */

$this->breadcrumbs=array(
	Yii::t('app','Update'),
);
?>

<div class="col-lg-12">
<?php foreach(Yii::app()->user->getFlashes() as $type => $message):?>
  <div class="alert alert-<?php echo $type?>">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $message?>
  </div>
<?php endforeach;?>

<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-info-form',
	'htmlOptions'=>array("class"=>"","role"=>"form"),
	'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true),
)); ?>
	<div class="col-lg-12">
	<?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-danger')); ?>

    <div class="form-group">
        <div class="text-right">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'btn btn-primary btn-large')); ?>
        </div>
    </div>

<div class="row">
    <div class="col-lg-4">

<div class="form-group">
    <?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'email',
					'allowed' => 255,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'email',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'title',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'title',
					'allowed' => 100,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'title',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'subtitle',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'subtitle',
					'allowed' => 100,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'subtitle',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'contact_text',array('class'=>'control-label')); ?>
    <?php echo $form->textArea($model,'contact_text',array('rows'=>5, 'cols'=>50,'class'=>'form-control')); ?>
    <?php echo $form->error($model,'contact_text',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'address',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'address',
					'allowed' => 266,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'address',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'phone',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'phone',
					'allowed' => 100,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'phone',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'facebook',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'facebook',
					'allowed' => 255,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'facebook',array('class'=>'help-block')); ?>
</div>
    </div>
    <div class="col-lg-8">
<div class="form-group">
    <?php echo $form->labelEx($model,'twitter',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'twitter',
					'allowed' => 255,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'twitter',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'google_plus',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'google_plus',
					'allowed' => 255,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'google_plus',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'linked_in',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'linked_in',
					'allowed' => 255,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'linked_in',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'youtube',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'youtube',
					'allowed' => 255,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'youtube',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'skype',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'skype',
					'allowed' => 255,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'skype',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'map_address',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.map.GMap', array(
			    'model' => $model,
			    'attribute' => 'map_address',
			),true); ?>
    <?php echo $form->error($model,'map_address',array('class'=>'help-block')); ?>
</div>
    </div>
</div>
    <div class="form-group">
        <div class="pull-right">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'btn btn-primary btn-large')); ?>
        </div>
    </div>
    </div>
<?php $this->endWidget(); ?>
        </div>
    </div>
</section>

</div>