<?php
/* @var $this RatesController */
/* @var $model CartShippingRates */

$this->breadcrumbs=array(
	'Shipping Rates'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
