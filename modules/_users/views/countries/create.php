<?php
/* @var $this CountriesController */
/* @var $model UsersLocationCountries */

$this->breadcrumbs=array(
	'Countries'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
