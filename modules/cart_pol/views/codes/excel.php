<table border="1">
	<tr>
					<th>ID</th>
					<th>SECRET_CODE</th>
					<th>CREATED_AT</th>
					<th>STATE</th>
					<th>CART_UPLOAD_ID</th>
			</tr>
	<?php foreach(CartSecretCodes::model()->findAll($model->search()->getCriteria()) as $data):?>
	<tr>
					<td><?=$data->id?></td>
					<td><?=$data->secret_code?></td>
					<td><?=$data->created_at?></td>
					<td><?=$data->state?></td>
					<td><?=$data->cart_upload_id?></td>
			</tr>
	<?php endforeach;?>
</table>