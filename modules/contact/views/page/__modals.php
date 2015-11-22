<?php $contact=ContactInfo::model()->find(); ?>
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
            <button type="submit" class="btn btn-primary"><?=r('app','Enviar')?></button>
          </div>
        </form>
    </div>
  </div>
</div>

<div class="modal fade" id="suscribe-modal" tabindex="-1" role="dialog" aria-labelledby="suscribe-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action"#" id="suscribe-form-1" role="form">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="suscribe-modalLabel">Suscribase a nuestor boletín</h4>
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
                  
                  
                  
                  
              </fieldset>
                 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn-link" data-dismiss="modal"><?=r('app','Close')?></button>
            <button type="submit" class="btn btn-primary"><?=r('app','Enviar')?></button>
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

  $(document).on('click','.suscribe-modal',function (e) {
    e.preventDefault();
    $('#suscribe-modal').modal("show");
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
            if(bootbox) {
              bootbox.alert(data.message);
            } else {
              alert(data.message);
            }

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

  $(document).on('submit','#suscribe-form-1, #suscribe-form-2',function(e) {
    e.preventDefault();
    var $form = $(this);
    $.ajax({
        url: '<?php echo $this->createUrl("/contact/page/newsJson");?>',
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
            $('#suscribe-modal').modal("hide");
            $form[0].reset();
            if(bootbox) {
              bootbox.alert(data.message);
            } else {
              alert(data.message);
            }

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

});
  <?php  // <script src="//maps.googleapis.com/maps/api/js?v=3.exp"></script> ?>
    var locations = [
      /*Marker*/
      ['<div class="row tool-map">'+
        // '<div class="col-xs-6"><img src="<?=r()->theme->baseUrl?>/img/map-img.jpg"></div>'+
        '<div class="col-xs-12 col-info-contact">'+
          // '<h4><?=$contact->address?></h4>'+
          '<p><?=$contact->address?></p>'+
          '<p><a href="emailto:<?=$contact->email?>"><?=$contact->email?></a></p>'+
          '<p><a href="callto://<?=$contact->phone?>"><?=$contact->phone?></a></p>'+
        '</div>'+
      '</div>', <?=$contact->map_address_lat?>, <?=$contact->map_address_lng?>],
    ],
    map = new google.maps.Map(document.getElementById("map-canvas"), {
      scrollwheel: false,
      zoom: 18,
      // center: new google.maps.LatLng(4.598056, -74.075833)
    }),
    image = {
      url: "<?=r()->theme->baseUrl?>/img/marker.png",
      size: new google.maps.Size(48, 42),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(16, 42)
    },
    infowindow = new google.maps.InfoWindow(), marker, i;
    function infoMarker(marker, i, location) {
      return function() {
        infowindow.setContent(location[0]);
        infowindow.open(map, marker);
      };
    }

    function setMarkers(data) {

      var bounds = new google.maps.LatLngBounds();
      for (i = 0; i < data.length; i = i + 1) {
        marker = new google.maps.Marker({
          icon: image,
          position: new google.maps.LatLng(data[i][1], data[i][2]),
          map: map,
          zIndex: data[3]
        });
      bounds.extend(marker.position);
        google.maps.event.addListener(marker, "click", (infoMarker(marker, i, data[i])));
      }

      map.fitBounds(bounds);

      document.addEventListener("DOMContentLoaded", function() {
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
      });
    }

    setMarkers(locations);
</script>
