<?php
/* @var $this ItemsController */
/* @var $model ShoppingItems */
/* @var $form CActiveForm */
?>
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap ">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shopping-items-form',
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
<div class="form-group">
    <?php echo $form->labelEx($model,'video_promocional',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.counter.GTextfield',array(
					'model'=>$model,
					'attribute'=>'video_promocional',
					'allowed' => 100,
					'htmlOptions' => array('class'=>'form-control'),
				),true); ?>
    <?php echo $form->error($model,'video_promocional',array('class'=>'help-block')); ?>
</div>
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
			    'field' => 'name',
			),true); ?>
    <?php echo $form->error($model,'slug',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'description',array('class'=>'control-label')); ?>
    <?php echo $form->textArea($model,'description',array('rows'=>5, 'cols'=>50,'class'=>'form-control')); ?>
    <?php echo $form->error($model,'description',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'description_detail',array('class'=>'control-label')); ?>
    <?php echo $this->widget('ext.inputs.wisi.GSummerNote', array(
            	'model'=>$model,
                'attribute'=>'description_detail',
            	'height'=>'250px',
                'htmlOptions' => array(
                    'class' => 'form-control',
                )
			),true); ?>
    <?php echo $form->error($model,'description_detail',array('class'=>'help-block')); ?>
</div>
	</div>
	<div class="col-lg-5">
<div class="form-group">
    <?php echo $form->labelEx($model,'price',array('class'=>'control-label')); ?>
    <?php echo "";
			$model->price=Yii::app()->format->money($model->price);
			echo $this->widget('yiiwheels.widgets.maskmoney.WhMaskMoney', array(
            	'model'=>$model,
                'attribute'=>'price',
                'htmlOptions' => array(
                    'class' => 'form-control'
                )
			),true); ?>
    <?php echo $form->error($model,'price',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'free',array('class'=>'control-label')); ?>
    <?php echo $form->checkBox($model,'free'); ?>
    <?php echo $form->error($model,'free',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'state',array('class'=>'control-label')); ?>
    <?php echo $form->checkBox($model,'state'); ?>
    <?php echo $form->error($model,'state',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'shopping_categories_id',array('class'=>'control-label')); ?>
    <?php echo $form->dropDownList($model,'shopping_categories_id',ShoppingCategories::listData(),array('empty'=>Yii::t('app','Select ...'),'class'=>'form-control')); ?>
    <?php echo $form->error($model,'shopping_categories_id',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'temas_relacionados',array('class'=>'control-label')); ?>
    <?php echo $form->textArea($model,'temas_relacionados',array('rows'=>5, 'cols'=>50,'class'=>'form-control')); ?>
    <?php echo $form->error($model,'temas_relacionados',array('class'=>'help-block')); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'shopping_facilitador_id',array('class'=>'control-label')); ?>
    <?php echo $form->dropDownList($model,'shopping_facilitador_id',ShoppingFacilitador::listData(),array('empty'=>Yii::t('app','Select ...'),'class'=>'form-control')); ?>
    <?php echo $form->error($model,'shopping_facilitador_id',array('class'=>'help-block')); ?>
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