<table border="1">
	<tr>
					<th>ID</th>
					<th>VIDEO</th>
					<th>TITULO</th>
					<th>DESCRIPCION</th>
					<th>ORDEN_ID</th>
			</tr>
	<?php foreach(VideosVideos::model()->findAll($model->search()->getCriteria()) as $data):?>
	<tr>
					<td><?=$data->id?></td>
					<td><?=$data->video?></td>
					<td><?=$data->titulo?></td>
					<td><?=$data->descripcion?></td>
					<td><?=$data->orden_id?></td>
			</tr>
	<?php endforeach;?>
</table>