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
    <?php echo "<?php echo \$this->widget('yiiwheels.widgets.formhelpers.WhSelectBox', array(
            	'model'=>\$model,
                'attribute'=>'{$this->viewName}',
				/* 'data' => CHtml::listData(".$this->modelClass."::model()->findAll(array('condition'=>'1=1')),'id','name') */
                'data' => array(
                	'1'=>'Value 1',
                	'2'=>'Value 2',
                	'3'=>'Value 3'
            	)
            ),true)?>\n"?>
    <?php echo "<?php echo \$form->error(\$model,'{$this->viewName}',array('class'=>'help-block')); ?>\n"?>
</div>