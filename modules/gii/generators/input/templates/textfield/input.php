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
    <?php echo "<?php echo \$form->textField(\$model,'{$this->viewName}',array('class'=>'form-control')); ?>\n"?>
    <?php echo "<?php echo \$form->error(\$model,'{$this->viewName}',array('class'=>'help-block')); ?>\n"?>
</div>