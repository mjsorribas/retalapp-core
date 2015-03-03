<table border="1">
	<tr>
					<th>ID</th>
					<th>MOBILE_ID_FROM</th>
					<th>MOBILE_ID_TO</th>
					<th>MESSAGE</th>
					<th>IMG_IMAGEN</th>
					<th>DATE_CREATED</th>
			</tr>
	<?php foreach(PushMessage::model()->findAll($model->search()->getCriteria()) as $data):?>
	<tr>
					<td><?=$data->id?></td>
					<td><?=$data->mobile_id_from?></td>
					<td><?=$data->mobile_id_to?></td>
					<td><?=$data->message?></td>
					<td><?=$data->img_imagen?></td>
					<td><?=$data->date_created?></td>
			</tr>
	<?php endforeach;?>
</table>