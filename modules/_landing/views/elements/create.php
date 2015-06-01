<?php
/* @var $this ElementsController */
/* @var $model LandingElements */

$this->breadcrumbs=array(
	'Landing Elements'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
