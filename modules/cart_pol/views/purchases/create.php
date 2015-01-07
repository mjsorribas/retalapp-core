<?php
/* @var $this PurchasesController */
/* @var $model CartShoppingHeader */

$this->breadcrumbs=array(
	'Purchases'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
