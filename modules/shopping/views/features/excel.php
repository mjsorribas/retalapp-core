<table border="1">
	<tr>
					<th>ID</th>
					<th>IMAGE</th>
					<th>TITLE</th>
					<th>DESCRIPTION</th>
					<th>ORDEN_ID</th>
			</tr>
	<?php foreach(ShoppingFeatures::model()->findAll($model->search()->getCriteria()) as $data):?>
	<tr>
					<td><?=$data->id?></td>
					<td><?=$data->image?></td>
					<td><?=$data->title?></td>
					<td><?=$data->description?></td>
					<td><?=$data->orden_id?></td>
			</tr>
	<?php endforeach;?>
</table>