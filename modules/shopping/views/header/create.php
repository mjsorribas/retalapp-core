<?php
/* @var $this HeaderController */
/* @var $model ShoppingHeader */

$this->breadcrumbs=array(
	'Compras'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
