<section id="contact">
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Contact Me</h2>
            <hr class="star-primary">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
            <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
            <form action="#" id="contact-form">
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                        
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Email Address</label>
                        <input type="text" class="form-control" placeholder="Email Address" id="email" name="email">
                        
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" placeholder="Phone Number" id="phone" name="phone">
                        
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Message</label>
                        <textarea rows="5" class="form-control" placeholder="Message" id="message" name="message"></textarea>
                        
                    </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <button type="submit" class="btn btn-success btn-lg">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</section>
<script type="text/javascript">
$(function(){

$(document).on('submit','#contact-form',function(e) {
    
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
            $('[name='+name.name+']')
              .parent()
              .find('#validate-'+name.name)
              .remove();
          });

          if(data.success) {
            // here submit 
            // $.fn.modal(data.message,'');
            window.location.reload(true);
            //$(".mb_go1").fancybox().trigger("click");
          } else {

            $.each(data.data, function(name, errors) {
              $('[name='+name+']')
              .parent()
              .append($('<p id="validate-'+name+'" class="help-block text-danger">'+errors.join(',<br>')+'</p>'));
            });
          }
        }
    });
});

})
</script>