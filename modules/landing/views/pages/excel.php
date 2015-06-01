<table border="1">
	<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>SLUG</th>
					<th>VIDEO</th>
					<th>IMAGE</th>
					<th>CALL</th>
					<th>CALL_TEXT</th>
					<th>CODE</th>
					<th>CREATED_AT</th>
					<th>ORDEN_ID</th>
			</tr>
	<?php foreach(LandingPages::model()->findAll($model->search()->getCriteria()) as $data):?>
	<tr>
					<td><?=$data->id?></td>
					<td><?=$data->name?></td>
					<td><?=$data->slug?></td>
					<td><?=$data->video?></td>
					<td><?=$data->image?></td>
					<td><?=$data->call?></td>
					<td><?=$data->call_text?></td>
					<td><?=$data->code?></td>
					<td><?=$data->created_at?></td>
					<td><?=$data->orden_id?></td>
			</tr>
	<?php endforeach;?>
</table>