<?php
/* @var $this PriceController */
/* @var $model PriceItems */

$this->breadcrumbs=array(
	'Prices'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
