  <section>
    <div class="con_section">
      <div class="mg_grl mg_int clearfix" id="an_pro">
        <div class="col_ll_s fl">
        	<div class="con_pro_tt">
        		<div class="pro_tt gr5">CARRITO DE COMPRAS ROD</div>
        	</div>
        </div>
        <div class="col_b fl">
        	<div class="con_main_bts">
        		<button class="btn btn-primary sel_pro_tab an_din" type="button" data-rel="tab_1" data-role="#an_pro"><i>1.</i>Productos</button>
        		<button class="btn btn-primary sel_pro_tab an_din" type="button" data-rel="tab_2" data-role="#an_pro"><i>2.</i>Datos del usuario</button>
        		<button class="btn btn-primary sel_pro_tab an_din" type="button" data-rel="tab_3" data-role="#an_pro"><i>3.</i>Datos de envío</button>
        		<button class="btn btn-primary sel_pro_tab an_din" type="button" data-rel="tab_4" data-role="#an_pro"><i>4.</i>Orden de compra</button>
        		<button class="btn btn-default" onclick="location.href='<?php echo $this->createUrl('/home')?>'" type="button"><i class="fa fa-home"></i>Inicio</button>
        	</div>
					<!--Tab-->
					<div class="con_tab clearfix tab_1">
						<table align="center" border="1" bordercolor="#ccc" cellpadding="0" cellspacing="0" width="840">
							<tr>
								<th>Producto</th>
								<th>Nombre</th>
								<th>Descripción</th>
								<th>Cantidad</th>
								<th>Valor unitario</th>
								<th>Total</th>
								<th>Borrar</th>
							</tr>
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
								<td><div class="car_img"><img src="<?php echo Yii::app()->request->baseUrl?>/uploads/<?php echo $data->{$modelImage}?>" alt=""></div></td>
								<td><?php echo $data->{$modelName}?></td>
								<td><?php echo substr($data->{$modelDescription}, 0,60)."..."?></td>
								<td>
									<input class="cantidad update-cart" data-id="<?php echo $row['product_id']?>" value="<?php echo $row['quantity']?>">
									<span class="messages-amount" style="font-size: 9px;color: red;display:block">&nbsp;</span>
									<span class="messages-amount-success" style="font-size: 9px;color: green;display:block">&nbsp;</span>
								</td>
								<td class="data-item-<?php echo $i?>">$<?php echo number_format($data->{$modelUnitValue})?></td>
								<td class="data-item-<?php echo $i?>-total">$<?php echo number_format(($data->{$modelUnitValue})*$row['quantity'])?></td>
								<td><button data-id="<?php echo $row['product_id']?>" class="btn btn-warning remove-cart" type="button"><i class="fa fa-trash-o"></i></button></td>
							</tr>
							
							<?php $subTotal+=(($data->{$modelUnitValue})*$row['quantity'])?>
							<?php endforeach;?>

						</table>
						
						<?php #$subTotal?>
						
						<?php $overallTax=$config->overall_tax?>
						<?php $totalTax=$this->module->tax($overallTax,$subTotal);?>
						<?php $shippingCost=$config->shipping_cost?>
						<?php $total=($subTotal+$totalTax+$shippingCost)?>

						<div class="con_total clearfix">
							<h3 class="fr">SUBTOTAL<span class="text-right data-sub_total">$<?php echo number_format($subTotal)?></span></h3>
							<div class="clearfix"></div>
							<h3 class="fr">IVA<span class="text-right data-total_tax">$<?php echo number_format($totalTax)?></span></h3>
							<div class="clearfix"></div>
							<h3 class="fr">ENVÍO<span class="text-right data-shipping_cost">$<?php echo number_format($shippingCost)?></span></h3>
							<div class="clearfix"></div>
							<h3 class="fr">TOTAL<span class="text-right data-total">$<?php echo number_format($total)?></span></h3>
						</div>
						<button class="btn btn-primary sel_pro_tab an_din fr" type="button" data-rel="tab_2" data-role="#an_pro">Siguiente 2<i class="fa fa-chevron-right"></i></button>
					</div>
     			<!--Tab-->
					<div class="con_tab clearfix tab_2">
						<form action="" id="step2-form" class="grl_form step2_form clearfix" method="post">
							<div class="con_campo con_campo_s fl">
								<label class="label_tx" for="email">Email</label>
								<input class="bs tr" data-rule-required="true" value="<?php echo $user->email?>" id="email" name="email" type="text">
							</div>
							<div class="con_campo con_campo_s fr">
								<label class="label_tx" for="card_identity">No. de identificación</label>
								<input class="bs tr" data-rule-required="true" value="<?php echo $user->card_identity?>" id="card_identity" name="card_identity" minlength="8">
							</div>
							<!-- <button class="btn btn-success bt_form fr" type="submit"><i class="fa fa-paper-plane-o"></i>Enviar</button> -->
						</form>
						<button id="select3" class="btn btn-primary sel_pro_tab an_din fr" type="button" >Siguiente 3<i class="fa fa-chevron-right"></i></button>
						<!-- <button class="btn btn-primary sel_pro_tab an_din fr" type="button" data-rel="tab_3" data-role="#an_pro">Siguiente 3<i class="fa fa-chevron-right"></i></button> -->
						<button class="btn btn-primary sel_pro_tab an_din fr" type="button" data-rel="tab_1" data-role="#an_pro"><i class="fa fa-chevron-left"></i>Anterior 1</button>
					</div>
    			<!--Tab-->
					<div class="con_tab clearfix tab_3">
						<form action="" id="step3-form" class="grl_form step3_form clearfix" method="post">
							<div class="con_campo con_campo_s fl">
								<label class="label_tx" for="name">Nombre:</label>
								<input class="bs tr" data-rule-required="true" value="<?php echo $user->name?>" id="name" name="name">
							</div>
							<div class="con_campo con_campo_s fr">
								<label class="label_tx" for="lastname">Apellido:</label>
								<input class="bs tr" data-rule-required="true" value="<?php echo $user->lastname?>" id="lastname" name="lastname">
							</div>
							<div class="con_campo con_campo_s fl">
								<label class="label_tx" for="gender">Sexo:</label>
								<select data-rule-required="true" id="gender" name="gender">
									<option value=""></option>
									<option <?php echo ($user->gender=='m')?'selected="selected" ':'';?>value="m">&nbsp; &bull; Masculino</option>
									<option <?php echo ($user->gender=='f')?'selected="selected" ':'';?>value="f">&nbsp; &bull; Femenino</option>
								</select>
							</div>
							<div class="con_campo con_campo_s fr">
								<label class="label_tx" for="card_identity">No. de identificación</label>
								<input class="bs tr cc" data-rule-required="true" value="<?php echo $user->card_identity?>" id="card_identity" name="card_identity" minlength="8">
							</div>
							<div class="con_campo con_campo_s fl">
								<label class="label_tx" for="birthdate">Fecha de nacimiento:</label>
								<input class="bs tr" min="1910-01-01" max="<?php echo date('Y-m-d')?>" type="date" data-rule-required="true" value="<?php echo ($user->birthdate!==null)?$user->birthdate:date('Y-m-d')?>" id="birthdate" name="birthdate">
							</div>
							<div class="con_campo con_campo_s fr">
								<label class="label_tx" for="users_address_city_id">Ciudad:</label>
								<select data-rule-required="true" id="users_address_city_id" name="users_address_city_id">
									<option value=""></option>
									<?php foreach(UsersCities::model()->findAll() as $data):?>
										<option <?php echo ($data->id==$user->users_address_city_id)?'selected="selected" ':'';?>value="<?php echo $data->id?>">&nbsp; &bull; <?php echo $data->name?></option>
									<?php endforeach;?>
								</select>
							</div>
							<div class="con_campo con_campo_s fl">
								<label class="label_tx" for="address">Dirección de residencia:</label>
								<input class="bs tr" data-rule-required="true" value="<?php echo $user->address?>" id="address" name="address" type="text">
							</div>
							<div class="con_campo con_campo_s fr">
								<label class="label_tx" for="phone">Teléfono:</label>
								<input class="bs tr" data-rule-required="true" value="<?php echo $user->phone?>" id="phone" name="phone">
							</div>
							<div class="con_campo con_campo_s fl">
								<label class="label_tx" for="mobile">Celular:</label>
								<input class="bs tr" data-rule-required="true" value="<?php echo $user->mobile?>" id="mobile" name="mobile">
							</div>
							<div class="con_campo con_campo_s fr">
								<label class="label_tx" for="email">Email:</label>
								<input class="bs tr ee" data-rule-required="true" value="<?php echo $user->email?>" data-msg-email="* Correo no valido" id="email" name="email" type="email">
							</div>
							<div class="con_campo con_campo_s fl">
								<label class="label_tx" for="users_city_delivery_id">Ciudad de entrega:</label>
								<select data-rule-required="true" id="users_city_delivery_id" name="users_city_delivery_id">
									<option value=""></option>
									<?php foreach(UsersCities::model()->findAll() as $data):?>
										<option <?php echo ($data->id==$user->users_address_city_id)?'selected="selected" ':'';?>value="<?php echo $data->id?>">&nbsp; &bull; <?php echo $data->name?></option>
									<?php endforeach;?>
								</select>
							</div>
							<div class="con_campo con_campo_s fr">
								<label class="label_tx" for="address_delivery">Dirección de entrega:</label>
								<input class="bs tr" data-rule-required="true" value="<?php echo $model->address_delivery?>" id="address_delivery" name="address_delivery" type="text">
							</div>
							<div class="con_campo con_campo_s fl">
								<label class="label_tx" for="contact_receiving">Contacto de entrega:</label>
								<input class="bs tr" data-rule-required="true" value="<?php echo $model->contact_receiving?>" id="contact_receiving" name="contact_receiving" type="text">
							</div>
							<div class="con_campo con_campo_s fr">
								<label class="label_tx" for="contact_phone">Teléfono de contacto:</label>
								<input class="bs tr" data-rule-required="true" value="<?php echo $model->contact_phone?>" id="contact_phone" name="contact_phone">
							</div>
							<div class="con_campo con_campo_b fl">
								<label class="label_tx" for="comment">Comentario:</label>
								<textarea class="bs tr" data-rule-required="true" id="comment" name="comment"><?php echo $model->comment?></textarea>
							</div>
							<div class="con_campo con_campo_b fl">
							  <input class="select ck" id="ck1" checked="checked" value="1" name="conditions" type="checkbox">
							  <label class="ck_tx">He leído las politicas de compra <a class="mb_act" href="#mb_terms">ver politicas de compra</a></label>
							  <div class="clearfix"></div>
							  <input class="ck" id="ck2"  checked="checked" value="1" name="deliver_same_address" type="checkbox">
							  <label class="ck_tx">La dirección de entrega será la misma dirección de residencia</label>
							  <div class="clearfix"></div>
							  <p class="ck_tx">* La fecha de entrega será 5 días hábiles a partir de la fecha de la orden compra</p>
							</div>
							<!-- <button class="btn btn-success bt_form fr" type="submit"><i class="fa fa-paper-plane-o"></i>Enviar</button> -->
						</form>
						
						<button id="select4" class="btn btn-primary an_din fr" type="button">Siguiente 4<i class="fa fa-chevron-right"></i></button>
						<!-- <button class="btn btn-primary sel_pro_tab an_din fr" type="button" data-rel="tab_4" data-role="#an_pro">Siguiente 4<i class="fa fa-chevron-right"></i></button> -->
						<button class="btn btn-primary sel_pro_tab an_din fr" type="button" data-rel="tab_2" data-role="#an_pro"><i class="fa fa-chevron-left"></i>Anterior 2</button>
					</div>
     			<!--Tab-->
					<div class="con_tab clearfix tab_4">
						<ul class="step4_col_s fl">
							<li>
								<h2>Nombre:</h2>
								<p><?php echo $user->name?></p>
							</li>
							<li>
								<h2>Apellido:</h2>
								<p><?php echo $user->lastname?></p>
							</li>
							<li>
								<h2>Sexo:</h2>
								<p><?php echo $user->gender=='m'?'Masculino':'Femenino'?></p>
							</li>
							<li>
								<h2>No. de identificación:</h2>
								<p><?php echo $user->card_identity?></p>
							</li>
							<li>
								<h2>Fecha de nacimiento:</h2>
								<p><?php echo $user->birthdate?></p>
							</li>
							<li>
								<h2>Ciudad:</h2>
								<p><?php echo ($user->city!==null)?$user->city->name:''?></p>
							</li>
							<li>
								<h2>Dirección de residencia:</h2>
								<p><?php echo $user->address?></p>
							</li>
							<li>
								<h2>Teléfono:</h2>
								<p><?php echo $user->phone?></p>
							</li>
							<li>
								<h2>Celular:</h2>
								<p><?php echo $user->mobile?></p>
							</li>
							<li>
								<h2>Email:</h2>
								<p><?php echo $user->email?></p>
							</li>
							<li>
								<h2>Entrega del pedido:</h2>
								<p>8 días habiles</p>
							</li>
							<li>
								<h2>Ciudad de entrega:</h2>
								<p><?php echo ($model->city!==null)?$model->city->name:''?></p>
							</li>
							<li>
								<h2>Dirección de entrega:</h2>
								<p><?php echo $model->address_delivery?></p>
							</li>
							<li>
								<h2>Contacto de entrega:</h2>
								<p><?php echo $model->contact_receiving?></p>
							</li>
							<li>
								<h2>Teléfono de contacto:</h2>
								<p><?php echo $model->contact_phone?></p>
							</li>
							<li>
								<h2>Comentario:</h2>
								<p><?php echo $model->comment?></p>
							</li>
						</ul>
						<div class="step4_col_b fr">
							


						<table align="center" border="1" bordercolor="#ccc" cellpadding="0" cellspacing="0" width="530">
							<tr>
								<th></th>
								<th>Nombre</th>
								<th>Cantidad</th>
								<th>Valor unitario</th>
								<th>Total</th>
							</tr>
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
								<td style="width: 50px;"><div class=""><img class="img-responsive img-thumbnail" style="width:100%" src="<?php echo Yii::app()->request->baseUrl?>/uploads/<?php echo $data->{$modelImage}?>" alt=""></div></td>
								<td style="width: 100px;"><?php echo $data->{$modelName}?></td>
								<td style="width: 70px;">
									<input readonly="readonly"  class="data-item-input-<?php echo $i?> cantidad update-cart" data-id="<?php echo $row['product_id']?>" value="<?php echo $row['quantity']?>">
									<span class="messages-amount" style="font-size: 9px;color: red;display:block">&nbsp;</span>
									<span class="messages-amount-success" style="font-size: 9px;color: green;display:block">&nbsp;</span>
								</td>
								<td style="width: 70px;" class="data-item-<?php echo $i?>">$<?php echo number_format($data->{$modelUnitValue})?></td>
								<td style="width: 70px;" class="data-item-<?php echo $i?>-total">$<?php echo number_format(($data->{$modelUnitValue})*$row['quantity'])?></td>
							</tr>
							
							<?php $subTotal+=(($data->{$modelUnitValue})*$row['quantity'])?>
							<?php endforeach;?>

						</table>
						
						<?php #$subTotal?>
						
						<?php $overallTax=$config->overall_tax?>
						<?php $totalTax=$this->module->tax($overallTax,$subTotal);?>
						<?php $shippingCost=$config->shipping_cost?>
						<?php $total=($subTotal+$totalTax+$shippingCost)?>

						<div class="con_total clearfix">
							<h3 class="fr">SUBTOTAL<span class="text-right data-sub_total">$<?php echo number_format($subTotal)?></span></h3>
							<div class="clearfix"></div>
							<h3 class="fr">IVA<span class="text-right data-total_tax">$<?php echo number_format($totalTax)?></span></h3>
							<div class="clearfix"></div>
							<h3 class="fr">ENVÍO<span class="text-right data-shipping_cost">$<?php echo number_format($shippingCost)?></span></h3>
							<div class="clearfix"></div>
							<h3 class="fr">TOTAL<span class="text-right data-total">$<?php echo number_format($total)?></span></h3>
						</div>
					
					<div class="text-right">
						
							<button class="btn btn-primary sel_pro_tab an_din" type="button" data-rel="tab_3" data-role="#an_pro"><i class="fa fa-chevron-left"></i>Anterior 3</button>
							<a class="btn btn-primary btn-lg sel_pro_lk send-confirm" href="#">Ir a pagar<i class="fa fa-chevron-right"></i></a>
					</div>
			
						</div>
					</div>
       	</div>
       	<div class="con_decor_int"><div class="decor_int"></div><span><img src="<?php echo Yii::app()->theme->baseUrl?>/img/marca.png" alt=""></span></div>
      </div>
    </div>
  </section>
  <div class="mb_wrap">
    <div class="mb_info clearfix" id="mb_terms">
    	<?php echo $config->editor_purchase_terms?>
    </div>
  </div>
<script>
$(function(){



$('#select3').click(function(e){
    e.preventDefault();
	$('#step2-form').submit();
});

/*Validate*/
$('#step2-form').submit(function(e){
    e.preventDefault();
});
$("#step2-form").validate({
	rules: {
		card_identity: {number: true}
	}, 
	messages: {
		card_identity: {
			required: "* Campo obligatorio", 
			minlength: "* Debe ingresar mínimo 8 caracteres", 
			number: "* Ingrese solo números"
		}
	},
	submitHandler: function(form) {
		console.log($(form).serialize());
		// bootbox.alert("Mensaje enviado exitosamente.");
		$.ajax({
		    url:'<?php echo $this->createUrl("step2")?>',
		    data: $(form).serialize(),
		    type: 'post',
		    dataType: 'json',
		    success:function(data){
		        if(data.success==1) {
	        		$(".ee").val($("#email").val());
					$(".cc").val($("#card_identity").val());
		        	// set all attributes
		        	if(data.data.users_id) {
		        		$("#email").val(data.data.users_id.email);
						$("#name").val(data.data.users_id.name);
						$("#lastname").val(data.data.users_id.lastname);
						$("#username").val(data.data.users_id.username);
						$("#state").val(data.data.users_id.state);
						$("#state_email").val(data.data.users_id.state_email);
						$("#img").val(data.data.users_id.img);
						$("#registered").val(data.data.users_id.registered);
						$("#papelera").val(data.data.users_id.papelera);
						$("#phone").val(data.data.users_id.phone);
						$("#mobile").val(data.data.users_id.mobile);
						$("#users_address_country_id").val(data.data.users_id.users_address_country_id);
						$("#users_address_state_id").val(data.data.users_id.users_address_state_id);
						$("#users_address_city_id").val(data.data.users_id.users_address_city_id);
						$("#address").val(data.data.users_id.address);
						$("#birthdate").val(data.data.users_id.birthdate);
						$("#gender").val(data.data.users_id.gender);
						$("#card_identity").val(data.data.users_id.card_identity);
						$("#shipping_data").val(data.data.users_id.shipping_data);
						$("#form_pol").val(data.data.users_id.form_pol);
						$("#cart_states_id").val(data.data.users_id.cart_states_id);
						$("#created_at").val(data.data.users_id.created_at);
						$("#updated_at").val(data.data.users_id.updated_at);
		        	}

					if(data.delivery) {
						$('#users_country_delivery_id').val(data.delivery.users_country_delivery_id);
						$('#users_state_delivery_id').val(data.delivery.users_state_delivery_id);
						$('#users_city_delivery_id').val(data.delivery.users_city_delivery_id);
						$('#address_delivery').val(data.delivery.address_delivery);
						$('#contact_receiving').val(data.delivery.contact_receiving);
						$('#contact_phone').val(data.delivery.contact_phone);
						$('#comment').val(data.delivery.comment);
						$('#deliver_same_address').val(data.delivery.deliver_same_address);
					}

		            $('[data-rel=tab_3]').trigger('click');
		        } else {
		           bootbox.alert("No se envió el mensaje por favor recargar la página y volver a intentarlo.");
		        }
		    }
		});
	}
});



$('#select4').click(function(e){
    e.preventDefault();
	$('#step3-form').submit();
});

$('#step3-form').submit(function(e){
    e.preventDefault();
});
$("#step3-form").validate({
	rules: {
		card_identity: {number: true}, 
		phone: {number: true}, 
		mobile: {number: true}, 
		contact_phone: {number: true},
		conditions: { required: function(elem) {
	            return $("input.select:checked").length > 0;
	        }
    	}
	}, 
	messages: {
		card_identity: {
			required: "* Campo obligatorio", 
			minlength: "* Debe ingresar mínimo 8 caracteres", 
			number: "* Ingrese solo números"
		},
		conditions: {
			required: "* Por favor aceptar términos y condiciones para continuar", 
		},
	},
	submitHandler: function(form) {
		console.log($(form).serialize());
		// bootbox.alert("Mensaje enviado exitosamente.");
		$.ajax({
		    url:'<?php echo $this->createUrl("step3")?>',
		    data: $(form).serialize(),
		    type: 'post',
		    dataType: 'json',
		    success:function(data) {
		        if(data.success==1) {
		           $('[data-rel=tab_4]').trigger('click');
		        } else {
		           bootbox.alert("No se envió el mensaje por favor recargar la página y volver a intentarlo.");
		        }
		    }
		});
	}
});

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
	$('.data-shipping_cost').html('$'+data.data.shipping_cost);
	$('.data-total').html('$'+data.data.total);

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
		
		var amount=parseInt($(e.currentTarget).val());
		var id=$(e.currentTarget).attr('data-id');

		if(!isNaN(amount) && amount>0) {
			console.log(amount);
			
			$('.messages-amount').html('&nbsp;');
			
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
						$('.messages-amount').html('&nbsp;');
						
						$.fn.updateCart(data);

						$('.messages-amount-success').html('Carrito actualizado');
						setTimeout(function(){
							$('.messages-amount-success').html('&nbsp;');
						},9000);
					} else {
						$('.messages-amount-success').html('&nbsp;');
						$('.messages-amount').html('Error al actualizar la cantidad.');
					}
				}
			});
			
		} else {
			$('.messages-amount-success').html('&nbsp;');
			$('.messages-amount').html('Ingrese un número válido');
		}
	}

});

});
</script>