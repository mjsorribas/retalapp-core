<?php
/* @var $this PagesController */
/* @var $model LandingPages */

$this->breadcrumbs=array(
	'Pages'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
