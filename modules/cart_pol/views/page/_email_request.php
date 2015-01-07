<?php
$simbol='$';
if($this->module->justRequest)
  $simbol='';
?>
<?php if($states!==null):?>
<strong>Fecha de <?=$states->description?>:</strong><span><?php echo r('#format')->formatSayDate(@$shop->created_at);?></span> <br>
<strong>Referencia de <?=$states->description?>:</strong><span><?php echo @$shop->ref_venta;?></span> <br>
<?php else:?>
<strong>Fecha:</strong><span><?php echo r('#format')->formatSayDate(@$shop->created_at);?> </span> <br>
<strong>Ref :</strong><span><?php echo @$shop->ref_venta;?></span> <br>
<?php endif;?>

<strong>Cliente:</strong><span><?php echo @$shop->user->name;?> <?php echo @$shop->user->lastname;?></span> <br>
<strong>Teléfono:</strong><span><?php echo @$shop->user->phone;?></span> <br>
<strong>Email:</strong><span><?php echo @$shop->user->email;?></span> <br>
<?php if(!empty($shop->address) and !empty($shop->city)): ?>
  <strong>Destino:</strong><span><?php echo $shop->city?></span> <br>
  <strong>Dirección:</strong><span><?php echo $shop->address?></span> <br>
<?php else: ?>
 <?php if(isset($shop->cart_shipment_data) and $shop->cart_shipment_data!==null): ?>
  <strong>Destino:</strong><span><?php echo @$shop->cart_shipment_data->city->name?></span> <br>
  <strong>Dirección:</strong><span><?php echo @$shop->cart_shipment_data->address_delivery?></span> <br>
 <?php endif; ?>
<?php endif; ?>
<hr>
<table style="width: 100%;margin-bottom: 20px;border-collapse: collapse;border-collapse: collapse;">
  <tr>
    <!-- <th>Producto</th> -->
    <th>Nombre</th>
    <th>Descripción</th>
    <th>Cantidad</th>
    <th>Valor unitario</th>
    <th>Total</th>
  </tr>
  <?php $subTotal=0?>
  <?php foreach($shop->items as $i => $data):?>
  <?php
    $row=CActiveRecord::model($data->table_related)->findByPk($data->product_id);
    $modelFields=$this->module->typesAllowed[$data->table_related];
    $modelId=$modelFields['id'];
    $modelUnitValue=$modelFields['unit_value'];
    $modelName=$modelFields['name'];
    $modelImage=$modelFields['image'];
    $modelDescription=$modelFields['description'];
    $modelExtra=$modelFields['extra'];

    if($row===null)
      continue;
  ?>
  <tr>
    <!-- <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;"><img class="img-responsive img-thumbnail" style="width:60px" src="<?php echo Yii::app()->request->baseUrl?>/uploads/<?php echo $row->{$modelImage}?>" alt=""></td> -->
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;"><?php echo $row->{$modelName}?></td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;"><?php echo substr($row->{$modelDescription}, 0,60)."..."?></td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;">
      <?php echo $data->quantity?>
    </td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;" class="data-item-<?php echo $i?>"><?=$simbol?><?php echo number_format($row->{$modelUnitValue})?></td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;" class="data-item-<?php echo $i?>-total"><?=$simbol?><?php echo number_format(($row->{$modelUnitValue})*$data->quantity)?></td>
  </tr>

  <?php $subTotal+=(($row->{$modelUnitValue})*$data->quantity)?>
  <?php endforeach;?>

</table>
  <?php #$subTotal?>

<?php $overallTax=$this->module->overall_tax?>
<?php $totalTax=$this->module->tax($overallTax,$subTotal);?>
<?php $shippingCost=$shop->shipping_cost?>
<?php $total=($subTotal+$totalTax+$shippingCost)?>
<table style="width: 100%;margin-bottom: 20px;margin-bottom: 20px;border-spacing: 0;border-collapse: collapse;">
  <?php if(!$this->module->justRequest):?>
  <tr>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;">&nbsp;</td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;">&nbsp;</td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;">&nbsp;</td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;text-align:right"><strong>SUBTOTAL</strong></td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;text-align:right"><?=$simbol?><?php echo number_format($subTotal)?></td>
  </tr>
  <tr>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;">&nbsp;</td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;">&nbsp;</td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;">&nbsp;</td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;text-align:right"><strong>IVA</strong></td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;text-align:right"><?=$simbol?><?php echo number_format($totalTax)?></td>
  </tr>
  <tr>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;">&nbsp;</td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;">&nbsp;</td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;">&nbsp;</td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;text-align:right"><strong>ENVÍO</strong></td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;text-align:right"><?=$simbol?><?php echo number_format($shippingCost)?></td>
  </tr>
  <?php endif;?>
  <tr>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;">&nbsp;</td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;">&nbsp;</td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;">&nbsp;</td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;text-align:right"><strong>TOTAL</strong></td>
    <td style="padding: 8px;
line-height: 1.4285714285714286;
vertical-align: top;
border-top: 1px solid #ddd;text-align:right"><?=$simbol?><?php echo number_format($total)?></td>
  </tr>
</table>
