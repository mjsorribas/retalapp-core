<?php if($states!==null):?>
<strong>Fecha de <?=$states->description?>:</strong><span><?php echo r('#format')->formatSayDate(@$shop->created_at);?> <span style="color:#ccc"><?php echo r('#format')->formatAgoComment(@$shop->created_at);?></span></span> <br>
<strong>Referencia de <?=$states->description?>:</strong><span><?php echo @$shop->ref_venta;?></span> <br>
<?php else:?>
<strong>Fecha de Compra:</strong><span><?php echo r('#format')->formatSayDate(@$shop->created_at);?> <span style="color:#ccc"><?php echo r('#format')->formatAgoComment(@$shop->created_at);?></span></span> <br>
<strong>Referencia :</strong><span><?php echo @$shop->ref_venta;?></span> <br>
<?php endif;?>

<strong>Tipo de cliente:</strong><span><?php echo @$shop->user->tipo->nombre;?></span> <br>
<strong>Nombre del cliente:</strong><span><?php echo @$shop->user->name;?></span> <br>
<strong>Cédula:</strong><span><?php echo @$shop->user->card_identity;?></span> <br>
<strong>Ciudad:</strong><span><?php echo @$shop->user->ciudad;?></span> <br>
<strong>Dirección:</strong><span><?php echo @$shop->user->address;?></span> <br>
<strong>Teléfono:</strong><span><?php echo @$shop->user->phone;?></span> <br>
<strong>Observaciones:</strong> <br>
<span><?php echo @$shop->comment;?></span> <br>
<hr>
<table class="">
<tbody>
   <tr>
      <td colspan="6">
         <h3>
          <?php if(isset($shop->cart_shipment_data) and $shop->cart_shipment_data!==null): ?>
            Destino: <?php echo @$shop->cart_shipment_data->city->locality?> <br>
            Dirección: <?php echo @$shop->cart_shipment_data->address_delivery?>
          <?php endif; ?>
        </h3>
      </td>
   </tr>
   <tr style="background: #eee;">
      <?php if(isset($showCodigoOrmos)):?>
      <td>
         <h3>Código Ormos</h3>
      </td>
      <?php endif;?>
      <td>
         <h3>Descripción</h3>
      </td>
      <td>
         <h3>Marca</h3>
      </td>
      <td>
         <h3>Cantidad</h3>
      </td>
      <td>
         <h3>Valor unitario</h3>
      </td>
      <td>
         <h3>Sub-total</h3>
      </td>
   </tr>
  <?php $subTotal=0?>
  <?php foreach($shop->items as $i => $data):?>
  <?php
    
    
    $unitValue=$data->unit_value;


  ?>
  <tr>
  <?php if(isset($showCodigoOrmos)):?>
    <td><?php echo $data->codigo_ormos?></td>
  <?php endif;?>
    <td><?php echo $data->ref?></td>
    <td><?php echo substr($data->description, 0,60)."..."?></td>
    <td><?php echo $data->marca?></td>
    <td>
      <?php echo $data->quantity?>
    </td>
    <td class="data-item-<?php echo $i?>">$<?php echo r('#format')->money($unitValue)?></td>
    <td class="data-item-<?php echo $i?>-total">$<?php echo r('#format')->money(($unitValue)*$data->quantity)?></td>
  </tr>

  <?php $subTotal+=(($unitValue)*$data->quantity)?>
  <?php endforeach;?>


<?php $overallTax=$this->module->overall_tax?>
<?php $totalTax=$this->module->tax($overallTax,$subTotal);?>
<?php $shippingCost=$shop->shipping_cost?>
<?php $total=($subTotal+$totalTax+$shippingCost)?>

 <tr>
    <td colspan="4"></td>
    <td class="text-right"><strong>SUBTOTAL</strong></td>
    <td class="text-right" style="width:120px">$<?php echo r('#format')->money($subTotal)?></td>
  </tr>
  <tr>
    <td colspan="4"></td>
    <td class="text-right"><strong>ENVÍO</strong></td>
    <td class="text-right" style="width:120px">$<?php echo r('#format')->money($shippingCost)?></td>
  </tr>
  <tr>
    <td colspan="4"></td>
    <td class="text-right"><strong>TOTAL</strong></td>
    <td class="text-right" style="width:120px">$<?php echo r('#format')->money($total)?></td>
  </tr>



                  </tbody>
               </table>
