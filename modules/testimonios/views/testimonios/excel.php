<table border="1">
	<tr>
					<th>ID</th>
					<th>IMAGEN</th>
					<th>TESTIMONIO</th>
					<th>NOMBRE_USUARIO</th>
					<th>OCUPACION_USUARIO</th>
					<th>ORDEN_ID</th>
			</tr>
	<?php foreach(TestimoniosTestimonios::model()->findAll($model->search()->getCriteria()) as $data):?>
	<tr>
					<td><?=$data->id?></td>
					<td><?=$data->imagen?></td>
					<td><?=$data->testimonio?></td>
					<td><?=$data->nombre_usuario?></td>
					<td><?=$data->ocupacion_usuario?></td>
					<td><?=$data->orden_id?></td>
			</tr>
	<?php endforeach;?>
</table>