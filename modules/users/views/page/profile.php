<?php
/* @var $this SiteController */
/* @var $user LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('app','Profile');
?>

<section style="padding-top:130px;padding-bottom: 0;" id="products" class="gray-bg padding-top-bottom">

    <div class="container">
        <div class="row">

    <div class="col-lg-6">
    <h1><?=Yii::t('app','Profile')?></h1>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'users-form',
        'htmlOptions'=>array("class"=>"form-horizontal","role"=>"form"),
        'enableAjaxValidation'=>true,
        'clientOptions'=>array('validateOnSubmit'=>true),
    )); ?>
    <?php #echo $form->errorSummary($user,"","",array("class"=>"alert alert-danger")); ?>
    <br>
    <!--
    <div class="form-group">
        <?php #echo $form->labelEx($user,'img',array('class'=>'control-label')); ?>
        <?php echo $this->widget('ext.inputs.uploader.GUpload', array(
                    'model' => $user,
                    'attribute' => 'img',
                    //'sizeValidate' => array('width'=>'300','height'=>'300'),
                    'allowedExtensions'=>array('png','jpg','jpeg','gif'),
                    'actionUrl' => $this->createUrl('upload'),
                ),true)?>
        <?php echo $form->error($user,'img',array('class'=>'help-block')); ?>
    </div>
   
    -->
    <div class="form-group">
        <?php echo $form->labelEx($user,'email',array('class'=>'control-label')); ?>
        <?php echo $form->textField($user,'email',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
        <i class="fa fa-at"></i>
        <?php echo $form->error($user,'email',array('class'=>'help-block')); ?>
    </div>
   
    <div class="form-group">
        <?php echo $form->labelEx($user,'name',array('class'=>'control-label')); ?>
        <?php echo $form->textField($user,'name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <i class="fa fa-user"></i>
        <?php echo $form->error($user,'name',array('class'=>'help-block')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($user,'phone',array('class'=>'control-label')); ?>
        <?php echo $form->textField($user,'phone',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <i class="fa fa-phone"></i>
        <?php echo $form->error($user,'phone',array('class'=>'help-block')); ?>
    </div>
   
    <div class="form-group">
        <?php echo $form->labelEx($user,'address',array('class'=>'control-label')); ?>
        <?php echo $form->textField($user,'address',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <i class="fa fa-map-marker"></i>
        <?php echo $form->error($user,'address',array('class'=>'help-block')); ?>
    </div>
   
    <div class="form-group">
        <?php echo $form->labelEx($user,'birthdate',array('class'=>'control-label')); ?>
            <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $user,
                'attribute' => 'birthdate',
                'language' =>  Yii::app()->language,
                'htmlOptions' => array('class'=>'form-control'),
                'options' => array(
                    'showButtonPanel' => true,
                    'changeYear' => true,
                    'dateFormat' => 'yy-mm-dd',
                ),
            ),true) ?>
            <i class="fa fa-calendar"></i>
        <?php echo $form->error($user,'birthdate',array('class'=>'help-block')); ?>
    </div>
   
    <!--
    <div class="form-group">
        <?php echo $form->labelEx($user,'lastname',array('class'=>'control-label')); ?>
        <?php echo $form->textField($user,'lastname',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($user,'lastname',array('class'=>'help-block')); ?>
    </div>

    
    <div class="form-group">
        <?php echo $form->labelEx($user,'newPassword',array('class'=>'control-label')); ?>
        <?php echo $form->passwordField($user,'newPassword',array('class'=>'form-control',"placeholder"=>$user->getAttributeLabel('newPassword'))); ?>
        <?php echo $form->error($user,'newPassword',array('class'=>'help-block')); ?>
    </div>
    -->
    
    <?php echo CHtml::submitButton(Yii::t('app','Change'),array("class"=>"btn pull-right btn-lg btn-qubico ")); ?>
    <?php $this->endWidget(); ?>

  </div>
    <div class="col-lg-6"></div>
  
</div>
    </div>
</section>
