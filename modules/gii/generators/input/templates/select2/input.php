<?php
/**
 * This is the template for generating the action script for the form.
 * - $this: the CrudCode object
 */
?>
<?php
$this->modelClass;
$viewName=basename($this->viewName);
?>
<div class="form-group">
    <?php echo "<?php echo \$form->labelEx(\$model,'{$this->viewName}',array('class'=>'control-label')); ?>\n"?>
    <?php echo "<?php echo \$this->widget('ext.inputs.select2.ESelect2',array(
            'model'=>\$model,
            'attribute'=>'{$this->viewName}',
            'data'=>array(
                '1'=>'Value 1',
                '2'=>'Value 2',
                '3'=>'Value 3',
            ),
            // 'data'=>UsersUsers::listData(),
            'htmlOptions'=>array('class'=>'form-control'),
        ),true)?>\n"?>
    <?php echo "<?php echo \$form->error(\$model,'{$this->viewName}',array('class'=>'help-block')); ?>\n"?>
</div>