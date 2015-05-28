<?php
/* @var $this CitiesController */
/* @var $model UsersLocationCities */

$this->breadcrumbs=array(
	'Cities'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
