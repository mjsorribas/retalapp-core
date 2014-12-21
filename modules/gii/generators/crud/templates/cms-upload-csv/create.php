<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$label=$this->labelName;
echo "\$this->breadcrumbs=array(
	'$label'=>array('admin'),
	Yii::t('app','Create'),
);\n ?>";

?>
<div class="col-lg-12">
	<?php echo "<?php if(\$errors!==array()):?>\n"?>
	<div class="alert alert-danger">
		<em><strong><?php echo "<?=r('app','Data validation errors')?>"?></strong> <?php echo "<?=r('app','Please review the following information and try again')?>"?></em>
	</div>

	<table class="table table-bordered">
		<?php echo "<?php foreach(\$errors as \$ID => \$data):?>"?>
		<tr>
			<td>ID <strong><?php echo "<?=\$ID?>"?></strong></td>
			<td>
				<?php echo "<?php foreach(\$data as \$label => \$row):?>\n"?>
					<strong><?php echo "<?=\$modelToUpload->getAttributeLabel(\$label)?>"?>:</strong> <br>
					<?php echo "<?php foreach(\$row as \$error):?>\n"?>
					<span><?php echo "<?=\$error?>\n"?></span><br>
					<?php echo "<?php endforeach;?>\n"?>
				<?php echo "<?php endforeach;?>\n"?>
			</td>
		</tr>
		<?php echo "<?php endforeach;?>\n"?>
	</table>
	<?php echo "<?php endif;?>\n"?>
	<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>\n"; ?>
</div>
