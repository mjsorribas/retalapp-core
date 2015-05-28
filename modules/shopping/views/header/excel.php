<table border="1">
	<tr>
					<th>ID</th>
					<th>Nombre Comprador</th>
					<th>Email Comprador</th>
					<th>Teléfono Comprador</th>
					<th>Dirección Comprador</th>
					<th>Mensaje para el destinatario</th>
					<th>Nombre destinatario</th>
					<th>Teléfono destinatario</th>
					<th>Dirección destinatario</th>
					<th>Fecha de entrega</th>
					<th>Fecha de la compra o pedido</th>
					<th>Estado</th>
					<th>Fecha respuesta PAYU</th>
					<th>Mensaje respuesta PAYU</th>
					<th>Código respuesta PAYU</th>
					<th>Código 2 respuesta PAYU</th>
			</tr>
	<?php foreach(ShoppingHeader::model()->findAll($model->search()->getCriteria()) as $data):?>
	<tr>
					<td><?=$data->id?></td>
					<td><?=$data->buyer_name?></td>
					<td><?=$data->buyer_email?></td>
					<td><?=$data->buyer_phone?></td>
					<td><?=$data->buyer_address?></td>
					<td><?=$data->buyer_message?></td>
					<td><?=$data->send_name?></td>
					<td><?=$data->send_phone?></td>
					<td><?=$data->send_address?></td>
					<td><?=$data->send_date?></td>
					<td><?=$data->created_at?></td>
					<td><?=$data->getStateName()?></td>
					<td><?=$data->datetime_return_pay;?></td>
					<td><?=$data->message_return_pay;?></td>
					<td><?=$data->code_response_pay;?></td>
					<td><?=$data->code2_response_pay;?></td>
			</tr>
	<?php endforeach;?>
</table>