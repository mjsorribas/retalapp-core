<?php
/* @var $this CategoriesController */
/* @var $model ShoppingCategories */
/* @var $form CActiveForm */
?>
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shopping-categories-form',
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
	<div class="col-lg-7">

<div class="form-group">
    <?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'name',
					'allowed' => 60,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'name',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'slug',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.slug.GSlug', array(
			    'model' => $model,
			    'attribute' => 'slug',
			    // 'field' => 'name', // field for keyup callback
			),true); ?>
    <?php echo $form->error($model,'slug',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="col-lg-5">
<div class="form-group">
    <?php echo $form->labelEx($model,'color',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.colorpicker.EColorPicker', array(
                'model'=>$model,
                'attribute'=>'color',
                'htmlOptions'=>array('class'=>'form-control'),
                'mode'=>'textfield',
                'fade' => false,
                'slide' => false,
                'curtain' => true,
           ),true); ?>
    <?php echo $form->error($model,'color',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'icon',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.radio.GFontAwesome',array(
				'model'=>$model,
				'attribute'=>'icon',
			),true); ?>
    <?php echo $form->error($model,'icon',array('class'=>'help-block')); ?>
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