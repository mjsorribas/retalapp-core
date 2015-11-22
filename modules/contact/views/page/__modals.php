<?php
$contact_contact=ContactInfo::model()->find();
?>
<!-- contact-modal Modal -->
<div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="contact-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action"#" id="contact-form-2" role="form">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="contact-modalLabel">Contáctenos</h4>
            <!--
            <h4 class="modal-title" id="contact-modalLabel"><?=r('app','Contact us')?></h4>
            -->
          </div>
          <div class="modal-body">
            
              <fieldset>
                  <div class="row">
                      <div class="form-group col-sm-12">
                          <label for="name"><?=r('app','Name')?>:<span>*</span></label>
                          <?php $nameValue=(r()->user->isGuest)?"":r()->user->name;?>
                          <input type="text" class="form-control " placeholder="Nombre" id="name" name="name" value="<?=$nameValue?>">
                          <i class="fa fa-user"></i>
                      </div>                               
                  </div>
                  
                  <div class="row">
                      <div class="form-group col-sm-12">
                          <label for="email2"><?=r('app','Email')?>:<span>*</span></label>
                          <?php $emailValue=(r()->user->isGuest)?"":r()->user->email;?>
                          <input type="text" class="form-control " placeholder="Email" id="email" name="email" value="<?=$emailValue?>">
                          <i class="fa fa-at"></i>
                      </div>
                  </div>
                  
                  <div class="row">
                    <div class="form-group col-sm-12">
                          <label for="phone"><?=r('app','Phone')?>:</label>
                          <input type="text" class="form-control " placeholder="Teléfono" id="phone" name="phone">
                          <i class="fa fa-phone"></i>
                      </div>
                  </div>
                  
                  <div class="row">
                      <div class="form-group col-sm-12">
                          <label for="message"><?=r('app','Message')?>:<span>*</span></label>
                          <textarea class="form-control" id="contact-message-input" placeholder="Mensaje" name="message"></textarea>
                          <i class="fa fa-comment"></i>
                      </div>
                  </div>
              </fieldset>
                 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn-link" data-dismiss="modal"><?=r('app','Close')?></button>
            <button type="submit" class="btn btn-qubico"><?=r('app','Enviar')?></button>
          </div>
        </form>
    </div>
  </div>
</div>

<!-- ==============================================
SCRIPTS
=============================================== --> 

<script type="text/javascript">
jQuery(document).ready(function($) {

  $(document).on('click','.contact-modal',function (e) {
    e.preventDefault();
    var message='';
    if($(this).attr('data-message')) {
      message = $(this).attr('data-message');
    }
    $('#contact-message-input').val(message);
    $('#contact-modal').modal("show");
  });

  $(document).on('submit','#contact-form-1, #contact-form-2',function(e) {
    e.preventDefault();
    var $form = $(this);
    $.ajax({
        url: '<?php echo $this->createUrl("/contact/page/contactJson");?>',
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
            // here submit 
            $('#contact-modal').modal("hide");
            $form[0].reset();
            bootbox.alert(data.message);

          } else {

            $.each(data.data, function(name, errors) {
              $form.find('[name='+name+']')
              .parent()
              .append($('<p id="validate-'+name+'" class="help-block text-danger">'+errors.join(',<br>')+'</p>'));
            });
          }
        }
    });
  });
});
</script>