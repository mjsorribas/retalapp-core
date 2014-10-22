<?php
/**
 * This is the template for generating a form script file.
 * The following variables are available in this template:
 * - $this: the FormCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getModelClass(); ?>Controller */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form CActiveForm */
?>

<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to view detail of -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="<?php echo $this->class2id($this->modelClass)?>-modal" tabindex="-1" role="<?php echo $this->class2id($this->modelClass)?>-modal" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title"><?php echo "<?php echo Yii::t('app','{$this->modelClass}')?>"?></h4>
        </div>
    	<div class="modal-body">

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'action'=>\$this->createUrl('".($this->viewName)."'),
	'htmlOptions'=>array('class'=>'form-horizontal','role'=>'form'),
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnChange'=>false,
		'validateOnSubmit'=>true,		
		'beforeValidate'=>\"js:function(form){
	    	$('.".$this->class2id($this->modelClass)."-submit').addClass('disabled');
	    	$('.".$this->class2id($this->modelClass)."-loading').removeClass('hide');
	    }\",
		'afterValidate'=>\"js:function(form,data,hasError){ 
	    	$('.".$this->class2id($this->modelClass)."-submit').removeClass('disabled');
	    	$('.".$this->class2id($this->modelClass)."-loading').addClass('hide');
			if(!hasError) {
				form.each (function(){
				  this.reset();
				});
				$('#".$this->class2id($this->modelClass)."-modal').modal('hide');
				return false;
			}
			return false;
		}\",
	),
)); ?>\n"; ?>


<?php foreach($this->getModelAttributes() as $attribute): ?>
	<div class="form-group">
		<?php echo "<?php echo \$form->labelEx(\$model,'{$attribute}',array('class'=>'control-label')); ?>\n"; ?>
		<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$attribute)."; ?>\n"; ?>
		<?php echo "<?php echo \$form->error(\$model,'{$attribute}',array('class'=>'help-block')); ?>\n"; ?>
    </div>
<?php endforeach; ?>
   
<div class="modal-footer">
	<button type="button" class="btn default" data-dismiss="modal"><?php echo "<?php echo Yii::t('app','Cancel')?>"?></button>
	<i class="hide fa fa-cog fa-spin spiner <?php echo $this->class2id($this->modelClass)?>-loading"></i>
	<?php echo "<?php echo CHtml::submitButton(Yii::t('app','Send'),array('class'=>'".$this->class2id($this->modelClass)."-submit btn btn-primary btn-large')); ?>\n"; ?>
</div>
<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

        </div>
        </div>
    </div>
</div>