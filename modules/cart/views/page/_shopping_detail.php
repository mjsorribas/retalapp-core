<table class="zona_tb con_see">
<tbody>
   <tr>
      <td colspan="6">
         <?php if(isset($shop->cart_shipment_data) and $shop->cart_shipment_data!==null): ?>
            Destino: <?php echo @$shop->cart_shipment_data->city->locality?>,
            Dirección: <?php echo @$shop->cart_shipment_data->address_delivery?>
          <?php endif; ?>

      </td>
   </tr>
   <tr style="background: #eee;">
      <td>
         <h3>Referencia #</h3>
      </td>
      <td>
         <h3>Descripción</h3>
      </td>
      <td width="100">
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
