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
    <?php echo "<?php echo \$this->widget('ext.widgets.xheditor.XHeditor',array(
			    'model'=>\$model,
			    'modelAttribute'=>'{$this->viewName}',
			    'config'=>array(
			        'tools'=>'mfull', // mini, simple, mfull, full or from XHeditor::\$_tools, tool names are case sensitive
			        'skin'=>'default', // default, nostyle, o2007blue, o2007silver, vista
			        'width'=>'100%',
			        'height'=>'300px',
			        'upImgUrl'=>\$this->createUrl('request/uploadFile'), // NB! Access restricted by IP        'upImgExt'=>'jpg,jpeg,gif,png',
			    ),
			),true)?>\n"?>
    <?php echo "<?php echo \$form->error(\$model,'{$this->viewName}',array('class'=>'help-block')); ?>\n"?>
</div>