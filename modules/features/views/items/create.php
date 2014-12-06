<?php
/* @var $this ItemsController */
/* @var $model FeaturesItems */

$this->breadcrumbs=array(
	'Features'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
