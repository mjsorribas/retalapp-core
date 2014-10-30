<?php
/* @var $this SiteController */
/* @var $user LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('app','Sign In');
?>
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><?php echo Yii::t('app','Sign In')?></h2>
                <hr class="star-light">
            </div>
        </div>
    </div>
</header>
<section>
    <div class="container">
        <div class="row">

    <div class="col-lg-3"></div>
    <div class="col-lg-6">
    <em><small><?php echo Yii::t('app',"You do not have an account yet?")?> <?php echo CHtml::link(Yii::t('app',"Sign Up"),$this->module->urlRegister)?></small></em>
<em><small>, If fotgot your password please <?php echo CHtml::link(Yii::t('app',"click here"),$this->module->urlForgot)?></small></em>

    <?php $form=$this->beginWidget('CActiveForm', array(
      'id'=>'login-form',
      'htmlOptions'=>array("class"=>"form-signin"),
      'enableAjaxValidation'=>true,
      'clientOptions'=>array('validateOnSubmit'=>true),
    )); ?>
    <?php #echo $form->errorSummary($model,"","",array("class"=>"alert alert-danger")); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model,'username',array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'username',array('class'=>'form-control',"placeholder"=>$model->getAttributeLabel('username'))); ?>
        <?php echo $form->error($model,'username',array('class'=>'help-block')); ?>
    </div>  
    
     <div class="form-group">
        <?php echo $form->labelEx($model,'password',array('class'=>'control-label')); ?>
        <?php echo $form->passwordField($model,'password',array('class'=>'form-control',"placeholder"=>$model->getAttributeLabel('password'))); ?>
        <?php echo $form->error($model,'password',array('class'=>'help-block')); ?>
     </div>
    
    <div class="form-group">
     <?php echo $form->checkBox($model,'rememberMe'); ?>
     <?php echo $form->label($model,'rememberMe'); ?> <br>
    </div>
    
    <?php echo CHtml::submitButton(Yii::t('app','Sign in'),array("class"=>"btn pull-left btn-lg btn-primary button")); ?>
    <?php $this->endWidget(); ?>

  </div>
    <div class="col-lg-3"></div>
  
</div>
    </div>
</section>
