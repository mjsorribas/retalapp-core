<?php 
$shopping_conditions=ShoppingConditions::model()->find();
$shopping_config=ShoppingConfig::model()->find();
?>
<div class="modal fade product-details-modal" id="shoping-cart-modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-small" style="overflow: scroll">
    <div class="modal-content">
      
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
          <h3 class="modal-title-site text-center" > Tu compra <?php if(!r()->user->isGuest):?><small>Bienvenido <?=r()->user->name?></small><?php endif;?></h3>
        </div>

        <div class="container-shop-cart cartMenu col-lg-12 col-md-12 col-sm-12  col-xs-12" style="padding:0">
          <?php $this->renderPartial('shopping.views.page._cart',array())?>
        </div>   
        
        <div class="col-lg-12">
            <h3 class="text-center mtl">Opciones de pago</h3>
        </div>
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-details no-padding">
        <div class="modal-details-inner">

        <div class="cart-actions hide cart-container-guest-options">
            <div class=" text-center col-md-12">
                <em>Para continuar con el pago debe ingresar o crear su cuenta</em>
            </div>
            <div class=" text-center col-md-12">
                <button data-href="<?=$this->createUrl('/users/page/login')?>" type="button" class="action-login-inorderto-buy btn btn-qubico btn-green" title="Ingresar">
                  Ingresar
                </button>
            </div>
        </div>
        
        <div class="cart-actions hide cart-container-login-options">
        <form action"#" id="shopping-header-form" role="form">
            <input value="0" name="delivery" id="delivery-hidden-field" type="hidden">
            <?php if(!r('shopping')->justBuyRegister):?>
            <div class="col-md-12">
                <div class="form-group login-username">
                    <div>
                        <strong>Nombre *</strong> <br>
                        <input value="<?php echo isset($header['buyer_name'])?$header['buyer_name']:'';?>" name="buyer_name" id="buyer-name-field" class="form-control input"  size="20" placeholder="" type="text">
                            <i style="top: 25px;" class="fa fa-user"></i>
                    </div>
                </div>
                <div class="form-group login-username">
                    <div>
                        <strong>Correo *</strong> <br>
                        <input value="<?php echo isset($header['buyer_email'])?$header['buyer_email']:'';?>" name="buyer_email" id="login-user" class="form-control input"  size="20" placeholder="" type="text">
                            <i style="top: 25px;" class="fa fa-at"></i>
                    </div>
                </div>
            </div>
            <?php endif;?>
            
            <?php if($shopping_config->allow_request):?>
            <div class="col-md-12 text-center">
                <button class="btn btn-qubico btn-green button btn-cart cart first btn-pay-bank" title="Ir a pagar" type="button">
                  Pagar por consignación o giro
                </button>
            </div>
            <div class="col-md-12">
                <em>Una vez seleccionas esta opción recibirás los datos del banco donde realizar la consignación.</em>
            </div>
            <?php endif;?>

            <div class="col-md-12 text-center">
                <button class="btn btn-qubico btn-green button btn-cart cart first btn-pay-online" title="Ir a pagar" type="button">
                  Pagar en línea
                </button>
            </div>
            <div class="col-md-12">
                <img style="width:100%" src="<?=r()->theme->baseUrl?>/img/PayU2.png" alt="">
                <em>Con esta opción podrás pagar de forma electrónica con diferentes opciones incluyendo tarjeta de crédito, débito, consignación bancaria, Efecty y pago en punto Baloto.</em>
            </div>

            <div class="col-md-12">
                <em>Al seleccionar alguna opción de pago estas aceptando los <a data-toggle="modal" href="#conditions-modal" style="  text-decoration: underline;"> Términos y condiciones </a></em>
            </div>

        </form>          
          
        </div>
            

        </div>
        </div>
        <div class="clear"></div>

      <div class="modal-footer">
        <p class="text-center"> 
          <a href="<?=$this->createUrl('/shopping/page/items')?>"> Cerrar y seguir comprando </a> <br>
          <!-- <a data-dismiss="modal" href="#"> Cerrar y seguir comprando </a> <br> -->
        </p>
      </div>
    </div>
</div>
</div>  

<div class="modal fade product-details-modal" id="shoping-cart-free-modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-small" style="overflow: scroll">
    <div class="modal-content">
      
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
          <h3 class="modal-title-site text-center" > Curso tomado </h3>
        </div>

        
        <div class="modal-body col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-details no-padding">
        <div class="modal-details-inner">

            <div class="col-md-12">
                <em>Has tomado este curso y ha sido agregado a la sección de tus cursos</em>
            </div>
            <div class="col-md-12 text-center">
                <a href="<?=$this->createUrl('/shopping/page/myitems')?>" class="btn btn-qubico btn-green button btn-cart cart first" title="Ir a pagar">
                  Ir a mis cursos
                </a>
            </div>
        
        
        </div>
        </div>

      <div class="modal-footer">
        <p class="text-center"> 
          <a href="<?=$this->createUrl('/shopping/page/items')?>"> Cerrar y seguir comprando </a>
          <!-- <a data-dismiss="modal" href="#"> Cerrar y seguir comprando </a> <br> -->
        </p>
      </div>
    </div>
</div>
</div>

<div class="modal fade product-details-modal" id="need-login-modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-small" style="overflow: scroll">
    <div class="modal-content">
      
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
          <h3 class="modal-title-site text-center"> Ingresar  </h3>
        </div>

        
        <div class="modal-body col-lg-12 col-md-12 col-sm-12 col-xs-12 modal-details no-padding">
        <div class="modal-details-inner">

         <div class="cart-actions hide cart-container-guest-options">
            <div class=" text-center col-md-12">
                <em>Para continuar con el curso gratuito debe ingresar o crear su cuenta</em>
            </div>
            <div class=" text-center col-md-12">
                <button data-href="<?=$this->createUrl('/users/page/login')?>" type="button" class="action-login-inorderto-buy btn btn-qubico btn-green" title="Ingresar">
                  Ingresar
                </button>
            </div>
        </div>
        
        
        </div>
        </div>

      <div class="modal-footer">
        <p class="text-center"> 
          <a href="<?=$this->createUrl('/shopping/page/items')?>"> Cerrar y seguir comprando </a>
          <!-- <a data-dismiss="modal" href="#"> Cerrar y seguir comprando </a> <br> -->
        </p>
      </div>
    </div>
</div>
</div>  

<script type="text/javascript">
jQuery(document).ready(function($) {
     
////////////////////////////////////
// CARRITO DE COMPRAS
////////////////////////////////////

  $(document).on('click','.btn-cart-add-to-cart-free',function(e){
    e.preventDefault();
    var that = $(this);

        $.ajax({
            url: '<?=$this->createUrl("/users/page/isGuest")?>',
            type: 'post',
            dataType: 'json',
            success: function (data) {
              var success = data.success;
              
              if(!success) {
              
                $.ajax({
                  url: '<?=$this->createUrl("/shopping/page/addToCartFree")?>',
                  data: { id: that.attr('data-id') },
                  dataType: 'json',
                  success: function(data) {
                    
                    if(data.success) {
                        $('#shoping-cart-free-modal').modal('show');
                    } else {
                      bootbox.alert(data.message);
                    }
                  }
                });

              } else {
                // $('#login-modal').modal("show");
                $('#need-login-modal').modal("show");

              }
              
            }
        });
        
    });

    $.fn.showModalShoppingCart=function () {
        
        $.ajax({
            url: '<?=$this->createUrl("/users/page/isGuest")?>',
            type: 'post',
            dataType: 'json',
            success: function (data) {
              var success = data.success;
                if(success) {
                    $('.cart-container-guest-options').removeClass('hide');
                    $('.cart-container-login-options').addClass('hide');
                } else {
                    $('.cart-container-guest-options').addClass('hide');
                    $('.cart-container-login-options').removeClass('hide');
                }

                $('.container-shop-cart').load('<?php echo $this->createUrl("/shopping/page/loadToCart")?>');
                $('#shoping-cart-modal').modal('show');
            }
        });
    };

    <?php if(r()->user->getState('is_loging') and !r()->user->isGuest):?>
    <?php r()->user->setState('is_loging',false);?>
       $.fn.showModalShoppingCart();
    <?php endif;?>
    
    $(document).on('click','.show-modal-shopping-cart',function(e){
      $.fn.showModalShoppingCart();
    });

    $(document).on('click','.btn-cart-add-to-cart',function(e){
        e.preventDefault();
        var that = $(this);

        $.ajax({
          url: '<?=$this->createUrl("/shopping/page/addToCart")?>',
          data: { id: that.attr('data-id') },
          dataType: 'json',
          success: function(data) {
            
            if(data.success) {
              $(that.attr('data-modal')).modal('hide');
              $.fn.showModalShoppingCart();
            } else {
              bootbox.alert(data.message);
            }
          }
        });
    });

  $(document).on('click','.delete-to-cart',function(e){
    e.preventDefault();
    var that = $(this);
    bootbox.confirm('¿Seguro que no desea comprar este producto?',function(ok){
      
      if(ok) {
        $.ajax({
          url: '<?=$this->createUrl("/shopping/page/deleteToCart")?>',
          data: { id: that.attr('data-id') },
          dataType: 'json',
          success: function(data) {
            if(data.success) {
              $('.container-shop-cart').load('<?php echo $this->createUrl("/shopping/page/loadToCart")?>');
              //that.parent().remove();
            } else {
              bootbox.alert(data.message);
            }
          }
        });
      }
    });

  });


  $(document).on('click','.action-login-inorderto-buy',function(e) {
    $('#shoping-cart-modal').modal('hide');
    window.open($(this).attr('data-href'),'_blank');
  });
  // Options for pay
     
  $(document).on('click','.btn-pay-delivery',function(e) {
    $('#delivery-hidden-field').val(1);
    $('#shopping-header-form').submit();
  });
     
  $(document).on('click','.btn-pay-bank',function(e) {
    $('#delivery-hidden-field').val(2);
    $('#shopping-header-form').submit();
  });

  $(document).on('click','.btn-pay-online',function(e) {
    $('#delivery-hidden-field').val(0);
    $('#shopping-header-form').submit();
  });

  $(document).on('submit','#shopping-header-form',function(e) {
    e.preventDefault();
    var $form = $(this);
    $.ajax({
        url: '<?php echo $this->createUrl("/shopping/page/createAjax");?>',
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
  
          if(data.success==1) {
            // here all ok go to pol
            // bootbox.alert(data.message);
            var form=$('<form/>').attr({action:data.data.actionUrl,method:'post'});
                $.each(data.data,function(i,value) {
                  form.append($('<input type="hidden">').attr({name:i,value:value}));
                });
                form.appendTo('body');
                console.log(form.serializeArray());
              if(confirm('POL'))
              form.submit();

          } else if(data.success==2) {
            $('#shoping-cart-modal').modal('hide');
            bootbox.alert(data.message);
          } else if(data.success==3) {
            $('#shoping-cart-modal').modal('hide');
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