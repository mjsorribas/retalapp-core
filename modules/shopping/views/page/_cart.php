<?php $cart=r()->user->getState('cart',array());?>
<div class="w100 scroll-pane" style="background-color: #fff">
  <table style="width: 100%;  border-bottom: 1px solid #ccc;">
    <tbody>
      <?php $total=0;?>
      <?php foreach($cart as $id =>$data):?>
      <?php $model=ShoppingItems::model()->findByPk($data['id'])?>
      <tr class="miniCartProduct">
        <td class="miniCartProductThumb">
        <div> 
          <?php if(!empty($model->image)):?>
            <img style="width: 80px;" src="<?=$model->image_path?>" alt="img"> 
          <?php else:?>
            &nbsp;
          <?php endif;?>
        </div>
        </td>
        <td><div class="miniCartDescription">
            <h4> 
            <?php echo substr($model->name, 0,30)."..."?>
            <!-- <a data-target="#product-details-modal" data-toggle="modal" href="#"> </a> -->
            </h4>
            <div class="price"> <span> $<?php echo r()->format->money($model->price)?> </span> </div>
          </div></td>
        <td class="miniCartQuantity price"><span><?php echo $data['amount']?> Unds</span></td>
        <td class="miniCartSubtotal price"><span> $<?php echo r()->format->money($data['amount']*$model->price)?> </span></td>
        <td data-id="<?php echo $data['id']?>" class="delete-to-cart"><a class="btn btn-qubico btn-sm"><i class="fa fa-trash-o"></i></a></td>
      </tr>
      <?php $total+=$data['amount']*$model->price;?>
      <?php endforeach;?>
      <tr class="miniCartProduct" style="border-bottom: 1px solid #ccc;
  border-top: 1px solid #ccc;">
        <td class="miniCartProductThumb"><div></div></td>
        <td><div class="miniCartDescription">
          TOTAL: 
        </div></td>
        <td class="miniCartQuantity"></td>
        <td class="miniCartSubtotal price"><span>$<?php echo r()->format->money($total)?> </span></td>
        <td>&nbsp;</td>
      </tr>

    </tbody>
  </table>
</div>