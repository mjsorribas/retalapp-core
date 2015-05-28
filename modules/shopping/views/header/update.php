<?php
/* @var $this HeaderController */
/* @var $model ShoppingHeader */

$this->breadcrumbs=array(
	'Compras'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);
?>
<div class="col-lg-12">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>