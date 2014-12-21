ID (Numeric);Field 2 (Numeric)<?php echo "\n";?>
<?php echo "<?php foreach(Model::model()->findAll(\$model->search()->getCriteria()) as \$data):?>\n"?>
<?php echo "<?=\$data->id?>"?>;<?php echo "<?php echo (int)\$data->field2.\"\\\n\"?>"?>
<?php echo "<?php endforeach;?>\n"?>