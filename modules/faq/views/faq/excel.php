<table border="1">
	<tr>
					<th>ID</th>
					<th>PREGUNTA</th>
					<th>RESPUESTA</th>
					<th>ORDEN_ID</th>
			</tr>
	<?php foreach(FaqFaq::model()->findAll($model->search()->getCriteria()) as $data):?>
	<tr>
					<td><?=$data->id?></td>
					<td><?=$data->pregunta?></td>
					<td><?=$data->respuesta?></td>
					<td><?=$data->orden_id?></td>
			</tr>
	<?php endforeach;?>
</table>