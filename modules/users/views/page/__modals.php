<!-- login-modal Modal -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action"#" id="login-form-1" role="form">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="login-modalLabel">Ingresar</h4>
          </div>
          <div class="modal-body">
            
              <div class="form-group">
                <label for="recipient-name" class="control-label">Username:</label>
                <input name="username" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Password:</label>
                <input name="password" type="password" class="form-control">
              </div>
              <a href="#" class="register-modal"><?=r('app','Register')?></a>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Entrar</button>
          </div>
        </form>
    </div>
  </div>
</div>

<!-- register-modal Modal -->
<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="register-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action"#" id="register-form-1" role="form">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="register-modalLabel">Registrarse</h4>
          </div>
          <div class="modal-body">
            
              <div class="form-group">
                <label for="recipient-name" class="control-label">Email:</label>
                <input name="email" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Nombre:</label>
                <input name="name" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Apellido:</label>
                <input name="lastname" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Password:</label>
                <input name="password" type="password" class="form-control">
              </div>
              
              <div class="form-group">
                 <input name="conditions" value="1" type="checkbox">     
                 <label for="conditions">I accept terms and conditions.</label> <br>
              </div>

              <br>

              <a href="#" class="login-modal"><?=r('app','Login')?></a>
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
          </div>
        </form>
    </div>
  </div>
</div>

<!-- recover-modal Modal -->
<div class="modal fade" id="recover-modal" tabindex="-1" role="dialog" aria-labelledby="recover-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action"#" id="recover-form-1" role="form">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="recover-modalLabel">Recuperar contraseña</h4>
          </div>
          <div class="modal-body">
            
              <div class="form-group">
                <label for="recipient-name" class="control-label">Ingrese su email registrado:</label>
                <input name="email" type="text" placeholder="Ingrese su email registrado" class="form-control">
                <i class="fa fa-at"></i>
              </div>
              
          </div>
          <div class="modal-footer">
            <button type="button" class="btn-link" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary btn-qubico">Enviar</button>
          </div>
        </form>
    </div>
  </div>
</div>

<!-- change-modal Modal -->
<div class="modal fade" id="change-modal" tabindex="-1" role="dialog" aria-labelledby="change-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action"#" id="change-form-1" role="form">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="change-modalLabel">Change password</h4>
          </div>
          <div class="modal-body">
            
              <div class="form-group">
                <label for="recipient-name" class="control-label">Current password:</label>
                <input name="oldPassword" type="password" class="form-control">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">New password:</label>
                <input name="newPassword" type="password" class="form-control">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Confirm New password:</label>
                <input name="confirmNewPassword" type="password" class="form-control">
              </div>
              
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?=r('app','Close')?></button>
            <button type="submit" class="btn btn-primary"><?=r('app','Send')?></button>
          </div>
        </form>
    </div>
  </div>
</div>

<div class="modal signUpContent fade" id="conditions-modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
        <h3 class="modal-title-site text-center" > Términos y condiciones </h3>
      </div>
      <div class="modal-body" style="height: 300px;overflow-y: scroll;">
        <?php /* @@TODO echo $shopping_conditions->conditions*/?>
      </div>
      <div class="modal-footer">
        <p class="text-center"> 
          <a data-dismiss="modal" href="#"> Cerrar </a> <br>
        </p>
      </div>
    </div>
  </div>
  
</div>
<!-- ==============================================
SCRIPTS
=============================================== --> 


<script type="text/javascript">
jQuery(document).ready(function($) {
    <?php if(isset($_GET['showLoginform'])):?>
      $('#login-modal').modal("show");
    <?php endif;?>
    $(document).on('click','.login-modal',function (e) {
      e.preventDefault();
      $('#register-modal').modal("hide");
      $('#recover-modal').modal("hide");
      $('#change-modal').modal("hide");
      $('#login-modal').modal("show");

    });

    $(document).on('click','.register-modal',function (e) {
      e.preventDefault();
      $('#login-modal').modal("hide");
      $('#recover-modal').modal("hide");
      $('#change-modal').modal("hide");
      $('#register-modal').modal("show");
    });

    $(document).on('click','.recover-modal',function (e) {
      e.preventDefault();
      
      $('#login-modal').modal("hide");
      $('#change-modal').modal("hide");
      $('#recover-modal').modal("show");
      $('#register-modal').modal("hide");
    });

    $(document).on('click','.change-modal',function (e) {
      e.preventDefault();

      $('#login-modal').modal("hide");
      $('#register-modal').modal("hide");
      $('#recover-modal').modal("hide");
      $('#change-modal').modal("show");

    });

$(document).on('submit','#login-form-1, #login-form-3',function(e) {

    e.preventDefault();
    var $form = $(this);
    $.ajax({
        url: '<?php echo $this->createUrl("/users/page/loginAjax");?>',
        dataType: 'json',
        type: 'post',
        data: $form.serialize(),
        success: function (data){

          console.log(data);

          $.each($form.serializeArray(), function(index, name) {
            $form.find('[name='+name.name+']')
              .parent()
              .find('#validate-'+name.name)
              .remove();
          });

          if(data.success) {
            
            window.location.href=data.redirect;
            // $('#login-modal').modal("hide");
            // $form[0].reset();
            // bootbox.alert((data.message));

          } else {

            $.each(data.data, function(name, errors) {
              $form.find('[name='+name+']')
              .parent()
              .append($('<span id="validate-'+name+'" style="color:#c0392b;font-size:16px">'+errors.join(',<br>')+'</span>'));
            });
          }
        }
    });
});


$(document).on('submit','#register-form-1, #register-form-3',function(e) {

    e.preventDefault();
    var $form = $(this);
    $.ajax({
        url: '<?php echo $this->createUrl("/users/page/registerAjax");?>',
        dataType: 'json',
        type: 'post',
        data: $form.serialize(),
        success: function (data){

          console.log(data);

          $.each($form.serializeArray(), function(index, name) {
            $form.find('[name='+name.name+']')
              .parent()
              .find('#validate-'+name.name)
              .remove();
          });

          if(data.success) {
            
            $('#register-modal').modal("hide");
            $form[0].reset();
            bootbox.alert((data.message));

          } else {

            $.each(data.data, function(name, errors) {
              $form.find('[name='+name+']')
              .parent()
              .append($('<span id="validate-'+name+'" style="color:#c0392b;font-size:16px">'+errors.join(',<br>')+'</span>'));
            });
          }
        }
    });
});


$(document).on('submit','#recover-form-1',function(e) {

    e.preventDefault();
    var $form = $(this);
    $.ajax({
        url: '<?php echo $this->createUrl("/users/page/forgotAjax");?>',
        dataType: 'json',
        type: 'post',
        data: $form.serialize(),
        success: function (data){

          console.log(data);

          $.each($form.serializeArray(), function(index, name) {
            $form.find('[name='+name.name+']')
              .parent()
              .find('#validate-'+name.name)
              .remove();
          });

          if(data.success) {
            function strip(html) {
               var tmp = document.createElement("DIV");
               tmp.innerHTML = html;
               return tmp.textContent || tmp.innerText || "";
            }
            // here submit
            
            $('#recover-modal').modal("hide");
            $form[0].reset();
            bootbox.alert((data.message));
          } else {

            $.each(data.data, function(name, errors) {
              $form.find('[name='+name+']')
              .parent()
              .append($('<span id="validate-'+name+'" style="color:#c0392b;font-size:16px">'+errors.join(',<br>')+'</span>'));
            });
          }
        }
    });
});


$(document).on('submit','#change-form-1',function(e) {

    e.preventDefault();
    var $form = $(this);
    $.ajax({
        url: '<?php echo $this->createUrl("/users/page/changePasswordAjax");?>',
        dataType: 'json',
        type: 'post',
        data: $form.serialize(),
        success: function (data){

          console.log(data);

          $.each($form.serializeArray(), function(index, name) {
            $form.find('[name='+name.name+']')
              .parent()
              .find('#validate-'+name.name)
              .remove();
          });

          if(data.success==1 || data.success==2) {
            
            $('#change-modal').modal("hide");
            $form[0].reset();
            bootbox.alert((data.message));

          } else {

            $.each(data.data, function(name, errors) {
              $form.find('[name='+name+']')
              .parent()
              .append($('<span id="validate-'+name+'" style="color:#c0392b;font-size:16px">'+errors.join(',<br>')+'</span>'));
            });
          }
        }
    });
});

  $(document).on('click','.module-users-perfil',function (e) {
    e.preventDefault();
    var href = $(e.currentTarget).attr('href');
      $.ajax({
        url: '<?=$this->createUrl("/users/page/isGuest")?>',
        type: 'post',
        dataType: 'json',
        success: function (data) {
          if(data.success) {
            $('.login-modal').click();
          } else {
            window.location.href=href;
          }
        }
      });
  })

////////////////////////////////////
// LOGIN FACEBOOK
////////////////////////////////////
$(document).on('click','.facebook-login',function(e){
    e.preventDefault();
    
    FB.login(function(response){
  
        console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
          // Logged into your app and Facebook.
            console.log('Connected!!');

            FB.api('/me', function(response) {
              
              //console.log(response);
              $.ajax({
                url: '<?php echo $this->createUrl("/users/page/facebookRegisterAjax");?>',
                dataType: 'json',
                type: 'post',
                data: response,
                success: function (data){

                  console.log(data);
                  if(data.success) {
                    window.location.href=data.redirect;
                  } else {
                    bootbox.alert((data.message));
                  }
                }
            });
            });
        } else if (response.status === 'not_authorized') {
          // The person is logged into Facebook, but not your app.
          console.log('Not_authorized!!');
          bootbox.alert('Por favor intenta ingresar nuevamente y asegutrate de aceptar los permisos que solicita nuestra aplicación.');
        } else {
          bootbox.alert('Por favor intenta ingresar nuevamente y asegutrate de aceptar los permisos que solicita nuestra aplicación.');
          console.log('Not_session_yet!!');
          // The person is not logged into Facebook, so we're not sure if
          // they are logged into this app or not.
        }
    },{scope: 'public_profile,email'});
});

$(document).on('click','.action-url',function(e){
    e.preventDefault();
    window.location.href=$(this).data('url');
});
  
$('[data-toggle="tooltip"]').tooltip();

});
</script>