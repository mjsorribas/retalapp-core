<a class="btn btn-misc" data-toggle="modal" data-target="#mb-codes" type="button"><span class="misc3 pull-left"></span>Códigos</a>





<!--Modal codes-->
<div class="modal fade" id="mb-codes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <button class="close-pro close-mb" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
      <div class="modal-body">
        <h2 class="main-title">Agregar códigos</h2>
        <p>Ingresa tus códigos para conseguir más puntos.</p>
        <hr>
        <div class="row">
        <form id="cart-credits-form" action="" class="grl-form codes-form clearfix" method="post">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-xs-2"></div>
              <div class="con-field col-xs-8 clearfix">
                <h3 style="font-size:1.1em" class="text-left">En que ciudad compraste nuestros productos?</h3>
                
                <select class="form-submiter" id="users_location_states_id" name="users_location_states_id" style="margin-bottom: 10px">
                  <option value="">Departamento</option>
                  <?php foreach($users_location_states as $data): ?>
                  <option value="<?=$data->id;?>"><?=$data->name;?></option>
                  <?php endforeach; ?>
                </select>
                  
                <select class="form-submiter" id="users_location_cities_id" name="users_location_cities_id">
                  <option value="">Ciudad</option>
                </select>
                  
              </div>
              <div class="col-xs-2"></div>
            </div>
          </div>
          <hr>
          <div class="col-sm-12">
            <div class="row">
              <div class="col-xs-2"></div>
              <div class="col-xs-8">
                <h3 style="font-size:1.1em" class="text-left">Códigos <button class="btn" onclick="addFn();"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button></h3>
                  <div class="row row-add">
                    
                    <div class="col-xs-12">
                      <div class="row">
                        <div class="con-field col-xs-8 clearfix">
                          <input name="secret_code[0]" data-id="0" class="form-submiter" placeholder="Introducir" type="text">
                        </div>
                        <div class="col-xs-1 col-verify">
                          <span class="glyphicon glyphicon-minus remove" aria-hidden="true"></span>
                        </div>
                        <div class="col-xs-1 col-verify">
                          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                <hr>
                <div class="col-md-6">
                <!--
                  <input class="btn btn-primary pull-left" type="submit" value="ENVIAR">
                -->
                  
                </div>
                <div class="col-md-6">
                  <h3 style="font-size:1.1em" class="text-right">
                    <strong>Total puntos: </strong>
                    <span class="content-points">0</span>
                  </h3>
                  <a href="#" class="btn btn-default pull-right btn-close">CERRAR</a>
                </div>
              </div>
              <div class="col-xs-2"></div>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Modal codes-->

<!--Modal total-->
<div class="modal fade" id="mb-total" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <button class="close-pro close-mb" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
      <div class="modal-body">
        <h2 class="main-title">Tus puntos</h2>
        <h4>Tus puntos vigentes son: <strong class="content-summary-points">0</strong></h4>
      </div>
    </div>
  </div>
</div>
<!--/ Modal total-->

<!--/ Modal recovery-->
<!--</div>-->
<?php echo $this->builtEndBody()?>



<script src="<?=r()->theme->baseUrl?>/js/bootbox.min.js"></script>
<script>
function addFn() {
  "use strict";
  var lengthItems = $('.row-add').children().length;
  $(".row-add").append("<div class='col-xs-12'><div class='row'><div class='con-field col-xs-8 clearfix'><input data-id='"+lengthItems+"' name='secret_code["+lengthItems+"]' class='form-submiter' placeholder='Introducir' type='text'></div><div class='col-xs-1 col-verify'><span class='glyphicon glyphicon-minus remove' aria-hidden='true'></span></div><div class='col-xs-1 col-verify'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></div></div></div>");
}
$(function(){

$(document).on('click','.btn-close',function(){
  
  $.ajax({
    url: '<?=$this->createUrl("/cart/page/summaryPoints")?>',
    success: function(data){
      $('#mb-codes').modal('hide');
      $('.content-summary-points').html(data);
      $('#mb-total').modal('show');
    }
  });
  
});

$(document).on('keyup change','.form-submiter',function(){
  $('#cart-credits-form').trigger('submit');
});

$.fn.inputMessage = function(selector, type, message, icon) {
  
  var color = type === 'success'?'green':'red';

   $(selector)
    .parent()
    .append($('<p style="text-align:left;color:'+color+'" class="help-block text-danger">'+message+'</p>'));

  var icon = icon || false;
  if(icon) {

  var iconShow = type === 'success'?'glyphicon-ok':'glyphicon-remove';
  var iconRemove = type === 'success'?'glyphicon-remove':'glyphicon-ok';

   $(selector)
    .parent()
    .parent()
    .find('.glyphicon.'+iconRemove)
    .removeClass(iconRemove)
    .addClass(iconShow)
  }
};

$(document).on('submit','#cart-credits-form',function(e) {
  e.preventDefault();
  var $form = $(this);
  $.ajax({
      url: '<?php echo $this->createUrl("/cart/page/creditsAjax");?>',
      dataType: 'json', 
      type: 'post',
      data: $form.serialize(),
      success: function (data){
      
      if(!data.success) {
        $('.help-block.text-danger').remove();

        var message_city = '';
        var message_state = '';
          $.each(data.datas, function(index, name) {
            
            console.log(index);
            if(name.users_location_cities_id) {
              console.log(name.users_location_cities_id[0]);
            message_city = name.users_location_cities_id[0];
          }
            if(name.users_location_states_id) {
              console.log(name.users_location_states_id[0]);
            message_state = name.users_location_states_id[0];
          }
          });

          if(message_city!='') {
            $.fn.inputMessage('[name=users_location_cities_id]','error',message_city);
          }

          if(message_state!='') {
            $.fn.inputMessage('[name=users_location_states_id]','error',message_state);
          }

          $.each(data.datas, function(index, name) {
                      
            console.log(index);
            if(name.secret_code) {
              $.fn.inputMessage('[data-id='+index+']','error',name.secret_code[0],true);
          }

          if(message_city!='') {
              $.fn.inputMessage('[data-id='+index+']','error',message_city+' en el menú superior',true);
          }

          if(message_state!='') {
              $.fn.inputMessage('[data-id='+index+']','error',message_state+' en el menú superior',true);
          }

         });

          $.each(data.ok, function(index, name) {
                      
            console.log('[OK]',index);
            if(message_state=='' && message_city=='' && name.secret_code) {
              $('[data-id='+index+']').prop('disabled','disabled');
              $('[data-id='+index+']').prop('data-ponits',data.pointsPerCode);
              $('.content-points').html(parseInt($('.content-points').html())+data.pointsPerCode);
              $.fn.inputMessage('[data-id='+index+']','success',name.secret_code[0],true);
          }


         });
      }

      }
  });
});
$(document).on('change','#users_location_states_id',function(e){
  var state_id = $(this).val();
  $.ajax({
      url:'<?php echo $this->createUrl("/cart/page/cities")?>',
      data: { state_id: state_id},
      success:function(data){
          $('#users_location_cities_id').html(data);
      }
  });   
});
});
</script>