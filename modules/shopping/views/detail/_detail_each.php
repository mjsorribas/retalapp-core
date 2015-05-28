<?php
/* @var $this DetailController */
/* @var $data ShoppingDetail */
?>
<tr>
	<td>
		<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b> <br>
		<?php echo CHtml::encode($data->name); ?>
	</td>
	<td>
	<?php if(!empty($data->image)):?>
		<img style="width:100px" src="<?php echo $data->image_path?>" alt="">
	<?php else:?>
		<img style="width:100px" src="http://placehold.it/100x150" alt="">
	<?php endif;?>
	</td>
	<?php if(!isset($email)): ?>
	<td>
		<b><?php echo CHtml::encode($data->getAttributeLabel('description_detail')); ?>:</b>
	<br />
	<?php echo ($data->description_detail); ?>

	</td>
	<?php endif; ?>
	<td>
			<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<br />
	<?php echo "$".r()->format->money($data->price); ?>

	</td>
	<td>
			<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<br />
	<?php echo CHtml::encode($data->amount); ?>

	</td>
	<td>
			<b>Subtotal:</b>
	<br />
	<?php echo "$".r()->format->money($data->price*$data->amount); ?>

	</td>
</tr>