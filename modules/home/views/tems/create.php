<?php
/* @var $this TemsController */
/* @var $model HomeItems */

$this->breadcrumbs=array(
	'Home Items'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
