<table border="1">
	<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>SLUG</th>
					<th>COLOR</th>
					<th>ICON</th>
					<th>ORDEN_ID</th>
			</tr>
	<?php foreach(ShoppingCategories::model()->findAll($model->search()->getCriteria()) as $data):?>
	<tr>
					<td><?=$data->id?></td>
					<td><?=$data->name?></td>
					<td><?=$data->slug?></td>
					<td><?=$data->color?></td>
					<td><?=$data->icon?></td>
					<td><?=$data->orden_id?></td>
			</tr>
	<?php endforeach;?>
</table>