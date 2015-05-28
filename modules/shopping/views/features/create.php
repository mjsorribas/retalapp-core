<?php
/* @var $this FeaturesController */
/* @var $model ShoppingFeatures */

$this->breadcrumbs=array(
	'Beneficios'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
