<a class="back-bt tr" href="javascript:history.back()">« Volver</a>
<section>
   <div class="con-section">
<div class="mg-section cfx">
<div class="con-fletes cfx">
    <h1 class="pro-title">Valor del flete a nivel nacional</h1>
<ul class="fl">
<?php 
$i = 0; 
$cont = ceil(count($rates)/2);

foreach ($rates as $data) : 
  if($i == $cont){
    echo '</ul><ul class="fr">';
  }
  ?>
  <li><?php echo $data->locality ?></li><li><?php echo ($data->price==0)?"Pago contra entrega":"$".$data->price;  ?></li>
  
  <?php
  $i++;
endforeach;
?>
</ul>
  </div>
              
      </div>
   </div>
</section>

<!-- MODALES -->

