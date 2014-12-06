<?php
/* @var $this ItemsController */
/* @var $model TeamItems */

$this->breadcrumbs=array(
	'Team'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
