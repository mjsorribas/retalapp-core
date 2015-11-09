<?php
/* @var $this SiteController */
/* @var $user LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('app','Sign In');
?>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->



    <div class="container container-page">
        <div class="row">

    <div class="col-lg-6">
      <div class="col-sm-10 col-sm-offset-2">
    <h1><?=Yii::t('app','Ingresar')?></h1>
<?php if(r('users')->fb_appId!==null):?>
<a href="#" class="facebook-login btn btn-facebook btn-block">
    <i class="fa fa-facebook"></i>
    Ingresar con Facebook
</a>
<?php endif;?>

<form class="form-signin" id="login-form-3" action="#" method="post">    
    <div class="form-group success">
        <label class="control-label required" for="LoginForm_username">Usuario o email <span class="required">*</span></label>
        <input class="form-control" placeholder="Email" name="username" id="LoginForm_username" type="text">        
        <i class="fa fa-at"></i>
    </div>  
    
     <div class="form-group success">
        <label class="control-label required" for="LoginForm_password">Contraseña <span class="required">*</span></label>
        <input class="form-control" placeholder="Contraseña" name="password" id="LoginForm_password" type="password">        
        <i class="fa fa-key"></i>
    </div>
    
    <input class="btn pull-right btn-lg btn-primary" type="submit" name="yt0" value="Ingresar">    
</form>      

    

    <?php if($this->module->allowRegister):?>
      <p>Si olvidó su contraseña <a data-toggle="modal" href="#recover-modal">recuperela desde aquí</a></p>
    <br>
    <?php endif;?>

  </div>
  </div>
    <div class="col-lg-6">

   <div class="col-sm-10 col-sm-offset-2">
   
    <?php if($this->module->allowRegister):?>
    
      <h1><?=Yii::t('app','Registrarse')?></h1>
     
      <form class="form-signin" id="register-form-3" action="#" method="post">  
        
        <div class="form-group success">
          <label class="control-label required" for="Users_name">Nombre <span class="required">*</span></label>      
          <input class="form-control" placeholder="Nombre" name="name" id="Users_name" type="text" maxlength="255">
          <i class="fa fa-user"></i>
        </div>  
      
        <div class="form-group success">
          <label class="control-label required" for="Users_email">Correo <span class="required">*</span></label>    
          <input class="form-control" placeholder="Correo" name="email" id="Users_email" type="text" maxlength="128">
          <i class="fa fa-at"></i>
        </div>

        <div class="form-group success">
          <label class="control-label required" for="Users_password">Contraseña <span class="required">*</span></label>    
          <input class="form-control" placeholder="Contraseña" name="password" id="Users_password" type="password" maxlength="128">
          <i class="fa fa-key"></i>
        </div>
       
        <div class="form-group error">
           <input name="conditions" id="Users_conditions" value="1" type="checkbox">     
           <label for="Users_conditions">Acepto Términos y condiciones.</label> <br> <em>Acepto términos y condiciones</em>
        </div>
        <input class="pull-right btn btn-lg btn-primary" type="submit" name="yt1" value="Registrarme"> 
      </form>

    <?php endif;?>
  
      
    </div>
    </div>
  
</div>
    </div>



