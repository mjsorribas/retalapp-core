<table border="1">
	<tr>
					<th>ID</th>
					<th>IMAGEN</th>
					<th>NOMBRE</th>
					<th>PERFIL</th>
					<th>ORDEN_ID</th>
			</tr>
	<?php foreach(ShoppingFacilitador::model()->findAll($model->search()->getCriteria()) as $data):?>
	<tr>
					<td><?=$data->id?></td>
					<td><?=$data->imagen?></td>
					<td><?=$data->nombre?></td>
					<td><?=$data->perfil?></td>
					<td><?=$data->orden_id?></td>
			</tr>
	<?php endforeach;?>
</table>