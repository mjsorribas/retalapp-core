  <section class="jumbotron2">
    	<div class="container">
            <h2><?=$contact->title?><small><?=$contact->subtitle?></small></h2>
        </div>
    </section>
    
    <section class="content" id="contact">
    	<div class="container">
            <div class="row">
            	<div class="col-sm-6">
                	<h2>Leave a message</h2>
                    <form action="#" id="contact-form">
                        <fieldset>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="name">Your name:<span>*</span></label>
                                    <input type="text" class="form-control " placeholder="Your name:" id="name" name="name">
                                </div>                               
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="email2">Your email:<span>*</span></label>
                                    <input type="text" class="form-control " placeholder="Your email:" id="email" name="email">
                                </div>
                            </div>
                            
                            <div class="row">
                            	<div class="form-group col-sm-12">
                                    <label for="phone">Your phone:</label>
                                    <input type="text" class="form-control " placeholder="Your phone:" id="phone" name="phone">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="message">Your message:<span>*</span></label>
                                    <?php
                                        if(isset($_GET['subject'])) {
                                            $content=$_GET['subject'];
                                        } else {
                                            $content='';
                                        }
                                    ?>
                                    <textarea class="form-control" placeholder="Your message:" id="message" name="message"><?=$content?></textarea>
                                    <button type="submit" id="send" class="btn btn-primary btn-sm"><i class="fa fa-check"></i>Submit</button>
                                    <span class="form-info"><span class="required">*</span> These fields are required</span>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-sm-6">
                	<h2>Contact</h2>
                    <p><?=r()->format->toBr($contact->contact_text)?></p>
                	<ul class="list-unstyled contact-address">
                    	<li><?=$contact->address?></li>
                        <li><a href="emailto:<?=$contact->email?>"><?=$contact->email?></a></li>
                        <li><a href="callto://<?=$contact->phone?>"><?=$contact->phone?></a></li>
                    </ul>
                    <ul class="brands brands-md brands-inline brands-transition brands-circle main">
                        <?php if(!empty($contact->facebook)):?>
                        <li><a href="<?=$contact->facebook?>"><i class="fa fa-facebook"></i></a></li>
                    	<?php endif;?>
                        <?php if(!empty($contact->twitter)):?>
                        <li><a href="<?=$contact->twitter?>"><i class="fa fa-twitter"></i></a></li>
                        <?php endif;?>
                        <?php if(!empty($contact->google_plus)):?>
                        <li><a href="<?=$contact->google_plus?>"><i class="fa fa-google-plus"></i></a></li>
                        <?php endif;?>
                        <?php if(!empty($contact->linked_in)):?>
                        <li><a href="<?=$contact->linked_in?>"><i class="fa fa-linkedin"></i></a></li>
                        <?php endif;?>
                        <?php if(!empty($contact->youtube)):?>
                        <li><a href="<?=$contact->youtube?>"><i class="fa fa-youtube"></i></a></li>
                        <?php endif;?>
                        <?php if(!empty($contact->skype)):?>
                        <li><a href="skype:<?=$contact->skype?>?call"><i class="fa fa-skype"></i></a></li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>            
        </div>
    </section>  
    
    <section id="google-map">
    	<div id="map-canvas"></div>
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

    //GOOGLE MAP
    var myLatlng = new google.maps.LatLng(<?=$contact->map_address_lat?>,<?=$contact->map_address_lng?>);
    var mapOptions = {
      zoom: 8,
      center: myLatlng,
      navigationControl: false,
      mapTypeControl: false,
      scaleControl: false,
      draggable: true,
      scrollwheel: false
    }

    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title:"We are here!"
    });
})
</script>
 