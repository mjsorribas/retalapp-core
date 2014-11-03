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
    <?php echo "<?php echo \$this->widget('ext.inputs.radio.GThumbnail', array(
                'model'=>\$model,
                'attribute'=>'{$this->viewName}',
                'htmlOptions'=>array('class'=>'form-control'),
                'listData'=>array(
                  '1'=>'Example <strong>html</strong> support 1',
                  '2'=>'Example <strong>html</strong> support 2',
                  '3'=>'Example <strong>html</strong> support 3',
                  '4'=>'Example <strong>html</strong> support 4',
                  '5'=>'Example <strong>html</strong> support 5',
                  '6'=>'Example <strong>html</strong> support 6'
                ),
            ),true)?>\n"?>
    <?php echo "<?php echo \$form->error(\$model,'{$this->viewName}',array('class'=>'help-block')); ?>\n"?>
</div>
