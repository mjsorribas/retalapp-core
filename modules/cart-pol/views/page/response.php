<section>
	<div class="container">
    <div class="mg-grl cfx">
      <h1 class="main-tt fl">Resumen Transacción<span><i></i></span></h1>
      <div class="cfx"></div>
      <p align="justify">

		<div class="con-tb">
            <!-- <h2 class="bg1">DETALLES DEL PAGO</h2> -->
<?php
if(r()->pol->typePlataform=='payu') {
  $ApiKey=Yii::app()->pol->ApiKey;/////llave de usuario de pruebas 2 6u39nqhq8ftd0hlvnjfs66eh8c
  $merchant_id=$_REQUEST['merchantId'];
  $referenceCode=$_REQUEST['referenceCode'];
  $TX_VALUE=$_REQUEST['TX_VALUE'];
  $New_value=number_format($TX_VALUE, 1, '.', '');
  $currency=$_REQUEST['currency'];
  $transactionState=$_REQUEST['transactionState'];
  $firma_cadena= "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
  $firmacreada = md5($firma_cadena);//firma que generaron ustedes
  $firma =$_REQUEST['signature'];//firma que envía nuestro sistema 
  /*echo $firma;
  echo ‘——’;
  echo $firmacreada;
  echo $ApiKey; echo ‘~’;echo $usuario_id;echo ‘~’;echo $ref_venta;echo ‘~’;echo $New_value;echo ‘~’;echo $moneda;echo ‘~’;echo $estado_pol;
  echo ‘ – ‘ ;
  echo $firma_cadena; 
  echo $firma; //verificación firmas codificadas
  echo ‘ – ‘ ;
  echo $firmacreada;
  $processingDate=$_REQUEST['processingDate'];
  $processingDate = date("Y-m-d H:i:s");*/
  $reference_pol=$_REQUEST['reference_pol'];
  $cus=$_REQUEST['cus'];
  $extra1=$_REQUEST['description'];
  $pseBank=$_REQUEST['pseBank'];
  $lapPaymentMethod=$_REQUEST['lapPaymentMethod'];
  $transactionId=$_REQUEST['transactionId'];
  if($_REQUEST['transactionState'] == 6 && $_REQUEST['polResponseCode'] == 5)
  {$estadoTx = "Transacci&oacute;n fallida";}
  else if($_REQUEST['transactionState'] == 6 && $_REQUEST['polResponseCode'] == 4)
  {$estadoTx = "Transacci&oacute;n rechazada";}
  else if($_REQUEST['transactionState'] == 12 && $_REQUEST['polResponseCode'] == 9994)
  {$estadoTx = "Pendiente, Por favor revisar si el d&eacute;bito fue realizado en el Banco";}
  else if($_REQUEST['transactionState'] == 4 && $_REQUEST['polResponseCode'] == 1)
  {$estadoTx = "Transacci&oacute;n aprobada";}
  else
  {
    $estadoTx=@$_REQUEST['mensaje'];
  }
} else {
  $ApiKey=Yii::app()->pol->ApiKey;/////llave de usuario de pruebas 2 6u39nqhq8ftd0hlvnjfs66eh8c
  $merchant_id=$_REQUEST['usuario_id'];
  $referenceCode=$_REQUEST['ref_venta'];
  $TX_VALUE=@$_REQUEST['TX_VALUE'];
  $New_value=number_format($TX_VALUE, 1, '.', '');
  $currency=$_REQUEST['moneda'];
  $transactionState=$_REQUEST['estado_pol'];
  $firma_cadena= "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
  $firmacreada = md5($firma_cadena);//firma que generaron ustedes
  $firma =$_REQUEST['firma'];//firma que envía nuestro sistema 
  /*echo $firma;
  echo ‘——’;
  echo $firmacreada;
  echo $ApiKey; echo ‘~’;echo $usuario_id;echo ‘~’;echo $ref_venta;echo ‘~’;echo $New_value;echo ‘~’;echo $moneda;echo ‘~’;echo $estado_pol;
  echo ‘ – ‘ ;
  echo $firma_cadena; 
  echo $firma; //verificación firmas codificadas
  echo ‘ – ‘ ;
  echo $firmacreada;
  $processingDate=$_REQUEST['processingDate'];
  $processingDate = date("Y-m-d H:i:s");*/
  $reference_pol=$_REQUEST['ref_pol'];
  $cus=$_REQUEST['cus'];
  $extra1=@$_REQUEST['extra1'];
  $pseBank=$_REQUEST['banco_pse'];
  $lapPaymentMethod=$_REQUEST['tipo_medio_pago'];
  $transactionId=$_REQUEST['ref_pol'];
  if($_REQUEST['estado_pol'] == 6 && $_REQUEST['codigo_respuesta_pol'] == 5)
  {$estadoTx = "Transacci&oacute;n fallida";}
  else if($_REQUEST['estado_pol'] == 6 && $_REQUEST['codigo_respuesta_pol'] == 4)
  {$estadoTx = "Transacci&oacute;n rechazada";}
  else if($_REQUEST['estado_pol'] == 12 && $_REQUEST['codigo_respuesta_pol'] == 9994)
  {$estadoTx = "Pendiente, Por favor revisar si el d&eacute;bito fue realizado en el Banco";}
  else if($_REQUEST['estado_pol'] == 4 && $_REQUEST['codigo_respuesta_pol'] == 1)
  {$estadoTx = "Transacci&oacute;n aprobada";}
  else
  {
    $estadoTx=@$_REQUEST['mensaje'];
  }
}

if(strtoupper($firma)==strtoupper($firmacreada)){//comparacion de las firmas para comprobar que los datos si vienen de Pagosonline
?>
<table class="table table-striped">
<tr>
<td>Estado de la transaccion</td>
<td><?php echo $estadoTx; ?> </td>
</tr>
<tr>
<tr>
<td>ID de la transaccion</td>
<td><?php echo $transactionId; ?> </td>
</tr>
<tr>
<td>referencia de la venta </td>
<td><?php echo $reference_pol; ?> </td> </tr>
<tr>
<td>Referencia de la transaccion </td>
<td><?php echo $referenceCode; ?> </td>
</tr>
<tr>
<?php
if(isset($banco_pse) and $banco_pse!=null){
?>
<tr>
<td>cus </td>
<td><?php echo $cus; ?> </td>
</tr>
<tr>
<td>Banco </td>
<td><?php echo $pseBank; ?> </td>
</tr>
<?php
}
?>
<tr>
<td>Valor total</td>
<td>$<?php echo number_format($TX_VALUE); ?> </td>
</tr>
<tr>
<td>moneda </td>
<td><?php echo $currency; ?></td>
</tr>
<tr>
<td>Descripción:</td>
<td><?php echo ($extra1); ?></td>
</tr>
<tr>
<td>Entidad:</td>
<td><?php echo ($lapPaymentMethod); ?></td>
</tr>

<?php if(r()->pol->typePlataform=='payu'):?>
<?php if($_REQUEST['transactionState'] == 4 && $_REQUEST['polResponseCode'] == 1):?>
<tr>
<td colspan="2">
<a href="<?php echo CHtml::normalizeUrl($this->module->returnUrlAfterPay)?>" style="padding-left: 24px;" id="button-continuar" class="btn-irapagar submit-bt grl-bt fr tr"><?php echo CHtml::image(Yii::app()->request->baseUrl."/img/spinner.gif",'',array('style'=>'display:inline;width: 21px;margin-right:8px'))?> Cargando...</a>
</td>
</tr>
<?php endif;?>
<?php else:?>

  <?php if($_REQUEST['estado_pol'] == 4 && $_REQUEST['codigo_respuesta_pol'] == 1):?>
<tr>
<td colspan="2">
<a href="<?php echo CHtml::normalizeUrl($this->module->returnUrlAfterPay)?>" style="padding-left: 24px;" id="button-continuar" class="btn-irapagar submit-bt grl-bt fr tr"><?php echo CHtml::image(Yii::app()->request->baseUrl."/img/spinner.gif",'',array('style'=>'display:inline;width: 21px;margin-right:8px'))?> Cargando...</a>
</td>
</tr>
<?php endif;?>
<?php endif;?>


</table>


<?php
}else{
?>
<table border="1" bordercolor="#ccc" class="tbr1 bs table-pagos" width="100%">
<tr>
<th width="100%" scope="col"><h1>Error validando firma digital.</h1>
<br />
</tr>
</table>
<?php
}
?>
          </div>			
      </p>
    </div>
  </div>
</section>

<script>
$(function(){
  setTimeout(function(){
    $('#button-continuar').html('Continuar');
    $('#button-continuar').removeClass('btn-irapagar');
    // $('#button-continuar').addClass('bt-icon1');
  },3500);
});
</script>