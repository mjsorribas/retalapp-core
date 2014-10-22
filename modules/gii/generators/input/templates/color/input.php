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
    <?php echo "<?php echo \$this->widget('ext.inputs.radio.GFontAwesome',array(
				'model'=>\$model,
				'attribute'=>'{$this->viewName}',
			),true)?>\n"?>
    <?php echo "<?php echo \$form->error(\$model,'{$this->viewName}',array('class'=>'help-block')); ?>\n"?>
</div>