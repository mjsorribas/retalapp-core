<a class="back-bt tr" href="javascript:history.back()">« Volver</a>
<section>
   <div class="con-section">
    <div class="mg-section cfx">
        
    <?php if(r('#user')->isGuest):?>
      <h1 class="pro-title">Agrega productos al carrito</h1>

      <div class="con-carro-bts cfx"> 
        <a class="carro-bt modals-act fr tr" href="<?php echo $this->createUrl("/catalogo/page/productos")?>">Ver productos<span class="con_tool">Encuentra el producto que necesitas<i class="tr"></i></span></a> 
      </div>

    <?php else:?>
    <?php if(count($cart['items'])>0):?>

    <h1 class="pro-title">Carrito de compras - Todos nuestros productos ya tienen IVA</h1>
    <table class="resumen-table">
      <thead>
         <tr>
            <th>Referencia</th>
            <th>Descripción</th>
            <th width="120">Marca</th>
            <th>Cantidad</th>
            <th>Valor Unitario</th>
            <th>Sub-Total</th>
            <th>Eliminar</th>
         </tr>
      </thead>
       <tbody>
        
    <?php $subTotal=0?>
    <?php foreach($cart['items'] as $i => $row):?>
    <?php 
      $data=CActiveRecord::model($row['table_related'])->findByPk($row['product_id']);
      $modelFields=$modelConfig[$row['table_related']];
      $modelId=$modelFields['id'];
      $modelUnitValue=$modelFields['unit_value'];
      $modelName=$modelFields['name'];
      $modelImage=$modelFields['image'];
      $modelDescription=$modelFields['description'];
      $modelExtra=$modelFields['extra'];
    ?>
    <tr class="data-rows-<?php echo $row['product_id']?>">
      <td><?php echo $data->{$modelName}?></td>
      <td><?php echo substr($data->{$modelDescription}, 0,60)."..."?></td>
      <td><?php eval('echo $data->'.$modelExtra.';')?></td>
      <td>
        <input class="cantidad update-cart" data-id="<?php echo $row['product_id']?>" value="<?php echo $row['quantity']?>">
        <span class="messages-amount" style="font-size: 15px;color: red;display:block">&nbsp;</span>
        <span class="messages-amount-success" style="font-size: 15px;color: green;display:block">&nbsp;</span>
      </td>
      <td class="data-item-<?php echo $i?>">$<?php echo r('#format')->money(r('#price')->getPrice($data))?></td>
      <td class="data-item-<?php echo $i?>-total">$<?php echo r('#format')->money((r('#price')->getPrice($data))*$row['quantity'])?></td>
      <td>
        <div class="con-clear-bt fl">
          <a data-id="<?php echo $row['product_id']?>" class="clear-bt tr remove-cart" href=""></a>
        </div>
      </td>
    </tr>
    
    <?php $subTotal+=((r('#price')->getPrice($data))*$row['quantity'])?>
    <?php endforeach;?>

       </tbody>
  </table>

  
  <?php $overallTax=$config->overall_tax?>
  <?php $totalTax=$this->module->tax($overallTax,$subTotal);?>
  <?php if($currentLocality!==null):?>
    <?php $shippingCost=$config->shipping_cost+$currentLocality->price?>
  <?php else:?>
    <?php $shippingCost=$config->shipping_cost?>
  <?php endif;?>
  <?php $total=($subTotal+$totalTax+$shippingCost)?>

         <div class="con-total cfx">
            <ul class="fr">
               <li class="total-high">Subtotal</li>
               <li id="total_sin_iva" class="data-sub_total">$<?php echo r('#format')->money($subTotal)?></li>
               <?php if(!empty($overallTax)):?>
               <li style="" class="total-high">IVA</li>
               <li style="" class="data-total_tax" id="iva">$<?php echo r('#format')->money($totalTax)?></li>
               <?php endif;?>
               
               <li class="total-high">Destino</li>
               <li>
                  <form action="" class="go-form cfx fr" method="post">
                     <div class="src-select tr">
                        <select name="locality" id="locality">
                          <option value="" selected="">Seleccione...</option>
                          <?php foreach(CartShippingRates::listData() as $id => $locality):?>
                              <option value="<?php echo $id?>"<?php echo ($currentLocality!==null and $currentLocality->id==$id)?' selected="selected"':'';?>><?php echo $locality?></option>
                          <?php endforeach;?>
                        </select>
                     </div>
                  </form>
               </li>
               <li class="total-high">Dirección de envío</li>
               <li>
                  <form action="#" class="go-form cfx fr" method="post">
                     <div class="src-select tr"> 
                      <input name="address_cart" id="address_cart" type="text">
                     </div>
                  </form>
               </li>
               <li class="total-high">Valor del envío</li>
               
               <?php if($shippingCost<=0):?>
                <li id="valor_destino" class="data-shipping_cost">Pago contra entrega</li>
               <?php else:?>
                <li id="valor_destino" class="data-shipping_cost">$<?php echo r('#format')->money($shippingCost)?></li>
               <?php endif;?>
               
               <li class="total-high">Total</li>
               <li id="total" class="data-total" data-total="<?php echo $total?>">$<?php echo r('#format')->money($total)?></li>
            </ul>
         </div>
         
       <div class="con-carro-bts cfx"> 
          
          <a class="carro-bt modals-act-pagar fr tr" href="#">PAGAR AHORA<span class="con_tool">Recibimos todas las tarjetas<i class="tr"></i></span></a> 
          <a class="carro-bt modals-act-pedido fr tr" href="#"> HACER PEDIDO <span class="con_tool"> Tienes crédito con nosotros? <i class="tr"></i> </span> </a> 
          <a class="carro-bt modals-act-cotizar fr tr" href="#"> COTIZAR ENVÍO <span class="con_tool"> Deseas conocer el valor de envío antes de finalizar la compra? <i class="tr"></i> </span> </a> 
          
          <a style="display:none" class="carro-bt pagar-cart modals-act fr tr" href="#modal-carro">PAGAR AHORA<span class="con_tool">Recibimos todas las tarjetas<i class="tr"></i></span></a> 
          <a style="display:none" class="carro-bt pedido-cart modals-act fr tr" href="#mb_pedido"> HACER PEDIDO <span class="con_tool"> Tienes crédito con nosotros? <i class="tr"></i> </span> </a> 
          <a style="display:none" class="carro-bt cotizar-cart modals-act fr tr" href="#mb_cotiza"> COTIZAR ENVÍO <span class="con_tool"> Deseas conocer el valor de envío antes de finalizar la compra? <i class="tr"></i> </span> </a> 
          
          <a class="carro-bt modals-act fr tr" href="#mb_guarda"> GUARDAR PEDIDO <span class="con_tool"> Guarda tu pedido para continuar más adelante. <i class="tr"></i> </span> </a> 
          <a class="carro-bt fr tr" href="<?php echo r()->createUrl("/catalogo/page/productos")?>">SEGUIR COMPRANDO</a>
       </div>

        <script type="text/javascript">
        $(function(){
          $('#address_cart').on('keyup',function(e){
            e.preventDefault();
            $('#address_delivery').val($(this).val());
            $('.address_delivery_request').val($(this).val());
          });

          $('.modals-act-pagar').on('click',function(e){
            e.preventDefault();
              if($('#locality').val()!="" && $('#address_cart').val()!="") {

                $('#shop-form').submit();
              //$('.pagar-cart').click();
              } else {
                $.fn.modal('Datos de envío','Antes de realizar esta acción, por favor ingrese la ciudad destino y la dirección de envío en el carrito');
              }
          });
          $('.modals-act-pedido').on('click',function(e){
            e.preventDefault();
              if($('#locality').val()!="" && $('#address_cart').val()!="") {

              $('.pedido-cart').click();
              } else {
                $.fn.modal('Datos de envío','Antes de realizar esta acción, por favor ingrese la ciudad destino y la dirección de envío en el carrito');
              }
          });
          $('.modals-act-cotizar').on('click',function(e){
            e.preventDefault();
              if($('#locality').val()!="" && $('#address_cart').val()!="") {

              $('.cotizar-cart').click();    
              } else {
                $.fn.modal('Datos de envío','Antes de realizar esta acción, por favor ingrese la ciudad destino y la dirección de envío en el carrito');
              }
          });
        
        })
        </script>

       
        
        
        <?php else:?>
        <h1 class="pro-title">No hay productos en el carrito</h1>

        <div class="con-carro-bts cfx"> 
          <a class="carro-bt modals-act fr tr" href="<?php echo $this->createUrl("/catalogo/page/productos")?>">Ver productos<span class="con_tool">Encuentra el producto que necesitas<i class="tr"></i></span></a> 
        </div>

        <?php endif;?>
    <?php endif;?>
      
      </div>
   </div>
</section>

<!-- MODALES -->
<div class="con-modals">
   <div class="info-modal cfx" id="modal-carro">
      <h1>Registro de compra</h1>
      <p></p>
      <p>gracias por tu compra</p>
      <p></p>
      <form id="shop-form" action="#" class="grl-form cfx" method="post">
            <?php if(!r()->user->isGuest):?>
            <?php $currentUser=Users::model()->findByPk(r()->user->id);?>
         <div class="grl-col fl">
            <div>
               <input value="<?=$currentUser->name?> <?=$currentUser->lastname?>" name="contact_receiving" class="tr" placeholder="Nombre" type="text">
            </div>
            
            <div class="src-select tr">
               
               <select name="users_city_delivery_id" id="users_city_delivery_id" class="">
               <option value="" selected="">Seleccione...</option>
               <?php foreach(CartShippingRates::listData() as $id => $locality):?>
                  <option value="<?php echo $id?>"<?php echo ($currentLocality!==null and $currentLocality->id==$id)?' selected="selected"':'';?>><?php echo $locality?></option>
               <?php endforeach;?>
               </select>
                   
            </div>

            <div>
               <input class="tr" value="<?=$currentUser->phone?>" name="contact_phone" placeholder="Teléfono" type="text">
            </div>
         
         </div>
         
         <div class="grl-col fr"> 

            <div>
               <input value="<?=$currentUser->card_identity?>" class="tr" name="contact_id" placeholder="No. de Cédula" type="text"> 
            </div>
            <div>
               <input value="<?=$currentUser->address?>" class="tr" name="address_delivery" placeholder="Dirección" type="text"> 
            </div>
            <div>
               <input class="tr" value="<?=$currentUser->phone?>" name="contact_mobile" placeholder="Celular" type="text">
            </div>
         
         </div>
      
         <div class="con-grl-bts" id="botones_modal" style="display:none;"> 
            <input class="grl-submit fr tr" name="typo_pago" type="submit" value="CONSIGNAR"> <input class="grl-submit fr tr" name="typo_pago" type="submit" value="PAGAR EN EFECTIVO">
         </div>

            <?php endif;?>
         <div class="con-grl-bts"> <input class="grl-submit fr tr" name="tipo_pago" type="submit" value="PAGAR EN LÍNEA"></div>
      </form>
   </div>

   <div class="info-modal mb_car cfx" id="mb_pedido">
      <h1>Hacer pedido</h1>
      <p>Lorem Ipsum is simply dummy text of the printing.</p>
      <form id="make-form" action="#" class="make-request-form grl-form cfx" method="post">
         <div class="grl-col-b">
          <textarea class="tr" name="comment" placeholder="Observaciones..."></textarea>
          <input name="type" type="hidden" value="5">
          
          <input name="address_delivery_request" class="address_delivery_request" type="hidden" value="">
          <input name="locality_request" class="locality_request" type="hidden" value="">
          
         </div>
        
        <div class="con-grl-bts"> 
          <input class="grl-submit fr tr" type="submit" id="newsletter_btn" value="SOLICITAR PEDIDO">
        </div>
      </form>
   </div>
   <div class="info-modal cfx" id="mb_car_ok1">
      <h1>Pedido realizado</h1>
      <p>Lorem Ipsum is simply dummy text of the printing.</p>
      <a class="mb_go_car1" href="#mb_car_ok1"></a>
   </div>
   <div class="info-modal mb_car cfx" id="mb_cotiza">
      <h1>Cotizar envío</h1>
      <p>Lorem Ipsum is simply dummy text of the printing.</p>
      <form action="#" class="make-request-form grl-form cfx" method="post">
         <div class="grl-col-b">
          <textarea class="tr" name="comment" placeholder="Observaciones..."></textarea>
          <input name="type" type="hidden" value="6">

          <input name="address_delivery_request" class="address_delivery_request" type="hidden" value="">
          <input name="locality_request" class="locality_request" type="hidden" value="">
         
        </div>
         <div class="con-grl-bts"> <input class="grl-submit fr tr" type="submit" id="newsletter_btn" value="SOLICITAR COTIZACIÓN"></div>
      </form>
   </div>
   <div class="info-modal cfx" id="mb_car_ok2">
      <h1>Cotización enviada</h1>
      <p>Lorem Ipsum is simply dummy text of the printing.</p>
      <a class="mb_go_car2" href="#mb_car_ok2"></a>
   </div>
   <div class="info-modal cfx" id="mb_guarda">
      <h1>Sesión guardada</h1>
      <p>Cuando vuelva a iniciar sesión se mostrarán sus mismos productos en el carrito para
que pueda continuar la compra.</p>
   </div>
</div>

<script>
$(function(){
	$(document).on('change','#locality',function(e){
		e.preventDefault();

    $('#users_city_delivery_id').val($(this).val());
    $('.locality_request').val($(this).val());
         
		var locality = $(this).val();
		$.ajax({
			url:'<?php echo $this->createUrl("validateLocality")?>',
			data:{'locality': locality},
			success: function(data){
				console.log(data.data.price_format);
				if(parseInt(data.data.price)<=0) {
          $('.data-shipping_cost').html('Pago contra entrega');
        } else {
          $('.data-shipping_cost').html(data.data.price_format);
        }
				$('.data-total').html(data.data.total);
			}
		});
	});


$(document).on('submit','#shop-form',function(e) {
 e.preventDefault();
 var $form = $(this);
 $.ajax({
     url: '<?php echo $this->createUrl("shopAjax");?>',
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
       
          if(data.success==2) {
            $.fn.modal(data.message,'');

          } else {
            var form=$('<form/>').attr({action:data.data.actionUrl,method:'post'});
            $.each(data.data,function(i,value) {
              form.append($('<input type="hidden">').attr({name:i,value:value}));
            });
            form.appendTo('body');
            console.log(form.serializeArray());
            <?php if($this->module->pol_test):?>
              // if(confirm('POL'))
            <?php endif;?>
            form.submit();
          }

       } else {

         $.each(data.data, function(name, errors) {
           $('[name='+name+']')
           .parent()
           .append($('<span id="validate-'+name+'" style="color:red;font-size:11px">'+errors.join(',<br>')+'</span>'));
         });
       }
     }
 });
});

$(document).on('submit','.make-request-form',function(e) {
 e.preventDefault();
 var $form = $(this);

 if($form.find('[name=comment]').val()=='') {
  
  $form.find('[name=comment]')
  .parent()
  .append($('<span id="validate-comment" style="color:red;font-size:11px">Campo obligatorio</span>'));
 
 } else {

  $.ajax({
     url: '<?php echo $this->createUrl("requestAjax");?>',
     dataType: 'json', 
     type: 'post',
     data: $form.serialize(),
     success: function (data){
        
        $.fn.modal(data.message,'');
        setTimeout(function(){
          window.location.href='<?php echo $this->createUrl("/home")?>';
        },5000);
      }
   });
 }
});

});

$(function(){
$(document).on('click','.send-confirm',function(e){
	e.preventDefault();
	$.ajax({
	    url:'<?php echo $this->createUrl("confirm")?>',
	    type: 'post',
	    dataType: 'json',
	    success:function(data){
	        if(data.success==1) {
	            var form=$('<form/>').attr({action:data.data.actionUrl,method:'post'});
                $.each(data.data,function(i,value) {
                  form.append($('<input type="hidden">').attr({name:i,value:value}));
                });
                form.appendTo('body');
                console.log(form.serializeArray());
                <?php if($this->module->pol_test):?>
                // if(confirm('POL'))
                <?php endif;?>
            	form.submit();
            } else {
	           bootbox.alert("No se envió el mensaje por favor recargar la página y volver a intentarlo.");
	        }
	    }
	});
});

$.fn.updateCart = function(data) {
	$('.data-sub_total').html('$'+data.data.sub_total);
	$('.data-total_tax').html('$'+data.data.total_tax);
	if(data.data.shipping_cost<=0) {
    $('.data-shipping_cost').html('Pago contra entrega');
  } else {
    $('.data-shipping_cost').html('$'+data.data.shipping_cost);
  }
	$('.data-total').html('$'+data.data.total);
	$('.data-total').attr('data-total',data.data.total);

	console.log("--------------------------------------");
	console.log("--",data,"--");
	console.log("--------------------------------------");
	
	for (var row in data.data.items) {
		console.log('.data-item-'+row+'');
		$('.data-item-input-'+row+'').val(data.data.items[row].quantity);
		$('.data-item-'+row+'').html('$'+(data.data.items[row].unit_value));
		$('.data-item-'+row+'-total').html('$'+(data.data.items[row].unit_value*data.data.items[row].quantity));
	}
};

$(document).on('click','.remove-cart',function(e){
	e.preventDefault();
	var id = $(this).attr('data-id');
	var that = $(this);
	$.ajax({
		dataType:'json',
		type:'post',
		url:'<?php echo $this->createUrl("remove")?>',
		data: { 
			id :id, 
		},
		success: function(data){
			if(data.success) {
				$('.data-rows-'+id).fadeOut();
				$.fn.updateCart(data);
				// that.parent().parent().fadeOut();
			} else {
				bootbox.alert('Error al subir al carrito por favor intente mas tarde');
			}
		},
	});
});

$(document).on('keyup','.update-cart',function(e){

	if (window.event) { 
		keynum = e.keyCode; 
	} else { 
		keynum = e.which; 
	} 

	if ((keynum > 47 && keynum < 58) || keynum==8) {
		
		var amount = parseInt($(e.currentTarget).val());
		var that = $(e.currentTarget);
		var id = that.attr('data-id');

		if(!isNaN(amount) && amount>0) {
			console.log(amount);
			
			that.parent().find('.messages-amount').html('&nbsp;');
			
			$.ajax({
				type: 'post',
				dataType: 'json',
				url: '<?php echo $this->createUrl("update")?>',
				data: {
					id: id,
					quantity: amount,
				},
				success:function(data){
					if(data.success) {
						that.parent().find('.messages-amount').html('&nbsp;');
						
						$.fn.updateCart(data);

						that.parent().find('.messages-amount-success').html('Carrito actualizado');
						setTimeout(function(){
							that.parent().find('.messages-amount-success').html('&nbsp;');
						},9000);
					} else {
						that.parent().find('.messages-amount-success').html('&nbsp;');
						
            if(data.error_code=='amount_error') {
              that.parent().find('.messages-amount').html(data.message);
            } else {
              that.parent().find('.messages-amount').html('Error al actualizar la cantidad.');
            }
					}
				}
			});
			
		} else {
			that.parent().find('.messages-amount-success').html('&nbsp;');
			that.parent().find('.messages-amount').html('Ingrese un número válido');
		}
	}

});

});
</script>