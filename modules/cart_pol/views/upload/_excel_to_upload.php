<table border="1">
	<tr>
		<th>ID</th>
	</tr>
	<?php foreach(CartSecretCodes::model()->findAll($model->search()->getCriteria()) as $data):?>
	<tr>
		<td><?=$data->id?></td>
	</tr>
	<?php endforeach;?>
</table>