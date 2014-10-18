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
    <?php echo "<?php echo \$this->widget('ext.inputs.radio.GStatus',array(
				'model'=>\$model,
				'attribute'=>'{$this->viewName}',
				'listData'=>array(
				  	'default'=>'<span class=\"label label-default\">Default</span>',
					'primary'=>'<span class=\"label label-primary\">Primary</span>',
					'success'=>'<span class=\"label label-success\">Success</span>',
					'info'=>'<span class=\"label label-info\">Info</span>',
					'warning'=>'<span class=\"label label-warning\">Warning</span>',
					'danger'=>'<span class=\"label label-danger\">Danger</span>'
				)
			),true)?>\n"?>
    <?php echo "<?php echo \$form->error(\$model,'{$this->viewName}',array('class'=>'help-block')); ?>\n"?>
</div>