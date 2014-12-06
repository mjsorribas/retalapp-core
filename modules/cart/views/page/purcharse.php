<a class="back-bt tr" href="javascript:history.back()">« Volver</a>
<section>
   <div class="con-section">
      <div class="mg-section cfx">
         <div class="cfx"></div>
         <div class="con_sedes">

         <?php if(count($purcharses)<=0 and count($pending)<=0 and count($request)<=0):?>

      <h1 class="pro-title">Hola <?=r('#user')->name?>! Has tu primer compra o pedido</h1>
      <div class="con-carro-bts cfx">
        <a class="carro-bt modals-act fr tr" href="<?php echo $this->createUrl("/catalogo/page/productos")?>">Ver productos<span class="con_tool">Encuentra el producto que necesitas<i class="tr"></i></span></a>
      </div>

         <?php endif;?>
            <div class="tabs_zona">

         <?php
         $activePurcharses=false;
         $activePending=false;
         $activeRequest=false;

         if(count($purcharses)>0) {
             $activePurcharses=true;
             $activePending=false;
             $activeRequest=false;
         }

         if(count($purcharses)<=0 and count($pending)>0) {
              $activePurcharses=false;
              $activePending=true;
              $activeRequest=false;
         }

         if(count($purcharses)<=0 and count($pending)<=0 and count($request)>0) {
             $activePurcharses=false;
             $activePending=false;
             $activeRequest=true;
         }


         ?>
            <?php if(count($purcharses)>0):?>
              <a class="tab_zona<?php echo $activePurcharses?" tab_zona_act":"";?>" data-rel="zona_tab1">Mis compras online</a>
            <?php endif;?>
            <?php if(count($pending)>0):?>
              <a class="tab_zona<?php echo $activePending?" tab_zona_act":"";?>" data-rel="zona_tab2">Mis compras pendientes</a>
            <?php endif;?>
            <?php if(count($request)>0):?>
              <a class="tab_zona<?php echo $activeRequest?" tab_zona_act":"";?>" data-rel="zona_tab3">Mis pedidos</a>
            <?php endif;?>

            </div>

            <?php if(count($purcharses)>0):?>
            <div class="con_zona_tab zona_tab1" <?php echo $activePurcharses?"style=\"display: block;\"":"style=\"display: none;\"";?>>
              <?php foreach($purcharses as $shop):?>
               <h2 class="tab tr">
                  Referencia #<?php echo $shop->ref_venta?>
                  <!--
                  <div class="tab_remove fr">Eliminar</div>
                  -->
                  <span class="fr tr"><strong>Total: </strong>$<?php echo r('#format')->money($shop->getTotalShipping())?></span> <span class="fr tr"><?php echo r('#format')->formatShortTime($shop->created_at)?></span>
                  <div class="tab_close fr"></div>
               </h2>

               <?php $this->renderPartial('_shopping_detail',array('shop'=>$shop,'shoppingPrice'=>true));?>
               <?php endforeach;?>
            </div>
            <?php endif;?>

            <?php if(count($pending)>0):?>
            <div class="con_zona_tab zona_tab2" <?php echo $activePending?"style=\"display: block;\"":"style=\"display: none;\"";?>>
               <?php foreach($pending as $shop):?>
               <h2 class="tab tr">
                  Fecha: <?php echo r('#format')->formatShortTime($shop->created_at)?>
                  <div data-id="<?php echo $shop->id?>" class="tab_remove fr">Eliminar</div>
                  <a class="tab_pay fr go-shop" data-id="<?php echo $shop->id?>" href="#">Pagar ahora</a> <span class="fr tr"><strong>Total: </strong>$<?php echo r('#format')->money($shop->getTotalShipping())?></span>
                  <div class="tab_close fr"></div>
               </h2>

               <?php $this->renderPartial('_shopping_detail',array('shop'=>$shop));?>
               <?php endforeach;?>
            </div>
            <?php endif;?>

            <?php if(count($request)>0):?>
            <div class="con_zona_tab zona_tab3" <?php echo $activeRequest?"style=\"display: block;\"":"style=\"display: none;\"";?>>

               <?php foreach($request as $shop):?>
               <h2 class="tab tr">
                  Referencia de pedido #<?php echo $shop->ref_venta?>
                  <div data-id="<?php echo $shop->id?>" class="tab_remove fr">Eliminar</div>
                  <span class="fr tr"><strong>Total: </strong>$<?php echo r('#format')->money($shop->getTotalShipping())?></span> <span class="fr tr"><?php echo r('#format')->formatShortTime($shop->created_at)?></span>
                  <div class="tab_close fr"></div>
               </h2>

               <?php $this->renderPartial('_shopping_detail',array('shop'=>$shop,'shoppingPrice'=>true));?>
               <?php endforeach;?>
            </div>
            <?php endif;?>


         </div>
      </div>
   </div>
</section>

<script type="text/javascript">
$(function(){

$(document).on('click','.go-shop',function(e) {

  e.preventDefault();
  e.stopPropagation();

 var purcharse_id = $(this).attr('data-id');
 $.ajax({
     url: '<?php echo $this->createUrl("shopIdAjax");?>',
     dataType: 'json',
     type: 'post',
     data: {'purcharse_id':purcharse_id},
     success: function (data){

       if(data.success) {

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

          $.fn.modal(data.message,'');

       }
     }
 });

});


$(document).on('click','.tab_remove',function (e) {
  e.preventDefault();
    var that = $(this);
    var purcharse_id = that.attr('data-id');
   $.ajax({
       url: '<?php echo $this->createUrl("shopRemoveAjax");?>',
       dataType: 'json',
       type: 'post',
       data: {'purcharse_id':purcharse_id},
       success: function (data){

         if(data.success) {

            that.parent(".tab").hide();
            that.parent(".tab").next().hide();

         } else {

            $.fn.modal(data.message,'');

         }
       }
   });

});

})
</script>
