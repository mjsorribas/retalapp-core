<table border="1">
	<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>CODE</th>
					<th>ORDEN_ID</th>
			</tr>
	<?php foreach(UsersLocationCountries::model()->findAll($model->search()->getCriteria()) as $data):?>
	<tr>
					<td><?=$data->id?></td>
					<td><?=$data->name?></td>
					<td><?=$data->code?></td>
					<td><?=$data->orden_id?></td>
			</tr>
	<?php endforeach;?>
</table>