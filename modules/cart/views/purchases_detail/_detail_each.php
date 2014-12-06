<?php
/* @var $this Purchases_detailController */
/* @var $data CartShoppingDetail */
?>
<tr>
	<td class="text-center"><b class="text-muted"><?php echo CHtml::encode($data->cart_shoping_header_id); ?></b> <br> <?php echo CHtml::encode($data->getAttributeLabel('cart_shoping_header_id')); ?></td>
	<td class="text-center"><b class="text-muted"><?php echo CHtml::encode($data->product_id); ?></b> <br> <?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?></td>
	<td class="text-center"><b class="text-muted"><?php echo CHtml::encode($data->table_related); ?></b> <br> <?php echo CHtml::encode($data->getAttributeLabel('table_related')); ?></td>
	<td class="text-center"><b class="text-muted"><?php echo CHtml::encode($data->unit_value); ?></b> <br> <?php echo CHtml::encode($data->getAttributeLabel('unit_value')); ?></td>
	<td class="text-center"><b class="text-muted"><?php echo CHtml::encode($data->currency); ?></b> <br> <?php echo CHtml::encode($data->getAttributeLabel('currency')); ?></td>
	<td class="text-center"><b class="text-muted"><?php echo CHtml::encode($data->quantity); ?></b> <br> <?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?></td>
	<td class="text-center"><b class="text-muted"><?php echo CHtml::encode($data->tax_rate); ?></b> <br> <?php echo CHtml::encode($data->getAttributeLabel('tax_rate')); ?></td>
</tr>