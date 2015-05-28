<table border="1">
	<tr>
					<th>ID</th>
					<th>IMAGE</th>
					<th>VIDEO_PROMOCIONAL</th>
					<th>NAME</th>
					<th>SLUG</th>
					<th>DESCRIPTION</th>
					<th>DESCRIPTION_DETAIL</th>
					<th>PRICE</th>
					<th>FREE</th>
					<th>STATE</th>
					<th>SHOPPING_CATEGORIES_ID</th>
					<th>TEMAS_RELACIONADOS</th>
					<th>SHOPPING_FACILITADOR_ID</th>
					<th>ORDEN_ID</th>
					<th>CREATED_AT</th>
			</tr>
	<?php foreach(ShoppingItems::model()->findAll($model->search()->getCriteria()) as $data):?>
	<tr>
					<td><?=$data->id?></td>
					<td><?=$data->image?></td>
					<td><?=$data->video_promocional?></td>
					<td><?=$data->name?></td>
					<td><?=$data->slug?></td>
					<td><?=$data->description?></td>
					<td><?=$data->description_detail?></td>
					<td><?=$data->price?></td>
					<td><?=$data->free?></td>
					<td><?=$data->state?></td>
					<td><?=$data->shopping_categories_id?></td>
					<td><?=$data->temas_relacionados?></td>
					<td><?=$data->shopping_facilitador_id?></td>
					<td><?=$data->orden_id?></td>
					<td><?=$data->created_at?></td>
			</tr>
	<?php endforeach;?>
</table>