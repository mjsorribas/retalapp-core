<!-- ////////////////////////////// -->
<!--          REGISTER              -->
<!-- ////////////////////////////// -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <?php $form=$ctr->beginWidget('CActiveForm', array(
        'id'=>'registration-form',
        'action'=>$ctr->createUrl('/'.$module->id.'/page/register'),
        'htmlOptions'=>array("class"=>"form-signin"),
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="registerModalLabel"><?php echo Yii::t('app','Sign Up')?></h4>
      </div>
    <div class="modal-body">
    <?php #echo $form->errorSummary($register,"","",array("class"=>"alert alert-danger")); ?>
    
    <em><small><?php echo Yii::t('app',"You have an account?")?> <?php echo CHtml::link(Yii::t('app',"Sign In"),array('#'),array("class"=>"module-users-login"))?></small></em>
    
    <div class="form-group">
        <?php echo $form->labelEx($register,'name',array('class'=>'control-label')); ?>
        <?php echo $form->textField($register,'name',array('class'=>'form-control',"placeholder"=>$register->getAttributeLabel('name'))); ?>
        <?php echo $form->error($register,'name',array('class'=>'help-block')); ?>
    </div>  
     
     <div class="form-group">
        <?php echo $form->labelEx($register,'lastname',array('class'=>'control-label')); ?>
        <?php echo $form->textField($register,'lastname',array('class'=>'form-control',"placeholder"=>$register->getAttributeLabel('lastname'))); ?>
        <?php echo $form->error($register,'lastname',array('class'=>'help-block')); ?>
     </div>
    
     <div class="form-group">
        <?php echo $form->labelEx($register,'email',array('class'=>'control-label')); ?>
        <?php echo $form->textField($register,'email',array('class'=>'form-control',"placeholder"=>$register->getAttributeLabel('email'))); ?>
        <?php echo $form->error($register,'email',array('class'=>'help-block')); ?>
     </div>

     <?php if(!$module->sendPassword):?>
     <div class="form-group">
        <?php echo $form->labelEx($register,'password',array('class'=>'control-label')); ?>
        <?php echo $form->passwordField($register,'password',array('class'=>'form-control',"placeholder"=>$register->getAttributeLabel('password'))); ?>
        <?php echo $form->error($register,'password',array('class'=>'help-block')); ?>
     </div>
    
     <div class="form-group">
        <?php echo $form->labelEx($register,'confirmPassword',array('class'=>'control-label')); ?>
        <?php echo $form->passwordField($register,'confirmPassword',array('class'=>'form-control',"placeholder"=>$register->getAttributeLabel('confirmPassword'))); ?>
        <?php echo $form->error($register,'confirmPassword',array('class'=>'help-block')); ?>
     </div>

     <?php endif;?>

    <div class="form-group">
     <?php echo $form->checkBox($register,'conditions'); ?>
     <?php echo $form->label($register,'conditions'); ?> <br>
     <?php echo $form->error($register,'conditions',array('class'=>'help-block')); ?>
    </div>
    

  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <?php echo CHtml::submitButton(Yii::t('app','Sign up'),array("class"=>"btn btn-lg btn-primary")); ?>
      </div>
    <?php $ctr->endWidget(); ?>
    
    </div>
  </div>
</div>

<!-- ////////////////////////////// -->
<!--          LOGIN                 -->
<!-- ////////////////////////////// -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
  <?php $form=$ctr->beginWidget('CActiveForm', array(
    'id'=>'login-form',
    'action'=>$ctr->createUrl('/'.$module->id.'/page/login'),
    'htmlOptions'=>array("class"=>"form-signin"),
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>false,
    'clientOptions'=>array(
      'validateOnSubmit'=>true
    ),
  )); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="loginModalLabel"><?php echo Yii::t('app','Sign In')?></h4>
      </div>
    <div class="modal-body">
  <?php #echo $form->errorSummary($login,"","",array("class"=>"alert alert-danger")); ?>
    
  <em><small><?php echo Yii::t('app',"You do not have an account yet?")?> <?php echo CHtml::link(Yii::t('app',"Sign Up"),array('#'),array("class"=>"module-users-register"))?></small></em>
  <em><small>, If fotgot your password please <?php echo CHtml::link(Yii::t('app',"click here"),array('#'),array("class"=>"module-users-forgot"))?></small></em>

    <div class="form-group">
        <?php echo $form->labelEx($login,'username',array('class'=>'control-label')); ?>
        <?php echo $form->textField($login,'username',array('class'=>'form-control',"placeholder"=>$login->getAttributeLabel('username'))); ?>
        <?php echo $form->error($login,'username',array('class'=>'help-block')); ?>
    </div>  
    
     <div class="form-group">
        <?php echo $form->labelEx($login,'password',array('class'=>'control-label')); ?>
        <?php echo $form->passwordField($login,'password',array('class'=>'form-control',"placeholder"=>$login->getAttributeLabel('password'))); ?>
        <?php echo $form->error($login,'password',array('class'=>'help-block')); ?>
     </div>
    
    <div class="form-group">
     <?php echo $form->checkBox($login,'rememberMe'); ?>
     <?php echo $form->label($login,'rememberMe'); ?> <br>
    </div>
    
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       <?php echo CHtml::submitButton(Yii::t('app','Sign in'),array("class"=>"btn btn-lg btn-primary")); ?>
     </div>
  <?php $ctr->endWidget(); ?>
    
    </div>
  </div>
</div>


<!-- ////////////////////////////// -->
<!--          FORGOT                -->
<!-- ////////////////////////////// -->
<div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="forgotModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
  <?php $form=$ctr->beginWidget('CActiveForm', array(
      'id'=>'recover-form',
      'action'=>$ctr->createUrl('/'.$module->id.'/page/forgot'),
      'htmlOptions'=>array("class"=>"form-signin"),
      'enableAjaxValidation'=>true,
      'enableClientValidation'=>false,
      'clientOptions'=>array(
        'validateOnSubmit'=>true,
      ),
  )); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="forgotModalLabel"><?php echo Yii::t('app','Forgot')?></h4>
      </div>
    <div class="modal-body">
  <?php #echo $form->errorSummary($forgot,"","",array("class"=>"alert alert-danger")); ?>
    
    <em><small><?php echo CHtml::link(Yii::t('app',"Sign Up"),array('#'),array('class'=>'module-users-register'))?>, <?php echo CHtml::link(Yii::t('app',"Sign In"),array('#'),array('class'=>'module-users-login'))?></small></em>

    
    <div class="form-group">
        <?php echo $form->labelEx($forgot,'email',array('class'=>'control-label')); ?>
        <?php echo $form->textField($forgot,'email',array('class'=>'form-control',"placeholder"=>$forgot->getAttributeLabel('email'))); ?>
        <?php echo $form->error($forgot,'email',array('class'=>'help-block')); ?>
    </div>  
        
   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <?php echo CHtml::submitButton(Yii::t('app','Remenber'),array("class"=>"btn btn-lg btn-primary")); ?>
     </div>
  <?php $ctr->endWidget(); ?>
    
    </div>
  </div>
</div>

    

<!-- ////////////////////////////// -->
<!--          PROFILE               -->
<!-- ////////////////////////////// -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
  <?php $form=$ctr->beginWidget('CActiveForm', array(
        'id'=>'users-form',
        'action'=>$ctr->createUrl('/'.$module->id.'/page/profile'),
        'htmlOptions'=>array("class"=>"form-horizontal","role"=>"form"),
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array(
            'validateOnSubmit'=>true
        ),
  )); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="profileModalLabel"><?php echo Yii::t('app','Profile')?></h4>
      </div>
    <div class="modal-body">
    <div class="row">
    
    <?php #echo $form->errorSummary($user,"","",array("class"=>"alert alert-danger")); ?>
    <div class="col-lg-6">

    <div class="form-group" style="margin-left:0;margin-right:0;">
        <?php echo $form->labelEx($user,'email',array('class'=>'control-label')); ?>
        <?php echo $form->textField($user,'email',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
        <?php echo $form->error($user,'email',array('class'=>'help-block')); ?>
    </div>
   
    <div class="form-group" style="margin-left:0;margin-right:0;">
        <?php echo $form->labelEx($user,'name',array('class'=>'control-label')); ?>
        <?php echo $form->textField($user,'name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($user,'name',array('class'=>'help-block')); ?>
    </div>
   
    <div class="form-group" style="margin-left:0;margin-right:0;">
        <?php echo $form->labelEx($user,'lastname',array('class'=>'control-label')); ?>
        <?php echo $form->textField($user,'lastname',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($user,'lastname',array('class'=>'help-block')); ?>
    </div>

    <div class="form-group" style="margin-left:0;margin-right:0;">
        <?php echo $form->labelEx($user,'address',array('class'=>'control-label')); ?>
        <?php echo $form->textField($user,'address',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($user,'address',array('class'=>'help-block')); ?>
    </div>

    <div class="form-group" style="margin-left:0;margin-right:0;">
        <?php echo $form->labelEx($user,'phone',array('class'=>'control-label')); ?>
        <?php echo $form->textField($user,'phone',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($user,'phone',array('class'=>'help-block')); ?>
    </div>

    <div class="form-group" style="margin-left:0;margin-right:0;">
        <?php echo $form->labelEx($user,'birthdate',array('class'=>'control-label')); ?>
        <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $user,
                'attribute' => 'birthdate',
                'language' =>  Yii::app()->language,
                'htmlOptions' => array('class'=>'form-control',"autocomplete"=>'off'),
                'options' => array(
                    'showButtonPanel' => true,
                    'changeYear' => true,
                    'dateFormat' => 'yy-mm-dd',
                ),
            ));
        ?>
        <?php echo $form->error($user,'birthdate',array('class'=>'help-block')); ?>
    </div>
    
    <div class="form-group" style="margin-left:0;margin-right:0;">
        <?php echo $form->labelEx($user,'newPassword',array('class'=>'control-label')); ?>
        <?php echo $form->passwordField($user,'newPassword',array('class'=>'form-control',"placeholder"=>$user->getAttributeLabel('newPassword'),"autocomplete"=>'off')); ?>
        <?php echo $form->error($user,'newPassword',array('class'=>'help-block')); ?>
    </div>            
        </div>

        <div class="col-lg-6">
            <div class="">
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
        </div>
        
    </div>
    </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <?php echo CHtml::submitButton(Yii::t('app','Change'),array("class"=>"btn btn-lg btn-primary")); ?>
     </div>
  <?php $ctr->endWidget(); ?>
    
    </div>
  </div>
</div>
