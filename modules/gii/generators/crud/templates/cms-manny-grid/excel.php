<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
$arratClean=Yii::app()->getModule('gii')->arrayClean;
$module=Yii::app()->getModule('gii');
?><table border="1">
	<tr>
		<?php foreach($this->tableSchema->columns as $column):?>
			<th><?=strtoupper($column->name)?></th>
		<?php endforeach;?>
	</tr>
	<?php echo "<?php foreach({$this->modelClass}::model()->findAll(\$model->search()->getCriteria()) as \$data):?>\n"?>
	<tr>
		<?php foreach($this->tableSchema->columns as $column):?>
			<td><?php echo "<?=\$data->{$column->name}?>"?></td>
		<?php endforeach;?>
	</tr>
	<?php echo "<?php endforeach;?>\n"?>
</table>