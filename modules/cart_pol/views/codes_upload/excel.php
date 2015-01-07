<table border="1">
	<tr>
					<th>ID</th>
					<th>FILE</th>
					<th>CREATED_AT</th>
					<th>USERS_USERS_ID</th>
			</tr>
	<?php foreach(CartUpload::model()->findAll($model->search()->getCriteria()) as $data):?>
	<tr>
					<td><?=$data->id?></td>
					<td><?=$data->file?></td>
					<td><?=$data->created_at?></td>
					<td><?=$data->users_users_id?></td>
			</tr>
	<?php endforeach;?>
</table>