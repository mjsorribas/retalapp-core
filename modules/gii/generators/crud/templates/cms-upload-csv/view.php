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
	Yii::t('app','View'),
);\n ?>";

?>
<div class="col-lg-12">
	<div class="alert alert-success">
		<em><strong><?php echo "<?=r('app','Congratulation!!! ;)')?>"?></strong> <?php echo "<?=r('app','All your contacts are right')?>"?></em>
	</div>
	<div class="col-lg-4"></div>
	<div class="col-lg-4">
		<a href="<?php echo "<?=\$this->createUrl(\"create\")?>"?>" class="btn btn-primary btn-lg btn-block"><?php echo "<?=r('app','Upload other')?>"?></a>
		<a href="<?php echo "<?=\$this->createUrl(\"admin\")?>"?>" class="btn btn-default btn-lg btn-block"><?php echo "<?=r('app','View all uploads')?>"?></a>
	</div>
	<div class="col-lg-4"></div>
</div>

