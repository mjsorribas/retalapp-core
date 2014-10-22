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
<!-- FOr render your view you need to use sirToHtml method filter -->
<!-- <?php echo "<?php /*echo Yii::app()->format->sirToHtml(\$model->{$this->viewName}) */?>"?> -->
<div class="form-group">
	<?php echo "<?php #echo \$form->labelEx(\$model,'{$this->viewName}',array('class'=>'control-label')); ?>\n"?>
	<?php echo "<?php echo \$form->error(\$model,'{$this->viewName}',array('class'=>'help-block')); ?>\n"?>
	<?php echo "<?php echo \$this->widget('ext.inputs.sir-trevor.GSirTrevor',array(
			    'model'=>\$model,
			    'attribute'=>'{$this->viewName}',
				'uploadUrl'=>\$this->createUrl('upload'),
				// list of avalilables blocks
				'blockTypes'=>array(
					\"Heading\",
					\"Text\",
					\"List\",
					\"Quote\",
					\"Image\",
					\"Video\",
					\"Tweet\"
				),
				'blockLimit'=>0, // 0 is infinite bloks
				'required'=>array('Text'),
				'onEditorRender'=>'js:function(){
					console.log(\"Do something\")
				}',
				// 'blockTypeLimits'=>array(
				// 	'Text'=>'2',
				// 	'Image'=>'1',
				// ),
			),true);?>\n" ?>
</div>