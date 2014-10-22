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
    <?php echo "<?php echo \$this->widget('yiiwheels.widgets.datetimepicker.WhDateTimePicker', array(
		        'model' => \$model,
		        'attribute' => '{$this->viewName}',
				'pluginOptions'=>array( 
			        'pick12HourFormat' => false,
		    		'format' => 'YYYY-MM-DD HH:mm:ss',
					'showButtonPanel' => true,
			        'changeYear' => true,
			    ),
				'htmlOptions' => array('class'=>'form-control'),
		    ),true) ?>\n"?>
    <?php echo "<?php echo \$form->error(\$model,'{$this->viewName}',array('class'=>'help-block')); ?>\n"?>
</div>