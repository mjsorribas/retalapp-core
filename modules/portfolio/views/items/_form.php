<?php
/* @var $this ItemsController */
/* @var $model PortfolioItems */
/* @var $form CActiveForm */
?>
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'portfolio-items-form',
	'htmlOptions'=>array("class"=>"","role"=>"form"),
	'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true),
)); ?>
	<?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-danger')); ?>
	<div class="col-lg-12">
    <div class="form-group">
        <div class="text-right">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'btn btn-primary btn-large')); ?>
		<?php echo CHtml::link(Yii::t('app','Back'),array('admin'),array('class'=>'btn btn-large btn-default'))?>        </div>
    </div>
<div class="row">
	<div class="col-lg-6">

<div class="form-group">
	<?php echo $form->labelEx($model,'title',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'title',
					'allowed' => 255,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
	<?php echo $form->error($model,'title',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'date',array('class'=>'control-label')); ?>
	<?php echo $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
				'model'=>$model,
				'attribute'=>'date',
		        'pluginOptions' => array(
		            'format' => 'yyyy-mm-dd'
		        ),
				'htmlOptions' => array('class'=>'form-control'),
		    ),true); ?>
	<?php echo $form->error($model,'date',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'preview',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.uploader.GUpload', array(
			    'model' => $model,
			    'attribute' => 'preview',
			    // 'sizeValidate' => array('width'=>'500','height'=>'500'),
			    'actionUrl' => $this->createUrl('upload'),
			),true); ?>
	<?php echo $form->error($model,'preview',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'image',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.uploader.GUpload', array(
			    'model' => $model,
			    'attribute' => 'image',
			    // 'sizeValidate' => array('width'=>'500','height'=>'500'),
			    'actionUrl' => $this->createUrl('upload'),
			),true); ?>
	<?php echo $form->error($model,'image',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="col-lg-6">
<div class="form-group">
	<?php echo $form->labelEx($model,'video',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'video',
					'allowed' => 255,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
	<?php echo $form->error($model,'video',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'audio',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'audio',
					'allowed' => 255,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
	<?php echo $form->error($model,'audio',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'prominent',array('class'=>'control-label')); ?>
	<?php echo $form->checkBox($model,'prominent'); ?>
	<?php echo $form->error($model,'prominent',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'portfolio_categories_id',array('class'=>'control-label')); ?>
	<?php echo $form->dropDownList($model,'portfolio_categories_id',PortfolioCategories::listData(),array('empty'=>Yii::t('app','Select ...'),'class'=>'form-control')); ?>
	<?php echo $form->error($model,'portfolio_categories_id',array('class'=>'help-block')); ?>
</div>
	</div>
</div>

    <div class="form-group">
        <div class="text-right">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'btn btn-primary btn-large')); ?>
		<?php echo CHtml::link(Yii::t('app','Back'),array('admin'),array('class'=>'btn btn-large btn-default'))?>        </div>
    </div>

	</div>
<?php $this->endWidget(); ?>
        </div>
    </div>
</section>
