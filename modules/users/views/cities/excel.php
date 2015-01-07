<table border="1">
	<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>CODE</th>
					<th>USERS_LOCATION_STATES_ID</th>
					<th>ORDEN_ID</th>
			</tr>
	<?php foreach(UsersLocationCities::model()->findAll($model->search()->getCriteria()) as $data):?>
	<tr>
					<td><?=$data->id?></td>
					<td><?=$data->name?></td>
					<td><?=$data->code?></td>
					<td><?=$data->users_location_states_id?></td>
					<td><?=$data->orden_id?></td>
			</tr>
	<?php endforeach;?>
</table>