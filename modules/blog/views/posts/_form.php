<?php
/* @var $this PostsController */
/* @var $model BlogPosts */
/* @var $form CActiveForm */
?>
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blog-posts-form',
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
	<div class="col-lg-5">

<div class="form-group">
	<?php echo $form->labelEx($model,'author_id',array('class'=>'control-label')); ?>
	<?php echo $form->dropDownList($model,'author_id',BlogAuthor::listData(),array('empty'=>Yii::t('app','Select ...'),'class'=>'form-control')); ?>
	<?php echo $form->error($model,'author_id',array('class'=>'help-block')); ?>
</div>
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
	<?php echo $form->labelEx($model,'text',array('class'=>'control-label')); ?>
	<?php echo $this->widget('yiiwheels.widgets.redactor.WhRedactor', array(
            	'model'=>$model,
                'attribute'=>'text',
            	'height'=>'250px',
                'htmlOptions' => array(
                    'class' => 'form-control',
                )
			),true); ?>
	<?php echo $form->error($model,'text',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="col-lg-7">
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
	<?php echo $form->labelEx($model,'vimeo',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'vimeo',
					'allowed' => 255,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
	<?php echo $form->error($model,'vimeo',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
	<?php echo $form->labelEx($model,'image',array('class'=>'control-label')); ?>
	<?php echo $this->widget('ext.inputs.uploader.GUpload', array(
			    'model' => $model,
			    'attribute' => 'image',
			    // 'sizeValidate' => array('width'=>'500','height'=>'500'),
			    // 'allowedExtensions' => array('png','jpg','jpeg','pdf','zip'),
			    // 'iconButtom' => 'fa-cloud-upload',
			 	'actionUrl' => $this->createUrl('upload'),
			),true); ?>
	<?php echo $form->error($model,'image',array('class'=>'help-block')); ?>
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
