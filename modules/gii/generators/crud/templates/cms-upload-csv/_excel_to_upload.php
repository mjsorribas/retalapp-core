<table border="1">
	<tr>
		<th>ID</th>
	</tr>
	<?php echo "<?php foreach(".$this->foraneKey."::model()->findAll(\$model->search()->getCriteria()) as \$data):?>\n"?>
	<tr>
		<td><?php echo "<?=\$data->id?>"?></td>
	</tr>
	<?php echo "<?php endforeach;?>\n"?>
</table>