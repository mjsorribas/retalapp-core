<?php
/* @var $this ItemsController */
/* @var $model LocationItems */

$this->breadcrumbs=array(
	'Locations'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
