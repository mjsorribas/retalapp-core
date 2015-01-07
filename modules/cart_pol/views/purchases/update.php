<?php
/* @var $this PurchasesController */
/* @var $model CartShoppingHeader */

$this->breadcrumbs=array(
	'Purchases'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);
?>
<div class="col-lg-12">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>