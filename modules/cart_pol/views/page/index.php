<section>
<div class="con-section sub-section" data-site="micrositio">
	<div class="mg-grl clearfix">
	
	<h1 class="main-title clearfix">Carrito de premios</h1>
	<div class="row">
		<div class="col-xs-12">
		<div class="table-responsive">
			
			<?php if(isset($cart['items']) and count($cart['items'])>0):?>
				<table class="table table-bordered text-center table-shop">
					<thead>
						<tr>
							<th width="40%">Premio</th>
							<th width="15%">Puntos</th>
							<th width="15%">Cantidad</th>
							<th width="15%">Subtotal</th>
							<th width="15%">Eliminar</th>
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
				$modelExtra=@$modelFields['extra'];
				?>

				<tr class="data-rows-<?php echo $row['product_id']?>">
					<!-- <td><div class="car_img"><img src="<?php echo Yii::app()->request->baseUrl?>/uploads/<?php echo $data->{$modelImage}?>" alt=""></div></td> -->
					<!-- <td><?php echo $data->{$modelName}?></td> -->
					<td><p class="text-justify"><?php echo substr($data->{$modelDescription}, 0,60)."..."?></p></td>
					<td class="data-item-<?php echo $i?>"><?php echo number_format($data->{$modelUnitValue})?></td>
					<td>
						<input type="number" class="cantidad update-cart con-field" data-id="<?php echo $row['product_id']?>" value="<?php echo $row['quantity']?>">
						<span class="messages-amount" style="font-size: 9px;color: red;display:block">&nbsp;</span>
						<span class="messages-amount-success" style="font-size: 9px;color: green;display:block">&nbsp;</span>
					</td>
					<td class="data-item-<?php echo $i?>-total"><?php echo number_format(($data->{$modelUnitValue})*$row['quantity'])?></td>
					<td><button data-id="<?php echo $row['product_id']?>" class="btn btn-delete remove-cart"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></button></td>
				</tr>

				<?php $subTotal+=(($data->{$modelUnitValue})*$row['quantity'])?>
				<?php endforeach;?>
											
				</tbody>
			</table>
			<?php else:?>
			<div class="text-center">
				<em style="display:block">No hay items en el carrito aún, mira nuestro catálogo y selecciona tus produstos favoritos</em>
				<a href="<?=$this->createUrl("/premios/page/catalogo")?>" class="btn btn-primary" style="margin-top: 10px;">VER CATÁLOGO</a>
			</div>
			<?php endif;?>
	
		</div>
		<hr>

	<?php if(isset($cart['items']) and count($cart['items'])>0):?>
		<?php #$subTotal?>

		<?php $overallTax=$config->overall_tax?>
		<?php $totalTax=$this->module->tax($overallTax,$subTotal);?>
		<?php $shippingCost=$config->shipping_cost?>
		<?php $total=($subTotal+$totalTax+$shippingCost)?>
		<?php if($this->module->valuesOnMoney):?>
		<div class="text-right">
		<h3>SUBTOTAL<span class="text-right data-sub_total">$<?php echo number_format($subTotal)?></span></h3>
		<h3>IVA<span class="text-right data-total_tax">$<?php echo number_format($totalTax)?></span></h3>
		<h3>ENVÍO<span class="text-right data-shipping_cost">$<?php echo number_format($shippingCost)?></span></h3>
		<h3>TOTAL<span class="text-right data-total">$<?php echo number_format($total)?></span></h3>
		</div>
		<?php else:?>
			<h3 class="text-right">Total de puntos a redimir: <strong class="text-right data-total"><?php echo number_format($total)?></strong></h3>
			<em class="message-overpoints text-right" style="display:block;color:red"></em>
		<?php endif;?>

		<hr>
		<a href="<?=$this->createUrl("/premios/page/catalogo")?>" class="btn btn-primary" style="">VER CATÁLOGO</a>
		<button class="btn btn-primary pull-right btn-continue" data-toggle="modal" data-target="#mb-delivery"><i class="fa fa-tag"></i> REDIMIR</button>
			
	<?php endif;?>
	
			</div>
		</div>
	</div>
</div>
</section>

<?php $this->renderPartial('webroot.themes.itw.views.premios.page._contact_info')?>

<div class="modal fade" id="mb-delivery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<button class="close-pro close-mb" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			<div class="modal-body">
				<h2 class="main-title">Datos de envío</h2>
				<div class="row">
					<div class="col-sm-12">
						<form id="request-form" action="" class="grl-form login-form clearfix" method="post">
							<div class="row">
								<div class="col-sm-12 clearfix text-left">
									<div class="table">
										<div class="table-cell">
											<input name="deliver_same_address" value="1" id="check" type="checkbox">
											<label class="check" for="check"><p>Usar mi dirección de registro.</p></label>
										</div>
									</div>
									<hr>
								</div>
								<div class="con-field col-sm-6 clearfix">
									<label class="label-tx" for="users_state_delivery_id">Departamento:</label>
									<select id="users_state_delivery_id" name="users_state_delivery_id">
										<option value="">Departamento</option>
										<?php foreach($users_location_states as $data): ?>
										<option value="<?=$data->id;?>"><?=$data->name;?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="con-field col-sm-6 clearfix">
									<label class="label-tx" for="users_city_delivery_id">Ciudad:</label>
									<select id="users_city_delivery_id" name="users_city_delivery_id">
										<option value="">Ciudad</option>
									</select>
								</div>
								<div class="con-field col-sm-12 clearfix">
									<label class="label-tx" for="contact_phone">Teléfono:</label>
									<input id="contact_phone" name="contact_phone" placeholder="Teléfono" type="tel">
								</div>
								<div class="con-field col-sm-12 field-address clearfix">
									<label class="label-tx" for="address_delivery">Dirección:</label>
									<input id="address_delivery" name="address_delivery" placeholder="Dirección" type="text">
								</div>
								<div class="con-field col-sm-12 field-address clearfix">
									<label class="label-tx" for="comment">Comentario:</label>
									<textarea  id="comment" name="comment" cols="30" rows="10" class="form-control"></textarea>
								</div>
							</div>
							<div class="clearfix"></div>
							<input class="btn btn-primary transition pull-right" type="submit" value="FINALIZAR">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
$(function(){

	$(document).on('submit','#request-form',function(e) {
	    
	    e.preventDefault();
	    var $form = $(this);
	    $.ajax({
	        url: '<?php echo $this->createUrl("/cart/page/request");?>',
	        dataType: 'json', 
	        type: 'post',
	        data: $form.serialize(),
	        success: function (data){

	          $.each($form.serializeArray(), function(index, name) {
	            $('[name='+name.name+']')
	              .parent()
	              .find('#validate-'+name.name)
	              .remove();
	          });

	          if(data.success) {
	            $('#mb-delivery').modal('hide');
	            $('#request-form')[0].reset();
	            bootbox.alert(data.message);
	            setTimeout(function(){
	            	window.location.href=data.redirect;
	            },4000);
	          } else if(data.success==0) {
	            
	            if(data.data) {
	            	$.each(data.data, function(name, errors) {
		              $('[name='+name+']')
		              .parent()
		              .append($('<p id="validate-'+name+'" style="text-align: left;color: #a94442;" class="help-block text-danger">'+errors.join(',<br>')+'</p>'));
		            });	
	            } else {
	            	bootbox.alert(data.message);
	            }
			  }
	        }
	    });
	});

	$(document).on('change','#check',function(e){
		var same = $(this).is(':checked');
        if(same) {
			$.ajax({
			    url:'<?php echo $this->createUrl("sameData")?>',
			    dataType: 'json',
			    data: { same: same},
			    success:function(data){
			    	if(data.data) {
						$.ajax({
						    url:'<?php echo $this->createUrl("cities")?>',
						    data: { state_id: data.data.departamento_id},
						    success:function(content){
								$('#users_city_delivery_id').html(content);
					    		$('#users_state_delivery_id').val(data.data.departamento_id);
					    		$('#users_city_delivery_id').val(data.data.ciudad_id);
					    		$('#contact_phone').val(data.data.phone);
					    		$('#address_delivery').val(data.data.address);
						    }
						});
			    	}
			    }
			});
        } else {
			$('#users_city_delivery_id').html('<option value="">Ciudad</option>');
    		$('#users_state_delivery_id').val('');
    		$('#users_city_delivery_id').val('');
    		$('#contact_phone').val('');
    		$('#address_delivery').val('');
        }
	});
	
	$(document).on('change','#users_state_delivery_id',function(e){
		var state_id = $(this).val();
		$.ajax({
		    url:'<?php echo $this->createUrl("cities")?>',
		    data: { state_id: state_id},
		    success:function(data){
		        $('#users_city_delivery_id').html(data);
		    }
		});		
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
		$('.data-sub_total').html(''+data.data.sub_total);
		$('.data-total_tax').html(''+data.data.total_tax);
		$('.data-shipping_cost').html(''+data.data.shipping_cost);
		$('.data-total').html(''+data.data.total);

		console.log("--------------------------------------");
		console.log("--",data,"--");
		console.log("--------------------------------------");
		
		for (var row in data.data.items) {
			console.log('.data-item-'+row+'');
			$('.data-item-input-'+row+'').val(data.data.items[row].quantity);
			$('.data-item-'+row+'').html(''+(data.data.items[row].unit_value));
			$('.data-item-'+row+'-total').html(''+(data.data.items[row].unit_value*data.data.items[row].quantity));
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

	$.fn.updateAmount = function (that) {

		var amount = parseInt(that.val());
		var id = that.attr('data-id');

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
					if(data.error_action=='update') {
						$.fn.updateCart(data);
					}
					if(data.error_code=='overdue') {
						$('.message-overpoints').html(data.message);
						$('.btn-continue')
						.removeClass('btn-primary')
						.addClass('btn-default');
						$('.btn-continue').prop('disabled',true);
					} else {
						$('.message-overpoints').html('');
						$('.btn-continue')
						.removeClass('btn-default')
						.addClass('btn-primary');
						$('.btn-continue').prop('disabled',false);
					}
					if(data.success) {
						$('.messages-amount').html('&nbsp;');
						$('.messages-amount-success').html(data.message);
						setTimeout(function(){
							$('.messages-amount-success').html('&nbsp;');
						},9000);
					} else {
						$('.messages-amount-success').html('&nbsp;');
						$('.messages-amount').html(data.message);
					}
				}
			});
			
		} else {
			$('.messages-amount-success').html('&nbsp;');
			$('.messages-amount').html('Ingrese un número válido');
		}
	};

	$(document).on('keyup change','.update-cart',function(e){
		if (window.event) { 
			keynum = e.keyCode; 
		} else { 
			keynum = e.which; 
		} 
		if ((keynum > 47 && keynum < 58) || keynum==8) {
			$.fn.updateAmount($(e.currentTarget));
		} else if(e.type == "change") {
			$.fn.updateAmount($(e.currentTarget));
		}
	});
});
</script>
		